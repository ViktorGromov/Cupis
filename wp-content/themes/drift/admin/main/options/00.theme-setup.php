<?php
/**
 * Theme setup functions.
 *
 * @package ThinkUpThemes
 */

//----------------------------------------------------------------------------------
//	MIGRATE SLIDER SETTINGS PAGE -> IMAGE
//----------------------------------------------------------------------------------

// Migrate slider settings from the page slider to the image slider
function drift_thinkup_migrate_slider_page2image() {

	// Set possible options names
	$options_redux   = get_option( 'drift_thinkup_redux_variables' );
	$options_migrate = get_option( 'thinkup_migrate_slider_page2image' );

	// Get theme options values.
	$thinkup_homepage_sliderpage1 = drift_thinkup_var ( 'thinkup_homepage_sliderpage1' );
	$thinkup_homepage_sliderpage2 = drift_thinkup_var ( 'thinkup_homepage_sliderpage2' );
	$thinkup_homepage_sliderpage3 = drift_thinkup_var ( 'thinkup_homepage_sliderpage3' );

	// Get url of featured images in slider pages
	$slide1_image_url = wp_get_attachment_url( get_post_thumbnail_id( $thinkup_homepage_sliderpage1 ) );
	$slide2_image_url = wp_get_attachment_url( get_post_thumbnail_id( $thinkup_homepage_sliderpage2 ) );
	$slide3_image_url = wp_get_attachment_url( get_post_thumbnail_id( $thinkup_homepage_sliderpage3 ) );

	// Get titles of slider pages
	$slide1_title = get_the_title( $thinkup_homepage_sliderpage1 );
	$slide2_title = get_the_title( $thinkup_homepage_sliderpage2 );
	$slide3_title = get_the_title( $thinkup_homepage_sliderpage3 );

	// Get descriptions (excerpt) of slider pages
	$slide1_desc = apply_filters( 'the_excerpt', get_post_field( 'post_excerpt', $thinkup_homepage_sliderpage1 ) );
	$slide2_desc = apply_filters( 'the_excerpt', get_post_field( 'post_excerpt', $thinkup_homepage_sliderpage2 ) );
	$slide3_desc = apply_filters( 'the_excerpt', get_post_field( 'post_excerpt', $thinkup_homepage_sliderpage3 ) );

	// Create array for slider content
	$thinkup_homepage_sliderpage = array(
		array(
			'slide_image_url'   => $slide1_image_url,
			'slide_title'       => $slide1_title,
			'slide_desc'        => $slide1_desc,
			'slide_link'        => $thinkup_homepage_sliderpage1
		),
		array(
			'slide_image_url'   => $slide2_image_url,
			'slide_title'       => $slide2_title,
			'slide_desc'        => $slide2_desc,
			'slide_link'        => $thinkup_homepage_sliderpage2
		),
		array(
			'slide_image_url'   => $slide3_image_url,
			'slide_title'       => $slide3_title,
			'slide_desc'        => $slide3_desc,
			'slide_link'        => $thinkup_homepage_sliderpage3
		),
	);

	// Only migrate if not already migrated
	if ( $options_migrate != 1 ) {

		foreach ($thinkup_homepage_sliderpage as $slide) {

			if ( is_numeric( $slide['slide_link'] ) ) {

				$count++;

				// Get updated option values
				$options_redux['thinkup_homepage_sliderimage' . $count. '_image']['url'] = $slide['slide_image_url'];
				$options_redux['thinkup_homepage_sliderimage' . $count. '_title']        = $slide['slide_title'];
				$options_redux['thinkup_homepage_sliderimage' . $count. '_desc']         = $slide['slide_desc'];
				$options_redux['thinkup_homepage_sliderimage' . $count. '_link']         = $slide['slide_link'];

			}

			// Migrate values - options
			update_option( 'drift_thinkup_redux_variables', $options_redux );

			// Set the migrated flag
			update_option( $name_migration, 1 );

		}

	} else {

		// Set the migrated	flag
		update_option( $name_migration, 1 );

	}
}
add_action( 'init', 'drift_thinkup_migrate_slider_page2image', 999 );


//----------------------------------------------------------------------------------
//	ADD PAGE TITLE
//----------------------------------------------------------------------------------

function drift_thinkup_title_select() {
	global $post;

	if ( is_page() ) {
		printf( '<span>%s</span>', esc_html( get_the_title() ) );
	} elseif ( is_attachment() ) {
		printf( '<span>' . __( 'Blog Post Image: ', 'drift' ) . '</span>' . '%s', esc_html( get_the_title( $post->post_parent ) ) );
	} else if ( is_single() ) {
		printf( '<span>%s</span>', esc_html( get_the_title() ) );
	} else if ( is_search() ) {
		printf( '<span>' . __( 'Search Results: ', 'drift' ) . '</span>' . '%s', esc_html( get_search_query() ) );
	} else if ( is_404() ) {
		printf( '<span>' . __( 'Page Not Found', 'drift' ) . '</span>' );
	} elseif ( is_archive() ) {
		echo get_the_archive_title();
	} elseif ( drift_thinkup_check_isblog() ) {
		printf( '<span>' . __( 'Blog', 'drift' ) . '</span>' );
	} else {
		printf( '<span>%s</span>', esc_html( get_the_title() ) );
	}
}


