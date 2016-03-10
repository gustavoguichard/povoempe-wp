<?php
/**
 * @package WordPress
 * @subpackage Zen

 Template Name: Homepage

*/
get_header(); ?>
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
      <!-- Abstract Ends! -->

      <!-- Projects -->
      <div class="projects">
        <a class="anchor" id="<?= sanitize_title($menu_names[1]) ?>"></a>
        <!-- Title -->
        <div class="big-title">
          <h2>Nossas</h2>
          <h3><?= $menu_names[1] ?></h3>
        </div>
        <!-- Title Ends! -->

        <?php
          $featured_projects_args = array(
            'post_type' => 'portfolio',
            'orderby' => 'menu_order',
            'order' => 'ASC',
            'posts_per_page' => -1
          );

          $the_query = new WP_Query( $featured_projects_args );

        ?>

        <!-- Projects List -->
        <div class="project" data-id="<?= 'founded'.floor($the_query->found_posts/8) ?>">
          <?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
          <?php $image = wp_get_attachment_image_src(get_field('magethemes_zen_image'), 'magethemes_zen_portfolio'); ?>

          <div class="estabelecimento">
            <a href="#" class="estab-link" data-post-id="<?= get_post_field( 'post_name', get_post() ) ?>">
              <img src="<?= $image[0] ?>" class="estab-thumb" alt="<?php the_title(); ?>">
            </a>
          </div>

          <?php endwhile; endif; ?>

        </div>
        <!-- Projects List Ends! -->

        <!-- Project -->
        <?php $featured_projects_args = array(
            'post_type' => 'portfolio',
            'orderby' => 'menu_order',
            'order' => 'ASC',
            'posts_per_page' => $portfolios_to_show
          );

        $the_query = new WP_Query( $featured_projects_args );

        if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post();?>
       <?php $image = wp_get_attachment_image_src(get_field('magethemes_zen_image'), 'magethemes_zen_portfolio'); ?>

       <div class="single" data-post-id="<?= get_post_field( 'post_name', get_post() ) ?>" style="display: none;">

          <div class="image">
            <img src="<?= $image[0]; ?>" alt="<?php the_title() ?>">
          </div>

          <div class="details">
            <h2><?php the_title(); ?><a href="#" class="close"><i class="fa fa-times"></i></a></h2>
            <?= get_field( 'magethemes_zen_portfolio_description' ) ?>
          </div>

        </div>

        <?php endwhile; endif; ?>
        <!-- Project Example Ends! -->
      </div>
      <!-- Projects Ends! -->

    </div>
  </div>
  <!-- Page Content Ends! -->

  <!-- Services -->
  <a class="anchor" id="<?= sanitize_title($menu_names[3]) ?>"></a>
  <div class="services bg-parallax">

    <h2 class="green-title"><?= $menu_names[3] ?></h2>

    <!-- Services List -->
    <div class="service">
      <div class="container service-container">

      <?php
        $services_args = array(
          'post_type' => 'service',
          'orderby' => 'menu_order',
          'order' => 'ASC'
        );
        $the_query = new WP_Query( $services_args );
      ?>

      <?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

        <div class="service-item">
          <h3><i class="fa <?php the_field( 'magethemes_zen_service_icon' ); ?> fa-3x"></i><br><?php the_title(); ?></h3>
          <p><?php the_field( 'magethemes_zen_services_description' ); ?></p>
        </div>

      <?php endwhile; endif; ?>

      <?php wp_reset_postdata(); // Restore original Post Data ?>

      </div>
    </div>
    <!-- Services List Ends! -->

  </div>
  <!-- Services Ends! -->

  <!-- Page Content -->
  <div class="page">
    <div class="container">

      <!-- About -->
      <a class="anchor" id="<?= sanitize_title($menu_names[4]) ?>"></a>
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

  <?php
    global $fb;
    if(current_user_can( 'publish_posts' ) && !isset($_SESSION['facebook_access_token']) && isset($fb)) {
      $helper = $fb->getRedirectLoginHelper();
      $permissions = ['email'];
      $loginUrl = $helper->getLoginUrl(get_option("siteurl").'/login-callback/', $permissions);
    }

    $string = file_get_contents(get_template_directory().'/data/events.json');
    $json_a = json_decode($string, true);
    $valid_events = array_reverse(
      array_filter($json_a['events'], function($event) {
        $today = date(c);
        $has_start = isset($event['start_time']['date']);
        $has_end = isset($event['end_time']['date']);
        $is_scheduled = ($has_end & $event['end_time']['date'] >= $today) || ($has_start & $event['start_time']['date'] >= $today);
        return($is_scheduled);
      })
    );
  ?>
  <div class="agenda">
    <a class="anchor" id="<?= sanitize_title($menu_names[2]) ?>"></a>
    <h2 class="green-title"><?= $menu_names[2] ?></h2>
    <?php if(isset($loginUrl) && !isset($_GET['agenda'])) : ?>
      <a class="button" href="<?=$loginUrl?>">ATUALIZAR AGENDA!</a>
    <?php elseif(isset($_GET['agenda'])) : ?>
      <span>Agenda atualizada</span>
    <?php endif; ?>
    <div class="abstract">
    <?php if(empty($valid_events)) : ?>
      <br/>
      <br/>
      <h2>Sem items na agenda</h2>
    <?php else: ?>
      <?php foreach($valid_events as $event) : ?>
        <?php
          $start_date = new DateTime($event['start_time']['date']);
          $end_date = new DateTime($event['end_time']['date']);
        ?>
        <article class="event-item">
          <a href="https://www.facebook.com/events/<?= $event['id'] ?>/" class="event-link" target="blank">
            <?php if(isset($event['cover'])) : ?>
              <div style="background-image: url(<?= $event['cover']['source'] ?>); background-position: 50% <?= $event['cover']['offset_y'] ?>%;" alt="Imagem do evento" class="event-image"></div>
            <?php endif; ?>
            <div class="event-details">
              <h3 class="event-name"><?= $event['name'] ?></h3>
              <p class="event-date">
                <?= $start_date->format('d/m/Y') ?>
                <?php if($end_date > $start_date) { echo ' - '.$end_date->format('d/m/Y'); } ?>
              </p>
            </div>
          </a>
        </article>
      <?php endforeach; ?>
    <?php endif; ?>
    </div>
  </div>

  <!-- Map -->
  <div class="map" id="<?= sanitize_title($menu_names[5]) ?>">
    <div id="map_canvas"></div>
  </div>
  <!-- Map Ends! -->

<?php get_footer(); ?>