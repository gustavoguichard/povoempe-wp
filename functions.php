<?php
require(get_template_directory().'/globals.php');

if ( ! isset( $content_width ) ) $content_width = 960;
add_theme_support( 'menus' ); //enable custom menus
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-thumbnails'); //add support for thumbnails
register_nav_menu( 'left-side-menu', 'Left Side Menu' );
register_nav_menu( 'right-side-menu', 'Right Side Menu' );
set_post_thumbnail_size( 480, 480, false );
add_image_size('mini_thumb', 144, 104, true);

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
  wp_enqueue_style( 'magethemes_zen_main', get_template_directory_uri() . '/style.css' );
  wp_enqueue_style( 'magethemes_zen_color', get_template_directory_uri() . '/green.css' );
  wp_enqueue_style( 'magethemes_zen_font', get_template_directory_uri() . '/font-awesome/css/font-awesome.min.css' );
} //load the theme CSS ends!

//load the theme JS
function magethemes_zen_theme_js() {

  wp_enqueue_script( 'magethemes_zen_myjquery', get_template_directory_uri() . '/scripts/jquery-1.11.0.min.js', array('jquery'), '', true );

  wp_enqueue_script( 'magethemes_zen_google_map', 'https://maps.googleapis.com/maps/api/js?key=' . get_option('magethemes_zen_theme_maps_api_key'));
  wp_enqueue_script( 'magethemes_zen_google_map', 'https://maps.googleapis.com/maps/api/js' );
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
  echo "
  <!-- Google Map -->
  <script>
    function initialize() {
      var myLatlng = new google.maps.LatLng(-30.2120678, -51.1973606);
      var map_options = {
        zoom: 14,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        center: myLatlng,
        scrollwheel: false,
      }

      var map = new google.maps.Map(document.getElementById('map_canvas'), map_options);
      var myIcon = new google.maps.MarkerImage('".get_template_directory_uri()."/images/icon-marker-2x.png', null, null, null, new google.maps.Size(34,45));
      var marker = new google.maps.Marker({
        position: myLatlng,
        map: map,
        icon: myIcon
      });
      var styles = [
        {
          featureType: \"all\",
          stylers: [
            { saturation: -80 },
            { gamma: 0.5 },
            { lightness: 10 },
            { hue: 220 }
          ]
        }
      ];
      map.setOptions({styles: styles});
      /* Ends here! */
    }
    google.maps.event.addDomListener(window, 'load', initialize);
  </script>";
}

add_action('wp_head', 'magethemes_zen_jScriptUtilities');

// Function for ACF
define( 'ACF_LITE', false );

