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

        <!-- Social Links -->
        <ul>
          <?php if(get_option('magethemes_zen_theme_social_twitter')!=''){ ?><li><a href="<?php echo get_option('magethemes_zen_theme_social_twitter'); ?>"><i class="fa fa-twitter fa-2x"></i></a></li><?php } ?>
          <?php if(get_option('magethemes_zen_theme_social_facebook')!=''){ ?><li><a href="<?php echo get_option('magethemes_zen_theme_social_facebook'); ?>"><i class="fa fa-facebook fa-2x"></i></a></li><?php } ?>
          <?php if(get_option('magethemes_zen_theme_social_pinterest')!=''){ ?><li><a href="<?php echo get_option('magethemes_zen_theme_social_pinterest'); ?>"><i class="fa fa-pinterest fa-2x"></i></a></li><?php } ?>
          <?php if(get_option('magethemes_zen_theme_social_instagram')!=''){ ?><li><a href="<?php echo get_option('magethemes_zen_theme_social_instagram'); ?>"><i class="fa fa-instagram fa-2x"></i></a></li><?php } ?>
          <?php if(get_option('magethemes_zen_theme_social_dribbble')!=''){ ?><li><a href="<?php echo get_option('magethemes_zen_theme_social_dribbble'); ?>"><i class="fa fa-dribbble fa-2x"></i></a></li><?php } ?>
          <?php if(get_option('magethemes_zen_theme_social_google')!=''){ ?><li><a href="<?php echo get_option('magethemes_zen_theme_social_google'); ?>"><i class="fa fa-google-plus fa-2x"></i></a></li><?php } ?>
          <?php if(get_option('magethemes_zen_theme_social_linkedin')!=''){ ?><li><a href="<?php echo get_option('magethemes_zen_theme_social_linkedin'); ?>"><i class="fa fa-linkedin fa-2x"></i></a></li><?php } ?>
        </ul>
        <!-- Social Links Ends! -->

        <p class="copyright">Copyright <a href="<?php bloginfo('siteurl'); ?>"><?php echo $name_bloginfo ?></a></p>
      </div>

    </div>
  </div>
  <!-- Footer Ends! -->

</div>
<?php wp_footer(); ?>
</body>
</html>