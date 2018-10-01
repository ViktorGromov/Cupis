<?php
/**
 * @package blooster
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
                <h4><i class="fa fa-bookmark"></i><?php the_category(' '); ?></h4>
		<?php the_title( sprintf( '<h1 class="entry-title"><i class="fa fa-pencil stx"></i><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php blooster_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_post_thumbnail(); ?>
            <p>
                <?php echo get_the_excerpt(); ?>
            </p> 
            
            
               
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'blooster' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php blooster_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->