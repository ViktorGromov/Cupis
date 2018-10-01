
<div class="clear"></div>
<?php if (get_theme_mod('footer_widgets') == 'Yes') { ?>
<div id="footer">
  <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Widget') ) : ?>
  <div class="left">
    <h3>
      <?php _e("Footer Widget #1", 'themejunkie'); ?>
    </h3>
    <div class="box">
      <?php _e("Тут может быть какой-то текст или меню, просто поместите сюда виджет.", 'themejunkie'); ?>
    </div>
  </div>
  <div class="left">
    <h3>
      <?php _e("Footer Widget #2", 'themejunkie'); ?>
    </h3>
    <div class="box">
      <?php _e("Тут может быть какой-то текст или меню, просто поместите сюда виджет.", 'themejunkie'); ?>
    </div>
  </div>
  <div class="left">
    <h3>
      <?php _e("Footer Widget #3", 'themejunkie'); ?>
    </h3>
    <div class="box">
      <?php _e("Тут может быть какой-то текст или меню, просто поместите сюда виджет.", 'themejunkie'); ?>
    </div>
  </div>
  <?php endif; ?>
  <div class="clear"></div>
</div>
<?php } else { ?>
<?php } ?>
<!--end: footer-->
<div class="clear"></div>
<div id="bottom">
  <div class="left">
    <?php _e("Все права защищены &copy; 2010", 'themejunkie'); ?>
    <a href="<?php bloginfo('siteurl'); ?>"><?php bloginfo('name'); ?></a>.
  </div>
  <div class="right">
    <a href="http://mtekst.ru/12196/">Catharsis  ,   Catharsis,   Catharsis</a>
  </div>
  <div class="clear"></div>
</div>
<!--end: bottom-->
</div>
<div class="clear"></div>
<!--end: wrapper-->
<?php if(get_theme_mod('track') == 'Yes') { ?>
<!--begin: blog tracking-->
<?php echo stripslashes(get_theme_mod('track_code')); ?>
<!--end: blog tracking-->
<?php } else { ?>
<?php } ?>
<?php wp_footer(); ?>
</body></html>