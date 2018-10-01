<?php get_header(); ?>

<div id="content">
  <?php if (have_posts()) : ?>
  <?php /* If this is a category archive */ if (is_category()) { ?>
  <p class="browse">Главная //
    <?php single_cat_title(); ?>
  </p>
  <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
  <p class="browse">Главная // Публикации с меткой
    <?php single_tag_title(); ?>
  </p>
  <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
  <p class="browse">Главная // Архивы за
    <?php the_time('d M Y'); ?>
  </p>
  <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
  <p class="browse">Your are here: Home // Archives for
    <?php the_time('F Y'); ?>
  </p>
  <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
  <p class="browse">Главная // Архивы за
    <?php the_time('Y'); ?>
  </p>
  <?php /* If this is an author archive */ } elseif (is_author()) { ?>
  <p class="browse">Страница автора</p>
  <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
    <p class="browse">Архив сайта</p>
    <?php } ?>
  <?php while (have_posts()) : the_post(); ?>
  <div class="archive">
    <div id="post-<?php the_ID(); ?>">
      <h3> <a href="<?php the_permalink() ?>" rel="bookmark" title="Постоянная ссылка: <?php the_title_attribute(); ?>">
        <?php the_title(); ?>
        </a> </h3>
      <div class="archiveleft">
        <?php get_thumbnail($post->ID, 'thumbnail', 'alt="' . $post->post_title . '"'); ?>
      </div>
      <div class="archiveright">
        <?php the_content_limit(400,''); ?>
      </div>
      <div class="clear"></div>
      <div class="archivebottom">
        <?php the_tags('Метки: ', ', ', ' '); ?>
        <?php edit_post_link('Править', '[ ', ' ]'); ?>
      </div>
    </div>
  </div>
  <?php endwhile; ?>
  <div class="clear"></div>
    <div class="navigation">
  <?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>
  </div>
  <?php else : ?>
  <?php endif; ?>
</div>
<!--end: content-->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