//----------------------------------------------------------------------------------
//	ADD BREADCRUMBS FUNCTIONALITY
//----------------------------------------------------------------------------------

function drift_thinkup_input_breadcrumb() {

// Get theme options values.
$thinkup_general_breadcrumbdelimeter = drift_thinkup_var ( 'thinkup_general_breadcrumbdelimeter' );

	$output           = NULL;
	$count_loop       = NULL;
	$count_categories = NULL;

	if ( empty( $thinkup_general_breadcrumbdelimeter ) ) {
		$delimiter = '<span class="delimiter">/</span>';
	} else if ( ! empty( $thinkup_general_breadcrumbdelimeter ) ) {
		$delimiter = '<span class="delimiter"> ' . esc_html( $thinkup_general_breadcrumbdelimeter ) . ' </span>';
	}

	$delimiter_inner   =   '<span class="delimiter_core"> &bull; </span>';
	$main              =   __( 'Home', 'drift' );
	$maxLength         =   30;

	/* Display breadcumbs if NOT the home page */
	if ( ! is_front_page() ) {
		$output .= '<div id="breadcrumbs"><div id="breadcrumbs-core">';
		global $post, $cat;
		$homeLink = home_url( '/' );
		$output .= '<a href="' . esc_url( $homeLink ) . '">' . esc_html( $main ) . '</a>' . $delimiter;

		/* Display breadcrumbs for single post */
		if ( is_single() ) {
			$category = get_the_category();
			$num_cat = count($category);
			if ($num_cat <=1) {
				$output .= ' ' . esc_html( get_the_title() );
			} else {

				// Count Total categories
				foreach( get_the_category() as $category) {
					$count_categories++;
				}

				// Output Categories
				foreach( get_the_category() as $category) {
					$count_loop++;

					if ( $count_loop < $count_categories ) {
						$output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->cat_name ) . '</a>' . $delimiter_inner;
					} else {
						$output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->cat_name ) . '</a>';
					}
				}

				if (strlen(get_the_title()) >= $maxLength) {
					$output .=  ' ' . $delimiter . esc_html( trim( substr( get_the_title(), 0, $maxLength ) ) ) . ' &hellip;';
				} else {
					$output .=  ' ' . $delimiter . esc_html( get_the_title() );
				}
			}
		} elseif ( is_search() ) {
			$output .= __( 'Search Results for: ', 'drift' ) . esc_html( get_search_query() ) . '"';
		} elseif ( is_page() && !$post->post_parent ) {
			$output .=  esc_html( get_the_title() );
		} elseif ( is_page() && $post->post_parent ) {
			$post_array = get_post_ancestors( $post );
			krsort( $post_array );
			foreach( $post_array as $key=>$postid ){
				$post_ids = get_post( $postid );
				$title = $post_ids->post_title;
				$output  .= '<a href="' . esc_url( get_permalink( $post_ids ) ) . '">' . esc_html( $title ) . '</a>' . $delimiter;
			}
			$output .= esc_html( get_the_title() );
		} elseif ( is_404() ) {
			$output .= __( 'Error 404 - Not Found.', 'drift' );
		} elseif ( is_archive() ) {
			$output .= get_the_archive_title();
		} elseif ( drift_thinkup_check_isblog() ) {
			$output .= __( 'Blog', 'drift' );
		} else {
			$output .= esc_html( get_the_title() );
		}
		$output .=  '</div></div>';

		return $output;
	}
}


/* ----------------------------------------------------------------------------------
	ADD MENU DESCRIPTION FEATURE
---------------------------------------------------------------------------------- */

class drift_thinkup_menudescription extends Walker_Nav_Menu {

