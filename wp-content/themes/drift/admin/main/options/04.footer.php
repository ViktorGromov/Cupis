<?php
/**
 * Footer functions.
 *
 * @package ThinkUpThemes
 */

/* ----------------------------------------------------------------------------------
	FOOTER WIDGETS LAYOUT
---------------------------------------------------------------------------------- */

/* Assign function for widget area 1 */
function drift_thinkup_input_footerw1() {
	echo	'<div id="footer-col1" class="widget-area">';
	if ( ! dynamic_sidebar( 'footer-w1' ) and current_user_can( 'edit_theme_options' ) ) {
	echo	'<h3 class="widget-title"><span>' . __( 'Please Add Widgets', 'drift') . '</span></h3>',
			'<div class="error-icon">',
			'<p>' . __( 'Remove this message by adding widgets to Footer Widget Area 1.', 'drift') . '</p>',
			'<a href="' . esc_url( admin_url( 'widgets.php' ) ) . '" title="' . esc_attr__( 'No Widgets Selected', 'drift' ) . '">' . __( 'Click here to go to Widget area.', 'drift') . '</a>',
			'</div>';
	};
	echo	'</div>';
}

/* Assign function for widget area 2 */
function drift_thinkup_input_footerw2() {
	echo	'<div id="footer-col2" class="widget-area">';
	if ( ! dynamic_sidebar( 'footer-w2' ) and current_user_can( 'edit_theme_options' ) ) {
	echo	'<h3 class="widget-title"><span>' . __( 'Please Add Widgets', 'drift') . '</span></h3>',
			'<div class="error-icon">',
			'<p>' . __( 'Remove this message by adding widgets to Footer Widget Area 2.', 'drift') . '</p>',
			'<a href="' . esc_url( admin_url( 'widgets.php' ) ) . '" title="' . esc_attr__( 'No Widgets Selected', 'drift' ) . '">' . __( 'Click here to go to Widget area.', 'drift') . '</a>',
			'</div>';
	};
	echo	'</div>';
}

/* Assign function for widget area 3 */
function drift_thinkup_input_footerw3() {
	echo	'<div id="footer-col3" class="widget-area">';
	if ( ! dynamic_sidebar( 'footer-w3' ) and current_user_can( 'edit_theme_options' ) ) {
	echo	'<h3 class="widget-title"><span>' . __( 'Please Add Widgets', 'drift') . '</span></h3>',
			'<div class="error-icon">',
			'<p>' . __( 'Remove this message by adding widgets to Footer Widget Area 3.', 'drift') . '</p>',
			'<a href="' . esc_url( admin_url( 'widgets.php' ) ) . '" title="' . esc_attr__( 'No Widgets Selected', 'drift' ) . '">' . __( 'Click here to go to Widget area.', 'drift') . '</a>',
			'</div>';
	};	
	echo	'</div>';
}

/* Assign function for widget area 4 */
function drift_thinkup_input_footerw4() {
	echo	'<div id="footer-col4" class="widget-area">';
	if ( ! dynamic_sidebar( 'footer-w4' ) and current_user_can( 'edit_theme_options' ) ) {
	echo	'<h3 class="widget-title"><span>' . __( 'Please Add Widgets', 'drift') . '</span></h3>',
			'<div class="error-icon">',
			'<p>' . __( 'Remove this message by adding widgets to Footer Widget Area 4.', 'drift') . '</p>',
			'<a href="' . esc_url( admin_url( 'widgets.php' ) ) . '" title="' . esc_attr__( 'No Widgets Selected', 'drift' ) . '">' . __( 'Click here to go to Widget area.', 'drift') . '</a>',
			'</div>';
	};	
	echo	'</div>';
}

/* Assign function for widget area 5 */
function drift_thinkup_input_footerw5() {
	echo	'<div id="footer-col5" class="widget-area">';
	if ( ! dynamic_sidebar( 'footer-w5' ) and current_user_can( 'edit_theme_options' ) ) {
	echo	'<h3 class="widget-title"><span>' . __( 'Please Add Widgets', 'drift') . '</span></h3>',
			'<div class="error-icon">',
			'<p>' . __( 'Remove this message by adding widgets to Footer Widget Area 5.', 'drift') . '</p>',
			'<a href="' . esc_url( admin_url( 'widgets.php' ) ) . '" title="' . esc_attr__( 'No Widgets Selected', 'drift' ) . '">' . __( 'Click here to go to Widget area.', 'drift') . '</a>',
			'</div>';
	};	
	echo	'</div>';
}

