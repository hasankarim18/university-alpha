import $ from "jquery";

class Search {
  // 1. describe and create / initiate our object
  constructor() {
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
  }

  // 2. events
  events() {
    this.openButton.on("click", () => {
      this.openOverlay();
    });
    this.closeButton.on("click", this.closeOverlay.bind(this));
  }

  // 3. methods (functions, actions....)

  openOverlay() {
    this.searchOverlay.addClass("search-overlay--active");
  }

  closeOverlay() {
    this.searchOverlay.removeClass("search-overlay--active");
  }
}

export default Search;
