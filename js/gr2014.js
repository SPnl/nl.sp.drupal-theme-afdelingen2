(function($) {
  $(document).ready(function(){

  // Top
    $("a[href='#top']").click(function() {
        $("html, body").animate({ scrollTop: 0 }, "slow");
          return false;
    });

  // Content tabs display
    $('.content-tab').hide();
    $('#tab-overzicht').show();
    $('.nav-tabs a').click(function(e){
      e.preventDefault();
      $('.nav-tabs li.active').removeClass('active');
      var target = $(this).attr('href');
      $('.content-tab:visible').hide();
      $(target).show();
      $(this).parent().addClass('active');
      $("html, body").animate({ scrollTop: 0 }, "fast");
     });

  // nieuws tabs display
    $('.nieuws-item').hide();
    $('.nieuws-item').first().show();
    $('.nieuws-titel').first().addClass('active');
    //$('#tab-overzicht').show();
    $('.nieuws-titel a').click(function(e){
      e.preventDefault();
      $('.nieuws-titels li.active').removeClass('active');
      var target = $(this).attr('href');
      $('.nieuws-item:visible').hide();
      $(target).show();
      $(this).parent().addClass('active');
    });

  // achtergrondinfo display
    $('.achtergrond-item').hide();
    //$('#tab-overzicht').show();
    $('.kandidaat .meer-over a').click(function(e){
      e.preventDefault();
      var target = $(this).attr('href');
      $(target).show();
    });
    $('.achtergrond-item a').click(function(e){
      e.preventDefault();
      $('.achtergrond-item:visible').hide();
    });

  // Chapter navigation
    $('.chapter').hide();
    $('.chapter:first').show();
    $('.nav-chapters a').click(function(e){
      e.preventDefault();
      $('.nav-chapters li.active').removeClass('active');
      var target = $(this).attr('href');
      $('.chapter:visible').hide();
      $(target).show();
      $(this).parent().addClass('active');
    });	
  });
})(jQuery);
