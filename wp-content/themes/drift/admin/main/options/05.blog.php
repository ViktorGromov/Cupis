<?php
/**
 * Blog functions.
 *
 * @package ThinkUpThemes
 */


 /* ----------------------------------------------------------------------------------
	BLOG STYLE
---------------------------------------------------------------------------------- */

function drift_thinkup_input_blogclass($classes){

	if ( drift_thinkup_check_isblog() ) {
		$classes[] = 'blog-style1 blog-style1-layout1';
	}
	return $classes;
}
add_action( 'body_class', 'drift_thinkup_input_blogclass');

// Add blog class to search results page
function drift_thinkup_input_searchclass($classes){

	if ( is_search() ) {
		$classes[] = 'blog-style1';
	}
	return $classes;
}
add_action( 'body_class', 'drift_thinkup_input_searchclass');	

/* ----------------------------------------------------------------------------------
	BLOG STYLE
---------------------------------------------------------------------------------- */

function drift_thinkup_input_stylelayout() {
	echo ' column-1';
}


/* ----------------------------------------------------------------------------------
	BLOG STYLE - CLASSES FOR STYLE 1
---------------------------------------------------------------------------------- */

function drift_thinkup_input_stylelayout_class1() {
global $post;

	if ( has_post_thumbnail( $post->ID ) ) {
		echo ' two_fifth';
	}
}

function drift_thinkup_input_stylelayout_class2() {
global $post;

	if ( has_post_thumbnail( $post->ID ) ) {
		echo ' three_fifth last';
	}
}


/* ----------------------------------------------------------------------------------
	HIDE POST TITLE
---------------------------------------------------------------------------------- */

function drift_thinkup_input_blogtitle() {

	echo	'<h2 class="blog-title">',
			'<a href="' . esc_url( get_permalink() ) . '" title="' . esc_attr( sprintf( __( 'Permalink to %s', 'drift' ), the_title_attribute( 'echo=0' ) ) ) . '">' . get_the_title() . '</a>',
			'</h2>';
}


/* ----------------------------------------------------------------------------------
	BLOG CONTENT
---------------------------------------------------------------------------------- */

// Input post thumbnail / featured media
function drift_thinkup_input_blogimage() {
global $post;

// Get theme options values.
$thinkup_blog_lightbox     = drift_thinkup_var ( 'thinkup_blog_hovercheck', 'option1' );
$thinkup_blog_link         = drift_thinkup_var ( 'thinkup_blog_hovercheck', 'option2' );

	$size    = NULL;
	$link    = NULL;
	$media   = NULL;
	$output  = NULL;

	$blog_lightbox = NULL;
	$blog_link     = NULL;
	$blog_class    = NULL;
	$blog_overlay  = NULL;

	// Set image size for blog thumbnail
	$size = 'drift-thinkup-column2-2/3';

	$featured_id  = get_post_thumbnail_id( $post->ID );
	$featured_img = wp_get_attachment_image_src($featured_id,'full', true);

	// Determine featured media to input
	$link  = $featured_img[0];
	$media = get_the_post_thumbnail( $post->ID, $size );

	// Determine which links to show on hover
	if ( $thinkup_blog_lightbox =='1' ) {
		$blog_lightbox = '<a class="hover-zoom prettyPhoto" href="' . esc_url( $link ) . '"></a>';
	}
	if ( $thinkup_blog_link =='1' ) {
		$blog_link = '<a class="hover-link" href="' . esc_url( get_permalink() ) . '"></a>';
	}

	// Determine which if single link animation should be shown
	if ( ( $thinkup_blog_lightbox == '1' and $thinkup_blog_link != '1' ) 
		or ( $thinkup_blog_lightbox != '1' and $thinkup_blog_link == '1' ) ) {
		$blog_class = ' style2';
	}

	if ( $thinkup_blog_lightbox =='1' or $thinkup_blog_link =='1' ) {
		$blog_overlay .= '<div class="image-overlay' . $blog_class . '">';
		$blog_overlay .= '<div class="image-overlay-inner"><div class="hover-icons">';
		$blog_overlay .= $blog_lightbox;
		$blog_overlay .= $blog_link;
		$blog_overlay .= '</div></div>';
		$blog_overlay .= '</div>';
	}

	// Output media on blog page
	if ( ! empty( $featured_id ) ) {
		$output .= '<div class="blog-thumb">';
		$output .= '<a href="' . esc_url( get_permalink($post->ID) ) . '">' . $media . '</a>';
		$output .= $blog_overlay;
		$output .= '</div>';
	}

	return $output;
}

