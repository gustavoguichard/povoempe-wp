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

  $('.album-cover').click(function(event) {
    var string = $(event.currentTarget).data('photos');
    var photos_string = string.split('{-}');
    var data = photos_string.map(function(photo) {
      var photo_data = photo.split('{;}');
      return {
        title: photo_data[0],
        href: photo_data[1],
        thumbnail: photo_data[2],
      };
    });
    $.fancybox.open(data, {
      padding: 2,
      helpers: {
        title: {
          type: 'outside'
        },
        thumbs: {
          width: 70,
          height: 70,
          source: function(image) {
            return image.thumbnail;
          },
          position: 'bottom',
        }
      }
    });
    return false;
  });

});