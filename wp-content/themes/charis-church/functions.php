<?php
/*
 * @package    CharisChurchTheme
 * @subpackage ThemeCode
 * @author     ChapelWorks Church Theme Team <support@structurworks.com>
 * @copyright  Copyright (c) 2014, StructurWorks LLC
 * @link       http://chapelworks-church-themes.com
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
global $charisbasiccurrentversion;
$charisbasiccurrentversion = "1.0.9";
/************* INCLUDE NEEDED FILES ***************/

/*

	- head cleanup (remove rsd, uri links, junk css, ect)
	- enqueueing scripts & styles
	- theme support functions
	- custom menu output & fallbacks
	- related post function
	- page-navi function
	- removing <p> from around images
	- customizing the post excerpt
	- custom google+ integration
	- adding custom fields to user profiles
*/




/*********************
LAUNCH CHARIS
*********************/

// we're firing all out initial functions at the start
add_action( 'after_setup_theme', 'charis_ahoy', 16 );

function charis_ahoy() {

	// remove pesky injected css for recent comments widget
	add_filter( 'wp_head', 'charis_remove_wp_widget_recent_comments_style', 1 );
	// clean up comment styles in the head
	add_action( 'wp_head', 'charis_remove_recent_comments_style', 1 );
	// clean up gallery output in wp
	add_filter( 'use_default_gallery_style', '__return_false' );

	// enqueue base scripts and styles
	add_action( 'wp_enqueue_scripts', 'charis_scripts_and_styles', 999 );
	// ie conditional wrapper

	// launching this stuff after theme setup
	charis_theme_support();

	// adding sidebars to Wordpress 
	add_action( 'widgets_init', 'charis_register_sidebars' );
	
	// adding the charis search form 
	add_filter( 'get_search_form', 'charis_wpsearch' );

	// cleaning up random code around images
	add_filter( 'the_content', 'charis_filter_ptags_on_images' );
	// cleaning up excerpt
	add_filter( 'excerpt_more', 'charis_excerpt_more' );
	
	// Language support
	load_theme_textdomain('charistheme', get_template_directory() . '/languages');
	

	// Thumbnail sizes
	add_image_size( 'charis-thumb-600', 600, 150, true );
	add_image_size( 'charis-thumb-300', 300, 150, true );
	add_image_size( 'charis-smallthumbnail', 100, 100, true );



} /* end charis ahoy */


// remove injected CSS for recent comments widget
function charis_remove_wp_widget_recent_comments_style() {
	if ( has_filter( 'wp_head', 'wp_widget_recent_comments_style' ) ) {
		remove_filter( 'wp_head', 'wp_widget_recent_comments_style' );
	}
}

// remove injected CSS from recent comments widget
function charis_remove_recent_comments_style() {
	global $wp_widget_factory;
	if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
		remove_action( 'wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style') );
	}
}


/*********************
Plugin Activation Code
*********************/


//   Include the Plugin_Activation class
require_once 'pa/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'charis_register_required_plugins' );

