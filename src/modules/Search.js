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
    this.openButton.on("click", () => {
      this.openOverlay();
    });

    // /
    this.closeButton.on("click", this.closeOverlay.bind(this));
    // keypress dispather event
    this.document.on("keydown", this.keypressDispatcher.bind(this));

    // debouncer
    this.searchField.on("keyup", this.typingLogic.bind(this));
  }

  // 3. methods (functions, actions....)

  typingLogic(e) {
    if (this.searchField.val() != this.previousValue) {
      clearTimeout(this.typepingTimeout);
      if (this.searchField.val()) {
        // do something
        if (!this.isSpinnerVisible) {
          this.resultsDiv.html(`<div class="spinner-loader"> </div>`);
          this.isSpinnerVisible = true;
          this.typepingTimeout = setTimeout(this.getResults.bind(this), 1000);
        }
      } else {
        this.resultsDiv.html("");
        this.isSpinnerVisible = false;
      }
    }

    this.previousValue = this.searchField.val();
  }
  getResults() {
    // console.log("timeout logic");
    this.resultsDiv.html("Imagine real search herer");
    this.isSpinnerVisible = false;
  }

  keypressDispatcher(e) {
    // s = 83 , esc = 27
    // console.log(e.keyCode);
    if (
      e.keyCode == 83 &&
      !this.isOverlayOpen &&
      $("input, textarea").is(":focus")
    ) {
      this.openOverlay();
    }
    if (e.keyCode == 27 && this.isOverlayOpen) {
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