/* Assign function for widget area 6 */
function drift_thinkup_input_footerw6() {
	echo	'<div id="footer-col6" class="widget-area">';
	if ( ! dynamic_sidebar( 'footer-w6' ) and current_user_can( 'edit_theme_options' ) ) {
	echo	'<h3 class="widget-title"><span>' . __( 'Please Add Widgets', 'drift') . '</span></h3>',
			'<div class="error-icon">',
			'<p>' . __( 'Remove this message by adding widgets to Footer Widget Area 6.', 'drift') . '</p>',
			'<a href="' . esc_url( admin_url( 'widgets.php' ) ) . '" title="' . esc_attr__( 'No Widgets Selected', 'drift' ) . '">' . __( 'Click here to go to Widget area.', 'drift') . '</a>',
			'</div>';
	};	
	echo	'</div>';
}


/* Add Custom Footer Layout */
function drift_thinkup_input_footerlayout() {	

// Get theme options values.
$thinkup_footer_layout       = drift_thinkup_var ( 'thinkup_footer_layout' );
$thinkup_footer_widgetswitch = drift_thinkup_var ( 'thinkup_footer_widgetswitch' );
					
	if ( $thinkup_footer_widgetswitch != "1" and ! empty( $thinkup_footer_layout )  ) {
		echo	'<div id="footer">';
			if ( $thinkup_footer_layout == "option1" ) {
				echo	'<div id="footer-core" class="option1">';
						drift_thinkup_input_footerw1();
				echo	'</div>';
			} else if ( $thinkup_footer_layout == "option2" ) {
				echo	'<div id="footer-core" class="option2">';
						drift_thinkup_input_footerw1();
						drift_thinkup_input_footerw2();
				echo	'</div>';
			} else if ( $thinkup_footer_layout == "option3" ) {
				echo	'<div id="footer-core" class="option3">';
						drift_thinkup_input_footerw1();
						drift_thinkup_input_footerw2();
						drift_thinkup_input_footerw3();
				echo	'</div>';
			} else if ( $thinkup_footer_layout == "option4" ) {
				echo	'<div id="footer-core" class="option4">';
						drift_thinkup_input_footerw1();
						drift_thinkup_input_footerw2();
						drift_thinkup_input_footerw3();
						drift_thinkup_input_footerw4();
				echo	'</div>';
			} else if ( $thinkup_footer_layout == "option5" ) {
				echo	'<div id="footer-core" class="option5">';
						drift_thinkup_input_footerw1();
						drift_thinkup_input_footerw2();
						drift_thinkup_input_footerw3();
						drift_thinkup_input_footerw4();
						drift_thinkup_input_footerw5();
				echo	'</div>';
			} else if ( $thinkup_footer_layout == "option6" ) {
				echo	'<div id="footer-core" class="option6">';
						drift_thinkup_input_footerw1();
						drift_thinkup_input_footerw2();
						drift_thinkup_input_footerw3();
						drift_thinkup_input_footerw4();
						drift_thinkup_input_footerw5();
						drift_thinkup_input_footerw6();
				echo	'</div>';
			} else if ( $thinkup_footer_layout == "option7" ) {
				echo	'<div id="footer-core" class="option7">';
						drift_thinkup_input_footerw1();
						drift_thinkup_input_footerw2();
				echo	'</div>';
			} else if ( $thinkup_footer_layout == "option8" ) {
				echo	'<div id="footer-core" class="option8">';
						drift_thinkup_input_footerw1();
						drift_thinkup_input_footerw2();
				echo	'</div>';
			} else if ( $thinkup_footer_layout == "option9" ) {
				echo	'<div id="footer-core" class="option9">';
						drift_thinkup_input_footerw1();
						drift_thinkup_input_footerw2();
				echo	'</div>';
			} else if ( $thinkup_footer_layout == "option10" ) {
				echo	'<div id="footer-core" class="option10">';
						drift_thinkup_input_footerw1();
						drift_thinkup_input_footerw2();
				echo	'</div>';
			} else if ( $thinkup_footer_layout == "option11" ) {
				echo	'<div id="footer-core" class="option11">';
						drift_thinkup_input_footerw1();
						drift_thinkup_input_footerw2();
				echo	'</div>';
			} else if ( $thinkup_footer_layout == "option12" ) {
				echo	'<div id="footer-core" class="option12">';
						drift_thinkup_input_footerw1();
						drift_thinkup_input_footerw2();
				echo	'</div>';
			} else if ( $thinkup_footer_layout == "option13" ) {
				echo	'<div id="footer-core" class="option13">';
						drift_thinkup_input_footerw1();
						drift_thinkup_input_footerw2();
						drift_thinkup_input_footerw3();
						drift_thinkup_input_footerw4();
				echo	'</div>';
			} else if ( $thinkup_footer_layout == "option14" ) {
				echo	'<div id="footer-core" class="option14">';
						drift_thinkup_input_footerw1();
						drift_thinkup_input_footerw2();
						drift_thinkup_input_footerw3();
						drift_thinkup_input_footerw4();
				echo	'</div>';
			} else if ( $thinkup_footer_layout == "option15" ) {
				echo	'<div id="footer-core" class="option15">';
						drift_thinkup_input_footerw1();
						drift_thinkup_input_footerw2();
						drift_thinkup_input_footerw3();
				echo	'</div>';
			} else if ( $thinkup_footer_layout == "option16" ) {
				echo	'<div id="footer-core" class="option16">';
						drift_thinkup_input_footerw1();
						drift_thinkup_input_footerw2();
						drift_thinkup_input_footerw3();
				echo	'</div>';
			} else if ( $thinkup_footer_layout == "option17" ) {
				echo	'<div id="footer-core" class="option17">';
						drift_thinkup_input_footerw1();
						drift_thinkup_input_footerw2();
						drift_thinkup_input_footerw3();
						drift_thinkup_input_footerw4();
						drift_thinkup_input_footerw5();
				echo	'</div>';
			} else if ( $thinkup_footer_layout == "option18" ) {
				echo	'<div id="footer-core" class="option18">';
						drift_thinkup_input_footerw1();
						drift_thinkup_input_footerw2();
						drift_thinkup_input_footerw3();
						drift_thinkup_input_footerw4();
						drift_thinkup_input_footerw5();

				echo	'</div>';
			}
		echo	'</div>';
	}
}


