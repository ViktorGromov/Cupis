<?php
/**
 * Social media functions.
 *
 * @package ThinkUpThemes
 */

/* ----------------------------------------------------------------------------------
	PRE HEADER - OUTPUT SELECT MENU
---------------------------------------------------------------------------------- */

// http://wordpress.stackexchange.com/questions/27497/how-to-use-wp-nav-menu-to-create-a-select-menu-dropdown
class drift_thinkup_nav_menu_preheader extends Walker_Nav_Menu {

    // don't output children opening tag (`<ul>`)
    public function start_lvl(&$output, $depth=0, $args=array()){}

    // don't output children closing tag    
    public function end_lvl(&$output, $depth=0, $args=array()){}

    public function start_el(&$output, $item, $depth=0, $args=array(), $id = 0){

      // add spacing to the title based on the current depth
      $item->title = str_repeat("&#45; ", $depth ) . $item->title;
      parent::start_el($output, $item, $depth, $args);
	  
	  $output = str_replace( '<a', '<option', $output );
	  $output = str_replace( 'href=', 'value=', $output );

  } 
	
    // replace closing </li> with the closing option tag
    public function end_el(&$output, $item, $depth=0, $args=array()){
	  $output = str_replace( '</a>', '</option>', $output );
    }
}

// Fallback responsive menu when custom header menu has not been set.
function drift_thinkup_input_preheaderfall() {

// Get theme options values.
$thinkup_header_selecttextpre = drift_thinkup_var ( 'thinkup_header_selecttextpre' );

	// Change text for dropdown if set.
	if( empty( $thinkup_header_selecttextpre ) ) {
		$thinkup_header_selecttextpre = __( 'Navigation', 'drift');
	}

	$output = wp_list_pages('echo=0&title_li=');
	$output = str_replace( '<a', '<option', $output );
	$output = str_replace( 'href=', 'value=', $output );
	$output = str_replace( '</a>', '</option>', $output );

	$output = strip_tags( $output, '<div>, <select>, <option>' );

	echo '<div id="pre-header-links-inner">',
		 '<select onchange="location = this.options[this.selectedIndex].value;"><option value="#">' . esc_html( $thinkup_header_selecttextpre ) . '</option>' . $output . '</select>',
		 '</div>';
}

function drift_thinkup_input_preheaderhtml() {

// Get theme options values.
$thinkup_general_fixedlayoutswitch = drift_thinkup_var ( 'thinkup_general_fixedlayoutswitch' );
$thinkup_header_selecttextpre      = drift_thinkup_var ( 'thinkup_header_selecttextpre' );

	// Change text for dropdown if set.
	if( empty( $thinkup_header_selecttextpre ) ) {
		$thinkup_header_selecttextpre = __( 'Navigation', 'drift');
	}

	if ( $thinkup_general_fixedlayoutswitch !== '1' ) {
		
		$args = array(
			'container_class' => 'header-links',
			'container_id'    => 'pre-header-links-inner',
			'theme_location'  => 'pre_header_menu',
			'items_wrap'      => '<select onchange="location = this.options[this.selectedIndex].value;"><option value="#">' . esc_html( $thinkup_header_selecttextpre ) . '</option>%3$s</select>',
			'echo'            => true,
			'walker'          => new drift_thinkup_nav_menu_preheader(),
			'depth'           => 0,
			'fallback_cb'     => 'drift_thinkup_input_preheaderfall',
		);
		$menu = strip_tags(wp_nav_menu( $args ), '<div>, <select>, <option>' );

	}
}


/* ----------------------------------------------------------------------------------
	PRE HEADER STYLE
---------------------------------------------------------------------------------- */
function drift_thinkup_input_headerstylepre($classes) {

	// Output pre header style
	$classes[] = 'pre-header-style1';
	return $classes;
}
add_action( 'body_class', 'drift_thinkup_input_headerstylepre');


/* ----------------------------------------------------------------------------------
	HEADER STYLE
---------------------------------------------------------------------------------- */
function drift_thinkup_input_headerstyle($classes) {

	// Output header style
	$classes[] = 'header-style1';
	return $classes;
}
add_action( 'body_class', 'drift_thinkup_input_headerstyle');


