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
            if (have_posts()) : while (have_posts()) : the_post(); 
			
				get_template_part( 'content', 'blog' );
            
			endwhile;

                 charis_page_navi();

            else : ?>

                <article id="post-not-found" class="hentry clearfix">
                    <header class="article-header">
                            <h1><?php _e( 'Post Not Found!', 'charistheme' ); ?></h1>
                    </header>
                </article>

            <?php endif; ?>

		</div>
	</div>
</div>	

<div class="main ninepluscol last wrap clearfix" role="main">

	<div class="left-main sixcol first clearfix">
		
		<?php get_sidebar('sidebar1'); ?>
		
	</div>

</div>


<?php get_footer(); ?>