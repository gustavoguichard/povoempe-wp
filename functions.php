<?php

if ( ! isset( $content_width ) ) $content_width = 960;

/* add_theme_support( 'custom-header' ); //custom header/used for header image
add_theme_support( 'custom-background' ); //custom backgournd/used for paralax background */
add_theme_support( 'menus' ); //enable custom menus
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-thumbnails'); //add support for thumbnails
add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' )); //add support for post formats / audio, video, ...

//thumbnails dimensions
add_image_size('magethemes_zen_portfolio', 480, 480, true);

//registering navigation menu
register_nav_menu( 'left-side-menu', 'Left Side Menu' );
register_nav_menu( 'right-side-menu', 'Right Side Menu' );

//create widgets
function magethemes_zen_create_widget( $name, $id, $description ) {

  $args = array(
    'name' => __( $name ),
    'id' => $id,
    'description' => $description,
    'before_widget' => '<div class="zen_widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4>',
    'after_title' => '</h4>'
  );

  register_sidebar( $args );

} //create widgets ends!

magethemes_zen_create_widget( 'Footer widgets', 'magethemes_zen_footer_widget_id', 'Widget area in footer of the page for blog posts' );

//load the theme CSS
function magethemes_zen_theme_styles() {

  $theme_color = get_option('magethemes_zen_theme_color');

  wp_enqueue_style( 'magethemes_zen_main', get_template_directory_uri() . '/style.css' );

  if ($theme_color == 'blue') {
    wp_enqueue_style( 'magethemes_zen_color', get_template_directory_uri() . '/blue.css' );

  } else if($theme_color == 'purple') {
    wp_enqueue_style( 'magethemes_zen_color', get_template_directory_uri() . '/purple.css' );

  } else {
    wp_enqueue_style( 'magethemes_zen_color', get_template_directory_uri() . '/green.css' );

  }

  wp_enqueue_style( 'magethemes_zen_font', get_template_directory_uri() . '/font-awesome-4.0.3/css/font-awesome.min.css' );

} //load the theme CSS ends!

//load the theme JS
function magethemes_zen_theme_js() {

  wp_enqueue_script( 'magethemes_zen_myjquery', get_template_directory_uri() . '/scripts/jquery-1.11.0.min.js', array('jquery'), '', true );
  wp_enqueue_script( 'magethemes_zen_flexslider', get_template_directory_uri() . '/scripts/flexslider/jquery.flexslider-min.js', array('jquery'), '', true );

  $slider = get_option('magethemes_zen_slider');

  if ($slider == 'video') {
    wp_enqueue_script( 'magethemes_zen_vtplayer', get_template_directory_uri() . '/scripts/jquery.mb.YTPlayer.js', array('jquery'), '', true );

  }

  wp_enqueue_script( 'magethemes_zen_isotope', get_template_directory_uri() . '/scripts/isotope.pkgd.min.js', array('jquery'), '', true );

  if ($slider == 'parallax') {
    wp_enqueue_script( 'magethemes_zen_parallax', get_template_directory_uri() . '/scripts/jquery.parallax-1.1.3.js', array('jquery'), '', true );

  }

  wp_enqueue_script( 'magethemes_zen_google_map', 'https://maps.googleapis.com/maps/api/js?sensor=false' );
  wp_enqueue_script( 'magethemes_zen_theme_js', get_template_directory_uri() . '/scripts/theme.js', array('jquery'), '1.0.0', true );

} //load the theme JS ends!

add_action( 'wp_enqueue_scripts', 'magethemes_zen_theme_js' );
add_action( 'wp_enqueue_scripts', 'magethemes_zen_theme_styles' );


// Custom admin style
function magethemes_zen_custom_admin_style() {
  echo '<link rel="stylesheet" type="text/css" href="' . get_stylesheet_directory_uri() . '/admin.css" />';
}
add_action('admin_head', 'magethemes_zen_custom_admin_style');

// Custom admin js
function magethemes_zen_admin_init() {
  wp_enqueue_script('magethemes_zen_admin_jquery', get_template_directory_uri() . '/scripts/admin.js' );
}
add_action('admin_init', 'magethemes_zen_admin_init');

