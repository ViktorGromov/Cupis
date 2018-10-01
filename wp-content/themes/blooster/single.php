<?php
/**
 * The template for displaying all single posts.
 *
 * @package blooster
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main post-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'single' ); ?>
                    
                    <div id="authorarea">
                        <?php echo get_avatar( get_the_author_meta( 'user_email' ), 70 ); ?>
                        
                            <div class="authorinfo">
                                <h3>About <?php echo get_the_author(); ?></h3>
                                <p><?php the_author_meta( 'description' ); ?></p>
                                    <span class="readmore"><a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author"> <?php echo esc_html__('View all posts by','blooster'); echo get_the_author(); ?> </span></a>
                            </div>
                        
                    </div>

                    <h1><?php blooster_post_nav(); ?></h1>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // end of the loop. ?>
                    

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