/* ----------------------------------------------------------------------------------
	SEARCH - DISABLE SEARCH (HEADER)
---------------------------------------------------------------------------------- */
function drift_thinkup_input_headersearch() {

// Get theme options values.
$thinkup_header_searchswitch = drift_thinkup_var ( 'thinkup_header_searchswitch' );

	if ( $thinkup_header_searchswitch == '1' ) {
		$output = NULL;

		$output .= '<div id="header-search">';

		$output .= '<div id="header-search-form">';
		$output .= get_search_form( false );
		$output .= '</div>';

		$output .= '<div id="header-search-toggle">';
		$output .= '</div>';

		$output .= '</div>';
		$output .= '<!-- #header-search -->';
		
		echo $output;
	}
}


/* ----------------------------------------------------------------------------------
	SOCIAL MEDIA - CUSTOM ICONS
---------------------------------------------------------------------------------- */

/* Facebook - Custom Icon */
function drift_thinkup_input_facebookicon(){

// Get theme options values.
$thinkup_header_facebookiconswitch = drift_thinkup_var ( 'thinkup_header_facebookiconswitch' );
$thinkup_header_facebookcustomicon = drift_thinkup_var ( 'thinkup_header_facebookcustomicon', 'url' );

	$output = NULL;

	if ( $thinkup_header_facebookiconswitch == '1' and ! empty( $thinkup_header_facebookcustomicon ) ) {
		
		// Output for header social media
		$output .= '#header-social li.facebook a,';
		$output .= '#header-social li.facebook a:hover {';
		$output .= 'background: url("' . esc_url( $thinkup_header_facebookcustomicon ) . '") no-repeat center;';
		$output .= 'background-size: 25px;';
		$output .= '-webkit-border-radius: 0;';
		$output .= '-moz-border-radius: 0;';
		$output .= '-o-border-radius: 0;';
		$output .= 'border-radius: 0;';
		$output .= '}' . "\n";
		$output .= '#header-social li.facebook i {';
		$output .= 'display: none;';
		$output .= '}' . "\n";

		// Output for footer social media
		$output .= '#post-footer-social li.facebook a,';
		$output .= '#post-footer-social li.facebook a:hover {';
		$output .= 'background: url("' . esc_url( $thinkup_header_facebookcustomicon ) . '") no-repeat center;';
		$output .= 'background-size: 25px;';
		$output .= '-webkit-border-radius: 0;';
		$output .= '-moz-border-radius: 0;';
		$output .= '-o-border-radius: 0;';
		$output .= 'border-radius: 0;';
		$output .= '}' . "\n";
		$output .= '#post-footer-social li.facebook i {';
		$output .= 'display: none;';
		$output .= '}' . "\n";

	}
	return $output;
}

/* Twitter - Custom Icon */
function drift_thinkup_input_twittericon(){

// Get theme options values.
$thinkup_header_twittericonswitch = drift_thinkup_var ( 'thinkup_header_twittericonswitch' );
$thinkup_header_twittercustomicon = drift_thinkup_var ( 'thinkup_header_twittercustomicon', 'url' );

	$output = NULL;

	if ( $thinkup_header_twittericonswitch == '1' and ! empty( $thinkup_header_twittercustomicon ) ) {

		// Output for header social media
		$output .= '#header-social li.twitter a,';
		$output .= '#header-social li.twitter a:hover {';
		$output .= 'background: url("' . esc_url( $thinkup_header_twittercustomicon ) . '") no-repeat center;';
		$output .= 'background-size: 25px;';
		$output .= '-webkit-border-radius: 0;';
		$output .= '-moz-border-radius: 0;';
		$output .= '-o-border-radius: 0;';
		$output .= 'border-radius: 0;';
		$output .= '}' . "\n";
		$output .= '#header-social li.twitter i {';
		$output .= 'display: none;';
		$output .= '}' . "\n";

		// Output for footer social media
		$output .= '#post-footer-social li.twitter a,';
		$output .= '#post-footer-social li.twitter a:hover {';
		$output .= 'background: url("' . esc_url( $thinkup_header_twittercustomicon ) . '") no-repeat center;';
		$output .= 'background-size: 25px;';
		$output .= '-webkit-border-radius: 0;';
		$output .= '-moz-border-radius: 0;';
		$output .= '-o-border-radius: 0;';
		$output .= 'border-radius: 0;';
		$output .= '}' . "\n";
		$output .= '#post-footer-social li.twitter i {';
		$output .= 'display: none;';
		$output .= '}' . "\n";

	}
	return $output;
}

