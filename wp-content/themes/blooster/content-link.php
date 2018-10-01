<?php
/**
 * @package blooster
 * template for link post
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
                <h4><i class="fa fa-bookmark"></i><?php the_category(' '); ?></h4>

		<div class="entry-meta no-comments">
			<?php blooster_posted_on(); ?>
		</div><!-- .entry-meta -->
		
	</header><!-- .entry-header -->

	<div class="entry-content">
            <div class="linkpost"><?php the_content();?></div>
	</div><!-- .entry-content -->
        
	<footer class="entry-footer">
		<?php blooster_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->