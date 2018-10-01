<?php get_header(); ?>

<div id="content">
  <p class="browse"> You are here: Home / Search</p>
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
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
  <?php endwhile; else: ?>
  <h3 class="center">Не найдено</h3>
  <p class="center">К сожалению, по вашему запросу ничего не найдено.</p>
  <?php endif; ?>
</div>
<!--end: content-->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