/* ----------------------------------------------------------------------------------
	SUB-FOOTER WIDGETS LAYOUT
---------------------------------------------------------------------------------- */

/* Assign function for widget area 1 */
function drift_thinkup_input_subfooterw1() {
	echo	'<div id="sub-footer-col1" class="widget-area">';
	if ( ! dynamic_sidebar( 'sub-footer-w1' ) and current_user_can( 'edit_theme_options' ) ) {
	echo	'<h3 class="widget-title"><span>' . __( 'Please Add Widgets', 'drift') . '</span></h3>',
			'<div class="error-icon">',
			'<p>' . __( 'Remove this message by adding widgets to Footer Widget Area 1.', 'drift') . '</p>',
			'<a href="' . esc_url( admin_url( 'widgets.php' ) ) . '" title="' . esc_attr__( 'No Widgets Selected', 'drift' ) . '">' . __( 'Click here to go to Widget area.', 'drift') . '</a>',
			'</div>';
	};
	echo	'</div>';
}

/* Assign function for widget area 2 */
function drift_thinkup_input_subfooterw2() {
	echo	'<div id="sub-footer-col2" class="widget-area">';
	if ( ! dynamic_sidebar( 'sub-footer-w2' ) and current_user_can( 'edit_theme_options' ) ) {
	echo	'<h3 class="widget-title"><span>' . __( 'Please Add Widgets', 'drift') . '</span></h3>',
			'<div class="error-icon">',
			'<p>' . __( 'Remove this message by adding widgets to Footer Widget Area 2.', 'drift') . '</p>',
			'<a href="' . esc_url( admin_url( 'widgets.php' ) ) . '" title="' . esc_attr__( 'No Widgets Selected', 'drift' ) . '">' . __( 'Click here to go to Widget area.', 'drift') . '</a>',
			'</div>';
	};
	echo	'</div>';
}