// Google maps initalize
function magethemes_zen_jScriptUtilities() {
  $theme_color=get_option('magethemes_zen_theme_color');
  echo "
  <!-- Google Map -->
  <script>
    function initialize() {
      var myLatlng = new google.maps.LatLng(".get_option('magethemes_zen_theme_map_lat').", ".get_option('magethemes_zen_theme_map_lng').");
      var map_options = {
        zoom: ".get_option('magethemes_zen_theme_map_zoom').",
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        center: myLatlng,
        scrollwheel: ";
    if (get_option('magethemes_zen_theme_map_scrollwhell')) { echo "false"; } else { echo "true"; }
    echo ",
        disableDefaultUI: true
      }

      var map = new google.maps.Map(document.getElementById('map_canvas'), map_options);";
    if ($theme_color=='blue'){
      echo "var myIcon = new google.maps.MarkerImage('".get_template_directory_uri()."/images/icon-marker-blue-2x.png', null, null, null, new google.maps.Size(34,45));";
    } else if ($theme_color=='purple'){
      echo "var myIcon = new google.maps.MarkerImage('".get_template_directory_uri()."/images/icon-marker-purple-2x.png', null, null, null, new google.maps.Size(34,45));";
    } else {
     echo "var myIcon = new google.maps.MarkerImage('".get_template_directory_uri()."/images/icon-marker-2x.png', null, null, null, new google.maps.Size(34,45));";
    }

      echo "var marker = new google.maps.Marker({
        position: myLatlng,
        map: map,
        icon: myIcon
      });

      ";

    if ( get_option('magethemes_zen_theme_map_bw') ){
      echo "
      var styles = [
        {
          featureType: \"all\",
          stylers: [
            { saturation: -100 }
          ]
        }
      ];";
    
    echo "
      map.setOptions({styles: styles});
      /* Ends here! */";
    
	}
	echo "}

    google.maps.event.addDomListener(window, 'load', initialize);
  </script>
  <!-- Google Map Ends! -->

  <!-- home url for isotope -->
  <script>
  var cururl = '".home_url()."';
  </script>";

}

add_action('wp_head', 'magethemes_zen_jScriptUtilities');

// Function for ACF
define( 'ACF_LITE', false );

