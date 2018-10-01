<?php
/**
 * The template for displaying Archive pages.
 *
 * @package ThinkUpThemes
 */

get_header(); ?>

			<?php if( have_posts() ): ?>

				<div id="container">

				<?php while( have_posts() ): the_post(); ?>

					<div class="blog-grid element<?php drift_thinkup_input_stylelayout(); ?>">

					<article id="post-<?php the_ID(); ?>" <?php post_class('blog-article'); ?>>

						<?php if( has_post_thumbnail() ) { ?>
						<header class="entry-header<?php drift_thinkup_input_stylelayout_class1(); ?>">

							<?php echo drift_thinkup_input_blogimage(); ?>

						</header>
						<?php } ?>

						<div class="entry-content<?php drift_thinkup_input_stylelayout_class2(); ?>">

							<?php drift_thinkup_input_blogtitle(); ?>
							<?php drift_thinkup_input_blogmeta(); ?>
							<?php drift_thinkup_input_blogtext(); ?>

						</div><div class="clearboth"></div>

					</article><!-- #post-<?php get_the_ID(); ?> -->

					</div>

				<?php endwhile; ?>

				</div><div class="clearboth"></div>

				<?php the_posts_pagination(); ?>

			<?php else: ?>

				<?php get_template_part( 'no-results', 'archive' ); ?>		

			<?php endif; ?>

<?php get_footer() ?>