function charis_register_required_plugins() {

    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(

		
        // Include basic plugin from WordPress.org plugin directory
        array(
            'name'               => 'ChapelWorks Basic Church Plugin', // The plugin name.
            'slug'               => 'chapelworks-church-basic-features', // The plugin slug (typically the folder name).
            'required'           => false, // If false, the plugin is only 'recommended' instead of required.
        ),
		
    );

    /**
     * Array of configuration settings. 'version'            => '',
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => true,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => __( 'Install Required Plugins', 'charistheme' ),
            'menu_title'                      => __( 'Install Plugins', 'charistheme' ),
            'installing'                      => __( 'Installing Plugin: %s', 'charistheme' ), // %s = plugin name.
            'oops'                            => __( 'Something went wrong with the plugin API.', 'charistheme' ),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'charistheme' ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'charistheme' ), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'charistheme' ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'charistheme'), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'charistheme' ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'charistheme' ), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'charistheme' ), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'charistheme' ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'charistheme' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'charistheme' ),
            'return'                          => __( 'Return to Required Plugins Installer', 'charistheme' ),
            'plugin_activated'                => __( 'Plugin activated successfully.', 'charistheme' ),
            'complete'                        => __( 'All plugins installed and activated successfully. %s', 'charistheme' ), // %s = dashboard link.
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );

    tgmpa( $plugins, $config );

}




/*********************
SCRIPTS & ENQUEUEING
*********************/

// loading modernizr and jquery, and reply script
function charis_scripts_and_styles() {
	global $wp_styles; // call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way
	if (!is_admin()) {

		// modernizr (without media query polyfill)
		wp_enqueue_script( 'charis-modernizr', get_template_directory_uri() . '/library/js/libs/modernizr.custom.min.js', array(), '2.5.3', false );

		// comment reply script for threaded comments
		if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
			wp_enqueue_script( 'comment-reply' );
		}

		//adding scripts file in the footer
		wp_enqueue_script( 'charis-js', get_template_directory_uri() . '/library/js/scripts.js', array( 'jquery' ), '', true );

		// enqueue styles and scripts
		wp_enqueue_style( 'charis-stylesheet', get_template_directory_uri() . '/library/css/style.css', array(), '', 'all' );
		wp_enqueue_style( 'charis-ie-only', get_template_directory_uri() . '/library/css/ie.css', array(), ''  );

		$wp_styles->add_data( 'charis-ie-only', 'conditional', 'lt IE 9' ); // add conditional wrapper around ie stylesheet

		wp_enqueue_script( 'jquery' );

	}
}

/*********************
THEME SUPPORT
*********************/

// Adding WP 3+ Functions & Theme Support
function charis_theme_support() {

	// wp thumbnails (sizes handled in functions.php)
	add_theme_support( 'post-thumbnails' );

	// default thumb size
	set_post_thumbnail_size(125, 125, true);

	// wp custom background 
	add_theme_support( 'custom-background',
		array(
		'default-image' => '',  // background image default
		'default-color' => '', // background color default (dont add the #)
		'wp-head-callback' => '_custom_background_cb',
		'admin-head-callback' => '',
		'admin-preview-callback' => ''
		)
	);

	// rss thingy
	add_theme_support('automatic-feed-links');

	//Default video embed size
	function charis_video_embed_width( $defaults ) { 
		if ( has_post_format( 'video' ) || is_attachment() ) { 
			$defaults['width']  = 780; 
			$defaults['height'] =  440;
		} 
		return $defaults; 
	} 
	add_action( 'embed_defaults', 'charis_video_embed_width' ); 

	// adding post format support
	
	add_theme_support( 'post-formats',
		array(
			'video',             // video
			'aside',             // title less blurb
			'quote',             // a quick quote
			'status'             // a Facebook like status update
		)
	);

	
	//Allow WordPress to manage the title - WP 4.1 and later
	add_theme_support( 'title-tag' );
	// Title support for backwards compatibility - WP 4.0 and earlier
	if ( ! function_exists( '_wp_render_title_tag' ) ) {
		function theme_slug_render_title() {
			?>
			<title><?php wp_title( '|', true, 'right' ); ?></title>
			<?php
		}
		add_action( 'wp_head', 'theme_slug_render_title' );
	}

    
    
    /**** Register Theme Feature Support for Custom Headers ****************/

    $args = array(
        'width' => 1024,
        'height' => 175,
        'default-text-color' => '',
        'default-image' => '',
        'uploads' => true,
    );
    add_theme_support( 'custom-header' , $args);



	// registering wp3+ menus
	register_nav_menus(
		array(
			'main-nav' => __( 'The Main Menu', 'charistheme' ),   // main nav in header
			'side-menu' => __( 'Side Menu', 'charistheme' ),   // main nav in header
			'footer-links' => __( 'Footer Links', 'charistheme' ) // secondary nav in footer
		)
	);
} /* end charis theme support */




