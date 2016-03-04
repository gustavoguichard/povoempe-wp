<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

  <?php if(has_post_thumbnail()){ ?><div class="thumbnail"><?php the_post_thumbnail(); ?></div><?php } ?>

  <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

  <div class="excerpt">
    <?php if(is_single()): ?>

      <ul class="post-meta">
        <li><i class="fa fa-clock-o"></i> <?php the_time('jS F Y') ?></li>
        <li><i class="fa fa-folder-open"></i> <?php the_category(', ') ?></li>
        <li class="tags"></i><?php the_tags('<i class="fa fa-tags"></i>', ', '); ?></li>
        <li><i class="fa fa-user"></i><?php the_author(); ?></li>
      </ul>

      <?php the_content(); ?>

      <?php comments_template(); ?>

    <?php else: ?>

      <div class="the_excerpt">
        <?php the_excerpt(); ?>
      </div>

      <p class="tags"><?php the_tags('<i class="fa fa-tags"></i>', ', '); ?></p>
      <p><a class="post-link" href="<?php the_permalink(); ?>">Continue</a></p>

    <?php endif; ?>

  </div>

</div>