if ( function_exists("register_field_group") ) {
  register_field_group(array (
    'id' => 'magethemes_zen_portfolio',
    'title' => 'Portfolio',
    'fields' => array (
    array (
        'key' => 'field_530dbe9bf26dfc',
        'label' => 'Description',
        'name' => 'magethemes_zen_portfolio_description',
        'type' => 'wysiwyg',
        'instructions' => '',
        'required' => 1,
        'default_value' => '',
        'toolbar' => 'full',
        'media_upload' => 'yes',
      ),
      array (
        'key' => 'field_530f30310a165',
        'label' => 'Image',
        'name' => 'magethemes_zen_image',
        'type' => 'image',
        'instructions' => 'Required minimum size of the image is 480px by 480px',
        'required' => 1,
        'save_format' => 'id',
        'preview_size' => 'full',
        'library' => 'all',
      ),

    ),
    'location' => array (
      array (
        array (
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'portfolio',
          'order_no' => 0,
          'group_no' => 0,
        ),
      ),
    ),
    'options' => array (
      'position' => 'normal',
      'layout' => 'no_box',
      'hide_on_screen' => array (
        0 => 'permalink',
        1 => 'the_content',
        2 => 'excerpt',
        3 => 'custom_fields',
        4 => 'discussion',
        5 => 'comments',
        6 => 'revisions',
        7 => 'slug',
        8 => 'author',
        9 => 'format',
        10 => 'featured_image',
        11 => 'categories',
        12 => 'tags',
        13 => 'send-trackbacks',
      ),
    ),
    'menu_order' => 0,
  ));
  register_field_group(array (
    'id' => 'magethemes_zen_services',
    'title' => 'Services',
    'fields' => array (
      array (
        'key' => 'field_30dbe9bf26fc',
        'label' => 'Description',
        'name' => 'magethemes_zen_services_description',
        'type' => 'wysiwyg',
        'instructions' => 'Description of service',
        'required' => 1,
        'default_value' => '',
        'toolbar' => 'basic',
        'media_upload' => 'no',
      ),
      array (
        'key' => 'field_530dc1b771637',
        'label' => 'Icon',
        'name' => 'magethemes_zen_service_icon',
        'type' => 'text',
        'instructions' => 'Insert icon shortcode you want to use for this item, complete list is available here <a href="http://fortawesome.github.io/Font-Awesome/cheatsheet/" target="_blank">Font Awesome Cheatsheet</a>',
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      ),
    ),
    'location' => array (
      array (
        array (
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'service',
          'order_no' => 0,
          'group_no' => 0,
        ),
      ),
    ),
    'options' => array (
      'position' => 'normal',
      'layout' => 'no_box',
      'hide_on_screen' => array (
        0 => 'permalink',
        1 => 'the_content',
        2 => 'excerpt',
        3 => 'custom_fields',
        4 => 'discussion',
        5 => 'comments',
        6 => 'revisions',
        7 => 'slug',
        8 => 'author',
        9 => 'format',
        10 => 'featured_image',
        11 => 'categories',
        12 => 'tags',
        13 => 'send-trackbacks',
      ),
    ),
    'menu_order' => 0,
  ));
  register_field_group(array (
    'id' => 'magethemes_zen_slider',
    'title' => 'Slider',
    'fields' => array (

      array (
        'key' => 'field_d530dc1b771637',
        'label' => 'Subtitle',
        'name' => 'magethemes_zen_slider_subtitle',
        'type' => 'text',
        'instructions' => 'optional subtitle above slider image and under main title',
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_r530dc1b771637',
        'label' => 'Slider - line 2',
        'name' => 'magethemes_zen_slider_subtitle_2',
        'type' => 'text',
        'instructions' => 'optional subtitle above slider image and under main subtitle',
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      ),
    ),
    'location' => array (
      array (
        array (
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'slider',
          'order_no' => 0,
          'group_no' => 0,
        ),
      ),
    ),
    'options' => array (
      'position' => 'normal',
      'layout' => 'no_box',
      'hide_on_screen' => array (
        0 => 'permalink',
        1 => 'the_content',
        2 => 'excerpt',
        3 => 'custom_fields',
        4 => 'discussion',
        5 => 'comments',
        6 => 'revisions',
        7 => 'slug',
        8 => 'author',
        9 => 'format',
        10 => 'featured_image',
        11 => 'categories',
        12 => 'tags',
        13 => 'send-trackbacks',
      ),
    ),
    'menu_order' => 0,
  ));
  $slider=get_option('magethemes_zen_slider');
  if($slider!='video' && $slider!='parallax'){
  register_field_group(array (
    'id' => 'magethemes_zen_slider_img',
    'title' => 'Slider image',
    'fields' => array (

   array (
        'key' => 'field_5319dcfa31133',
        'label' => 'Image',
        'name' => 'magethemes_zen_slider_image',
        'type' => 'image',
        'instructions' => '',
        'required' => 1,
        'save_format' => 'url',
        'preview_size' => 'full',
        'library' => 'all',
      ),
    ),
    'location' => array (
      array (
        array (
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'slider',
          'order_no' => 0,
          'group_no' => 0,
        ),
      ),
    ),
    'options' => array (
      'position' => 'normal',
      'layout' => 'no_box',
      'hide_on_screen' => array (
        0 => 'permalink',
        1 => 'the_content',
        2 => 'excerpt',
        3 => 'custom_fields',
        4 => 'discussion',
        5 => 'comments',
        6 => 'revisions',
        7 => 'slug',
        8 => 'author',
        9 => 'format',
        10 => 'featured_image',
        11 => 'categories',
        12 => 'tags',
        13 => 'send-trackbacks',
      ),
    ),
    'menu_order' => 0,
  ));
  }
  register_field_group(array (
    'id' => 'magethemes_zen_team-member',
    'title' => 'Team Member',
    'fields' => array (
      array (
        'key' => 'field_530f611e52369',
        'label' => 'Position',
        'name' => 'magethemes_zen_position',
        'type' => 'text',
        'instructions' => 'Team member position',
        'default_value' => '',
        'placeholder' => 'position',
        'prepend' => '',
        'append' => '',
        'formatting' => 'none',
        'maxlength' => '',
      ),
    array (
        'key' => 'field_530dbe9bf26fc',
        'label' => 'Description',
        'name' => 'magethemes_zen_member_description',
        'type' => 'wysiwyg',
        'instructions' => '',
        'required' => 1,
        'default_value' => '',
        'toolbar' => 'basic',
        'media_upload' => 'no',
      ),
      array (
        'key' => 'field_530f6faed5d9f',
        'label' => 'Twitter Profile',
        'name' => 'magethemes_zen_twitter_profile',
        'type' => 'text',
        'instructions' => 'Twitter profile link goes here',
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'none',
        'maxlength' => '',
      ),
    array (
        'key' => 'field_530f6f31d5d9e',
        'label' => 'Facebook Profile',
        'name' => 'magethemes_zen_facebook_profile',
        'type' => 'text',
        'instructions' => 'Facebook profile link goes here',
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'none',
        'maxlength' => '',
      ),
    array (
        'key' => 'field_530f729461280',
        'label' => 'Pinterest Profile',
        'name' => 'magethemes_zen_pinterest_profile',
        'type' => 'text',
        'instructions' => 'Pinterest profile link goes here',
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'none',
        'maxlength' => '',
      ),
    array (
        'key' => 'field_530f72c861281',
        'label' => 'Instagram Profile',
        'name' => 'magethemes_zen_instagram_profile',
        'type' => 'text',
        'instructions' => 'Instagram profile link goes here',
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'none',
        'maxlength' => '',
      ),
    array (
        'key' => 'field_de530f72c861281',
        'label' => 'Dribbble Profile',
        'name' => 'magethemes_zen_dribbble_profile',
        'type' => 'text',
        'instructions' => 'Dribbble profile link goes here',
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'none',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_530f72456127e',
        'label' => 'Google Profile',
        'name' => 'magethemes_zen_google_profile',
        'type' => 'text',
        'instructions' => 'Google+ profile link goes here',
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'none',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_530f72726127f',
        'label' => 'LinkedIn Profile',
        'name' => 'magethemes_zen_linkedin_profile',
        'type' => 'text',
        'instructions' => 'LinkedIn profile link goes here',
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'none',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_530f7a39c105a',
        'label' => 'Image',
        'name' => 'magethemes_zen_member_image',
        'type' => 'image',
        'required' => 1,
        'save_format' => 'url',
        'preview_size' => 'thumbnail',
        'library' => 'all',
      ),
    ),
    'location' => array (
      array (
        array (
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'member',
          'order_no' => 0,
          'group_no' => 0,
        ),
      ),
    ),
    'options' => array (
      'position' => 'normal',
      'layout' => 'no_box',
      'hide_on_screen' => array (
        0 => 'permalink',
        1 => 'the_content',
        2 => 'excerpt',
        3 => 'custom_fields',
        4 => 'discussion',
        5 => 'comments',
        6 => 'revisions',
        7 => 'slug',
        8 => 'author',
        9 => 'format',
        10 => 'featured_image',
        11 => 'categories',
        12 => 'tags',
        13 => 'send-trackbacks',
      ),
    ),
    'menu_order' => 0,
  ));
}

