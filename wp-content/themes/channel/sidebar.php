<div id="sidebar">
  <?php if (get_theme_mod('showad300x250') == 'Yes') { ?>
  <div class="ad300x250"><?php echo stripslashes(get_theme_mod('ad300x250')); ?></div>
  <?php } else { ?>
  <?php } ?>
  <!--end: ad300x250-->
  <div class="widget">
    <?php if (get_theme_mod('subscribe') == 'Yes') { ?>
    <h3>
      <?php _e("Подписка", 'themejunkie'); ?>
    </h3>
    <div class="box">
      <div class="right"><img src="<?php echo bloginfo('template_url'); ?>/images/feed.gif" /></div>
      <?php _e("Вы можете подписаться на RSS или Email, чтобы получать последнии новости с сайта.", 'themejunkie'); ?>
      <p class="rss"> <span class="postsfeed"><a rel="nofollow" href="<?php bloginfo('rss_url');?>">
        <?php _e("Публикации", 'themejunkie'); ?>
        </a></span> <span class="commentsfeed"><a rel="nofollow" href="<?php bloginfo('comments_rss2_url');?>">
        <?php _e("Комментарии", 'themejunkie'); ?>
        </a></span></p>
      <form id="subscribeform" action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo get_theme_mod('feedburner_id'); ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
        <div id="subscribe">
          <input class="subscribeinput" value="Ваш email..." onclick="this.value='';" name="feed" id="input" />
          <input type="hidden" value="<?php echo get_theme_mod('feedburner_id'); ?>" name="uri"/>
          <input type="hidden" name="loc" value="en_US"/>
          <input type="submit" class="subscribesubmit" value="Ок!"/>
        </div>
      </form>
    </div>
    <?php } else { ?>
    <?php } ?>
    <!--end: subscribe-->
    <?php if(get_theme_mod('flickr') == 'Yes') { ?>
    <h3>
      <?php _e("Flickr", 'themejunkie'); ?>
    </h3>
    <div class="box flickr">
      <?php if (function_exists('get_flickrRSS')) get_flickrRSS(); ?>
    </div>
    <?php } else { ?>
    <?php } ?>
    <!--end: flickr rss-->
    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Full Width Widget') ) : ?>
    <?php endif; ?>
  </div>
  <!--end: widget-->
  <div class="leftwidget">
    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Left Widget') ) : ?>
    <h3>
      <?php _e("Left Widget", 'themejunkie'); ?>
    </h3>
    <div class="box">
      <?php _e("Тут может быть какой-то текст или меню, просто поместите сюда виджет.", 'themejunkie'); ?>
    </div>
    <?php endif; ?>
  </div>
  <!--end: left widget-->
  <div class="rightwidget">
    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Right Widget') ) : ?>
    <h3>
      <?php _e("Right Widget", 'themejunkie'); ?>
    </h3>
    <div class="box">
      <?php _e("Тут может быть какой-то текст или меню, просто поместите сюда виджет.", 'themejunkie'); ?>
    </div>
    <?php endif; ?>
  </div>
  <!--end: right widget-->
</div>
<!--end: sidebar-->
