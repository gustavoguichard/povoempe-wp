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

  $('.event-link', '.event-item').on('click', function(event) {
    $(this).closest('.event-item').toggleClass('expanded')
      .find('.event-description').slideToggle();
    event.preventDefault();
  })

});