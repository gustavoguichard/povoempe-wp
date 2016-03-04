<!-- Slider -->
<?php
  $abstract_args = array(
    'post_type' => 'slider'
  );
  $parallaxbg = get_option('magethemes_zen_theme_logo');
  $the_query = new WP_Query( $abstract_args );
?>
  <!-- Slider -->
  <!-- Slider -->
  <div class="slider" style="background:white url('<?php echo $parallaxbg['magethemes_zen_parallax_bg']; ?>') 50% 0 no-repeat fixed;">

    <div class="container">
      <ul class="slides">
      <?php if (  $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
        <li>

          <!-- Slider Item -->
          <div>
            <strong><?php the_title(); ?></strong><br>
            <?php the_field( 'magethemes_zen_slider_subtitle' ); ?><br>
           <?php the_field( 'magethemes_zen_slider_subtitle_2' ); ?>
          </div>
          <!-- Slider Item Ends! -->

        </li>
        <?php endwhile; else: ?>
        <p>Slides are missing!</p>
    	<?php endif; ?>
      </ul>
    </div>

  </div>
  <!-- Slider Ends! -->