<?php
/**
 * @package blooster
 * template for quote post
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
                <h4><i class="fa fa-bookmark"></i><?php the_category(' '); ?></h4>

		<div class="entry-meta">
			<?php blooster_posted_on(); ?>
		</div><!-- .entry-meta -->
		
	</header><!-- .entry-header -->
	<div class="entry-content">
		<?php
                    the_content();
                ?>
	</div><!-- .entry-content -->
	<footer class="entry-footer">
		<?php blooster_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->