if ( function_exists("register_field_group") ) {
  register_field_group(array (
    'id' => 'magethemes_zen_team-member',
    'title' => 'Guardião',
    'fields' => array (
      array (
        'key' => 'field_530f611e52369',
        'label' => 'Position',
        'name' => 'magethemes_zen_position',
        'type' => 'text',
        'instructions' => 'Titulo do Guardião',
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
        'key' => 'field_530f7a39c105a',
        'label' => 'Image',
        'name' => 'magethemes_zen_member_image',
        'save_format' => 'id',
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

// Members
add_action( 'init', 'magethemes_zen_register_cpt_members' );

function magethemes_zen_register_cpt_members() {
  $labels = array(
    'name' => 'Guardião',
    'singular_name' => 'Guardião',
    'add_new' => 'Adicionar',
    'add_new_item' => 'Adicionar Guardião',
    'edit_item' => 'Editar Guardião',
    'new_item' => 'Novo Guardião',
    'view_item' => 'Ver Guardião',
    'search_items' => 'Buscar Guardiões',
    'not_found' => 'Nenhum Guardião encontrado',
    'not_found_in_trash' => 'Nenhum Guardião encontrado na lixeira',
    'parent_item_colon' => 'Guardião Pai:',
    'menu_name' => 'Guardiões',
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


  $labels = array(
    'name' => 'Evento',
    'singular_name' => 'Evento',
    'add_new' => 'Adicionar',
    'add_new_item' => 'Adicionar Evento',
    'edit_item' => 'Editar Evento',
    'new_item' => 'Novo Evento',
    'view_item' => 'Ver Evento',
    'search_items' => 'Buscar Eventos',
    'not_found' => 'Nenhum Evento encontrado',
    'not_found_in_trash' => 'Nenhum Evento encontrado na lixeira',
    'menu_name' => 'Eventos',
    );

  $args = array(
    'labels' => $labels,
    'hierarchical' => true,
    'supports' => array( 'title', 'editor', 'thumbnail' ),
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_position' => 5,
    'menu_icon' => 'dashicons-calendar-alt',
    'show_in_nav_menus' => false,
    'publicly_queryable' => false,
    'exclude_from_search' => true,
    'has_archive' => false,
    'query_var' => true,
    'can_export' => true,
    'rewrite' => true,
    'capability_type' => 'post'
    );

  register_post_type( 'event', $args );
}

// create custom plugin settings menu
add_action('admin_menu', 'magethemes_zen_theme_settings');

function magethemes_zen_theme_settings() {
  //create new top-level menu
  add_menu_page('Opções do Template', 'Opções do Template', 'administrator', __FILE__, 'magethemes_zen_theme_settings_page','dashicons-edit');

  remove_menu_page( 'edit.php' );                   //Posts
  remove_menu_page( 'edit.php?post_type=page' );    //Pages
  remove_menu_page( 'edit-comments.php' );          //Comments

  //call register settings function
  add_action( 'admin_init', 'magethemes_zen_register_mysettings' );
}


function magethemes_zen_register_mysettings() {
  global $menus;
  register_setting( 'magethemes_zen_settings-group', 'magethemes_zen_theme_first_subtitle' );
  register_setting( 'magethemes_zen_settings-group', 'magethemes_zen_theme_first_title' );
  register_setting( 'magethemes_zen_settings-group', 'magethemes_zen_theme_first_content' );
  register_setting( 'magethemes_zen_settings-group', 'magethemes_zen_theme_first_blockquote' );
  register_setting( 'magethemes_zen_settings-group', 'magethemes_zen_theme_au_subtitle' );
  register_setting( 'magethemes_zen_settings-group', 'magethemes_zen_theme_au_title' );
  register_setting( 'magethemes_zen_settings-group', 'magethemes_zen_theme_au_content' );
  register_setting( 'magethemes_zen_settings-group', 'magethemes_zen_theme_footer_title' );
  register_setting( 'magethemes_zen_settings-group', 'magethemes_zen_theme_footer_content' );
  register_setting( 'magethemes_zen_settings-group', 'magethemes_zen_facebook_id' );
  register_setting( 'magethemes_zen_settings-group', 'magethemes_zen_facebook_secret' );
  register_setting( 'magethemes_zen_settings-group', 'magethemes_zen_slider' );
  register_setting( 'magethemes_zen_settings-group', 'magethemes_zen_slider_video_id' );
  foreach ($menus as $item) {
    register_setting('magethemes_zen_settings-group', 'magethemes_zen_menu_'.$item);
  }
}

//set default theme options
global $menus;
add_option('magethemes_zen_theme_first_subtitle', 'Espaço', '', 'no' );
add_option('magethemes_zen_theme_first_title', 'Povo em Pé', '', 'no' );
add_option('magethemes_zen_theme_first_content', '', '', 'no' );
add_option('magethemes_zen_theme_first_blockquote', '', '', 'no' );
add_option('magethemes_zen_theme_au_subtitle', 'Guardiões do', '', 'no' );
add_option('magethemes_zen_theme_au_title', 'Povo em Pé', '', 'no' );
add_option('magethemes_zen_theme_au_content', '', '', 'no' );
add_option('magethemes_zen_theme_footer_title', 'Avenida Beira Rio, 1135 - Belém Novo - Porto Alegre / RS', '', 'no' );
add_option('magethemes_zen_theme_footer_content', 'Telefone: +55 51 3331-1422', '', 'no' );
add_option('magethemes_zen_facebook_id', '', '', 'no' );
add_option('magethemes_zen_facebook_secret', '', '', 'no' );
add_option('magethemes_zen_slider', 'slider', '', 'no' );
add_option('magethemes_zen_slider_video_id', '127496191', '', 'no' );
foreach ($menus as $item) {
  add_option('magethemes_zen_menu_'.$item, '', '', 'no' );
}


// Theme Options admin markap
function magethemes_zen_theme_settings_page() {
?>

<div class="wrap mage-theme-options">
<h2>Opções do template</h2>

<form method="post" action="options.php" enctype="multipart/form-data">

<?php settings_fields( 'magethemes_zen_settings-group' ); ?>
<?php do_settings_sections( 'magethemes_zen_settings-group' ); ?>
<h3>Menus</h3>
<div>
<?php global $menus; foreach ($menus as $item) : ?>
<div>
  <label><?= $item ?></label>
  <input type="text" name="magethemes_zen_menu_<?= $item ?>" value="<?php echo get_option('magethemes_zen_menu_'.$item); ?>" />
</div>
<?php endforeach; ?>
</div>

<h3>Opções do banner</h3>
<div>
  <div id="video_link"><label>Slider video link</label>
  <input type="text" name="magethemes_zen_slider_video_id" value="<?php echo get_option('magethemes_zen_slider_video_id'); ?>" />
  </div>

  <br class="clear" />
</div>

<h3>Conteúdo principal</h3>
<div>
<div>
  <label>Titulo superior</label>
  <input type="text" name="magethemes_zen_theme_first_subtitle" value="<?php echo get_option('magethemes_zen_theme_first_subtitle'); ?>" />
</div>

<div>
  <label>Titulo</label>
  <input type="text" name="magethemes_zen_theme_first_title" value="<?php echo get_option('magethemes_zen_theme_first_title'); ?>" />
</div>

<div>
  <label>Conteudo</label>
  <textarea rows="5" name="magethemes_zen_theme_first_content"><?php echo get_option('magethemes_zen_theme_first_content'); ?></textarea>
</div>

<div>
  <label>Citação</label>
  <textarea rows="5" name="magethemes_zen_theme_first_blockquote"><?php echo get_option('magethemes_zen_theme_first_blockquote'); ?></textarea>
</div>

</div>

<h3>Sobre nós</h3>
<div>
<div>
  <label>Titulo superior</label>
  <input type="text" name="magethemes_zen_theme_au_subtitle" value="<?php echo get_option('magethemes_zen_theme_au_subtitle'); ?>" />
</div>

<div>
  <label>Titulo</label>
  <input type="text" name="magethemes_zen_theme_au_title" value="<?php echo get_option('magethemes_zen_theme_au_title'); ?>" />
</div>

<div>
  <label>Conteudo</label>
  <textarea rows="7" name="magethemes_zen_theme_au_content"><?php echo get_option('magethemes_zen_theme_au_content'); ?></textarea>
</div>
</div>

<h3>Rodapé</h3>
<div>
<div>
  <label>Titulo</label>
  <input type="text" name="magethemes_zen_theme_footer_Titulo" value="<?php echo get_option('magethemes_zen_theme_footer_title'); ?>" />
</div>

<div>
  <label>Conteudo</label>
  <textarea class="input" name="magethemes_zen_theme_footer_content"><?php echo stripcslashes(get_option('magethemes_zen_theme_footer_content')); ?></textarea>
</div>

<div>
  <label>MAPS API Key</label>
  <input type="text" name="magethemes_zen_theme_maps_api_key" value="<?php echo get_option('magethemes_zen_theme_maps_api_key'); ?>" />
</div>
</div>

<?php submit_button(); ?>

</form>
</div>
<?php }
?>