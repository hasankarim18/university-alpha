import $ from "jquery";

class Search {
  // 1. describe and create / initiate our object
  constructor() {
    this.searchHtml();
    this.apiUrl = phpVars.site_url;
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
  getResults() {
    // console.log("timeout logic");
    let url = `${
      this.apiUrl
    }/wp-json/wp/v2/posts?search=${this.searchField.val()}`;
    $.getJSON(url, (posts) => {
      console.log(posts);
      if (posts.length > 0) {
        this.resultsDiv.html(`
          <h2 class="search-overlay__section-title">General Information </h2>
          <ul class="link-list min-list">  
            ${(() => {
              return posts
                .map((post) => {
                  return `<li class=""> <a href="${post.link}">${post.title.rendered}</a>  </li>`;
                })
                .join("");
            })()}
           
          </ul>
        `);

        // this.isSpinnerVisible = false;
      } else {
        this.resultsDiv.html(
          `<h2>No results found for <u>${this.searchField.val()}</u></h2>`,
        );
        // this.isSpinnerVisible = false;
      }
      this.isSpinnerVisible = false;
    }); // get json
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
      <div class="search-overlay ">
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
