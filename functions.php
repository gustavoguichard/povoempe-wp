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
  wp_enqueue_style( 'magethemes_zen_main', get_template_directory_uri() . '/style.css' );
  wp_enqueue_style( 'magethemes_zen_color', get_template_directory_uri() . '/green.css' );
  wp_enqueue_style( 'magethemes_zen_font', get_template_directory_uri() . '/font-awesome/css/font-awesome.min.css' );

} //load the theme CSS ends!

//load the theme JS
function magethemes_zen_theme_js() {

  wp_enqueue_script( 'magethemes_zen_myjquery', get_template_directory_uri() . '/scripts/jquery-1.11.0.min.js', array('jquery'), '', true );

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
    'id' => 'magethemes_zen_portfolio',
    'title' => 'Estabelecimentos',
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
    'title' => 'Características',
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
  $slider=get_option('magethemes_zen_slider');
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
// Projects/Portfolio
add_action( 'init', 'magethemes_zen_register_cpt_portfolio' );

function magethemes_zen_register_cpt_portfolio() {
  $labels = array(
    'name' => 'Estabelecimentos',
    'singular_name' => 'Estabelecimento',
    'add_new' => 'Adicionar',
    'add_new_item' => 'Adicionar Estabelecimento',
    'edit_item' => 'Editar Estabelecimento',
    'new_item' => 'Novo Estabelecimento',
    'view_item' => 'Ver Estabelecimento',
    'search_items' => 'Buscar Estabelecimento',
    'not_found' => 'Nenhum Estabelecimento encontrado',
    'not_found_in_trash' => 'Nenhum Estabelecimento encontrado na lixeira',
    'parent_item_colon' => 'Estabelecimento Pai:',
    'menu_name' => 'Estabelecimentos',
    );

  $args = array(
    'labels' => $labels,
    'hierarchical' => true,
    'supports' => array( 'title', 'editor', 'page-attributes' ),
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_position' => 5,
    'menu_icon' => 'dashicons-admin-multisite',
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

// Características
add_action( 'init', 'magethemes_zen_register_cpt_service' );

function magethemes_zen_register_cpt_service() {
  $labels = array(
    'name' => 'Características',
    'singular_name' => 'Característica',
    'add_new' => 'Adicionar nova',
    'add_new_item' => 'Adicionar Característica',
    'edit_item' => 'Editar Característica',
    'new_item' => 'Nova Característica',
    'view_item' => 'Ver Característica',
    'search_items' => 'Buscar Características',
    'not_found' => 'Nenhuma Característica encontrada',
    'not_found_in_trash' => 'Nenhuma Característica encontrada na lixeira',
    'menu_name' => 'Características',
    );

  $args = array(
    'labels' => $labels,
    'hierarchical' => true,
    'supports' => array( 'title', 'page-attributes' ),
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_position' => 5,
    'menu_icon' => 'dashicons-palmtree',
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
  add_menu_page('Opções do Template', 'Opções do Template', 'administrator', __FILE__, 'magethemes_zen_theme_settings_page','dashicons-edit');

  remove_menu_page( 'edit.php' );                   //Posts
  remove_menu_page( 'edit-comments.php' );          //Comments

  //call register settings function
  add_action( 'admin_init', 'magethemes_zen_register_mysettings' );
}


function magethemes_zen_register_mysettings() {
  //register our settings
  register_setting( 'magethemes_zen_settings-group', 'magethemes_zen_theme_first_subtitle' );
  register_setting( 'magethemes_zen_settings-group', 'magethemes_zen_theme_first_title' );
  register_setting( 'magethemes_zen_settings-group', 'magethemes_zen_theme_first_content' );
  register_setting( 'magethemes_zen_settings-group', 'magethemes_zen_theme_first_blockquote' );
  register_setting( 'magethemes_zen_settings-group', 'magethemes_zen_theme_logo', 'magethemes_zen_validate_setting' );
  register_setting( 'magethemes_zen_settings-group', 'magethemes_zen_our_services_title' );
  register_setting( 'magethemes_zen_settings-group', 'magethemes_zen_theme_au_subtitle' );
  register_setting( 'magethemes_zen_settings-group', 'magethemes_zen_theme_au_title' );
  register_setting( 'magethemes_zen_settings-group', 'magethemes_zen_theme_au_content' );
  register_setting( 'magethemes_zen_settings-group', 'magethemes_zen_theme_footer_title' );
  register_setting( 'magethemes_zen_settings-group', 'magethemes_zen_theme_footer_content' );
  register_setting( 'magethemes_zen_settings-group', 'magethemes_zen_facebook_id' );
  register_setting( 'magethemes_zen_settings-group', 'magethemes_zen_facebook_secret' );
  register_setting( 'magethemes_zen_settings-group', 'magethemes_zen_theme_map_lat' );
  register_setting( 'magethemes_zen_settings-group', 'magethemes_zen_theme_map_lng' );
  register_setting( 'magethemes_zen_settings-group', 'magethemes_zen_theme_map_zoom' );
  register_setting( 'magethemes_zen_settings-group', 'magethemes_zen_theme_map_bw' );
  register_setting( 'magethemes_zen_settings-group', 'magethemes_zen_theme_map_scrollwhell' );
  register_setting( 'magethemes_zen_settings-group', 'magethemes_zen_slider' );
  register_setting( 'magethemes_zen_settings-group', 'magethemes_zen_slider_video_id' );
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
add_option('magethemes_zen_theme_first_subtitle', 'Espaço', '', 'no' );
add_option('magethemes_zen_theme_first_title', 'Povo em Pé', '', 'no' );
add_option('magethemes_zen_theme_first_content', 'Este espaço honra os irmãos que habitam junto com nós, duas pernas, a Mãe Terra.

Entendemos que a Mãe Terra é aquecida pelo Fogo, fertiliza-se e frutifica com a Água, movimenta-se com o Ar, e manifesta o Espírito do Éter.

O Espaço Povo em Pé definiu sua missão, em um dia de Kin Dragão Cristal Vermelho, uma corte de Kins da Onda Encantada do Cachorro Branco. Kali 25. Quarta semana da Lua Cristal do Coelho, 48º Heptal do ano Lua Harmônica Vermelha.

Aqui, como guardiões, promovemos encontros do Movimento Mundial pela Paz, facilitamos oficinas de alimentação natural, trabalhos corporais e aromas. Praticamos Yoga e buscamos auxiliar como educadores, em diária de vida ancestral - por um Agora Saudável.

Estamos abertos aos irmãos que queiram trazer seus saberes e o frescor da Mãe Terra!', '', 'no' );
add_option('magethemes_zen_theme_first_blockquote', 'Meu nome é o glorioso nascido do lótus. Eu catalizo luz-calor interior.
Que todos os seres habitem a Divina Presença comigo.', '', 'no' );
add_option('magethemes_zen_our_services_title', 'Características', '', 'no' );
add_option('magethemes_zen_theme_au_subtitle', 'Guardiões do', '', 'no' );
add_option('magethemes_zen_theme_au_title', 'Povo em Pé', '', 'no' );
add_option('magethemes_zen_theme_au_content', "Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.", '', 'no' );
add_option('magethemes_zen_theme_footer_title', 'Avenida Beira Rio, 1135 - Belém Novo - Porto Alegre / RS', '', 'no' );
add_option('magethemes_zen_theme_footer_content', 'Telefone: +55 51 3331-1422', '', 'no' );
add_option('magethemes_zen_facebook_id', '', '', 'no' );
add_option('magethemes_zen_facebook_secret', '', '', 'no' );
add_option('magethemes_zen_theme_map_lat', '-30.2120678', '', 'no' );
add_option('magethemes_zen_theme_map_lng', '-51.1973606', '', 'no' );
add_option('magethemes_zen_theme_map_zoom', '14', '', 'no' );
add_option('magethemes_zen_theme_map_bw', '1', '', 'no' );
add_option('magethemes_zen_theme_map_scrollwhell', '1', '', 'no' );
add_option('magethemes_zen_slider', 'slider', '', 'no' );
add_option('magethemes_zen_slider_video_id', '127496191', '', 'no' );
add_option('magethemes_zen_theme_logo', array("magethemes_zen_theme_logo"=>get_template_directory_uri().'/images/logo.jpg', "magethemes_zen_parallax_bg"=>get_template_directory_uri().'/images/parallax.jpg'), '', 'no' );

// Theme Options admin markap
function magethemes_zen_theme_settings_page() {
?>

<div class="wrap mage-theme-options">
<h2>Opções do template</h2>

<form method="post" action="options.php" enctype="multipart/form-data">

<?php settings_fields( 'magethemes_zen_settings-group' ); ?>
<?php do_settings_sections( 'magethemes_zen_settings-group' ); ?>
<h3>Theme Logo</h3>
<?php $logo = get_option('magethemes_zen_theme_logo'); ?>
<div><img src="<?php echo $logo['magethemes_zen_theme_logo']; ?>" alt="theme logo" style="max-width:622px; height:auto;" /><br/>
<input type="file" name="magethemes_zen_theme_logo" />
</div>

<h3>Opções do banner</h3>

<div>
  <label>Slider type</label>
  <div id="parallax_link">
  Parallax background image<br/>
<img src="<?php echo $logo['magethemes_zen_parallax_bg']; ?>" style="max-width:622px; height:auto;" alt="parallax image" /><br/>
<input type="file" name="magethemes_zen_parallax_bg" />
  </div>
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
</div>

<h3>Facebook App (Avançado)</h3>
<div>
<div>
  <label>App ID</label>
  <input type="text" name="magethemes_zen_facebook_id" value="<?php echo get_option('magethemes_zen_facebook_id'); ?>" />
</div>

<div>
  <label>App Secret</label>
  <input type="text" name="magethemes_zen_facebook_secret" value="<?php echo get_option('magethemes_zen_facebook_secret'); ?>" />
</div>
</div>
<?php submit_button(); ?>

</form>
</div>
<?php }
?>