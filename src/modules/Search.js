import $ from "jquery";

class Search {
  // 1. describe and create / initiate our object
  constructor() {
    this.searchHtml();
    this.apiUrl = phpVars.site_url;
    this.rootUrl = phpVars.root_url;
    this.isOverlayOpen = false;
    this.isSearching = false;
    // alert("I am a search!!!");
    this.selectElements();
    this.events();
    //this.openOverlay();
  }

  // 1.1 Select  or define

  selectElements() {
    this.openButton = $(".js-search-trigger");
    this.searchOverlay = $(".search-overlay");
    this.closeButton = $(".search-overlay__close");
    this.document = $(document);
    this.searchField = $("#search-term");
    this.typepingTimeout;
    this.resultsDiv = $("#search-overlay__results");
    this.isSpinnerVisible = false;
    this.previousValue;
  }

  // 2. events
  events() {
    this.openButton.on("click", this.openOverlay.bind(this));
    this.closeButton.on("click", this.closeOverlay.bind(this));
    $(document).on("keydown", this.keypressDispatcher.bind(this));
    this.searchField.on("keyup", this.typingLogic.bind(this));
  }

  // 3. methods (functions, actions....)

  typingLogic() {
    if (this.searchField.val() != this.previousValue) {
      clearTimeout(this.typingTimer);

      if (this.searchField.val()) {
        if (!this.isSpinnerVisible) {
          this.resultsDiv.html('<div class="spinner-loader"></div>');
          this.isSpinnerVisible = true;
        }
        this.typingTimer = setTimeout(this.getResults.bind(this), 750);
      } else {
        this.resultsDiv.html("");
        this.isSpinnerVisible = false;
      }
    }

    this.previousValue = this.searchField.val();
  }

  resultUi({ results, type }) {
    return `
       
      ${(() => {
        // console.log(results);
        if (results.length > 0) {
          return `
          <ul class="link-list min-list">
            ${results
              .map((info) => {
                return `<li><a href="${info.permalink}">${info.title}</a></li>`;
              })
              .join("")}
          </ul>
        `;
        } else {
          return `<h3>No ${type}  found. View all <a href="${
            this.rootUrl
          }/${type.toLowerCase()}">${type}</a>  </h3>`;
        }
      })()}
     
    `;
  }
  getResults() {
    // console.log("timeout logic");
    let search_url = `${
      this.apiUrl
    }/wp-json/university/v3/search?key=${this.searchField.val()}`;

    $.getJSON(search_url, (results) => {
      this.resultsDiv.html(`
          <div class="row"> 
            <div class="one-third"> 
              <h2 class="search-overlay__section-title"> General Information </h2>
             ${this.resultUi({
               results: results.generalInfo,
               type: "Post",
             })}
            </div>
            <div class="one-third"> 
                <h2 class="search-overlay__section-title"> Programs </h2>
                ${this.resultUi({
                  results: results.programs,
                  type: "Programs",
                })}
                <h2 class="search-overlay__section-title"> Professors </h2>
                 ${(() => {
                   // console.log(results.professors);
                   if (results.professors.length > 0) {
                     return `
                        <ul style="background:white;padding:0;margin:0; display:flex;flex-wrap:wrap;justify-content:flex-start;align-items:flex-start; gap:5px;width:100%;" class="professor-card">
                          ${results.professors
                            .map((info) => {
                              console.log(info);
                              return `
                                <li style="background:white;padding:0;margin:o;" class="professor-card__list-item">                                 
                                   <a class="professor-card" href="${info.permalink}" >
                                     <img class="professor-card__image" src="${info.image}" alt="${info.title}"/>
                                     <span class="professor-card__name">${info.title}</span>
                                   </a>
                                </li>
                              `;
                            })
                            .join("")}
                        </ul>
                      `;
                   } else {
                     return `<h3>No Professors  found.  </h3>`;
                   }
                 })()}
     

            </div>
            <div class="one-third">
                <h2 class="search-overlay__section-title"> Campuses </h2>
                   ${this.resultUi({
                     results: results.campuses,
                     type: "Campuses",
                   })}
                <h2 class="search-overlay__section-title">Events </h2> 
                 ${(() => {
                   if (results.events.length > 0) {
                     return `
                        <ul class="">
                          ${results.events
                            .map((info) => {
                              return `
                              <div class="event-summary">
   
                              <a style="background-color:${info.bg_color};" class="event-summary__date t-center" href="#">
                                  <span class="event-summary__month">
                                      ${info.month}
                                  </span>
                                  <span class="event-summary__day">
                                     ${info.day}
                                  </span>
                              </a>
                              <div class="event-summary__content">
                                  <h5 class="event-summary__title headline headline--tiny">
                                      <a href="${info.permalink}" >
                                         ${info.title}
                                      </a>
                                  </h5>

                                  <p> 
                                      ${info.description}
                                  
                                      <a href="${info.permalink}" class="nu gray">Learn more</a>
                                  </p>
                              </div>
                          </div>
                              `;
                            })
                            .join("")}
                        </ul>
                      `;
                   } else {
                     return `<h3>No Events  found. View all <a href="${this.rootUrl}/event">Events</a>  </h3>`;
                   }
                 })()}
            </div>
          </div>
        `);
    });

    this.isSpinnerVisible = false;
  }

  keypressDispatcher(e) {
    // s = 83 , esc = 27
    //  console.log(e.keyCode);
    if (
      e.key == "s" &&
      !this.isOverlayOpen &&
      !$("input, textarea").is(":focus")
    ) {
      this.openOverlay();
    }
    if (e.key == "Escape" && this.isOverlayOpen) {
      this.closeOverlay();
    }
  }

  openOverlay() {
    this.searchOverlay.addClass("search-overlay--active");
    $("body").addClass("body-no-scroll");
    this.searchField.val("");
    this.resultsDiv.html("");
    setTimeout(() => {
      this.searchField.focus();
    }, 301);
    this.isOverlayOpen = true;

    // console.log("overlay is open");
  }

  closeOverlay() {
    this.searchOverlay.removeClass("search-overlay--active");
    $("body").removeClass("body-no-scroll");
    this.isOverlayOpen = false;
    // console.log("overlay is closed");
  }

  // search html
  searchHtml() {
    $("body").append(`
      <div class="search-overlay">
    <div class="search-overlay__top">
        <div class="container">
            <i class="fa fa-search search-overlay__icon" aria-hidden="true"></i>
            <input type="text" class="search-term" placeholder="What are you looking for?" id="search-term"
                autocomplete="off">
            <i id="search-close-button" class="fa fa-window-close search-overlay__close" aria-hidden="true"></i>
        </div>
    </div>

        <div class="container">
            <div id="search-overlay__results"></div>
        </div>
    </div>
      `);
  }
}

export default Search;
