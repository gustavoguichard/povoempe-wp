jQuery(document).ready(function( $ ) {
"use strict";

  // Menu Scroll
  $('.menu a').click(function(event) {
    $('html, body').animate({ scrollTop: $($(this).attr('href')).offset().top }, 700);
    event.preventDefault();
  });

  // Theme members
  $('.member .image').hover(function(event) {
    $(this).find('.info').fadeToggle("fast", "linear");
  });

  // Single Projects
  $('.home .single').hide(); // hide all .single projects

  $('.project a').on('click', function(e) {

    if ($(this).children('img').hasClass('active')) {

      $(this).children('img').removeClass('active');
      $('.single.active').slideToggle('2500', 'swing').removeClass('active');

    } else {

      var item = $(this); // item me clicked on
      $('.project a').children('img').removeClass('active');
      item.children('img').addClass('active'); // toogle .active class on clicked item

      var image = item.children('img').attr( 'src' ); // select image in item
      $('.single.active').slideToggle('2500', 'swing').removeClass('active');
      $('.single img[src="' + image + '"]').parents('.single').addClass('active').slideToggle( '2500', 'swing' ); // toggle .single project which have same image!

      $(window).scrollTop(item.offset().top); // move to active projects details

    }

    e.preventDefault();
  });

  // Single Project close button
  $('.single h2 a').click(function(e) {

    $('.project a').children('img').removeClass('active');
    $(this).parents('.single').slideUp('2500', 'swing').removeClass('active'); // remove .active class from matching image

    e.preventDefault();
  });

});