/* Google+ - Custom Icon */
function drift_thinkup_input_googleicon(){

// Get theme options values.
$thinkup_header_googleiconswitch = drift_thinkup_var ( 'thinkup_header_googleiconswitch' );
$thinkup_header_googlecustomicon = drift_thinkup_var ( 'thinkup_header_googlecustomicon', 'url' );

	$output = NULL;

	if ( $thinkup_header_googleiconswitch == '1' and ! empty( $thinkup_header_googlecustomicon ) ) {

		// Output for header social media
		$output .= '#header-social li.google-plus a,';
		$output .= '#header-social li.google-plus a:hover {';
		$output .= 'background: url("' . esc_url( $thinkup_header_googlecustomicon ) . '") no-repeat center;';
		$output .= 'background-size: 25px;';
		$output .= '-webkit-border-radius: 0;';
		$output .= '-moz-border-radius: 0;';
		$output .= '-o-border-radius: 0;';
		$output .= 'border-radius: 0;';
		$output .= '}' . "\n";
		$output .= '#header-social li.google-plus i {';
		$output .= 'display: none;';
		$output .= '}' . "\n";

		// Output for footer social media
		$output .= '#post-footer-social li.google-plus a,';
		$output .= '#post-footer-social li.google-plus a:hover {';
		$output .= 'background: url("' . esc_url( $thinkup_header_googlecustomicon ) . '") no-repeat center;';
		$output .= 'background-size: 25px;';
		$output .= '-webkit-border-radius: 0;';
		$output .= '-moz-border-radius: 0;';
		$output .= '-o-border-radius: 0;';
		$output .= 'border-radius: 0;';
		$output .= '}' . "\n";
		$output .= '#post-footer-social li.google-plus i {';
		$output .= 'display: none;';
		$output .= '}' . "\n";

	}
	return $output;
}

/* LinkedIn - Custom Icon */
function drift_thinkup_input_linkedinicon(){

// Get theme options values.
$thinkup_header_linkediniconswitch = drift_thinkup_var ( 'thinkup_header_linkediniconswitch' );
$thinkup_header_linkedincustomicon = drift_thinkup_var ( 'thinkup_header_linkedincustomicon', 'url' );

	$output = NULL;

	if ( $thinkup_header_linkediniconswitch == '1' and ! empty( $thinkup_header_linkedincustomicon ) ) {

		// Output for header social media
		$output .= '#header-social li.linkedin a,';
		$output .= '#header-social li.linkedin a:hover {';
		$output .= 'background: url("' . esc_url( $thinkup_header_linkedincustomicon ) . '") no-repeat center;';
		$output .= 'background-size: 25px;';
		$output .= '-webkit-border-radius: 0;';
		$output .= '-moz-border-radius: 0;';
		$output .= '-o-border-radius: 0;';
		$output .= 'border-radius: 0;';
		$output .= '}' . "\n";
		$output .= '#header-social li.linkedin i {';
		$output .= 'display: none;';
		$output .= '}' . "\n";

		// Output for footer social media
		$output .= '#post-footer-social li.linkedin a,';
		$output .= '#post-footer-social li.linkedin a:hover {';
		$output .= 'background: url("' . esc_url( $thinkup_header_linkedincustomicon ) . '") no-repeat center;';
		$output .= 'background-size: 25px;';
		$output .= '-webkit-border-radius: 0;';
		$output .= '-moz-border-radius: 0;';
		$output .= '-o-border-radius: 0;';
		$output .= 'border-radius: 0;';
		$output .= '}' . "\n";
		$output .= '#post-footer-social li.linkedin i {';
		$output .= 'display: none;';
		$output .= '}' . "\n";

	}
	return $output;
}

