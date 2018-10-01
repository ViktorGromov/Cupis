<?php
/**
 * Template Name: No Background
 *
 * @package ThinkUpThemes
 */

get_header(); ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

				<?php /* Add comments */  drift_thinkup_input_allowcomments(); ?>

			<?php endwhile; ?>

<?php get_footer(); ?>