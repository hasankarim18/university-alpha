import $ from "jquery";

class Search {
  // 1. describe and create / initiate our object
  constructor() {
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
        this.typingTimer = setTimeout(this.getResults.bind(this), 2000);
      } else {
        this.resultsDiv.html("");
        this.isSpinnerVisible = false;
      }
    }

    this.previousValue = this.searchField.val();
  }
  getResults() {
    // console.log("timeout logic");
    let url = `http://university-alpha.local/wp-json/wp/v2/posts?search=${this.searchField.val()}`;
    $.getJSON(url, (posts) => {
      console.log(posts);
      if (posts.length > 0) {
        const ul = document.createElement("ul");

        posts.map((post) => {
          const li = document.createElement("li");
          const a = document.createElement("a");
          a.href = post.link;
          a.textContent = post.title.rendered;
          li.appendChild(a);
          ul.appendChild(li);
        });

        this.resultsDiv.html(ul.outerHTML);
        this.isSpinnerVisible = false;
      } else {
        this.resultsDiv.html(
          `<h2>No results found for <u>${this.searchField.val()} ${this.searchField.val()}</u></h2>`,
        );
        this.isSpinnerVisible = false;
      }
      // const first_title = posts[0].title.rendered;

      // this.resultsDiv.html(first_title);
    });
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
      setTimeout(() => {
        this.searchField.focus();
      }, 500);
    }
    if (e.key == "Escape" && this.isOverlayOpen) {
      this.closeOverlay();
    }
  }

  openOverlay() {
    this.searchOverlay.addClass("search-overlay--active");
    $("body").addClass("body-no-scroll");
    this.isOverlayOpen = true;
    // console.log("overlay is open");
  }

  closeOverlay() {
    this.searchOverlay.removeClass("search-overlay--active");
    $("body").removeClass("body-no-scroll");
    this.isOverlayOpen = false;
    // console.log("overlay is closed");
  }
}

export default Search;
