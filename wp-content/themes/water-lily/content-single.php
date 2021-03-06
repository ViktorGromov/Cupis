<?php
/**
 * @package water lily
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
	<?php if( has_post_thumbnail() ) : 
			
		/*echo the_post_thumbnail( 'full', array('class' => 'aligncenter') );*/ ?>
		
	<?php endif; ?>
		
	<div class="entry-content">
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<div class="entry-meta">
			<?php water_lily_posted_on(); ?>
		</div><!-- .entry-meta -->
			
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'water-lily' ),
				'after'  => '</div>',
			) );
		?>		
		
		<footer class="entry-meta below">
			<?php
				/* translators: used between list items, there is a space after the comma */
				$category_list = get_the_category_list( __( ', ', 'water-lily' ) );

				/* translators: used between list items, there is a space after the comma */
				$tag_list = get_the_tag_list( '', __( ', ', 'water-lily' ) );

				if ( ! water_lily_categorized_blog() ) {
					// This blog only has 1 category so we just need to worry about tags in the meta text
					if ( '' != $tag_list ) {
						$meta_text = __( 'Tags: %2$s.', 'water-lily' );
					} else {
						$meta_text = '';
					}

				} else {
					// But this blog has loads of categories so we should probably display them here
					if ( '' != $tag_list ) {
						$meta_text = __( 'Posted in: %1$s. Tags: %2$s.', 'water-lily' );
					} else {
						$meta_text = __( 'Posted in: %1$s.', 'water-lily' );
					}

				} // end check for categories on this blog

				printf(
					$meta_text,
					$category_list,
					$tag_list
				);
			?>

			<?php edit_post_link( __( 'Edit', 'water-lily' ), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-meta -->
		
	</div><!-- .entry-content -->

</article><!-- #post-## -->
