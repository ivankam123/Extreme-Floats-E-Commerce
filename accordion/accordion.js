(function ($) {
  /**
   * initializeBlock
   *
   * Adds custom JavaScript to the block HTML.
   *
   * @date    15/4/19
   * @since   1.0.0
   *
   * @param   object $block The block jQuery element.
   * @param   object attributes The block attributes (only available when editing).
   * @return  void
   */
  var initializeBlock = function ($block) {
    // Accordion Functionality
    $(".accordion-button").click(function () {
      var item = $(this).parents(".accordion");
      if (item.hasClass("open-tab")) {
        item.removeClass("open-tab");
        item.children(".accordion-text").slideUp(400);
      } else {
        item.addClass("open-tab");
        item.children(".accordion-text").slideDown(400);
        $("html,body").animate({ scrollTop: item.offset().top }, 500);
      }
    });
  };

  // Initialize each block on page load (front end).
  $(document).ready(function () {
    initializeBlock($("body"));
  });

  // Initialize dynamic block preview (editor).
  if (window.acf) {
    window.acf.addAction(
      "render_block_preview/type=accordion",
      initializeBlock
    );
  }
})(jQuery);
