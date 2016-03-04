<?php get_header(); ?>


<!-- Blog Page -->
<div class="blog-page">

  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <?php get_template_part( 'blog', 'post' ); ?>

  <?php endwhile; else: ?>

    <p>There are no posts or pages here</p>

  <?php endif; ?>

  <?php posts_nav_link(); ?>

</div>
<!-- Blog Page Ends! -->

<?php get_footer(); ?>