/*********************
PAGE NAVI
*********************/

// Numeric Page Navi (built into the theme by default)

function charis_page_navi() {
	global $wp_query;
	$bignum = 999999999;
	
	if ( $wp_query->max_num_pages <= 1 )
		return;
	
	echo '<nav class="pagination">';
	
		echo paginate_links( array(
			'base' 			=> str_replace( $bignum, '%#%', esc_url( get_pagenum_link($bignum) ) ),
			'format' 		=> '',
			'current' 		=> max( 1, get_query_var('paged') ),
			'total' 		=> $wp_query->max_num_pages,
			'prev_text' 	=> '&larr;',
			'next_text' 	=> '&rarr;',
			'type'			=> 'list',
			'end_size'		=> 3,
			'mid_size'		=> 3
		) );
	
	echo '</nav>';
}  /* end page navi */

/*********************
RANDOM CLEANUP ITEMS
*********************/

// remove the p from around imgs (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)
function charis_filter_ptags_on_images($content){
	return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

// This removes the annoying […] to a Read More link
function charis_excerpt_more($more) {
	global $post;
	// edit here if you like
	return '...  <a class="excerpt-read-more" href="'. get_permalink($post->ID) . '" title="'. __( 'Read', 'charistheme' ) . get_the_title($post->ID).'">'. __( 'Read more &raquo;', 'charistheme' ) .'</a>';
}

/*
 * This is a modified the_author_posts_link() which just returns the link.
 *
 * This is necessary to allow usage of the usual l10n process with printf().
 */
function charis_get_the_author_posts_link() {
	global $authordata;
	if ( !is_object( $authordata ) )
		return false;
	$link = sprintf(
		'<a href="%1$s" title="%2$s" rel="author">%3$s</a>',
		get_author_posts_url( $authordata->ID, $authordata->user_nicename ),
		esc_attr( sprintf( __( 'Posts by %s', 'charistheme' ), get_the_author() ) ), // No further l10n needed, core will take care of this one
		get_the_author()
	);
	return $link;
}



/*
Admin Options
*/


/************* DASHBOARD WIDGETS *****************/

function charis_theme_customizer( $wp_customize ) {
    
	
	// create a new section for logo upload
	$wp_customize->add_section( 'charis_logo_section' , array(
    'title'       => __( 'Logo', 'charistheme' ),
    'priority'    => 30,
    'description' => __('Upload a logo to replace the default site name and description in the header', 'charistheme'),
	) );
	
	// register our new setting
	$wp_customize->add_setting( 'charis_logo', array('sanitize_callback' =>  'esc_url_raw')); 
	
	// tell the Theme Customizer to use an image uploader
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'charis_logo', array(
    'label'    => __( 'Logo', 'charistheme' ),
    'section'  => 'charis_logo_section',
    'settings' => 'charis_logo',
	) ) );
	
}
add_action('customize_register', 'charis_theme_customizer');

 
function charis_colorpalette_theme_customizer( $wp_customize ) {

	$wp_customize->remove_section( 'colors' );


	$wp_customize->add_section( 'colorpalette_color_scheme_settings', array(
		'title'       => __( 'Color Scheme', 'charistheme' ),
		'priority'    => 30,
		'description' => __('Select your color scheme', 'charistheme' ),
	) );

	$wp_customize->add_setting( 'colorpalette_color_scheme', array(
		'default'        => '', 
		'sanitize_callback' =>  'charis_sanitize_colorpalette'
	) );

	$wp_customize->add_control( 'colorpalette_color_scheme', array(
		'label'   => __( 'Select Color Scheme', 'charistheme' ),
		'section' => 'colorpalette_color_scheme_settings',
		'type'       => 'radio',
		'choices'    => array(
			'custom_' =>  __( 'Custom', 'charistheme' ),
			'grey_' =>  __( 'Grey', 'charistheme' ),
			'white_ '=>  __( 'White', 'charistheme' ),
			'blue_' => __( 'Blue', 'charistheme' ),
			'sand_' => __( 'Sand', 'charistheme' ) ,
		),
	) );
}
add_action('customize_register', 'charis_colorpalette_theme_customizer');


