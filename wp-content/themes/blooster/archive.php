 <?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package blooster
 */

get_header(); ?>

	<section id="primary" class="content-area">
            <header class="page-header tittle-position">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->
		<main id="main" class="site-main" role="main">
     
		<?php if ( have_posts() ) : ?>
                       
			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
                        <div class="blooster-box">
				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );
				?>
                                <hr class="theline">
                        </div><!-- blooster-box -->
			<?php endwhile; ?>
                        
			<?php blooster_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
