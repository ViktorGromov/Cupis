<!doctype html>
<?php
/*
 * @package    CharisChurchTheme
 * @subpackage ThemeCode
 * @author     Kevin Gibson <kevin@structurworks.com>
 * @copyright  Copyright (c) 2014, StructurWorks LLC
 * @link       http://chapelworks-church-themes.com
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
?>


<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<?php // Google Chrome Frame for IE ?>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<?php // mobile meta  ?>
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        
		<?php 
		// wordpress head  
		 wp_head();
		// end of wordpress head ?>
		
	</head>

	<body <?php body_class(); ?>>
	

		<div class="container">
            
			<div class="header-container">
			
				<header class="header twelvecol clearfix" role="banner">
					
					<?php	
					if(get_header_image()) { // Header image set ?> 
					
						<style>
							.header, .header-logo-area {background-color: transparent};
						</style>

						<div class="header-logo-area" role="banner" style="background-size: 100% 100% !important; background-image:url(<?php header_image(); ?>); ">	
							
					<?php } else {  // No header image ?>
						<div class="header-logo-area left-main twelvecol">			
					<?php } ?>

					
						<?php
						if ( get_theme_mod( 'charis_logo' ) ) : ?>
							<div class='site-logo '>
								<a href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'><img src='<?php echo esc_url( get_theme_mod( 'charis_logo' ) ); ?>' alt='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>'></a>
							</div>
						<?php else : 
						
							if ( display_header_text() ) { // Check for Display Header Text checkbox in Customizer
							 ?>
								
								<div class='text-logo clearfix'>
									<a href="<?php echo esc_url( home_url( '/' ) );?>" class="site-title" ><?php bloginfo('name');?></a>
								</div>
								<div class='text-description'>
									<span class='site-description' ><?php bloginfo( 'description'); ?></span>
								</div>
						 <?php
							}

						endif; ?>
					</div>
					
					<div class='header-nav-area  left-main twelvecol last'>
						<?php charis_main_nav(); ?>
					</div>
                    
				</header>
				
							
				<div class="left-sidebar twocol">
					 <?php 			
					if ( has_nav_menu( 'side-menu' ) ) : ?>
		 
						<nav class="clearfix left-side-menu" role="navigation">
							<?php charis_side_nav(); ?>  
						</nav>

					<?php endif; ?>
					
						<div class="leftmenu-sidebar-area">
						<?php get_sidebar('sidebar2'); ?>
					</div>

					
				</div>
				
				
			</div>