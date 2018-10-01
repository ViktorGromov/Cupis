<?php
/**
 * @package blooster
 * template for link post
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
                <h4><i class="fa fa-bookmark"></i><?php the_category(' '); ?></h4>
		<?php the_title( sprintf( '<h1 class="entry-title"><i class="fa fa-file-image-o"></i><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

		<div class="entry-meta">
			<?php blooster_posted_on(); ?>
		</div><!-- .entry-meta -->
		
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_post_thumbnail(); ?>
            <p>
                <?php echo get_the_excerpt(); ?>
            </p> 
                
	</div><!-- .entry-content -->
        
	<footer class="entry-footer">
		<?php blooster_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->