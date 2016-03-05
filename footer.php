<!-- with $name_bloginfo we are preventing someone to output <span>'s -->
<?php $name_bloginfo = html_entity_decode(get_bloginfo('name')); ?>
<!-- Footer -->
  <a class="anchor" id="social"></a>
  <div class="footer bg-parallax">
    <div class="container">

      <?php if(!is_front_page()){ ?>

      <div class="widgets">
        <?php if ( dynamic_sidebar( 'magethemes_zen_footer_widget_id' ) ) : ?>

        <?php else : ?>

          <h4>Widget</h4>
          <p>Place the widget in the contact widget area.</p>

          <?php endif; ?>
      </div>

      <?php } ?>

      <div class="social">

        <?php if(get_option('magethemes_zen_theme_footer_title')!=''){ ?><h4><?php echo get_option('magethemes_zen_theme_footer_title'); ?></h4><?php } ?>
        <?php if(get_option('magethemes_zen_theme_footer_content')!=''){ ?><p><?php echo get_option('magethemes_zen_theme_footer_content'); ?></p><?php } ?>
      </div>

    </div>
  </div>
  <!-- Footer Ends! -->

</div>
<?php wp_footer(); ?>
</body>
</html>