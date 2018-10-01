<?php
/**
 * @package blooster
 * template for gallery posts
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
                <h4><i class="fa fa-bookmark"></i><?php the_category(' '); ?></h4>
		<?php the_title( sprintf( '<h1 class="entry-title"><i class="fa fa-picture-o"></i><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php blooster_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		
            <?php 
                $gallery_atts = array(
                    'post_parent' => $post->ID,
                    'post_mime_type' => 'image'
                );
                $gallery_images = get_children($gallery_atts);
                if (!empty($gallery_images)) {
                    $gallery_count = count($gallery_images);
                    $first_image =  array_shift($gallery_images);
                    $display_first_image = wp_get_attachment_image($first_image->ID);
                 ?>
            <figure>
                            <a href="<?php the_permalink();?>"><?php echo $display_first_image; ?></a>
            </figure>
            <?php }?>
            
            
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php blooster_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