/* Add Custom Sub-Footer Layout */
function drift_thinkup_input_subfooterlayout() {	

// Get theme options values.
$thinkup_subfooter_layout       = drift_thinkup_var ( 'thinkup_subfooter_layout' );
$thinkup_subfooter_widgetswitch = drift_thinkup_var ( 'thinkup_subfooter_widgetswitch' );
$thinkup_subfooter_widgetclose  = drift_thinkup_var ( 'thinkup_subfooter_widgetclose' );

	if ( $thinkup_subfooter_widgetswitch !== "1" and ! empty( $thinkup_subfooter_layout )  ) {

		// Output sub-footer widgets close button
		if ( $thinkup_subfooter_widgetclose == '1' ) {
			echo '<div id="sub-footer-close"><div id="sub-footer-close-core"></div></div>';	
		}
		
		// Output sub-footer widgets
		if ( $thinkup_subfooter_layout == "option1" ) {
			echo	'<div id="sub-footer-widgets" class="option1">';
					drift_thinkup_input_subfooterw1();
			echo	'</div>';
		} else if ( $thinkup_subfooter_layout == "option2" ) {
			echo	'<div id="sub-footer-widgets" class="option2">';
					drift_thinkup_input_subfooterw1();
					drift_thinkup_input_subfooterw2();
			echo	'</div>';
		} else if ( $thinkup_subfooter_layout == "option3" ) {
			echo	'<div id="sub-footer-widgets" class="option3">';
					drift_thinkup_input_subfooterw1();
					drift_thinkup_input_subfooterw2();
			echo	'</div>';
		} else if ( $thinkup_subfooter_layout == "option4" ) {
			echo	'<div id="sub-footer-widgets" class="option4">';
					drift_thinkup_input_subfooterw1();
					drift_thinkup_input_subfooterw2();
			echo	'</div>';
		} else if ( $thinkup_subfooter_layout == "option5" ) {
			echo	'<div id="sub-footer-widgets" class="option5">';
					drift_thinkup_input_subfooterw1();
					drift_thinkup_input_subfooterw2();
			echo	'</div>';
		} else if ( $thinkup_subfooter_layout == "option6" ) {
			echo	'<div id="sub-footer-widgets" class="option6">';
					drift_thinkup_input_subfooterw1();
					drift_thinkup_input_subfooterw2();
			echo	'</div>';
		} else if ( $thinkup_subfooter_layout == "option7" ) {
			echo	'<div id="sub-footer-widgets" class="option7">';
					drift_thinkup_input_subfooterw1();
					drift_thinkup_input_subfooterw2();
			echo	'</div>';
		} else if ( $thinkup_subfooter_layout == "option8" ) {
			echo	'<div id="sub-footer-widgets" class="option8">';
					drift_thinkup_input_subfooterw1();
					drift_thinkup_input_subfooterw2();
			echo	'</div>';
		}
	}
}


/* ----------------------------------------------------------------------------------
	SCROLL TO TOP
---------------------------------------------------------------------------------- */
function drift_thinkup_input_footerscroll( $classes ) {

// Get theme options values.
$thinkup_footer_scroll = drift_thinkup_var ( 'thinkup_footer_scroll' );

	if ( $thinkup_footer_scroll == '1' ) {
		$classes[] = 'scrollup-on';
	}
	return $classes;
}
add_action( 'body_class', 'drift_thinkup_input_footerscroll');


/* ----------------------------------------------------------------------------------
	COPYRIGHT TEXT
---------------------------------------------------------------------------------- */

function drift_thinkup_input_copyright() {

	printf( __( 'Developed by %1$s. Powered by %2$s.', 'drift' ) , '<a href="//www.thinkupthemes.com/" target="_blank">Think Up Themes Ltd</a>', '<a href="' . esc_url( __( '//wordpress.org/', 'drift' ) ) . '" target="_blank">WordPress</a>');
}