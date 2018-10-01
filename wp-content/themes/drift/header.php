<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up until id="main-core".
 *
 * @package ThinkUpThemes
 */
?><!DOCTYPE html>

<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<link rel="profile" href="//gmpg.org/xfn/11" />
<link rel="pingback" href="<?php esc_url( bloginfo( 'pingback_url' ) ); ?>" />

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="body-core-wrap">
<div id="body-core-header">

		<div id="logo">
		<?php /* Custom Logo */ echo drift_thinkup_custom_logo(); ?>
		</div>


		<div id="pre-header">
		<div class="wrap-safari">
		<div id="pre-header-core" class="main-navigation">

			<?php if ( has_nav_menu( 'pre_header_menu' ) ) : ?>
			<?php drift_thinkup_input_preheaderhtml(); ?>
			<?php endif; ?>

		</div>
		</div>
		</div>
		<!-- #pre-header -->

		<?php drift_thinkup_input_headersearch(); ?>

		<div id="header">
		<div id="header-core">

			<div id="header-links" class="main-navigation">
			<div id="header-links-inner" class="header-links">

				<?php $walker = new drift_thinkup_menudescription;
				wp_nav_menu(array( 'container' => false, 'theme_location'  => 'header_menu', 'walker' => new drift_thinkup_menudescription() ) ); ?>

			</div>
			</div>
			<!-- #header-links .main-navigation -->
 
			<?php /* Social Media Icons */ drift_thinkup_input_socialmediaheadermain(); ?>

		</div>
		</div>
		<!-- #header -->

		<?php /* Add responsive header menu */ drift_thinkup_input_responsivehtml1(); ?>
		<!-- #header-nav -->

</div>

<div id="body-core">

	<header>

	<div id="site-header">

		<?php if ( get_header_image() ) : ?>
			<div class="custom-header"><img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt=""></div>
		<?php endif; // End header image check. ?>

		<?php /* Add responsive header menu */ drift_thinkup_input_responsivehtml2(); ?>

		<?php /* Custom Slider */ drift_thinkup_input_sliderhome(); ?>

		<?php /* Custom Intro - Below */ drift_thinkup_custom_intro(); ?>

	</div>

	</header>
	<!-- header -->

	<?php /*  Call To Action - Intro */ drift_thinkup_input_ctaintro(); ?>
	<?php /*  Pre-Designed HomePage Content */ drift_thinkup_input_homepagesection(); ?>

	<div id="content">
	<div id="content-core">

		<div id="main">
		<div id="main-core">