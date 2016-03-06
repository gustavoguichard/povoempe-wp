jQuery(document).ready(function( $ ) {
"use strict";

  // Menu Scroll
  $('.menu a').click(function(event) {
    $('html, body').animate({ scrollTop: $($(this).attr('href')).offset().top }, 700);
  });

  // Theme members
  function toggleGuardDescription(event) {
    var effect = event.type === 'mouseleave' ? 'fadeOut' : 'fadeToggle'
    $(this).find('.info')[effect]("fast", "linear");
  }
  $('.member .image').hover(toggleGuardDescription).click(toggleGuardDescription);

  // Single Projects
  function closeEstabs(event) {
    $('.project .estab-thumb').removeClass('active');
    $('.single.active').slideUp('2500', 'swing').removeClass('active');
    event.preventDefault();
  }

  $('.project .estab-link').on('click', function(event) {
    var $image = $('img', this)
    var id = $(this).data('post-id')
    var shouldOpen = !$image.hasClass('active')
    closeEstabs(event)

    if (shouldOpen) {
      $image.addClass('active');
      $('.single[data-post-id="' + id + '"]').addClass('active').slideToggle( '2500', 'swing' );
    }
  });

  // Single Project close button
  $('.single .close').click(closeEstabs);

});