// Register custom post types

// Slider
add_action( 'init', 'magethemes_zen_register_cpt_slider' );

function magethemes_zen_register_cpt_slider() {
  $labels = array(
    'name' => 'Slider',
    'singular_name' => 'Slide',
    'add_new' => 'Add New',
    'add_new_item' => 'Add New Slide',
    'edit_item' => 'Edit Slide',
    'new_item' => 'New Slide',
    'view_item' => 'View Slide',
    'search_items' => 'Search Slides',
    'not_found' => 'No Slides found',
    'not_found_in_trash' => 'No Slides found in Trash',
    'parent_item_colon' => 'Parent Slide:',
    'menu_name' => 'Slider',
    );

  $args = array(
    'labels' => $labels,
    'hierarchical' => true,
    'supports' => array( 'title', 'page-attributes' ),
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_position' => 5,
    'menu_icon' => 'dashicons-slides',
    'show_in_nav_menus' => false,
    'publicly_queryable' => false,
    'exclude_from_search' => true,
    'has_archive' => false,
    'query_var' => true,
    'can_export' => true,
    'rewrite' => true,
    'capability_type' => 'post'
    );

  register_post_type( 'slider', $args );
}

// Projects/Portfolio
add_action( 'init', 'magethemes_zen_register_cpt_portfolio' );

function magethemes_zen_register_cpt_portfolio() {
  $labels = array(
    'name' => 'Portfolio',
    'singular_name' => 'Portfolio',
    'add_new' => 'Add New',
    'add_new_item' => 'Add New Portfolio',
    'edit_item' => 'Edit Portfolio',
    'new_item' => 'New Portfolio',
    'view_item' => 'View Portfolio',
    'search_items' => 'Search Portfolio',
    'not_found' => 'No Portfolio found',
    'not_found_in_trash' => 'No Portfolio found in Trash',
    'parent_item_colon' => 'Parent Portfolio:',
    'menu_name' => 'Portfolio',
    );

  $args = array(
    'labels' => $labels,
    'hierarchical' => true,
    'supports' => array( 'title', 'editor', 'page-attributes' ),
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_position' => 5,
    'menu_icon' => 'dashicons-portfolio',
    'show_in_nav_menus' => false,
    'publicly_queryable' => false,
    'exclude_from_search' => true,
    'has_archive' => false,
    'query_var' => true,
    'can_export' => true,
    'rewrite' => true,
    'capability_type' => 'page'
    );

  register_post_type( 'portfolio', $args );
}

// Services
add_action( 'init', 'magethemes_zen_register_cpt_service' );

function magethemes_zen_register_cpt_service() {
  $labels = array(
    'name' => 'Services',
    'singular_name' => 'Service',
    'add_new' => 'Add New',
    'add_new_item' => 'Add New Service',
    'edit_item' => 'Edit Service',
    'new_item' => 'New Service',
    'view_item' => 'View Service',
    'search_items' => 'Search Services',
    'not_found' => 'No Services found',
    'not_found_in_trash' => 'No Services found in Trash',
    'parent_item_colon' => 'Parent Service:',
    'menu_name' => 'Services',
    );

  $args = array(
    'labels' => $labels,
    'hierarchical' => true,
    'supports' => array( 'title', 'page-attributes' ),
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_position' => 5,
    'menu_icon' => 'dashicons-hammer',
    'show_in_nav_menus' => false,
    'publicly_queryable' => false,
    'exclude_from_search' => true,
    'has_archive' => false,
    'query_var' => true,
    'can_export' => true,
    'rewrite' => true,
    'capability_type' => 'post'
    );

  register_post_type( 'service', $args );
}

// Members
add_action( 'init', 'magethemes_zen_register_cpt_members' );