	function start_el(&$output, $item, $depth=0, $args=array(), $id = 0) {
		global $wp_query;
		
		$item_output = NULL;
		
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
 
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';
 
		$output .= $indent . '<li id="menu-item-'. esc_attr( $item->ID ) . '"' . $value . $class_names .'>';

		$attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
		$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
		$attributes .= ! empty( $item->url ) ? ' href="' . esc_url( $item->url ) . '"' : ' href="' . esc_url( get_permalink( $item->ID ) ) . '"';

        // Insert title for top level
		if ( has_nav_menu( 'header_menu' ) ) {
			$title = ( $depth == 0 )
				? '<span>' . apply_filters( 'the_title', $item->title, $item->ID ) . '</span>' : apply_filters( 'the_title', $item->title, $item->ID );
		} else {
			$title = ( $depth == 0 )
				? '<span>' . apply_filters( 'the_title', get_the_title($item->ID), $item->ID ) . '</span>' : apply_filters( 'the_title', get_the_title($item->ID), $item->ID );
		}

        // Structure of output
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $title;
		$item_output .= '</a>';

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}


//----------------------------------------------------------------------------------
//	ADD CUSTOM FEATURED IMAGE SIZES
//----------------------------------------------------------------------------------

if ( ! function_exists( 'drift_thinkup_input_addimagesizes' ) ) {
	function drift_thinkup_input_addimagesizes() {

		add_image_size( 'drift-thinkup-column1-1/4', 1140, 285, true );
		add_image_size( 'drift-thinkup-column2-2/3', 570, 380, true );
		add_image_size( 'drift-thinkup-column3-2/5', 380, 152, true );	
	}
	add_action( 'init', 'drift_thinkup_input_addimagesizes' );
}

if ( ! function_exists( 'drift_thinkup_input_showimagesizes' ) ) {
	function drift_thinkup_input_showimagesizes($sizes) {
	
		$sizes['drift-thinkup-column1-1/4'] = __( 'Full - 1:4', 'drift' );
		$sizes['drift-thinkup-column2-2/3'] = __( 'Half - 2:3', 'drift' );
		$sizes['drift-thinkup-column3-2/5'] = __( 'Third - 2:5', 'drift' );

		return $sizes;
	}
	add_filter('image_size_names_choose', 'drift_thinkup_input_showimagesizes');
}


//----------------------------------------------------------------------------------
//	CHANGE FALLBACK WP_PAGE_MENU CLASSES TO MATCH WP_NAV_MENU CLASSES
//----------------------------------------------------------------------------------

function drift_thinkup_input_menuclass( $ulclass ) {

	// Add menu class to list
	$ulclass = preg_replace( '/<ul>/', '<ul class="menu">', $ulclass, 1 );
	$ulclass = str_replace( 'children', 'sub-menu', $ulclass );

	// Remove div wrapper
	$ulclass = str_replace( '<div class="menu">', '', $ulclass );
	$ulclass = str_replace( '</div>', '', $ulclass );

	return preg_replace('/<div (.*)>(.*)<\/div>/iU', '$2', $ulclass );
}
add_filter( 'wp_page_menu', 'drift_thinkup_input_menuclass' );


//----------------------------------------------------------------------------------
//	DETERMINE IF THE PAGE IS A BLOG - USEFUL FOR HOMEPAGE BLOG.
//----------------------------------------------------------------------------------

// Credit to: http://www.poseidonwebstudios.com/web-development/wordpress-is_blog-function/
function drift_thinkup_check_isblog() {
 
    global $post;
 
    //Post type must be 'post'.
    $post_type = get_post_type($post);
 
    //Check all blog-related conditional tags, as well as the current post type,
    //to determine if we're viewing a blog page.
    return (
        ( is_home() || is_archive() )
        && ($post_type == 'post')
    ) ? true : false ;
}


//----------------------------------------------------------------------------------
//	ADD GOOGLE FONT - RALEWAY. (http://themeshaper.com/2014/08/13/how-to-add-google-fonts-to-wordpress-themes/)
//----------------------------------------------------------------------------------

function drift_thinkup_googlefonts_url() {
    $fonts_url = '';

    // Translators: Translate this to 'off' if there are characters in your language that are not supported by Open Sans
    $font_translate = _x( 'on', 'Raleway font: on or off', 'drift' );
 
    if ( 'off' !== $font_translate ) {
        $font_families = array();
  
        if ( 'off' !== $font_translate ) {
            $font_families[] = 'Raleway:300,400,600,700';
            $font_families[] = 'Open Sans:300,400,600,700';
        }
 
        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );
 
        $fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
    }
 
    return $fonts_url;
}

function drift_thinkup_googlefonts_scripts() {
   wp_enqueue_style( 'drift-thinkup-google-fonts', drift_thinkup_googlefonts_url(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'drift_thinkup_googlefonts_scripts' );


//----------------------------------------------------------------------------------
//	ADD THEMEBUTTON2 CLASS TO COMMENT CANCEL REPLY BUTTON
//----------------------------------------------------------------------------------

function drift_thinkup_input_cancelreplyclass($class){
    $class = str_replace( 'id="cancel-comment-reply-link"', 'id="cancel-comment-reply-link" class="themebutton2"', $class);
    return $class;
}
add_filter('cancel_comment_reply_link', 'drift_thinkup_input_cancelreplyclass');


//----------------------------------------------------------------------------------
//	FIX JETPACK PHOTON IMAGE LOAD ISSUE - DISABLE CACHING FOR SPECIFIC IMAGES 
//----------------------------------------------------------------------------------

function drift_thinkup_photon_exception( $val, $src, $tag ) {
        if ( $src == get_template_directory_uri() . '/images/transparent.png' ) {
			return true;
        }
        return $val;
}
add_filter( 'jetpack_photon_skip_image', 'drift_thinkup_photon_exception', 10, 3 );