// Input post excerpt / content to blog page
function drift_thinkup_input_blogtext() {
global $post;

// Get theme options values.
$thinkup_blog_postswitch = drift_thinkup_var ( 'thinkup_blog_postswitch' );

	// Output post content
	if ( is_search() ) {
		the_excerpt();
	} else if ( ! is_search() ) {
		if ( ( empty( $thinkup_blog_postswitch ) or $thinkup_blog_postswitch == 'option1' ) ) {
			if( ! is_numeric( strpos( $post->post_content, '<!--more-->' ) ) ) {
				the_excerpt();
			} else {
				the_content();
				wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'drift' ), 'after'  => '</div>', ) );
			}
		} else if ( $thinkup_blog_postswitch == 'option2' ) {
			the_content();
			wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'drift' ), 'after'  => '</div>', ) );
		}
	}
}


/* ----------------------------------------------------------------------------------
	BLOG META CONTENT & POST META CONTENT
---------------------------------------------------------------------------------- */

// Input sticky post
function drift_thinkup_input_sticky() {
	printf( '<span class="sticky"><a href="%1$s" title="%2$s">' . __( 'Sticky', 'drift' ) . '</a></span>',
		esc_url( get_permalink() ),
		esc_attr( get_the_title() )
	);
}

// Input blog date
function drift_thinkup_input_blogdate() {
	printf( __( '<span class="date"><a href="%1$s" title="%2$s"><time datetime="%3$s">%4$s</time></a></span>', 'drift' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_title() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);
}

// Input blog comments
function drift_thinkup_input_blogcomment() {

	if ( '0' != get_comments_number() ) {
		echo	'<span class="comment">';
			if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) {;
				comments_popup_link( __( '<span class="comment-count">0</span> <span class="comment-text">Comments</span>', 'drift' ), __( '<span class="comment-count">1</span> <span class="comment-text">Comment</span>', 'drift' ), __( '<span class="comment-count">%</span> <span class="comment-text">Comments</span>', 'drift' ) );
			};
		echo	'</span>';
	}
}

// Input blog categories
function drift_thinkup_input_blogcategory() {
$categories_list = get_the_category_list( __( ', ', 'drift' ) );

	if ( $categories_list && drift_thinkup_input_categorizedblog() ) {
		echo	'<span class="category">';
		printf( '%1$s', $categories_list );
		echo	'</span>';
	};
}

// Input blog tags
function drift_thinkup_input_blogtag() {
$tags_list = get_the_tag_list( '', __( ', ', 'drift' ) );

	if ( $tags_list ) {
		echo	'<span class="tags">';
		printf( '%1$s', $tags_list );
		echo	'</span>';
	};
}

// Input blog author
function drift_thinkup_input_blogauthor() {
	printf( __( '<span class="author"><a href="%1$s" title="%2$s" rel="author">%3$s</a></span>', 'drift' ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'drift' ), get_the_author() ) ),
		get_the_author()
	);
}

// Input blog tags
function drift_thinkup_input_blogformat() {
	
	$post_format = NULL;
	$post_format = get_post_format();

	if( ! empty( $post_format ) ) {
		echo	'<span class="blog-icon ' . esc_attr( $post_format ) . '">';
		echo	'<a href="' . esc_url( get_permalink() ) . '"></a>';
		echo	'</span>';
	}
}

//----------------------------------------------------------------------------------
//	CUSTOM READ MORE BUTTON.
//----------------------------------------------------------------------------------

function drift_thinkup_input_readmore( $link ) {
global $post;

	// Make no changes if in admin area
	if ( is_admin() ) {
		return $link;
	}

	$link = '&#8230;<p class="more-link"><a href="' . esc_url( get_permalink($post->ID) ) . '" class="themebutton">' . esc_html__( 'Read More', 'drift') . '</a></p>';

	return $link;
}
add_filter( 'excerpt_more', 'drift_thinkup_input_readmore' );
add_filter( 'the_content_more_link', 'drift_thinkup_input_readmore' );


/* ----------------------------------------------------------------------------------
	INPUT BLOG META CONTENT
---------------------------------------------------------------------------------- */

// Add format-media class to post article for featured image, gallery and video
function drift_thinkup_input_blogmediaclass($classes) {
global $post;

// Get theme options values.
$thinkup_blog_postswitch = drift_thinkup_var ( 'thinkup_blog_postswitch' );

	$featured_id = get_post_thumbnail_id( $post->ID );

	// Determine featured media to input
	if ( drift_thinkup_check_isblog() ) {
		if ( empty( $featured_id ) or $thinkup_blog_postswitch == 'option2' ) {
			$classes[] = 'format-nomedia';	
		} else if( has_post_thumbnail() ) {
			$classes[] = 'format-media';
		}
	}
	return $classes;
}
add_action( 'post_class', 'drift_thinkup_input_blogmediaclass');

// Blog meta content - Blog style 1
function drift_thinkup_input_blogmeta() {

	echo '<div class="entry-meta">';
		if ( is_sticky() && is_home() && ! is_paged() ) { drift_thinkup_input_sticky(); }

		drift_thinkup_input_blogdate();
		drift_thinkup_input_blogauthor();
		drift_thinkup_input_blogcomment();
		drift_thinkup_input_blogcategory();
		drift_thinkup_input_blogtag();
		drift_thinkup_input_blogformat();

	echo '</div>';
}