function magethemes_zen_register_cpt_members() {
  $labels = array(
    'name' => 'Members',
    'singular_name' => 'Member',
    'add_new' => 'Add New',
    'add_new_item' => 'Add New Member',
    'edit_item' => 'Edit Member',
    'new_item' => 'New Member',
    'view_item' => 'View Member',
    'search_items' => 'Search Members',
    'not_found' => 'No Members found',
    'not_found_in_trash' => 'No Members found in Trash',
    'parent_item_colon' => 'Parent Member:',
    'menu_name' => 'Members',
    );

  $args = array(
    'labels' => $labels,
    'hierarchical' => true,

    'supports' => array( 'title', 'page-attributes' ),
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_position' => 5,
    'menu_icon' => 'dashicons-groups',
    'show_in_nav_menus' => false,
    'publicly_queryable' => false,
    'exclude_from_search' => true,
    'has_archive' => false,
    'query_var' => true,
    'can_export' => true,
    'rewrite' => true,
    'capability_type' => 'post'
    );

  register_post_type( 'member', $args );
}

//custom categories for portfolio
add_action( 'init', 'magethemes_zen_register_taxonomy_portfolio_categories' );

function magethemes_zen_register_taxonomy_portfolio_categories() {
  $labels = array(
    'name' => 'Portfolio Categories',
    'singular_name' => 'Portfolio Category',
    'search_items' => 'Search Portfolio Categories',
    'popular_items' => 'Popular Portfolio Categories',
    'all_items' => 'All Portfolio Categories',
    'parent_item' => 'Parent Portfolio Category',
    'parent_item_colon' => 'Parent Portfolio Category:',
    'edit_item' => 'Edit Portfolio Category',
    'update_item' => 'Update Portfolio Category',
    'add_new_item' => 'Add New Portfolio Category',
    'new_item_name' => 'New Portfolio Category',
    'separate_items_with_commas' => 'Separate portfolio categories with commas',
    'add_or_remove_items' => 'Add or remove portfolio categories',
    'choose_from_most_used' => 'Choose from the most used portfolio categories',
    'menu_name' => 'Portfolio Categories',
    );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'show_in_nav_menus' => false,
    'show_ui' => true,
    'show_tagcloud' => false,
    'hierarchical' => false,
    'rewrite' => true,
    'query_var' => true
    );

  register_taxonomy( 'portfolio_categories', array('portfolio'), $args );
}

// create custom plugin settings menu
add_action('admin_menu', 'magethemes_zen_theme_settings');

function magethemes_zen_theme_settings() {
  //create new top-level menu
  add_menu_page('Theme Options', 'Theme Options', 'administrator', __FILE__, 'magethemes_zen_theme_settings_page','dashicons-edit');

  //call register settings function
  add_action( 'admin_init', 'magethemes_zen_register_mysettings' );
}


function magethemes_zen_register_mysettings() {
  //register our settings
  register_setting( 'magethemes_zen_settings-group', 'magethemes_zen_theme_first_subtitle' );
  register_setting( 'magethemes_zen_settings-group', 'magethemes_zen_theme_portfolio_nr' );
  register_setting( 'magethemes_zen_settings-group', 'magethemes_zen_theme_first_title' );
  register_setting( 'magethemes_zen_settings-group', 'magethemes_zen_theme_first_content' );
  register_setting( 'magethemes_zen_settings-group', 'magethemes_zen_theme_first_blockquote' );
  register_setting( 'magethemes_zen_settings-group', 'magethemes_zen_theme_logo', 'magethemes_zen_validate_setting' );
  register_setting( 'magethemes_zen_settings-group', 'magethemes_zen_our_services_title' );
  register_setting( 'magethemes_zen_settings-group', 'magethemes_zen_theme_au_subtitle' );
  register_setting( 'magethemes_zen_settings-group', 'magethemes_zen_theme_au_title' );
  register_setting( 'magethemes_zen_settings-group', 'magethemes_zen_theme_au_content' );
  register_setting( 'magethemes_zen_settings-group', 'magethemes_zen_theme_contact_subtitle' );
  register_setting( 'magethemes_zen_settings-group', 'magethemes_zen_theme_contact_title' );
  register_setting( 'magethemes_zen_settings-group', 'magethemes_zen_theme_contact_form' );
  register_setting( 'magethemes_zen_settings-group', 'magethemes_zen_theme_footer_title' );
  register_setting( 'magethemes_zen_settings-group', 'magethemes_zen_theme_footer_content' );
  register_setting( 'magethemes_zen_settings-group', 'magethemes_zen_theme_social_twitter' );
  register_setting( 'magethemes_zen_settings-group', 'magethemes_zen_theme_social_facebook' );
  register_setting( 'magethemes_zen_settings-group', 'magethemes_zen_theme_social_pinterest' );
  register_setting( 'magethemes_zen_settings-group', 'magethemes_zen_theme_social_instagram' );
  register_setting( 'magethemes_zen_settings-group', 'magethemes_zen_theme_social_dribbble' );
  register_setting( 'magethemes_zen_settings-group', 'magethemes_zen_theme_social_google' );
  register_setting( 'magethemes_zen_settings-group', 'magethemes_zen_theme_social_linkedin' );
  register_setting( 'magethemes_zen_settings-group', 'magethemes_zen_theme_map_lat' );
  register_setting( 'magethemes_zen_settings-group', 'magethemes_zen_theme_map_lng' );
  register_setting( 'magethemes_zen_settings-group', 'magethemes_zen_theme_map_zoom' );
  register_setting( 'magethemes_zen_settings-group', 'magethemes_zen_theme_color' );
  register_setting( 'magethemes_zen_settings-group', 'magethemes_zen_theme_map_bw' );
  register_setting( 'magethemes_zen_settings-group', 'magethemes_zen_theme_map_scrollwhell' );
  register_setting( 'magethemes_zen_settings-group', 'magethemes_zen_slider' );
  register_setting( 'magethemes_zen_settings-group', 'magethemes_zen_slider_video_link' );
}

