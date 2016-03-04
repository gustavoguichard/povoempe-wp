<!-- Slider -->
<?php
  $abstract_args = array(
    'post_type' => 'slider'
  );
  $the_query = new WP_Query( $abstract_args );
?>
  <!-- Slider -->
  <div class="slider" data-property="{videoURL:'<?php echo get_option('magethemes_zen_slider_video_link'); ?>', containment:'.slider', startAt:0, mute:true, opacity:.6, showControls:false}">

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