/* ----------------------------------------------------------------------------------
	INPUT POST META CONTENT
---------------------------------------------------------------------------------- */

function drift_thinkup_input_postmedia() {
global $post;

	// Set output variable to avoid php errors
	$output = NULL;

	if ( get_post_format() == 'image' ) {

		$output .= '<div class="post-thumb">' . get_the_post_thumbnail( $post->ID, 'drift-thinkup-column1-1/4' ) . '</div>';

	}

	// Output featured items if set
	if ( ! empty( $output ) ) {
		echo $output;
	}
}

// Add format-media class to post article for featured image, gallery and video
function drift_thinkup_input_postmediaclass($classes) {

	if ( is_singular( 'post' ) ) {
		if ( get_post_format() == 'image' ) {
			if( has_post_thumbnail() ) {
				$classes[] = 'format-media';
			}
		} else {
			$classes[] = 'format-nomedia';			
		}
	}
	return $classes;
}
add_action( 'post_class', 'drift_thinkup_input_postmediaclass');

// Input meta data for single post
function drift_thinkup_input_postmeta() {

		echo '<header class="entry-header">';

		echo '<div class="entry-meta">';
			drift_thinkup_input_blogdate();
			drift_thinkup_input_blogauthor();
			drift_thinkup_input_blogcomment();
			drift_thinkup_input_blogcategory();
			drift_thinkup_input_blogtag();
		echo '</div>';

		echo '<div class="clearboth"></div></header><!-- .entry-header -->';
}


/* ----------------------------------------------------------------------------------
	SHOW AUTHOR BIO
---------------------------------------------------------------------------------- */

// HTML for Author Bio
function drift_thinkup_input_postauthorbiocode() {

	$output = NULL;

	$output .= '<div id="author-bio">';

		// Author Title
		$output .= '<div id="author-title">';
		$output .= '<h3>' . __( 'About The Author', 'drift' ) . '</h3>';
		$output .= '</div>';

		// Author Image
		$output .= '<div id="author-image">';
		$output .= get_avatar( get_the_author_meta( 'email' ), '160' );
		$output .= '</div>';

		// Author Content
		$output .= '<div id="author-content">';
		$output .= '<div id="author-title">';
		$output .= '<p><a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '"/>' . get_the_author() . '</a></p>';
		$output .= '</div>';

		if ( get_the_author_meta( 'description' ) !== '' ) {
			$output .= '<div id="author-text">';
			$output .= wpautop( get_the_author_meta( 'description' ) );
			$output .= '</div>';
		}

		$output .= '</div>';

	$output .= '</div>';

	echo $output;
}

// Output Author Bio
function drift_thinkup_input_postauthorbio() {

// Get theme options values.
$thinkup_post_authorbio = drift_thinkup_var ( 'thinkup_post_authorbio' );

	if ( $thinkup_post_authorbio == '1' ) {
		drift_thinkup_input_postauthorbiocode();
	}
}


/* ----------------------------------------------------------------------------------
	TEMPLATE FOR COMMENTS AND PINGBACKS (PREVIOUSLY IN TEMPLATE-TAGS).
---------------------------------------------------------------------------------- */

/* Display comments  - Style 1 */
function drift_thinkup_input_allowcomments() {

	if ( comments_open() || '0' != get_comments_number() ) {
		comments_template( '/comments.php', true );
	}
}


/* ----------------------------------------------------------------------------------
	TEMPLATE FOR COMMENTS AND PINGBACKS (PREVIOUSLY IN TEMPLATE-TAGS).
---------------------------------------------------------------------------------- */

function drift_thinkup_input_commenttemplate( $comment, $args, $depth ) {

	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'drift'); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'drift' ), ' ' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
					<?php echo get_avatar( $comment, 90 ); ?>
			<header>

				<div class="comment-author">
					<h4><?php printf( '%s', sprintf( '%s', get_comment_author_link() ) ); ?></h4>
				</div>
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em><?php _e( 'Your comment is awaiting moderation.', 'drift'); ?></em>
					<br />
				<?php endif; ?>

				<div class="comment-meta">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time datetime="<?php esc_attr( comment_time( 'c' ) ); ?>">
					<?php
						/* translators: 1: date, 2: time */
						printf( '%1$s', get_comment_date() ); ?>
					</time></a>
					<?php edit_comment_link( __( 'Edit', 'drift' ), ' ' );
					?>
					<span class="reply">
						<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
					</span>
				</div>

			</header>

			<footer>

				<div class="comment-content"><?php comment_text(); ?></div>

			</footer><div class="clearboth"></div>

		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}

// List comments in single page
function drift_thinkup_input_comments() {
	$args = array( 
		'callback' => 'drift_thinkup_input_commenttemplate', 
	);
	wp_list_comments( $args );
}