function magethemes_zen_validate_setting($theme_logo) { $keys = array_keys($_FILES); $i = 0; foreach ( $_FILES as $image ) {
// if a files was upload
if ($image['size']) {

  // if it is an image
  if ( preg_match('/(jpg|jpeg|png|gif)$/', $image['type']) ) {
    $override = array('test_form' => false);

    // save the file, and store an array, containing its location in $file
    $file = wp_handle_upload( $image, $override );
    $theme_logo[$keys[$i]] = $file['url'];
  } else {

    // Not an image.
    $options = get_option('magethemes_zen_theme_logo');
    $theme_logo[$keys[$i]] = $options[$logo];

    // Die and let the user know that they made a mistake.
    wp_die('No image was uploaded.');}
  }

// Else, the user didn't upload a file.
// Retain the image that's already on file.
else {
    $options = get_option('magethemes_zen_theme_logo');
    $theme_logo[$keys[$i]] = $options[$keys[$i]];
  }

  $i++;

  } return $theme_logo;
}


//set default theme options
add_option('magethemes_zen_theme_first_subtitle', 'We are creative agency', '', 'no' );
add_option('magethemes_zen_theme_portfolio_nr', '8', '', 'no' );
add_option('magethemes_zen_theme_first_title', 'Passionate for what we do', '', 'no' );
add_option('magethemes_zen_theme_first_content', 'ZEN is a perfect template for those who desire simple but bold and contemporary look, with attention to details and typography. It is suitable for corporate, agency, creative, or any general business. The theme is well organized and documented.', '', 'no' );
add_option('magethemes_zen_theme_first_blockquote', 'Life is really simple, but we insist on making it complicated. - Confucius', '', 'no' );
add_option('magethemes_zen_our_services_title', 'Our services', '', 'no' );
add_option('magethemes_zen_theme_au_subtitle', 'Learn more about us', '', 'no' );
add_option('magethemes_zen_theme_au_title', 'The object of your desire is not an object.', '', 'no' );
add_option('magethemes_zen_theme_au_content', "Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.", '', 'no' );
add_option('magethemes_zen_theme_contact_subtitle', 'Feel free to contact us', '', 'no' );
add_option('magethemes_zen_theme_contact_title', 'Hello, what can we do for you?', '', 'no' );
add_option('magethemes_zen_theme_footer_title', 'Find Us on Social Networks', '', 'no' );
add_option('magethemes_zen_theme_footer_content', 'Lorem ipsum dolor sit amanet, ridiculus egestas random text.', '', 'no' );
add_option('magethemes_zen_theme_social_twitter', '#', '', 'no' );
add_option('magethemes_zen_theme_social_facebook', '#', '', 'no' );
add_option('magethemes_zen_theme_social_pinterest', '#', '', 'no' );
add_option('magethemes_zen_theme_social_instagram', '#', '', 'no' );
add_option('magethemes_zen_theme_social_dribbble', '#', '', 'no' );
add_option('magethemes_zen_theme_social_google', '#', '', 'no' );
add_option('magethemes_zen_theme_social_linkedin', '#', '', 'no' );
add_option('magethemes_zen_theme_map_lat', '-37.817314', '', 'no' );
add_option('magethemes_zen_theme_map_lng', '144.955431', '', 'no' );
add_option('magethemes_zen_theme_map_zoom', '16', '', 'no' );
add_option('magethemes_zen_theme_color', 'green', '', 'no' );
add_option('magethemes_zen_theme_map_bw', '1', '', 'no' );
add_option('magethemes_zen_theme_map_scrollwhell', '1', '', 'no' );
add_option('magethemes_zen_slider', 'slider', '', 'no' );
add_option('magethemes_zen_slider_video_link', 'http://youtu.be/ab0TSkLe-E0', '', 'no' );
add_option('magethemes_zen_developer_link', 'http://www.mage-themes.com', '', 'no' );
add_option('magethemes_zen_theme_logo', array("magethemes_zen_theme_logo"=>get_template_directory_uri().'/images/logo.png', "magethemes_zen_parallax_bg"=>get_template_directory_uri().'/images/parallax.jpg'), '', 'no' );

