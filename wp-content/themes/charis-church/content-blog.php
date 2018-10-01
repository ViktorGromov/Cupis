
            	<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
				
					<?php
					if ( has_post_format( 'aside' ) ) { ?>
						<h1 class="mini-title single-title" itemprop="headline"><?php the_title(); ?></h1>
						<p class="byline vcard"><?php
						printf( __( 'Posted <time class="updated" datetime="%1$s" pubdate>%2$s</time> by <span class="author">%3$s</span>  <br> %4$s.', 'charistheme' ), get_the_time( 'Y-m-j' ), get_the_time( get_option('date_format')), get_the_author(), get_the_category_list(', ') );
						?>
						<section class="aside-content ninepluscol first wrap clearfix" itemprop="articleBody">
							<?php
							the_content();                           
							?>
						</section> <?php
								

					} else if ( has_post_format( 'quote' ) ) { ?>
						<h1 class="mini-title single-title" itemprop="headline"><?php the_title(); ?></h1>
						<p class="byline vcard"><?php
						printf( __( 'Posted <time class="updated" datetime="%1$s" pubdate>%2$s</time> by <span class="author">%3$s</span>  <br> %4$s.', 'charistheme' ), get_the_time( 'Y-m-j' ), get_the_time( get_option('date_format')), get_the_author(), get_the_category_list(', ') );
						?>

						<section class="quote-content ninepluscol first wrap clearfix" itemprop="articleBody">
								<?php
								the_content(); 
							?>
						</section> <?php

					} else if ( has_post_format( 'status' ) ) { ?>
						<h1 class="mini-title single-title" itemprop="headline"><?php the_title(); ?></h1>
						<p class="byline vcard"><?php
						printf( __( 'Posted <time class="updated" datetime="%1$s" pubdate>%2$s</time> by <span class="author">%3$s</span>  <br> %4$s.', 'charistheme' ), get_the_time( 'Y-m-j' ), get_the_time( get_option('date_format')), get_the_author(), get_the_category_list(', ') );
						?>

						<section class="status-content ninepluscol first wrap clearfix" itemprop="articleBody">
								<?php
								the_content(); 
								?>
						</section> <?php
								
					} else if ( has_post_format( 'video' ) ) { ?>
						<h1 class="mini-title single-title" itemprop="headline"><?php the_title(); ?></h1>
						<p class="byline vcard"><?php
						printf( __( 'Posted <time class="updated" datetime="%1$s" pubdate>%2$s</time> by <span class="author">%3$s</span>  <br> %4$s.', 'charistheme' ), get_the_time( 'Y-m-j' ), get_the_time( get_option('date_format')), get_the_author(), get_the_category_list(', ') );
						?>

						<section class="video-content ninepluscol first wrap clearfix" itemprop="articleBody">
								<?php
								the_content(); 
								?>
						</section> <?php
						
					} else { ?>

						<header class="article-header">

							<?php 
							if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
							  the_post_thumbnail('thumbnail', array('class' => 'alignleft'));
							} ?>
							<h1 class="entry-title single-title" itemprop="headline"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
							
							<p class="byline vcard"><?php
								printf( __( 'Posted <time class="updated" datetime="%1$s" pubdate>%2$s</time> by <span class="author">%3$s</span>  <br> %4$s.', 'charistheme' ), get_the_time( 'Y-m-j' ), get_the_time( get_option('date_format')), get_the_author(), get_the_category_list(', ') );
							?></p>

						</header>

						<section class="entry-content alignleft ninepluscol first wrap clearfix" itemprop="articleBody">
							<?php
							the_content(); ?>

						</section>
						
					 <?php
					}?>
					
					<footer class="article-footer">
						<?php the_tags( '<p class="tag-links"><span class="tags-title">' .  '</span> ', '  ', '</p>' ); ?>

					</footer>

				
				</article>
			
