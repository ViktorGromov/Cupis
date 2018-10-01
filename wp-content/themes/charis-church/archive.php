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
<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap clearfix">

					<div id="main" class="ninepluscol last wrap clearfix" role="main">

						<?php if (is_category()) { ?>
							<h1 class="archive-title h2">
								<span><?php _e( 'Posts Categorized:', 'charistheme' ); ?></span> <?php single_cat_title(); ?>
							</h1>

						<?php } elseif (is_tag()) { ?>
							<h1 class="archive-title h2">
								<span><?php _e( 'Posts Tagged:', 'charistheme' ); ?></span> <?php single_tag_title(); ?>
							</h1>

						<?php } elseif (is_author()) {
							global $post;
							$author_id = $post->post_author;
						?>
							<h1 class="archive-title h2">

								<span><?php _e( 'Posts By:', 'charistheme' ); ?></span> <?php the_author_meta('display_name', $author_id); ?>

							</h1>
						<?php } elseif (is_day()) { ?>
							<h1 class="archive-title h2">
								<span><?php _e( 'Daily Archives:', 'charistheme' ); ?></span> <?php the_time('l, F j, Y'); ?>
							</h1>

						<?php } elseif (is_month()) { ?>
								<h1 class="archive-title h2">
									<span><?php _e( 'Monthly Archives:', 'charistheme' ); ?></span> <?php the_time('F Y'); ?>
								</h1>

						<?php } elseif (is_year()) { ?>
								<h1 class="archive-title h2">
									<span><?php _e( 'Yearly Archives:', 'charistheme' ); ?></span> <?php the_time('Y'); ?>
								</h1>
						<?php } ?>

						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?> role="article">

								<header class="article-header">

									<h3 class="h2"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
									<p class="byline vcard"><?php
										printf(__( 'Posted <time class="updated" datetime="%1$s" pubdate>%2$s</time> by <span class="author">%3$s</span> <span class="amp">&</span> filed under %4$s.', 'charistheme' ), get_the_time('Y-m-j'), get_the_time(__( 'F jS, Y', 'charistheme' )), charis_get_the_author_posts_link(), get_the_category_list(', '));
									?></p>

								</header>

								<section class="entry-content clearfix">

									<?php the_post_thumbnail( 'charis-thumb-300' ); ?>

									<?php the_excerpt(); ?>

								</section>

								<footer class="article-footer">
									<?php the_tags( '<p class="tag-links"><span class="tags-title">' .  '</span> ', '  ', '</p>' ); ?>

								</footer>

							</article>

						 <?php 
						endwhile; 

								
							charis_page_navi();
								

						else : ?>

								<article id="post-not-found" class="hentry clearfix">
									<header class="article-header">
										<h1><?php _e( 'Sorry, no posts were found.', 'charistheme' ); ?></h1>
									</header>
									<section class="entry-content">
										<p><?php _e( 'Posts may be available soon.', 'charistheme' ); ?></p>
									</section>
									<footer class="article-footer">
											<p><?php _e( 'This is a message in archive.php.', 'charistheme' ); ?></p>
									</footer>
								</article>

						 <?php 
						endif; ?>

					</div>

				</div>

			</div>

<?php get_footer(); ?>