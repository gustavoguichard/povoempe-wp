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
  <div class="slider" style="background-image: url('<?php echo $parallaxbg['magethemes_zen_parallax_bg']; ?>');">

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

      <!-- Abstract -->
      <div class="abstract">

        <!-- Title -->
        <?php if(get_option('magethemes_zen_theme_first_subtitle')!=''){ ?><h2><?php echo get_option('magethemes_zen_theme_first_subtitle'); ?></h2><?php } ?>
        <?php if(get_option('magethemes_zen_theme_first_title')!=''){ ?><h3><?php echo get_option('magethemes_zen_theme_first_title'); ?></h3><?php } ?>
        <!-- Title Ends! -->

        <?php if(get_option('magethemes_zen_theme_first_content')!=''){ ?><p><?php echo get_option('magethemes_zen_theme_first_content'); ?></p><?php } ?>
        <?php if(get_option('magethemes_zen_theme_first_blockquote')!=''){ ?><blockquote><p><?php echo get_option('magethemes_zen_theme_first_blockquote'); ?></p></blockquote><?php } ?>

      </div>
      <!-- Abstract Ends! -->

      <!-- Projects -->
      <a class="anchor" id="projects"></a>
      <div class="projects">
        <!-- Projects Types, Menu -->
        <ul class="button-group">
          <li><a href="#" class="active" data-filter="*">all</a></li>
          <?php $terms = get_terms("portfolio_categories");
           if ( !empty( $terms ) && !is_wp_error( $terms ) ){
             foreach ( $terms as $term ) {
               echo '<li><a href="#" data-filter=".'.$term->slug . '">'.$term->name.'</a></li>';
             }
           }
           ?>
        </ul>
        <!-- Projects Types, Menu Ends! -->
        <?php
			$portfolios_to_show = get_option('magethemes_zen_theme_portfolio_nr');
          if(isset($_GET['page'])){ $paged = $_GET['page']; } else { $paged = 1; }
          $featured_projects_args = array(
            'post_type' => 'portfolio',
            'orderby' => 'menu_order',
            'order' => 'ASC',
            'paged' => $paged,
            'posts_per_page' => $portfolios_to_show
          );

          $the_query = new WP_Query( $featured_projects_args );

          $foundedpostost = $the_query->found_posts;
        ?>

        <!-- Projects List -->
        <div class="project" data-id="<?php echo 'founded'.floor($the_query->found_posts/8); ?>">
          <?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
          <?php $image = wp_get_attachment_image_src(get_field('magethemes_zen_image'), 'magethemes_zen_portfolio'); ?>

          <div class="<?php $pterms = wp_get_post_terms( get_the_ID(), 'portfolio_categories');
          if ( !empty( $pterms ) && !is_wp_error( $pterms ) ) {
             foreach ( $pterms as $pterm ) {
               echo $pterm->slug . ' ';
             }
          } ?>">
          <a href="#"><img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>"></a>
        </div>

          <?php endwhile; else: ?>
          <p>No portfolio items! You will need to add some.</p>
          <?php endif; ?>

        </div>
        <!-- Projects List Ends! -->

        <?php if((int)$foundedpostost > $portfolios_to_show){ ?><div id="more" class="load-more">load more</div><?php } ?>

        <!-- Project -->
        <?php $featured_projects_args = array(
            'post_type' => 'portfolio',
            'orderby' => 'menu_order',
            'order' => 'ASC',
            'paged' => $paged,
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
  <a class="anchor" id="services"></a>
  <div class="services">

    <h2><?php echo get_option('magethemes_zen_our_services_title'); ?></h2>

    <!-- Services List -->
    <div class="service">
      <div class="container">

      <?php
        $services_args = array(
          'post_type' => 'service',
          'orderby' => 'menu_order',
          'order' => 'ASC'
        );
        $the_query = new WP_Query( $services_args );
      ?>

      <?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

        <div>
          <h3><i class="fa <?php the_field( 'magethemes_zen_service_icon' ); ?> fa-3x"></i><br><?php the_title(); ?></h3>
          <p><?php the_field( 'magethemes_zen_services_description' ); ?></p>
        </div>

      <?php endwhile; else: ?>
        <div>No services to display here! You will need to add some.</div>
      <?php endif; ?>

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
      <a class="anchor" id="about"></a>
      <div class="about">

        <!-- Title -->
        <div class="title">
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

      <ul>
        <?php if ( get_field( 'magethemes_zen_twitter_profile' ) ) : ?>
          <li><a href="<?php the_field( 'magethemes_zen_twitter_profile' ); ?>">&#xf099;</a></li>
        <?php endif; ?>
        <?php if ( get_field( 'magethemes_zen_facebook_profile' ) ) : ?>
          <li><a href="<?php the_field( 'magethemes_zen_facebook_profile' ); ?>">&#xf09a;</a></li>
        <?php endif; ?>
        <?php if ( get_field( 'magethemes_zen_pinterest_profile' ) ) : ?>
          <li><a href="<?php the_field( 'magethemes_zen_pinterest_profile' ); ?>">&#xf0d2;</a></li>
        <?php endif; ?>
        <?php if ( get_field( 'magethemes_zen_instagram_profile' ) ) : ?>
          <li><a href="<?php the_field( 'magethemes_zen_instagram_profile' ); ?>">&#xf16d;</a></li>
        <?php endif; ?>
        <?php if ( get_field( 'magethemes_zen_dribbble_profile' ) ) : ?>
          <li><a href="<?php the_field( 'magethemes_zen_dribbble_profile' ); ?>">&#xf17d;</a></li>
        <?php endif; ?>
        <?php if ( get_field( 'magethemes_zen_google_profile' ) ) : ?>
          <li><a href="<?php the_field( 'magethemes_zen_google_profile' ); ?>">&#xf0d5;</a></li>
        <?php endif; ?>
        <?php if ( get_field( 'magethemes_zen_linkedin_profile' ) ) : ?>
          <li><a href="<?php the_field( 'magethemes_zen_linkedin_profile' ); ?>">&#xf0e1;</a></li>
        <?php endif; ?>
      </ul>

    </div>
    <!-- Member Ends! -->

      <?php endwhile; else: ?>
        <p>No team members! You will need to hire some.</p>
      <?php endif; ?>

      <?php wp_reset_postdata(); // Restore original Post Data ?>

      </div>
      <!-- Team Ends! -->

    </div>
  </div>
  <!-- Page Ends! -->

  <!-- Contact -->
  <a class="anchor" id="contact"></a>
  <div class="contact">
    <div class="container">

      <!-- Contact Form -->
      <div class="form">

        <!-- Title -->
        <div class="title">
          <?php if(get_option('magethemes_zen_theme_contact_subtitle')!=''){ ?><h2><?php echo get_option('magethemes_zen_theme_contact_subtitle'); ?></h2><?php } ?>
          <?php if(get_option('magethemes_zen_theme_contact_title')!=''){ ?><h3><?php echo get_option('magethemes_zen_theme_contact_title'); ?></h3><?php } ?>
        </div>
        <!-- Title Ends! -->

        <!-- Form -->
        <?php echo do_shortcode( get_option('magethemes_zen_theme_contact_form') ) ?>
        <!-- Form Ends! -->

      </div>
      <!-- Contact Form Ends! -->

    </div>
  </div>
  <!-- Contact Ends! -->

  <!-- Map -->
  <div class="map">
    <div id="map_canvas"></div>
  </div>
  <!-- Map Ends! -->

<?php get_footer(); ?>