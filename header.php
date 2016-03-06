<?php $name_bloginfo = html_entity_decode(get_bloginfo('name')); $url = home_url();  $logo = get_option('magethemes_zen_theme_logo'); ?>
<!DOCTYPE html>
<html <?php language_attributes() ?>>
<head>
<meta charset="utf-8">
<title><?php if(is_home() || is_front_page()){ echo strip_tags($name_bloginfo) . ' - ' . get_bloginfo('description'); } else { wp_title( '' ); } ?></title>
<meta name="Keywords" content="">
<meta name="Description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">

<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php
  function top_side_menu($menu_name) {
    $menu_list ='';
    if ( ($locations = get_nav_menu_locations()) && isset($locations[$menu_name]) ) {
      $menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
      $menu_items = wp_get_nav_menu_items($menu->term_id);
      $menu_list = '<ul class="'.$menu_name.'">';

      foreach ( (array) $menu_items as $menu_item ) {
        $title = $menu_item->title;
        $id = get_post_meta( $menu_item->ID, '_menu_item_object_id', true );
        $menuurl = $menu_item->url;
        $menu_list .= '<li class="item">
                        <a href="'.$menuurl.'" class="title">'.$title.'</a>
                      </li>';
      }
      $menu_list .= '</ul>';
    }
    return($menu_list);
  }
?>

<div class="main">

  <!-- Header -->
  <div class="header">

    <h1><a href="<?php echo $url; ?>" class="logo-header"><img src="<?php echo $logo['magethemes_zen_theme_logo']; ?>" title="<?php echo $name_bloginfo; ?>" width="150" alt="<?php echo $name_bloginfo; ?> logo" /></a></h1>

    <!-- Menu -->
    <div class="menu">
      <div class="container">
        <?php echo top_side_menu('left-side-menu'); ?>
        <?php echo top_side_menu('right-side-menu'); ?>
      </div>
    </div>
     <!-- Menu Ends -->

  </div>
  <!-- Header Ends! -->