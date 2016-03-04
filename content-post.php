<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

  <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

  <p class="info">Posted in: <?php the_category(', '); ?> On: <?php the_time('F j, Y'); ?></p>

  <div class="excerpt">

    <?php the_content(); ?>

    <?php if(is_single()): ?>

      <?php comments_template(); ?>

    <?php else: ?>

      <p><a class="post-link" href="<?php the_permalink(); ?>">Continue Reading</a></p>

    <?php endif; ?>

    <p class="tags"><?php the_tags( '', ', '); ?></p>
  </div>

</div>