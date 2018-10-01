<?php get_header(); ?>

 <div id="content">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <p class="browse"> Главная //
      <?php the_category(', ') ?>
      //
      <?php the_title();?>
    </p>
    <?php the_title('<h3>', '</h3>'); ?>
    <p class="postmeta">Автор:
      <?php the_author_posts_link(); ?>,
      <?php the_time('d M Y') ?>
      |
      <?php comments_popup_link('Ваш отзыв', '1 отзыв', 'Отзывов (%)'); ?>
    </p>
    <div class="entry">
      <?php the_content('Читать полностью...'); ?>
    <div class="clear"></div>
    </div>
    <!--end: entry-->
    <p class="browse">
      <?php the_tags('Метки: ', ', ', ''); ?>
 
      <?php edit_post_link('Править', ' [ ', ' ] '); ?>
    </p>
    <?php comments_template(); ?>
    <?php endwhile; else: ?>

    <?php endif; ?>
  </div>
  <!--end: content-->
  
<?php get_sidebar(); ?>
<?php get_footer(); ?>