function charis_sanitize_colorpalette ($value ) {
    if ( ! in_array( $value, array( 'custom_' ,'grey_', 'white_', 'blue_', 'sand_') ) ){ 
        $value = ''; }
 
    return $value;
}



 function charis_colorpalette_add_customizer_css() {   ?>
 
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri();?>/css/<?php echo strtolower( get_theme_mod( 'colorpalette_color_scheme' ) ); ?>style.css" type="text/css" media="screen">

<?php }
add_action( 'wp_head', 'charis_colorpalette_add_customizer_css' );


/********** WordPress requires setting $content_width **/

//set the maximum allowed width for any content in the theme
if ( ! isset( $content_width ) ) {
	$content_width = 1024;
}


add_action( 'after_setup_theme', 'charis_add_editor_styles' );


/***** Apply theme's stylesheet to the visual editor. *****/
function charis_add_editor_styles() {
    add_editor_style(get_stylesheet_uri());
}

/************* THUMBNAIL SIZE OPTIONS *************/


add_filter( 'image_size_names_choose', 'charis_custom_image_sizes' );

function charis_custom_image_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'charis-thumb-600' => __('600px by 150px', 'charistheme'),
        'charis-thumb-300' => __('300px by 150px', 'charistheme'),
    ) );
}


/************* ACTIVE SIDEBARS ********************/


// Sidebars & Widgetizes Areas

