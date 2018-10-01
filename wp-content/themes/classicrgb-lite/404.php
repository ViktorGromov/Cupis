<?php get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="main_content">
					<div class="container">
						<div class="row">
							<div class="col-md-3">
								<aside class="sidebar-left">
								<?php dynamic_sidebar( 'sidebar-1' ); ?>
								</aside>
							</div>

							<div class="col-md-9">
								<div class="content-text">

									<div class="blog_item">
										<div class="row">
											<div class="col-md-12">

				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'classicrgb-lite' ); ?></h1>
				</header>

				<div class="page-content">
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'classicrgb-lite' ); ?></p>

					<?php
						get_search_form();

						the_widget( 'WP_Widget_Recent_Posts' );


						if ( classicrgb_lite_categorized_blog() ) :
					?>

					<div class="widget widget_categories">
						<h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'classicrgb-lite' ); ?></h2>
						<ul>
						<?php
							wp_list_categories( array(
								'orderby'    => 'count',
								'order'      => 'DESC',
								'show_count' => 1,
								'title_li'   => '',
								'number'     => 10,
							) );
						?>
						</ul>
					</div>

					<?php
						endif;

						$archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'classicrgb-lite' ), convert_smilies( ':)' ) ) . '</p>';
						the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );

						the_widget( 'WP_Widget_Tag_Cloud' );
					?>
				</div>


								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</section>




<?php
get_footer();
