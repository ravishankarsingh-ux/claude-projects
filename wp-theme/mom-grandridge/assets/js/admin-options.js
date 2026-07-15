/* Theme Options page: wp.media image-picker bindings.
   Uses only the media uploader bundled with WordPress core. */
(function ($) {
  "use strict";

  $(document).on("click", ".mgs-media-button", function (e) {
    e.preventDefault();
    var button = $(this);
    var targetId = button.data("target");
    var input = $("#" + targetId);
    var preview = input.siblings(".mgs-media-preview");
    var removeBtn = button.siblings(".mgs-media-remove");

    var frame = wp.media({
      title: "Select or Upload Image",
      button: { text: "Use this image" },
      multiple: false
    });

    frame.on("select", function () {
      var attachment = frame.state().get("selection").first().toJSON();
      input.val(attachment.id);
      var thumbUrl = (attachment.sizes && attachment.sizes.medium)
        ? attachment.sizes.medium.url
        : attachment.url;
      preview.find("img").attr("src", thumbUrl);
      preview.show();
      removeBtn.show();
    });

    frame.open();
  });

  $(document).on("click", ".mgs-media-remove", function (e) {
    e.preventDefault();
    var button = $(this);
    var targetId = button.data("target");
    var input = $("#" + targetId);
    input.val("");
    input.siblings(".mgs-media-preview").hide();
    button.hide();
  });
})(jQuery);
