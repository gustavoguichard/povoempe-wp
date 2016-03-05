jQuery(document).ready(function( $ ) {
"use strict";

  $('.header h1').css('margin-left', '-'+($('.header > h1 > a').width()/2)+'px');
  $('.header .menu .container .left-side-menu').css('padding-right', ($('.header > h1 > a').width()/2)+60+'px');
  $('.header .menu .container .right-side-menu').css('padding-left', ($('.header > h1 > a').width()/2)+60+'px');

  // Menu Scroll
  $('.menu a').click(function(event) {
    $('html, body').animate({ scrollTop: $($(this).attr('href')).offset().top }, 2000);
    event.preventDefault();
  });

  // Theme members
  $('.member .image').hover(function(event) {
    $(this).find('.info').fadeToggle("fast", "linear");
  });

  // Single Projects
  $('.home .single').hide(); // hide all .single projects

  $('.button-group li a').click(function() {
    $('.single h2 a').click();
  });

  $('body').on('click','.project a', function(e) {

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

  /*
  var menumiddle = Math.ceil($(".header div.menu div.container > ul > li").length/2);
  */

  /*
  $(".header div.menu div.container > ul > li:eq("+menumiddle+")").addClass('right-side');
  */

  /*
  var leftwidth = 0;
  var rightwidth = 0;
  */

  /*
  $(".header div.menu div.container > ul > li").each(function(index, element) {

    if( index < menumiddle ) {
      leftwidth+=$(this).width();
    } else {
      rightwidth+=$(this).width();
    }

    if( index == menumiddle ) {
      $(this).addClass('right-side');
    }

  });
  */

  /*
  if ( leftwidth > rightwidth ) {
    $(".header div.menu div.container > ul > li:last").css('padding-right', (leftwidth-rightwidth)+'px');
  } else {
    $(".header div.menu div.container > ul > li:first").css('padding-left', (rightwidth-leftwidth)+'px');
  }
  */

  var gethash = window.location.hash.slice(0,-4);

  if ( gethash!='' ) {
    window.location.hash = '';
    setTimeout(function(){  $('html, body').animate({ scrollTop: $(gethash).offset().top }, 2000); },500);
  }

  var page = 1;
  var maxpage = parseInt( $('.project').attr('data-id').replace('founded',''));

  $('#more').click(function() {

    $(this).addClass('loading');

    page++;

    $.get(cururl+'/?page='+page, function(data) {
      var posts = $(data).find('.project div');
      // init
      $('#more').removeClass('loading');
      if ( page>=maxpage ) { $('#more').hide(); }
      $('.project').append(posts).isotope('appended', posts);
    });
  });

  // Projects Isotope Setup

  // init
  var $container = $('.project').isotope({
    itemSelector: '.project div',
    layoutMode: 'fitRows'
  });

  // bind filter button click
  $('.button-group a').on( 'click', function(event) {
    var filterValue = $( this ).attr('data-filter');
    $container.isotope({ filter: filterValue });
    event.preventDefault();
  });

  // change is-checked class on buttons
  $('.button-group').each( function( i, buttonGroup ) {
    var $buttonGroup = $( buttonGroup );
      $buttonGroup.on( 'click', 'a', function() {
      $buttonGroup.find('.active').removeClass('active');
      $( this ).addClass('active');
    });
  });

});