// Theme Options admin markap
function magethemes_zen_theme_settings_page() {
?>

<div class="wrap mage-theme-options">
<h2>Theme Options</h2>

<p>Once again, thank you so much for purchasing this theme. Feel free to contact us for any support related question using email <a href="mailto:support@mage-themes.com">support@mage-themes.com</a>.<br>Feel free to browse our other premium themes at <a href="<?php echo get_option('developer_link'); ?>" target="_blank"><?php echo get_option('developer_link'); ?></a>.</p>

<form method="post" action="options.php" enctype="multipart/form-data">

<?php settings_fields( 'magethemes_zen_settings-group' ); ?>
<?php do_settings_sections( 'magethemes_zen_settings-group' ); ?>
<h3>Theme Logo</h3>
<?php $logo = get_option('magethemes_zen_theme_logo'); ?>
<div><img src="<?php echo $logo['magethemes_zen_theme_logo']; ?>" alt="theme logo" style="max-width:622px; height:auto;" /><br/>
<input type="file" name="magethemes_zen_theme_logo" />
</div>

<h3>Theme Color</h3>

<div>
  <label>Color</label>
  <select name="magethemes_zen_theme_color">
  <option<?php if(get_option('magethemes_zen_theme_color')=='green'){ echo ' selected="selected"'; } ?> value="green">Green</option>
  <option<?php if(get_option('magethemes_zen_theme_color')=='blue'){ echo ' selected="selected"'; } ?> value="blue">Blue</option>
  <option<?php if(get_option('magethemes_zen_theme_color')=='purple'){ echo ' selected="selected"'; } ?> value="purple">Purple</option>
  </select>
</div>

<h3>Slider options</h3>

<div>
  <label>Slider type</label>
  <div style="display:block; float:left; clear:right;">
  <select id="sliderselect" name="magethemes_zen_slider">
  <option<?php if(get_option('magethemes_zen_slider')=='slider'){ echo ' selected="selected"'; } ?> value="slider">Slider</option>
  <option<?php if(get_option('magethemes_zen_slider')=='parallax'){ echo ' selected="selected"'; } ?> value="parallax">Parallax</option>
  <option<?php if(get_option('magethemes_zen_slider')=='video'){ echo ' selected="selected"'; } ?> value="video">Video</option>
  </select>
  </div>
  <div id="parallax_link">
  Parallax background image<br/>
<img src="<?php echo $logo['magethemes_zen_parallax_bg']; ?>" style="max-width:622px; height:auto;" alt="parallax image" /><br/>
<input type="file" name="magethemes_zen_parallax_bg" />
  </div>
  <div id="video_link"><label>Slider video link</label>
  <input type="text" name="magethemes_zen_slider_video_link" value="<?php echo get_option('magethemes_zen_slider_video_link'); ?>" />
  </div>

  <br class="clear" />
</div>

<h3>Homepage Content</h3>
<div>
<div>
  <label>Upper title</label>
  <input type="text" name="magethemes_zen_theme_first_subtitle" value="<?php echo get_option('magethemes_zen_theme_first_subtitle'); ?>" />
</div>

<div>
  <label>Title</label>
  <input type="text" name="magethemes_zen_theme_first_title" value="<?php echo get_option('magethemes_zen_theme_first_title'); ?>" />
</div>

<div>
  <label>Content</label>
  <textarea rows="5" name="magethemes_zen_theme_first_content"><?php echo get_option('magethemes_zen_theme_first_content'); ?></textarea>
</div>

<div>
  <label>Blockquote</label>
  <textarea rows="5" name="magethemes_zen_theme_first_blockquote"><?php echo get_option('magethemes_zen_theme_first_blockquote'); ?></textarea>
</div>

<div>
  <label>Portfolio items to show?</label>
  <select name="magethemes_zen_theme_portfolio_nr">
    <option value="4" <?php if(get_option('magethemes_zen_theme_portfolio_nr')==4){ echo ' selected="selected"'; } ?>>4</option>
    <option value="8" <?php if(get_option('magethemes_zen_theme_portfolio_nr')==8){ echo ' selected="selected"'; } ?>>8</option>
    <option value="12" <?php if(get_option('magethemes_zen_theme_portfolio_nr')==12){ echo ' selected="selected"'; } ?>>12</option>
    <option value="16" <?php if(get_option('magethemes_zen_theme_portfolio_nr')==16){ echo ' selected="selected"'; } ?>>16</option>
    <option value="20" <?php if(get_option('magethemes_zen_theme_portfolio_nr')==20){ echo ' selected="selected"'; } ?>>20</option>
  </select>
</div>
</div>

<h3>Our Services</h3>

<div>
  <label>Title</label>
  <input type="text" name="magethemes_zen_our_services_title" value="<?php echo get_option('magethemes_zen_our_services_title'); ?>" />
</div>

<h3>About Us</h3>
<div>
<div>
  <label>Upper title</label>
  <input type="text" name="magethemes_zen_theme_au_subtitle" value="<?php echo get_option('magethemes_zen_theme_au_subtitle'); ?>" />
</div>

<div>
  <label>Title</label>
  <input type="text" name="magethemes_zen_theme_au_title" value="<?php echo get_option('magethemes_zen_theme_au_title'); ?>" />
</div>

<div>
  <label>Content</label>
  <textarea rows="7" name="magethemes_zen_theme_au_content"><?php echo get_option('magethemes_zen_theme_au_content'); ?></textarea>
</div>
</div>

<h3>Contact Us</h3>
<div>
<div>
  <label>Subtitle</label>
  <input type="text" name="magethemes_zen_theme_contact_subtitle" value="<?php echo get_option('magethemes_zen_theme_contact_subtitle'); ?>" />
</div>

<div>
  <label>Title</label>
  <input type="text" name="magethemes_zen_theme_contact_title" value="<?php echo get_option('magethemes_zen_theme_contact_title'); ?>" />
</div>
<div>
  <label>Contact form</label>
  <textarea class="input" name="magethemes_zen_theme_contact_form"><?php echo stripcslashes(get_option('magethemes_zen_theme_contact_form')); ?></textarea>
</div>
</div>

<h3>Google Map</h3>
<div>
<div>
  <label>Latitude</label>
  <input type="text" name="magethemes_zen_theme_map_lat" value="<?php echo get_option('magethemes_zen_theme_map_lat'); ?>" />
</div>

<div>
  <label>Longitude</label>
  <input type="text" name="magethemes_zen_theme_map_lng" value="<?php echo get_option('magethemes_zen_theme_map_lng'); ?>" />
</div>

<div>
  <label>Zoom</label>
  <input type="text" name="magethemes_zen_theme_map_zoom" value="<?php echo get_option('magethemes_zen_theme_map_zoom'); ?>" />
</div>

<div>
  <label>Map color</label>
  <input type="checkbox" name="magethemes_zen_theme_map_bw"<?php if(get_option('magethemes_zen_theme_map_bw')){ echo ' checked="checked"'; } ?> value="1" /> Check if you want map to be black/white
</div>

<div>
  <label>Scroll whell</label>
  <input type="checkbox" name="magethemes_zen_theme_map_scrollwhell"<?php if(get_option('magethemes_zen_theme_map_scrollwhell')){ echo ' checked="checked"'; } ?> value="1" /> Check if you want to disable scroll whell
</div>
</div>

<h3>Footer</h3>
<div>
<div>
  <label>Title</label>
  <input type="text" name="magethemes_zen_theme_footer_title" value="<?php echo get_option('magethemes_zen_theme_footer_title'); ?>" />
</div>

<div>
  <label>Content</label>
  <input type="text" name="magethemes_zen_theme_footer_content" value="<?php echo get_option('magethemes_zen_theme_footer_content'); ?>" />
</div>

<div>
  <label>Twitter</label>
  <input type="text" placeholder="http://" name="magethemes_zen_theme_social_twitter" value="<?php echo get_option('magethemes_zen_theme_social_twitter'); ?>" />
</div>

<div>
  <label>Facebook</label>
  <input type="text" placeholder="http://" name="magethemes_zen_theme_social_facebook" value="<?php echo get_option('magethemes_zen_theme_social_facebook'); ?>" />
</div>

<div>
  <label>Pinterest</label>
  <input type="text" placeholder="http://" name="magethemes_zen_theme_social_pinterest" value="<?php echo get_option('magethemes_zen_theme_social_pinterest'); ?>" />
</div>

<div>
  <label>Instagram</label>
  <input type="text" placeholder="http://" name="magethemes_zen_theme_social_instagram" value="<?php echo get_option('magethemes_zen_theme_social_instagram'); ?>" />
</div>

<div>
  <label>Dribbble</label>
  <input type="text" placeholder="http://" name="magethemes_zen_theme_social_dribbble" value="<?php echo get_option('magethemes_zen_theme_social_dribbble'); ?>" />
</div>

<div>
  <label>Google+</label>
  <input type="text" placeholder="http://" name="magethemes_zen_theme_social_google" value="<?php echo get_option('magethemes_zen_theme_social_google'); ?>" />
</div>

<div>
  <label>LinkedIn</label>
  <input type="text" placeholder="http://" name="magethemes_zen_theme_social_linkedin" value="<?php echo get_option('magethemes_zen_theme_social_linkedin'); ?>" />
</div>
</div>
<?php submit_button(); ?>

</form>
</div>
<?php }
?>