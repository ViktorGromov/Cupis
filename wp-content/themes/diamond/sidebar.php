<?php
/**
 * The sidebar containing the main widget area
 *
 * @package WordPress
 */

if ( has_nav_menu( 'primary' ) || has_nav_menu( 'social' ) || is_active_sidebar( 'sidebar-1' )  ) : ?>
	<div id="secondary" class="secondary">

		<?php if ( has_nav_menu( 'primary' ) ) : ?>
			<nav id="site-navigation" class="main-navigation" role="navigation">
				<?php
					// Primary navigation menu.
					wp_nav_menu( array(
						'menu_class'     => 'nav-menu',
						'theme_location' => 'primary',
					) );
				?>
			</nav><!-- .main-navigation -->
		<?php endif; ?>
        
		<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
			<div id="widget-area" class="widget-area" role="complementary">
				<?php dynamic_sidebar( 'sidebar-1' ); ?>
			</div><!-- .widget-area -->
		<?php endif; ?>
            <footer id="colophon" class="site-footer" role="contentinfo">
                <div class="site-info">
                    <?php
                        do_action( 'diamond_credits' );
                    ?>
                    <?php if( get_theme_mod( 'copyright_textbox' ) == '') { ?>	
                    <a href="<?php echo esc_url( __( 'http://www.eightpixeldesign.com/', 'diamond' ) ); ?>"><?php printf( __( 'Proudly published by EightPixelDesign', 'diamond' ), 'WordPress' ); ?></a>
                    <?php } 
                    else { 
                        $footercopyright = get_theme_mod( 'copyright_textbox' );
                        echo esc_html( $footercopyright );
                    } ?>
                </div><!-- .site-info -->
            </footer><!-- .site-footer -->

	</div><!-- .secondary -->

<?php endif; ?>
