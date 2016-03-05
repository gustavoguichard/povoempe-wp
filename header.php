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

<div class="main">

  <!-- Header -->
  <div class="header">

    <h1><a href="<?php echo $url; ?>"><img src="<?php echo $logo['magethemes_zen_theme_logo']; ?>" title="<?php echo $name_bloginfo; ?>" width="150" alt="<?php echo $name_bloginfo; ?> logo" class="logo-header" /></a></h1>

    <!-- Menu -->
    <div class="menu">
      <div class="container">

        <?php

          $menu_name = 'left-side-menu';
          $menu_list ='';

          if ( ($locations = get_nav_menu_locations()) && isset($locations[$menu_name]) ) {

            $menu = wp_get_nav_menu_object( $locations[ $menu_name ] );

            $menu_items = wp_get_nav_menu_items($menu->term_id);
            $menu_list = '<ul class="left-side-menu">';
            $isfrontpage = is_front_page();
            $submenu = false;
            $count = 0;

            // foreach
            foreach ( (array) $menu_items as $menu_item ) {
              $count++;
              $title = $menu_item->title;
              $id = get_post_meta( $menu_item->ID, '_menu_item_object_id', true );
              $link = get_page_link( $id );
              $menuurl = $menu_item->url;

              if ( $menu_item->menu_item_parent == "0" ) {

                if ( $submenu ) {
                  $menu_list .= '</ul></li>';
                  $submenu = false;

                } else {
                  if ( $count>1 ) { $menu_list .= '</li>'; }

                }

                if ( $isfrontpage) {
                  $menu_list .= '<li><a href="' . $menuurl . '">' . $title . '</a>';

                } else {
                  if (strpos($menuurl, '#') !== FALSE) {
                    $menu_list .= '<li><a href="' . $url .$menuurl. 'href">' . $title . '</a>';

                  } else {
                    $menu_list .= '<li><a href="' . $menuurl . '">' . $title . '</a>';
                  }

                }

              } else {
                if ( !$submenu ) {
                  $submenu = true;
                  $menu_list .=  '<ul class="sub-menu">';

                }

                $menu_list .= '<li class="item';

                if (get_the_ID()==$id) {
                  $menu_list .= ' current-menu-item';
                }

                $menu_list .= '">
                <a href="'.$menuurl.'" class="title">'.$title.'</a>';
                $menu_list .= '</li>';

                if (count($menu_items)==$count) {
                  $menu_list .= '</ul></li>';
                  $submenu = false;
                }
              }
            }
            // foreach ends!

            $menu_list .= '</ul>';

          }

          echo $menu_list;

        ?>

        <?php

          $menu_name = 'right-side-menu';
          $menu_list ='';

          if ( ($locations = get_nav_menu_locations()) && isset($locations[$menu_name]) ) {

            $menu = wp_get_nav_menu_object( $locations[ $menu_name ] );

            $menu_items = wp_get_nav_menu_items($menu->term_id);
            $menu_list = '<ul class="right-side-menu">';
            $isfrontpage = is_front_page();
            $submenu = false;
            $count = 0;

            // foreach
            foreach ( (array) $menu_items as $menu_item ) {
              $count++;
              $title = $menu_item->title;
              $id = get_post_meta( $menu_item->ID, '_menu_item_object_id', true );
              $link = get_page_link( $id );
              $menuurl = $menu_item->url;

              if ( $menu_item->menu_item_parent == "0" ) {

                if ( $submenu ) {
                  $menu_list .= '</ul></li>';
                  $submenu = false;

                } else {
                  if ( $count>1 ) { $menu_list .= '</li>'; }

                }

                if ( $isfrontpage) {
                  $menu_list .= '<li><a href="' . $menuurl . '">' . $title . '</a>';

                } else {
                  if (strpos($menuurl, '#') !== FALSE) {
                    $menu_list .= '<li><a href="' . $url .$menuurl. 'href">' . $title . '</a>';

                  } else {
                    $menu_list .= '<li><a href="' . $menuurl . '">' . $title . '</a>';
                  }

                }

              } else {
                if ( !$submenu ) {
                  $submenu = true;
                  $menu_list .=  '<ul class="sub-menu">';

                }

                $menu_list .= '<li class="item';

                if (get_the_ID()==$id) {
                  $menu_list .= ' current-menu-item';
                }

                $menu_list .= '">
                <a href="'.$menuurl.'" class="title">'.$title.'</a>';
                $menu_list .= '</li>';

                if (count($menu_items)==$count) {
                  $menu_list .= '</ul></li>';
                  $submenu = false;
                }
              }
            }
            // foreach ends!

            $menu_list .= '</ul>';

          }

          echo $menu_list;

        ?>

      </div>
    </div>
     <!-- Menu Ends -->

  </div>
  <!-- Header Ends! -->