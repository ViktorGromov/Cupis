<?php
/**
 * blooster functions and definitions
 *
 * @package blooster
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 800; /* pixels */
}

if ( ! function_exists( 'blooster_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function blooster_setup() {

	
        add_theme_support( 'title-tag' );   
                
    
	load_theme_textdomain( 'blooster', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	
        
        add_theme_support( 'post-thumbnails' );

            add_theme_support( 'post-thumbnails' );
            set_post_thumbnail_size( 340 );
        
            add_image_size( 'homepage-thumb', 340 );
       

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'blooster' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'audio', 'gallery', 'image', 'quote', 'status', 'link', 'video', 'chat'
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'blooster_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
        
       

}
endif; // blooster_setup
add_action( 'after_setup_theme', 'blooster_setup' );

       
/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function blooster_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'blooster' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'blooster_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function blooster_scripts() {
    
        wp_enqueue_script("jquery");
        
        wp_enqueue_style( 'blooster-google-fonts', 'http://fonts.googleapis.com/css?family=Sanchez:400,400italic', false );
        
	wp_enqueue_style( 'blooster-style', get_stylesheet_uri() );
        
        wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.css' );

	wp_enqueue_script( 'blooster-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'blooster-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
        
        wp_enqueue_script( 'masonry-init', get_template_directory_uri().'/js/masonry-init.js', array( 'masonry' ), null, true );
        
        wp_enqueue_script('no-menu', get_template_directory_uri().'/js/no-menu.js', array(), null, true);
        
        wp_enqueue_script('blooster-infinite-scroll', get_template_directory_uri().'/js/jquery.infinitescroll.js', array(), null, true);
        
        wp_enqueue_script('bls-infinite', get_template_directory_uri().'/js/bls-infinite.js', array(), null, true);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'blooster_scripts' );

  

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * custom excerpt
 */
function blooster_trim_excerpt($text) {
        global $post;
        if ( '' == $text ) {
                $text = get_the_content('');
                $text = apply_filters('the_content', $text);
                $text = str_replace('\]\]\>', ']]&gt;', $text);
                $text = preg_replace('@<script[^>]*?>.*?</script>@si', '', $text);
                $text = strip_tags($text,'<iframe>');
                $excerpt_length = 35;
                $words = explode(' ', $text, $excerpt_length + 1);
            if (count($words)> $excerpt_length) {
                    array_pop($words);
                    array_push($words, '...<span class="readmore" ><br/><br/><a href="' . get_permalink() . '" title="' . the_title_attribute('echo=0') . '">  ' . __( 'Read more &#187;', 'blooster' ) . ' </a></span>');
                    $text = implode(' ', $words);           
            }
        }
        return $text;
}

remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'blooster_trim_excerpt');



