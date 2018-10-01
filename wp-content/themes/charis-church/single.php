<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap clearfix">
				
				

					<div id="main" class="ninecol last clearfix" role="main">

						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

								<header class="article-header">

									<h1 class="entry-title single-title" itemprop="headline"><?php the_title(); ?></h1>
									<p class="byline vcard"><?php
										printf( __( 'Posted <time class="updated" datetime="%1$s" pubdate>%2$s</time> by <span class="author">%3$s</span>   %4$s.', 'charistheme' ), get_the_time( 'Y-m-j' ), get_the_time( get_option('date_format')), charis_get_the_author_posts_link(), get_the_category_list(', ') );
									?></p>

								</header>

								<section class="entry-content clearfix" itemprop="articleBody">
									 <?php 
									if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
									  the_post_thumbnail('thumbnail', array('class' => 'alignleft'));
									} 
									the_content(); 
                                    wp_link_pages()?>

								</section>

								<footer class="article-footer">
									<?php the_tags( '<p class="tags"><span class="tags-title">' . __( 'Tags:', 'charistheme' ) . '</span> ', ', ', '</p>' ); ?>

								</footer>

								<?php comments_template(); ?>

							</article>

						<?php endwhile; ?>

						<?php else : ?>

							<article id="post-not-found" class="hentry clearfix">
									<header class="article-header">
										<h1><?php _e( 'Post Not Found.', 'charistheme' ); ?></h1>
									</header>
									<section class="entry-content">
										<p><?php _e( 'There is no single post to display.', 'charistheme' ); ?></p>
									</section>
									<footer class="article-footer">
											<p><?php _e( 'single.php template.', 'charistheme' ); ?></p>
									</footer>
							</article>

						<?php endif; ?>

					</div>

				</div>

			</div>

<?php get_footer(); ?>