function charis_register_sidebars() {
	register_sidebar(array(
		'id' => 'sidebar1',
		'name' => __( 'Sidebar 1', 'charistheme' ),
		'description' => __( 'Front Page Sidebar', 'charistheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));
	
	register_sidebar(array(
		'id' => 'sidebar2',
		'name' => __( 'Sidebar 2', 'charistheme' ),
		'description' => __( 'Left Sidebar', 'charistheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	
}

/***** Navigations / Menus  ************************************/


/**** Initialize superfish menu utility ***********/



function charis_enqueue_superfish() {
// set the directory holding the superfish files
    $sf_dir = trailingslashit( get_stylesheet_directory_uri() ) . 'sf/';
 
 
// queue up superfish
    wp_enqueue_script( 'hoverIntent', $sf_dir . 'hoverIntent.js', 'jquery' );
    wp_enqueue_script( 'superfish', $sf_dir . 'superfish.js', 'jquery', '1.4.8' );
}
 
add_action( 'wp_enqueue_scripts', 'charis_enqueue_superfish', 0 );

// load jquery on page ready
function charis_init_superfish() {
echo '<script type="text/javascript">jQuery(document).ready(function(){
jQuery(\'ul.sf-menu\').superfish();});</script>';
}
 
add_action( 'wp_head', 'charis_init_superfish', 99999 );


// the main menu
function charis_main_nav() {
	
	wp_nav_menu(array(
		'container' => false,                           // remove nav container
		'container_class' => 'clearfix',           		// class of container (should you choose to use it)
		'menu' => __( 'The Main Menu', 'charistheme' ),  // nav name
		'menu_class' => 'sf-menu',  
		'theme_location' => 'main-nav',                 // where it's located in the theme
		'before' => '',                                 // before the menu
		'after' => '',                                  // after the menu
		'link_before' => '',                            // before each link
		'link_after' => '',                             // after each link
		'depth' => 0,                                   // limit the depth of the nav
		'fallback_cb' => 'charis_main_nav_fallback'      // fallback function
	));
} /* end charis main nav */

// the footer menu
function charis_footer_links() {
	
	wp_nav_menu(array(
		'container' => 'false',                              // remove nav container
		'container_class' => 'clearfix',   // class of container (should you choose to use it)
		'menu' => __( 'Footer Links', 'charistheme' ),   // nav name
		'menu_class' => 'menu-footer',      // adding custom nav class
		'theme_location' => 'footer-links',             // where it's located in the theme
		'before' => '',                                 // before the menu
		'after' => '',                                  // after the menu
		'link_before' => '',                            // before each link
		'link_after' => '',                             // after each link
		'depth' => 0,                                   // limit the depth of the nav
		'fallback_cb' => 'charis_footer_links_fallback'  // fallback function
	));
} /* end charis footer link */

// this is the fallback for header menu

function charis_main_nav_fallback() {

	wp_page_menu( array(
		'show_home' => true,
		'menu_class' => 'fallback-nav',      // adding fallback nav class 
		'include'     => '',
		'exclude'     => '',
		'echo'        => true,
		'link_before' => '',                            // before each link
		'link_after' => ''                             // after each link
	) );
	
}

// this is the fallback for footer menu
/*
function charis_footer_links_fallback() {	
}
*/


// the side page menu
function charis_side_nav() {
	// display the wp3 menu if available
	wp_nav_menu(array(
		'container' => 'nav',                           // remove nav container
		 'container_class' => 'menu ',           // class of container (should you choose to use it)
		'menu' => __( 'Side page Menu', 'charistheme' ),  // nav name
		'menu_class' => 'vertical menu-side left-side-menu ',         // adding custom nav class
		'theme_location' => 'side-menu',                  // where it's located in the theme
		'before' => '',                                 // before the menu
		'after' => '',                                  // after the menu
		'link_before' => '',                            // before each link
		'link_after' => '',                             // after each link
		'depth' => 0,                                   // limit the depth of the nav
		'fallback_cb' => 'charis_side_nav_fallback'       // fallback function
	));
}

// this is the fallback for footer menu
function charis_side_nav_fallback() {

}



/************* COMMENT LAYOUT *********************/

// Comment Layout
function charis_comments( $comment, $args, $depth ) {
   $GLOBALS['comment'] = $comment; ?>
  <div id="comment-<?php comment_ID(); ?>" <?php comment_class('cf'); ?>>
    <article  class="cf">
      <header class="comment-author vcard">
        <?php
        /*
          this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. 
		  What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! 
		  If you'd like to change it back, just replace it with the regular wordpress gravatar call:
          echo get_avatar($comment,$size='32',$default='<path_to_url>' );
        */
        ?>
        <?php // custom gravatar call ?>
        <?php
          // create variable
          $bgauthemail = get_comment_author_email();
        ?>
        <img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5( $bgauthemail ); ?>?s=40" class="load-gravatar avatar avatar-48 photo" height="40" width="40" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
        <?php // end custom gravatar call ?>
        <?php printf(__( '<cite class="fn">%1$s</cite> %2$s', 'charistheme' ), get_comment_author_link(), edit_comment_link(__( '(Edit)', 'charistheme' ),'  ','') ) ?>
        <time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__( 'F jS, Y', 'charistheme' )); ?> </a></time>
      </header>
      <?php if ($comment->comment_approved == '0') : ?>
        <div class="alert alert-info">
          <p><?php _e( 'Your comment is awaiting moderation.', 'charistheme' ) ?></p>
        </div>
      <?php endif; ?>
      <section class="comment_content cf">
        <?php comment_text() ?>
      </section>
      <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
    </article>
  <?php // </li> is added by WordPress automatically ?>
<?php
} // don't remove this bracket!


/************* SEARCH FORM LAYOUT *****************/

// Search Form
function charis_wpsearch($form) {
	$form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
	<label class="screen-reader-text" for="s">' . __( 'Search for:', 'charistheme' ) . '</label>
	<input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="' . esc_attr__( 'Search the Site...', 'charistheme' ) . '" />
	<input type="submit" id="searchsubmit" value="' . esc_attr__( 'Search', 'charistheme' ) .'" />
	</form>';
	return $form;
} // don't remove this bracket!



/************************************
Limit excerpt length to 30 words
************************************/

function custom_excerpt_length( $length ) {
	return 30;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


/************* Show messages in Dashboard *****************/
function charis_show_dashboard_message(){
	
	global $charisbasiccurrentversion;
	global $current_user;
  
	$user_id = $current_user->ID;

	if ( ! get_user_meta($user_id, 'charis_ignore_notice_meta') ) {

		
		$allowed_html = array(
			'a'             => array('href' => array (),'title' => array ()),
			'b'             => array(),
			'blockquote'    => array('cite' => array ()),
			'br'            => array(),
			'dd'            => array(),
			'dl'            => array(),
			'dt'            => array(),
			'em'            => array(),
			'i'             => array(),
			'span'          => array(),
			'li'            => array(),
			'ol'            => array(),
			'p'             => array(),
			'q'             => array('cite' => array ()),
			'strong'        => array(),
			'ul'            => array(),
			'h1'            => array('align' => array (),'class' => array (),'id' => array (), 'style' => array ()),
			'h2'            => array('align' => array (),'class' => array (),'id' => array (), 'style' => array ()),
			'h3'            => array('align' => array (),'class' => array (),'id' => array (), 'style' => array ()),
			'h4'            => array('align' => array (),'class' => array (),'id' => array (), 'style' => array ()),
			'h5'            => array('align' => array (),'class' => array (),'id' => array (), 'style' => array ()),
			'h6'            => array('align' => array (),'class' => array (),'id' => array (), 'style' => array ())
		);

		$screen = get_current_screen();
		if (isset($screen) && $screen->id == 'dashboard'){
			$msg_url = 'http://www.structurworks.com/charisfreemsg.html';
			ob_start(); ?>
			<div class="updated" style="color:blue; width:40%;">
				<h3 style="color:blue; "> <?php _e('This is the Charis Theme for Churches (Basic Edition)','charistheme') ?> </h3>
				<h3 style="color:black; "> <?php _e('Documentation for this theme can be found ','charistheme')?> <a href="http://chapelworks-church-themes.com/basic-theme-installation-and-setup/"><?php _e('here.','charistheme')?></a></h3>
				<h3 style="color:black; "> <?php _e('Support for this theme can be obtained at the ','charistheme')?> <a href="http://www.chapelworks-church-themes.com"><?php _e('Charis home website.','charistheme')?></a></h3>
				<p><?php _e('You are running version','charistheme')?> <strong><?php echo $charisbasiccurrentversion ?></strong>.</p>
				<?php $wp_remote_msg = wp_remote_get($msg_url); // show latest version
				if ( !is_wp_error($wp_remote_msg) && $wp_remote_msg['response']['message'] == 'OK'){
					echo wp_kses($wp_remote_msg['body'], $allowed_html); 
				} 
				printf(__('<a style="float:right; font-size:10px;"href="%1$s"><span class="dashicons dashicons-dismiss" style="color:grey; font-size:10px; line-height: 16px;"></span>Dismiss</a>','charistheme'), '?charis_ignore_admin_msg=0');

				echo ob_get_clean(); ?>
				<br>
			</div>

		 <?php
		}
	}
} 
add_action('admin_notices', 'charis_show_dashboard_message');

function charis_ignore_admin_msg() {
	global $current_user;
        $user_id = $current_user->ID;
        //if user clicks Dismiss Notice, add it to user meta
        if ( isset($_GET['charis_ignore_admin_msg']) && '0' == $_GET['charis_ignore_admin_msg'] ) {
             add_user_meta($user_id, 'charis_ignore_notice_meta', 'true', true);
	}
}
add_action('admin_init', 'charis_ignore_admin_msg');
?>