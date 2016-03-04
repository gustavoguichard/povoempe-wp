<?php get_header(); ?>

<!-- Blog Page -->
<div class="blog-page">

  <?php wp_link_pages(); ?>

  <div class="blog-posts <?php if ( !is_single() ) {echo 'test-s';}; ?>">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <?php get_template_part( 'blog', 'post' ); ?>

  <?php endwhile; ?>
  </div>

  <div class="pagination">

    <div class="nav-previous alignleft"><?php next_posts_link( 'Older posts' ); ?></div>
    <div class="nav-next alignright"><?php previous_posts_link( 'Newer posts' ); ?></div>

  </div>

  <?php else : ?>

  <p>There are no posts or pages here</p>

  <?php endif; ?>

</div>
<!-- Blog Page Ends! -->

<?php get_footer(); ?>