jQuery(document).ready(function() {
"use strict";

  if (jQuery('#sliderselect').val()=='parallax') {
    jQuery('#parallax_link').show();
    jQuery('#video_link').hide();
  } else if (jQuery('#sliderselect').val()=='video') {
    jQuery('#parallax_link').hide();
    jQuery('#video_link').show();
  } else {
    jQuery('#parallax_link').hide();
    jQuery('#video_link').hide();
  }

  jQuery('#sliderselect').on('change', function() {

  if (jQuery(this).val()=='parallax') {
    jQuery('#parallax_link').show();
    jQuery('#video_link').hide();
  } else if (jQuery(this).val()=='video') {
    jQuery('#parallax_link').hide();
    jQuery('#video_link').show();
  } else {
    jQuery('#parallax_link').hide();
    jQuery('#video_link').hide(); }
  });

  jQuery('.mage-theme-options h3').next('div').slideUp(0);

  jQuery('.mage-theme-options h3').on('click', function() {
    if(jQuery(this).hasClass('open')){
      jQuery(this).removeClass('open').next('div').slideUp(400);
    } else {
      jQuery(this).addClass('open').next('div').slideDown(800);
    }
  });

});