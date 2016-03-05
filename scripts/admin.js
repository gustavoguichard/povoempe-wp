jQuery(document).ready(function() {
"use strict";

  jQuery('.mage-theme-options h3').next('div').slideUp(0);

  jQuery('.mage-theme-options h3').on('click', function() {
    if(jQuery(this).hasClass('open')){
      jQuery(this).removeClass('open').next('div').slideUp(400);
    } else {
      jQuery(this).addClass('open').next('div').slideDown(800);
    }
  });

});