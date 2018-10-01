<?php get_header(); ?>

<div id="content">
  <?php if (have_posts()) : ?>
  <?php while (have_posts()) : the_post(); ?>
  <div class="entry">
    <div class="post" id="post-<?php the_ID(); ?>">
      <h3>
        <?php the_title(); ?>
      </h3>
      <?php the_content('Читать полностью &raquo;'); ?>
      <?php the_tags('Метки: ', ', ', ' '); ?>
      <?php edit_post_link('Править', '[ ', ' ]'); ?>
    </div>
  </div>
  <?php comments_template(); ?>
  <?php endwhile; ?>

  <?php else : ?>
  <h2 class="center">Не найдено</h2>
  <p class="center">К сожалению, по вашему запросу ничего не найдено.</p>
  <?php include (TEMPLATEPATH . "/searchform.php"); ?>
  <?php endif; ?>
</div>
<!--end: content-->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