/* Flickr - Custom Icon */
function drift_thinkup_input_flickricon(){

// Get theme options values.
$thinkup_header_flickriconswitch = drift_thinkup_var ( 'thinkup_header_flickriconswitch' );
$thinkup_header_flickrcustomicon = drift_thinkup_var ( 'thinkup_header_flickrcustomicon', 'url' );

	$output = NULL;

	if ( $thinkup_header_flickriconswitch == '1' and ! empty( $thinkup_header_flickrcustomicon ) ) {

		// Output for header social media
		$output .= '#header-social li.flickr a,';
		$output .= '#header-social li.flickr a:hover {';
		$output .= 'background: url("' . esc_url( $thinkup_header_flickrcustomicon ) . '") no-repeat center;';
		$output .= 'background-size: 25px;';
		$output .= '-webkit-border-radius: 0;';
		$output .= '-moz-border-radius: 0;';
		$output .= '-o-border-radius: 0;';
		$output .= 'border-radius: 0;';
		$output .= '}' . "\n";
		$output .= '#header-social li.flickr i {';
		$output .= 'display: none;';
		$output .= '}' . "\n";

		// Output for footer social media
		$output .= '#post-footer-social li.flickr a,';
		$output .= '#post-footer-social li.flickr a:hover {';
		$output .= 'background: url("' . esc_url( $thinkup_header_flickrcustomicon ) . '") no-repeat center;';
		$output .= 'background-size: 25px;';
		$output .= '-webkit-border-radius: 0;';
		$output .= '-moz-border-radius: 0;';
		$output .= '-o-border-radius: 0;';
		$output .= 'border-radius: 0;';
		$output .= '}' . "\n";
		$output .= '#post-footer-social li.flickr i {';
		$output .= 'display: none;';
		$output .= '}' . "\n";

	}
	return $output;
}

/* YouTube - Custom Icon */
function drift_thinkup_input_youtubeicon(){

// Get theme options values.
$thinkup_header_youtubeiconswitch = drift_thinkup_var ( 'thinkup_header_youtubeiconswitch' );
$thinkup_header_youtubecustomicon = drift_thinkup_var ( 'thinkup_header_youtubecustomicon', 'url' );

	$output = NULL;

	if ( $thinkup_header_youtubeiconswitch == '1' and ! empty( $thinkup_header_youtubecustomicon ) ) {

		// Output for header social media
		$output .= '#header-social li.youtube a,';
		$output .= '#header-social li.youtube a:hover {';
		$output .= 'background: url("' . esc_url( $thinkup_header_youtubecustomicon ) . '") no-repeat center;';
		$output .= 'background-size: 25px;';
		$output .= '-webkit-border-radius: 0;';
		$output .= '-moz-border-radius: 0;';
		$output .= '-o-border-radius: 0;';
		$output .= 'border-radius: 0;';
		$output .= '}' . "\n";
		$output .= '#header-social li.youtube i {';
		$output .= 'display: none;';
		$output .= '}' . "\n";

		// Output for footer social media
		$output .= '#post-footer-social li.youtube a,';
		$output .= '#post-footer-social li.youtube a:hover {';
		$output .= 'background: url("' . esc_url( $thinkup_header_youtubecustomicon ) . '") no-repeat center;';
		$output .= 'background-size: 25px;';
		$output .= '-webkit-border-radius: 0;';
		$output .= '-moz-border-radius: 0;';
		$output .= '-o-border-radius: 0;';
		$output .= 'border-radius: 0;';
		$output .= '}' . "\n";
		$output .= '#post-footer-social li.youtube i {';
		$output .= 'display: none;';
		$output .= '}' . "\n";

	}
	return $output;
}

/* Input Custom Social Media Icons */
function drift_thinkup_input_socialicon(){

	$output = NULL;
	
	$output .= drift_thinkup_input_facebookicon();
	$output .= drift_thinkup_input_twittericon();
	$output .= drift_thinkup_input_googleicon();
	$output .= drift_thinkup_input_linkedinicon();
	$output .= drift_thinkup_input_flickricon();
	$output .= drift_thinkup_input_youtubeicon();

	if ( ! empty( $output ) ) {
		echo    '<style type="text/css">' . "\n" . $output . '</style>';
	}
}
add_action( 'wp_head', 'drift_thinkup_input_socialicon', 13 );


