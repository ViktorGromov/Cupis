
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	
    <?php if( has_shortcode( $post->post_content, 'gallery' ) ) : ?>
		<?php 
                $gallery = get_post_gallery( $post, false );
				if ( !empty($gallery['ids']) ) {
					$ids = explode( ",", $gallery['ids'] );
					$total_images = 0;
					foreach( $ids as $id ) {
						
						$title = get_post_field('post_title', $id);
						$meta = get_post_field('post_excerpt', $id);
						$link = wp_get_attachment_url( $id );
						$image  = wp_get_attachment_image( $id, array(640, 480));
						$total_images++;
						
						if ($total_images == 1) {
							$first_img = $image;
						}
					}
				} else {
					$images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC' ) );
					if ( $images ) {
						$total_images = count( $images );
						$first_img = array_shift( $images );
						$image = wp_get_attachment_image( $first_img->ID, array(640, 480) );
					} else {
						$total_images = 0;
						$first_img = '';
						$image = '';	
					}
				}
        ?>
        <?php endif; ?>
        
        <?php if ( has_post_thumbnail()) : ?>
            <div class="imgthumb"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'full' ); ?></a></div><!-- .imgthumb -->
        <?php else : ?>
            <div class="imgthumb"><a href="<?php the_permalink(); ?>"><?php echo $first_img; ?></a></div><!-- .imgthumb -->
      	<?php endif; ?>
        
        <header class="entry-header">
		  <?php if ( is_single() ) : ?>
            <h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'virality' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
          <?php else : ?>
            <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'virality' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
          <?php endif; ?>
        </header><!-- .entry-header -->

</article><!-- #post-<?php the_ID(); ?> -->
