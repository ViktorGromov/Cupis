<?php get_header(); ?>

<div id="col1">
  <?php if (file_exists(ABSPATH . '/wp-content/plugins/featured-content-gallery/gallery.php')) include (ABSPATH . '/wp-content/plugins/featured-content-gallery/gallery.php'); ?>
  <div class="featuredline"></div>
  <div class="clear"></div>
  <?php if (have_posts()) : ?>
  <?php while (have_posts()) : the_post(); ?>
  <div id="post">
    <div id="postbox">
      <div class="header">
        <h3><a href="<?php the_permalink() ?>" rel="bookmark" title="Постоянная ссылка: <?php the_title_attribute(); ?>">
          <?php the_title(); ?>
          </a></h3>
        <span class="author">
        <?php the_author_posts_link(); ?>
        </span> // <span class="date">
        <?php the_time('d M Y') ?>
        </span></div>
      <div class="thumbnail">
        <?php get_thumbnail($post->ID, 'thumbnail', 'alt="' . $post->post_title . '"'); ?>
      </div>
            <div class="clear"></div>

      <div class="info">
        <?php the_content_limit('315'); ?>
      </div>
      <div class="meta"><span class="continue"> <a href="<?php the_permalink() ?>" rel="bookmark" title="Постоянная ссылка: <?php the_title_attribute(); ?>">
        <?php _e("Читать полностью", 'themejunkie'); ?>
        </a> </span> <span class="comment">
        <?php comments_popup_link('Ваш отзыв', '1 отзыв', 'Отзывов (%)'); ?>
        </span></div>
    </div>
    <!--end: postbox-->
  </div>
  <!--end: post-->
  <?php endwhile; ?>
  <div class="clear"></div>
  <div class="navigation">
    <?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>
  </div>
  <?php else : ?>
  <p>No posts found.</p>
  <?php endif; ?>
</div>
<!--end: col1-->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