/* ----------------------------------------------------------------------------------
	SOCIAL MEDIA - OUTPUT SOCIAL MEDIA SELECTIONS (MAIN HEADER)
---------------------------------------------------------------------------------- */

function drift_thinkup_input_socialmediaheadermain() {

// Get theme options values.
$thinkup_header_socialswitchmain = drift_thinkup_var ( 'thinkup_header_socialswitchmain' );
$thinkup_header_facebookswitch   = drift_thinkup_var ( 'thinkup_header_facebookswitch' );
$thinkup_header_facebooklink     = drift_thinkup_var ( 'thinkup_header_facebooklink' );
$thinkup_header_twitterswitch    = drift_thinkup_var ( 'thinkup_header_twitterswitch' );
$thinkup_header_twitterlink      = drift_thinkup_var ( 'thinkup_header_twitterlink' );
$thinkup_header_googleswitch     = drift_thinkup_var ( 'thinkup_header_googleswitch' );
$thinkup_header_googlelink       = drift_thinkup_var ( 'thinkup_header_googlelink' );
$thinkup_header_linkedinswitch   = drift_thinkup_var ( 'thinkup_header_linkedinswitch' );
$thinkup_header_linkedinlink     = drift_thinkup_var ( 'thinkup_header_linkedinlink' );
$thinkup_header_flickrswitch     = drift_thinkup_var ( 'thinkup_header_flickrswitch' );
$thinkup_header_flickrlink       = drift_thinkup_var ( 'thinkup_header_flickrlink' );
$thinkup_header_youtubeswitch    = drift_thinkup_var ( 'thinkup_header_youtubeswitch' );
$thinkup_header_youtubelink      = drift_thinkup_var ( 'thinkup_header_youtubelink' );

// Reset count values used in foreach loop
$i = 0;
$j = 0;
$count        = NULL;
$class_column = NULL;

	if ( $thinkup_header_socialswitchmain == '1' ) {

		// Assign social media link to an array
		$social_links = array( 
			array( 'social' => __( 'Facebook', 'drift' ),  'icon' => 'facebook',     'toggle' => $thinkup_header_facebookswitch,  'link' => $thinkup_header_facebooklink ),
			array( 'social' => __( 'Twitter', 'drift' ),   'icon' => 'twitter',      'toggle' => $thinkup_header_twitterswitch,   'link' => $thinkup_header_twitterlink ),
			array( 'social' => __( 'Google+', 'drift' ),   'icon' => 'google-plus',  'toggle' => $thinkup_header_googleswitch,    'link' => $thinkup_header_googlelink ),
			array( 'social' => __( 'LinkedIn', 'drift' ),  'icon' => 'linkedin',     'toggle' => $thinkup_header_linkedinswitch,  'link' => $thinkup_header_linkedinlink ),
			array( 'social' => __( 'Flickr', 'drift' ),    'icon' => 'flickr',       'toggle' => $thinkup_header_flickrswitch,    'link' => $thinkup_header_flickrlink ),
			array( 'social' => __( 'YouTube', 'drift' ),   'icon' => 'youtube',      'toggle' => $thinkup_header_youtubeswitch,   'link' => $thinkup_header_youtubelink ),
		);

		// Determine column layout
		foreach( $social_links as $social ) {
			if ( ! empty( $social['link'] ) and $social['toggle'] == '1' ) {
				$count++;
			}
		}
		if ( $count > '4' ) {
			$class_column = 'column-4';
		} else {
			$class_column = 'column-' . $count;
		}

		// Output social media links if any link is set
		foreach( $social_links as $social ) {
			if ( ! empty( $social['link'] ) and $j == 0 ) {
				echo '<div id="header-social"><ul>'; $j = 1;
			}

			if ( ! empty( $social['link'] ) and $social['toggle'] == '1' ) {

			echo '<li class="social ' . esc_attr( $social['icon'] ) . ' ' . esc_attr( $class_column ) . '">',
				 '<a href="' . esc_url( $social['link'] ) . '" data-tip="top" data-original-title="' . esc_attr( $social['social'] ) . '" target="_blank">',
				 '<i class="fa fa-' . esc_attr( $social['icon'] ) . '"></i>',
				 '</a>',
				 '</li>';
			}
		}

		// Close list output of social media links if any link is set
		if ( $j !== 0 ) echo '</ul></div>';
	}
}


