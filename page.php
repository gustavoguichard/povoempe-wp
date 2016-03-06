<?php get_header(); ?>


<!-- Blog Page -->
<div class="blog-page">

    <?php
    // Start the loop.
    while ( have_posts() ) : the_post();

      // Include the page content template.
      get_template_part( 'content', 'page' );

    // End the loop.
    endwhile;
    ?>

</div>
<!-- Blog Page Ends! -->

<?php get_footer(); ?>