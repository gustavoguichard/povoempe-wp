<!-- Slider -->
<?php
  $abstract_args = array(
    'post_type' => 'slider'
  );
  $the_query = new WP_Query( $abstract_args );
?>
<div class="promo">

  <div class="flexslider">
    <ul class="slides">
    <?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

    <li><img src="<?php the_field( 'magethemes_zen_slider_image' ); ?>" alt="" /></li>

    <?php endwhile; else: ?>
      <p>Slides are missing!</p>
    <?php endif; ?>

    </ul>
  </div>

</div>
<!-- Slider Ends! -->