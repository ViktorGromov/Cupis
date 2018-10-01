<?php 
/*
	Template Name: No Title-Wide
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
 
 
        <div id="main" class="" role="main">

            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

 
                <section class="entry-content clearfix" itemprop="articleBody">
                    <?php the_content(); 
                    wp_link_pages()?>
				</section>

                <footer class="article-footer">
                    <?php the_tags( '<span class="tags">' . __( 'Tags:', 'charistheme' ) . '</span> ', ', ', '' ); ?>

                </footer>



            </article>

            <?php endwhile; else : ?>

                    <article id="post-not-found" class="hentry clearfix">
                        <header class="article-header">
                            <h1><?php _e( ' Post Not Found!', 'charistheme' ); ?></h1>
                        </header>
                        <section class="entry-content">
                            <p><?php _e( 'Something is missing. Try double checking things.', 'charistheme' ); ?></p>
                        </section>
                        <footer class="article-footer">
                                <p><?php _e( 'This is the error message in the page.php template.', 'charistheme' ); ?></p>
                        </footer>
                    </article>

            <?php endif; ?>

        </div>

 
 
	</div>    
</div>					

<?php get_footer(); ?>