<?php
/**
 * @package WordPress
 * @subpackage Zen

 Template Name: Homepage

*/
get_header();
?>
  <?php
    global $menus;
    $menu_names = [];
    foreach ($menus as $item) {
      $name = get_option('magethemes_zen_menu_'.$item);
      array_push($menu_names, $name);
    }
    $video_id = get_option('magethemes_zen_slider_video_id');
    $au_subtitle = get_option('magethemes_zen_theme_au_subtitle');
    $au_title = get_option('magethemes_zen_theme_au_title');
    $au_content = get_option('magethemes_zen_theme_au_content');
    $first_subtitle = get_option('magethemes_zen_theme_first_subtitle');
    $first_title = get_option('magethemes_zen_theme_first_title');
    $first_content = get_option('magethemes_zen_theme_first_content');
    $first_blockquote = get_option('magethemes_zen_theme_first_blockquote');

  ?>
  <!-- Slider -->
  <div class="slider bg-parallax">

    <div class="container">
      <div class="video-container">
        <div class="videoWrapper">
          <iframe src="https://player.vimeo.com/video/<?= $video_id ?>?color=61744E&title=0&byline=0&portrait=0" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
        </div>
      </div>
    </div>

  </div>

  <!-- Page Content -->
  <div class="container-page">
    <div class="container">
      <a class="anchor" id="<?= sanitize_title($menu_names[0]) ?>"></a>
      <!-- Abstract -->
      <div class="abstract">

        <!-- Title -->
        <div class="big-title">
        <?php if($first_subtitle!=''){ ?><h2><?= $first_subtitle ?></h2><?php } ?>
        <?php if($first_title!=''){ ?><h3><?= $first_title ?></h3><?php } ?>
        </div>
        <!-- Title Ends! -->

        <?php if($first_content!=''){ ?><p><?= nl2br($first_content) ?></p><?php } ?>
        <?php if($first_blockquote!=''){ ?><blockquote><p><?= nl2br($first_blockquote) ?></p></blockquote><?php } ?>

      </div>
    </div>
  </div>
  <!-- Abstract Ends! -->

  <div class="agenda">
    <a class="anchor" id="<?= sanitize_title($menu_names[2]) ?>"></a>
    <!-- Title -->
    <div class="big-title">
      <h2>Agenda de</h2>
      <h3>Eventos</h3>
    </div>
    <!-- Title Ends! -->
    <div class="abstract">
      <?php
        $team_args = array(
          'post_type' => 'event', 'orderby' => 'menu_order', 'order' => 'ASC');
        $the_query = new WP_Query( $team_args );
      ?>

      <?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
        <?php
          $event_date = get_field( 'event_date' );
          $fb_link = get_field( 'fb_link' );
        ?>
        <article class="event-item">
          <a href="#" class="event-link">
            <?php the_post_thumbnail('mini_thumb', ['class' => 'event-image']); ?>
            <div class="event-details">
              <h3 class="event-name"><?php the_title(); ?></h3>
              <p class="event-date">
                <?= $event_date ?>
                <br />
                <span class="see-more">Click para ver mais...</span>
              </p>
            </div>
          </a>
          <div class="event-description">
            <?php the_content(); ?>
            <?php if($fb_link) : ?>
              <p style="text-align: right;">
                <a href="<?= $fb_link ?>" class="facebook-bt" target="blank">Ver no facebook</a>
              </p>
            <?php endif; ?>
          </div>
        </article>
      <?php endwhile; endif; ?>
      <?php wp_reset_postdata(); ?>
      <p style="margin-top: 1em; text-align: center;">
        <a class="button" style="float: none;" href="https://www.facebook.com/povoempepoa/events" target="blank">Confira nossa agenda do Facebook</a>
      </p>
    </div>
  </div>

  <div class="container-page">
    <div class="container">
      <div class="projects">
        <a class="anchor" id="<?= sanitize_title($menu_names[1]) ?>"></a>
        <div class="big-title">
          <h2>Algumas</h2>
          <h3><?= $menu_names[1] ?></h3>
        </div>
        <div class="project">
          <?php
            echo do_shortcode( '[rl_gallery id="264"]' );
          ;?>
        </div>
      </div>

    </div>
  </div>


  <!-- Page Content -->
  <div class="page">
    <div class="container">

      <!-- About -->
      <a class="anchor" id="<?= sanitize_title($menu_names[3]) ?>"></a>
      <div class="abstract">

        <!-- Title -->
        <div class="big-title">
          <?php if($au_subtitle!=''){ ?><h2><?= $au_subtitle ?></h2><?php } ?>
          <?php if($au_title!=''){ ?><h3><?= $au_title ?></h3><?php } ?>
        </div>
        <!-- Title Ends! -->

        <?php if($au_content!=''){ ?><p><?= $au_content ?></p><?php } ?>

      </div>
      <!-- About Ends! -->

      <!-- Team -->
      <div class="team">

      <?php
        $team_args = array(
          'post_type' => 'member',
          'orderby' => 'menu_order',
          'order' => 'ASC'
        );
        $the_query = new WP_Query( $team_args );
      ?>

      <?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

    <!-- Member -->
    <div class="member">
      <div class="image">
          <img src="<?= str_replace('.jpg', '-480x480.jpg', get_field( 'magethemes_zen_member_image')) ?>" alt="">
          <div class="info">
            <p><?php the_field( 'magethemes_zen_member_description' ); ?></p>
          </div>
      </div>
      <h4><?php the_title(); ?><br><span><?php the_field( 'magethemes_zen_position' ); ?></span></h4>
    </div>
    <!-- Member Ends! -->

      <?php endwhile; endif; ?>

      <?php wp_reset_postdata(); // Restore original Post Data ?>

      </div>
      <!-- Team Ends! -->

    </div>
  </div>
  <!-- Page Ends! -->

  <!-- Map -->
  <div class="map" id="<?= sanitize_title($menu_names[4]) ?>">
    <div id="map_canvas"></div>
  </div>
  <!-- Map Ends! -->

<?php get_footer(); ?>