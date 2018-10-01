<?php get_header(); ?>

<div id="content">
  <h2>Архивы по месяцам:</h2>
  <ul>
    <?php wp_get_archives('type=monthly'); ?>
  </ul>
  <h2>Архивы по рубрикам:</h2>
  <ul>
    <?php wp_list_categories(); ?>
  </ul>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
