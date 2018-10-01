<?php 
/*
	Template Name: Blog
*/
?>

<?php
/*
 * @package    CharisChurchTheme
 * @subpackage ThemeCode
 * @author     ChapelWorks Church Theme Team <support@structurworks.com>
 * @copyright  Copyright (c) 2014, StructurWorks LLC
 * @link       http://chapelworks-church-themes.com
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
?>

<?php 
get_header(); ?>

<div id="content">
    <div id="inner-content" class="wrap clearfix">
        <div class="main ninepluscol last wrap clearfix" role="main">

            <?php 
            $wp_query = new WP_Query(); 
            $wp_query->query('&paged='.$paged);
            if ($wp_query->have_posts()) : while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
            
				<?php get_template_part( 'content', 'blog' ); ?>

             <?php 
			endwhile; 
			
                charis_page_navi();
 
            else : ?>

                    <article id="post-not-found" class="hentry clearfix">
                        <header class="article-header">
                                <h1><?php _e( 'No posts are available at this time.', 'charistheme' ); ?></h1>
                        </header>
                    </article>

             <?php 
			endif; ?>
            
            
		</div>
	</div>    
</div>					

<?php get_footer(); ?>