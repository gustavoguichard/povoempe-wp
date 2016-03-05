<?php
/**
 * @package WordPress
 * @subpackage Zen

 Template Name: Homepage

*/
get_header(); ?>
  <?php
    $parallaxbg = get_option('magethemes_zen_theme_logo');
    $videoID = get_option('magethemes_zen_slider_video_id');
  ?>
  <!-- Slider -->
  <div class="slider bg-parallax" style="background-image: url('<?php echo $parallaxbg['magethemes_zen_parallax_bg']; ?>');">

    <div class="container">
      <div class="video-container">
        <div class="videoWrapper">
          <iframe src="https://player.vimeo.com/video/<?php echo $videoID ; ?>?color=61744E&title=0&byline=0&portrait=0" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
        </div>
      </div>
    </div>

  </div>

  <!-- Page Content -->
  <div class="container-page">
    <div class="container">
      <a class="anchor" id="sobre"></a>
      <!-- Abstract -->
      <div class="abstract">

        <!-- Title -->
        <div class="big-title">
        <?php if(get_option('magethemes_zen_theme_first_subtitle')!=''){ ?><h2><?php echo get_option('magethemes_zen_theme_first_subtitle'); ?></h2><?php } ?>
        <?php if(get_option('magethemes_zen_theme_first_title')!=''){ ?><h3><?php echo get_option('magethemes_zen_theme_first_title'); ?></h3><?php } ?>
        </div>
        <!-- Title Ends! -->

        <?php if(get_option('magethemes_zen_theme_first_content')!=''){ ?><p><?php echo nl2br(get_option('magethemes_zen_theme_first_content')); ?></p><?php } ?>
        <?php if(get_option('magethemes_zen_theme_first_blockquote')!=''){ ?><blockquote><p><?php echo nl2br(get_option('magethemes_zen_theme_first_blockquote')); ?></p></blockquote><?php } ?>

      </div>
      <!-- Abstract Ends! -->

      <!-- Projects -->
      <div class="projects">
        <a class="anchor" id="estabelecimentos"></a>
        <!-- Title -->
        <div class="big-title">
          <h2>Nossos</h2>
          <h3>Estabelecimentos</h3>
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
        <div class="project" data-id="<?php echo 'founded'.floor($the_query->found_posts/8); ?>">
          <?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
          <?php $image = wp_get_attachment_image_src(get_field('magethemes_zen_image'), 'magethemes_zen_portfolio'); ?>

          <div class="estabelecimento">
            <a href="#">
              <img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>">
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

       <div class="single">

          <div class="image">
            <img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>">
          </div>

          <div class="details">
            <h2><?php the_title(); ?><a href="#"><i class="fa fa-times"></i></a></h2>
            <?php echo get_field( 'magethemes_zen_portfolio_description' ); ?>
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
  <a class="anchor" id="caracteristicas"></a>
  <div class="services bg-parallax">

    <h2><?php echo get_option('magethemes_zen_our_services_title'); ?></h2>

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
      <a class="anchor" id="guardioes"></a>
      <div class="abstract">

        <!-- Title -->
        <div class="big-title">
          <?php if(get_option('magethemes_zen_theme_au_subtitle')!=''){ ?><h2><?php echo get_option('magethemes_zen_theme_au_subtitle'); ?></h2><?php } ?>
          <?php if(get_option('magethemes_zen_theme_au_title')!=''){ ?><h3><?php echo get_option('magethemes_zen_theme_au_title'); ?></h3><?php } ?>
        </div>
        <!-- Title Ends! -->

        <?php if(get_option('magethemes_zen_theme_au_content')!=''){ ?><p><?php echo get_option('magethemes_zen_theme_au_content'); ?></p><?php } ?>

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
          <img src="<?php the_field( 'magethemes_zen_member_image' ); ?>" alt="">
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

  <!-- Contact
  <div class="contact">
    <div class="container">

      <div class="form">

        <div class="title">
          <?php if(get_option('magethemes_zen_theme_contact_subtitle')!=''){ ?><h2><?php echo get_option('magethemes_zen_theme_contact_subtitle'); ?></h2><?php } ?>
          <?php if(get_option('magethemes_zen_theme_contact_title')!=''){ ?><h3><?php echo get_option('magethemes_zen_theme_contact_title'); ?></h3><?php } ?>
        </div>

        <?php echo do_shortcode( get_option('magethemes_zen_theme_contact_form') ) ?>

      </div>

    </div>
  </div>
  <!-- Contact Ends! -->
  <div class="services">
    <a class="anchor" id="agenda"></a>
    <h2>Agenda</h2>
  </div>

  <!-- Map -->
  <div class="map">
    <div id="map_canvas"></div>
  </div>
  <!-- Map Ends! -->

<?php get_footer(); ?>