/* ----------------------------------------------------------------------------------
	SOCIAL MEDIA - OUTPUT SOCIAL MEDIA SELECTIONS (FOOTER)
---------------------------------------------------------------------------------- */

function drift_thinkup_input_socialmediafooter() {

// Get theme options values.
$thinkup_header_socialswitchfooter = drift_thinkup_var ( 'thinkup_header_socialswitchfooter' );
$thinkup_header_facebookswitch     = drift_thinkup_var ( 'thinkup_header_facebookswitch' );
$thinkup_header_facebooklink       = drift_thinkup_var ( 'thinkup_header_facebooklink' );
$thinkup_header_twitterswitch      = drift_thinkup_var ( 'thinkup_header_twitterswitch' );
$thinkup_header_twitterlink        = drift_thinkup_var ( 'thinkup_header_twitterlink' );
$thinkup_header_googleswitch       = drift_thinkup_var ( 'thinkup_header_googleswitch' );
$thinkup_header_googlelink         = drift_thinkup_var ( 'thinkup_header_googlelink' );
$thinkup_header_linkedinswitch     = drift_thinkup_var ( 'thinkup_header_linkedinswitch' );
$thinkup_header_linkedinlink       = drift_thinkup_var ( 'thinkup_header_linkedinlink' );
$thinkup_header_flickrswitch       = drift_thinkup_var ( 'thinkup_header_flickrswitch' );
$thinkup_header_flickrlink         = drift_thinkup_var ( 'thinkup_header_flickrlink' );
$thinkup_header_youtubeswitch      = drift_thinkup_var ( 'thinkup_header_youtubeswitch' );
$thinkup_header_youtubelink        = drift_thinkup_var ( 'thinkup_header_youtubelink' );

// Reset count values used in foreach loop
$i = 0;
$j = 0;

	if ( $thinkup_header_socialswitchfooter == '1' ) {
	
		// Assign social media link to an array
		$social_links = array( 
			array( 'social' => __( 'Facebook', 'drift' ),  'icon' => 'facebook',     'toggle' => $thinkup_header_facebookswitch,  'link' => $thinkup_header_facebooklink ),
			array( 'social' => __( 'Twitter', 'drift' ),   'icon' => 'twitter',      'toggle' => $thinkup_header_twitterswitch,   'link' => $thinkup_header_twitterlink ),
			array( 'social' => __( 'Google+', 'drift' ),   'icon' => 'google-plus',  'toggle' => $thinkup_header_googleswitch,    'link' => $thinkup_header_googlelink ),
			array( 'social' => __( 'LinkedIn', 'drift' ),  'icon' => 'linkedin',     'toggle' => $thinkup_header_linkedinswitch,  'link' => $thinkup_header_linkedinlink ),
			array( 'social' => __( 'Flickr', 'drift' ),    'icon' => 'flickr',       'toggle' => $thinkup_header_flickrswitch,    'link' => $thinkup_header_flickrlink ),
			array( 'social' => __( 'YouTube', 'drift' ),   'icon' => 'youtube',      'toggle' => $thinkup_header_youtubeswitch,   'link' => $thinkup_header_youtubelink ),
		);


		// Output social media links if any link is set
		foreach( $social_links as $social ) {	
			if ( ! empty( $social['link'] ) and $j == 0 ) {
				echo '<div id="post-footer-social"><ul>'; $j = 1;
			}

			if ( ! empty( $social['link'] ) and $social['toggle'] == '1' ) {

			echo '<li class="social ' . esc_attr( $social['icon'] ) . '">',
				 '<a href="' . esc_url( $social['link'] ) . '" data-tip="top" data-original-title="' . esc_attr( $social['social'] ) . '" target="_blank">',
				 '<i class="fa fa-' . esc_attr( $social['icon'] ) . '"></i>',
				 '</a>',
				 '</li>';
			}
		}

		// Close list output of social media links if any link is set
		if ( $j !== 0 ) echo '</ul></div>';
	}
}

