
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>

		<?php if ( get_theme_mod('virality_enable_meta') ) : ?>
        <div class="entry-meta">
			<?php virality_posted_on(); ?>
		</div><!-- .entry-meta -->
        <?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content post-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'virality' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->

	<?php if ( get_theme_mod('virality_enable_meta') ) : ?>
    <footer class="entry-meta">
		<?php
			/* translators: used between list items, there is a space after the comma */
			$category_list = get_the_category_list( __( ', ', 'virality' ) );

			/* translators: used between list items, there is a space after the comma */
			$tag_list = get_the_tag_list( '', ', ' );

			if ( ! virality_categorized_blog() ) {
				// This blog only has 1 category so we just need to worry about tags in the meta text
				if ( '' != $tag_list ) {
					$meta_text = __( 'tagged %2$s', 'virality' );
				} 

			} else {
				// But this blog has loads of categories so we should probably display them here
				if ( '' != $tag_list ) {
					$meta_text = __( 'Posted in %1$s / tagged %2$s', 'virality' );
				} else {
					$meta_text = __( 'Posted in %1$s', 'virality' );
				}

			} // end check for categories on this blog

			printf(
				$meta_text,
				$category_list,
				$tag_list,
				get_permalink(),
				the_title_attribute( 'echo=0' )
			);
		?>
	</footer><!-- .entry-meta -->
    <?php endif; ?>
    
    <?php if ( ! get_theme_mod('virality_author_bio') ) : ?>
    <!--BEGIN .author-bio-->
    <div class="author-bio-wrap">
        <div class="author-bio clearfix">
            <?php
            $author_avatar = get_avatar( get_the_author_meta('email'), '80' );
            if ($author_avatar) : ?>
                <div class="author-thumb"><?php echo $author_avatar; ?></div>
            <?php endif; ?>
            
            <div class="author-info">
                <?php $author_posts_url = get_author_posts_url( get_the_author_meta( 'ID' )); ?> 
                <h4 class="author-title"><a href="<?php echo esc_url($author_posts_url); ?>" title="<?php printf( __( 'View all posts by %s', 'virality' ), get_the_author() ) ?>"><?php the_author(); ?></a></h4>
                <?php $author_desc = get_the_author_meta('description');
                if ( $author_desc ) : ?>
                <p class="author-description"><?php echo $author_desc; ?></p>
                <?php endif; ?>
                <?php $author_url = get_the_author_meta('user_url');
                if ( $author_url ) : ?>
                <p><?php _e('Website: ', 'virality') ?><a href="<?php echo $author_url; ?>"><?php echo $author_url; ?></a></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
	<!--END .author-bio-->
    <?php endif; ?>
    
</article><!-- #post-<?php the_ID(); ?> -->
