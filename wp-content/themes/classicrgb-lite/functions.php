<?php
if ( ! function_exists( 'classicrgb_lite_setup' ) ) :
function classicrgb_lite_setup() {
	load_theme_textdomain( 'classicrgb-lite', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',	) );
	register_nav_menu('header-menu', __( 'Header Menu', 'classicrgb-lite' ));
}
endif;
add_action( 'after_setup_theme', 'classicrgb_lite_setup' );

function classicrgb_lite_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'classicrgb_lite_content_width', 640 );
}
add_action( 'after_setup_theme', 'classicrgb_lite_content_width', 0 );
function classicrgb_lite_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Left', 'classicrgb-lite' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'classicrgb-lite' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Header', 'classicrgb-lite' ),
		'id'            => 'sidebar-4',
		'description'   => esc_html__( 'Add widgets here.', 'classicrgb-lite' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer-1', 'classicrgb-lite' ),
		'id'            => 'sidebar-5',
		'description'   => esc_html__( 'Add widgets here.', 'classicrgb-lite' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer-2', 'classicrgb-lite' ),
		'id'            => 'sidebar-6',
		'description'   => esc_html__( 'Add widgets here.', 'classicrgb-lite' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer-3', 'classicrgb-lite' ),
		'id'            => 'sidebar-7',
		'description'   => esc_html__( 'Add widgets here.', 'classicrgb-lite' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer-4', 'classicrgb-lite' ),
		'id'            => 'sidebar-8',
		'description'   => esc_html__( 'Add widgets here.', 'classicrgb-lite' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'classicrgb_lite_widgets_init' );










function classicrgb_lite_scripts() {
		wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.css', array( ), false, 'all' );
		wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap-theme.css', array( ), false, 'all' );
		wp_enqueue_script('jquery');
		wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.js', array( ), false, 'all' );
		wp_enqueue_style( 'classicrgb-lite-style', get_stylesheet_uri() );
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'classicrgb_lite_scripts' );


require get_template_directory() . '/inc/template-tags.php';
add_action( 'after_setup_theme', 'classicrgb_lite_woocommerce_support' );
function classicrgb_lite_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

add_filter('add_to_cart_fragments', 'classicrgb_lite_fragment');
function classicrgb_lite_fragment( $fragments ) {
    global $woocommerce;
    ob_start(); ?>
    <a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'classicrgb-lite'); ?>"> <?php echo $woocommerce->cart->get_cart_total(); ?></a>
    <?php
    $fragments['a.cart-contents'] = ob_get_clean();
    return $fragments;
}