(function ($) {
  Drupal.behaviors.AgendaOverzicht = {
    attach: function (context, settings) {

      $(".agenda-header").click(function(){
        $(this).closest(".agenda-row").find(".agenda-info").toggleClass("agenda-show");
        $(this).closest(".agenda-row").find(".agenda-button").toggleClass("agenda-button-rotate");
      });

      $("#hamburger").click(function(){
        $("#sidebar-left").toggleClass("sidebar-left-show");
      });

    }
  }

})(jQuery);

