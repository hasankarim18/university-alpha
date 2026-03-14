import $ from "jquery";

class MyNotes {
  constructor() {
    console.log("I am a MyNotes object!!!");
    this.selects();
    this.events();
  }

  // selectors
  selects() {
    this.root_url = phpVars.root_url;
    this.rest_nonce = phpVars.rest_nonce;

    // this.deleteButton;
  }

  // events
  events() {
    $("#my-notes").on("click", ".edit-note", this.editNote.bind(this));
    $("#my-notes").on("click", ".update-note", this.updateNote.bind(this));
    $("#my-notes").on("click", ".delete-note", this.deleteNote.bind(this));
    $(".submit-note").on("click", this.createNote.bind(this));
  }

  // methods

  createNote(e) {
    const createUrl = this.root_url + `/wp-json/wp/v2/note`;
    const title = $(".new-note-title").val();
    const content = $(".new-note-body").val();
    console.log(title, content);
    let ourNewPost = {
      title: title,
      content: content,
      status: "publish",
    };
    $.ajax({
      beforeSend: (xhr) => {
        xhr.setRequestHeader("X-WP-Nonce", this.rest_nonce);
      },
      url: createUrl,
      type: "POST",
      data: ourNewPost,
      success: (response) => {
        console.log(response);
        const { id, title, content } = response;
        $(".new-note-title, .new-note-body").val("");
        $(`
            <li data-id="${id}">             
              <input readonly class="note-title-field" type="text" value="${title.raw}">
              <span id="myNoteEdit" class="edit-note"><i class="fa fa-pencil" area-hidden="true"> Edit </i></span>
              <span id="myNoteDelete" class="delete-note"><i class="fa fa-trash" area-hidden="true"> Delete</i></span>

              <textarea readonly class="note-body-field" name="" id="">${content.raw}</textarea>
              <span id="myNoteEdit" class="update-note btn btn--blue btn--small"><i class="fa fa-arrow-right"
                      area-hidden="true"> Save </i></span>
          </li>
          `)
          .prependTo("#my-notes")
          .hide()
          .slideDown();
        // window.location.reload();
      },
      error: (error) => {
        if (
          error.responseText ==
          "You have reached the limit of 4 notes. Please delete"
        ) {
          $(".note-limit-message").addClass("active");
        }
        console.log(error);
      },
    });
  }

  // edit note
  editNote(e) {
    const thisNote = $(e.target).parents("li");
    const noteId = e.target.closest("li").dataset.id;
    if (thisNote.data("state") == "editable") {
      // make read only

      this.makeNoteReadonly(thisNote);
    } else {
      // make editable

      this.makeNoteEditable(thisNote);
    }
  }

  // update note

  updateNote(e) {
    const thisNote = $(e.target).parents("li");
    const noteId = e.target.closest("li").dataset.id;
    console.log(noteId);
    const updateUrl = this.root_url + `/wp-json/wp/v2/note/${noteId}`;
    const title = thisNote.find(".note-title-field").val();
    const content = thisNote.find(".note-body-field").val();
    console.log(title, content);
    let ourUpdatedPost = {
      title: title,
      content: content,
    };
    $.ajax({
      beforeSend: (xhr) => {
        xhr.setRequestHeader("X-WP-Nonce", this.rest_nonce);
      },
      url: updateUrl,
      type: "POST",
      data: ourUpdatedPost,
      success: (response) => {
        console.log("note edited successfully");
        this.makeNoteReadonly(thisNote);
        console.log(response);
      },
      error: (error) => {
        console.log(error);
      },
    });
  }

  makeNoteEditable(thisNote) {
    thisNote
      .find(".edit-note")
      .html('<i class="fa fa-times" area-hidden="true"> Cancel </i>');
    thisNote
      .find(".note-title-field, .note-body-field")
      .removeAttr("readonly")
      .addClass("note-active-field");
    thisNote.find(".update-note").addClass("update-note--visible");
    //
    thisNote.data("state", "editable");
  }

  makeNoteReadonly(thisNote) {
    thisNote
      .find(".edit-note")
      .html('<i class="fa fa-pencil" area-hidden="true"> Edit </i>');
    thisNote
      .find(".note-title-field, .note-body-field")
      .prop("readonly", true)
      .removeClass("note-active-field");
    thisNote.find(".update-note").removeClass("update-note--visible");
    thisNote.data("state", "cancel");
  }

  deleteNote(e) {
    const thisNote = $(e.target).parents("li");
    const noteId = e.target.closest("li").dataset.id;
    console.log(noteId);
    const deleteUrl = this.root_url + `/wp-json/wp/v2/note/${noteId}`;

    $.ajax({
      beforeSend: (xhr) => {
        xhr.setRequestHeader("X-WP-Nonce", this.rest_nonce);
      },
      url: deleteUrl,
      type: "DELETE",

      success: (response) => {
        console.log("note deleted");
        thisNote.slideUp();
        console.log(response);
        if (response.user_note_count < 5) {
          $(".note-limit-message").removeClass("active");
        }
      },
      error: (error) => {
        console.log(error);
      },
    });
  }
  //
}

export default MyNotes;

//
