<?php
/**
 * Extreme Floats functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Extreme_Floats
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function extreme_floats_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Extreme Floats, use a find and replace
		* to change 'extreme-floats' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'extreme-floats', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'extreme-floats' ),
			'socials' => esc_html__('Socials', 'extreme-floats'),
			'cart' => esc_html__('Cart', 'extreme-floats'),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'extreme_floats_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'extreme_floats_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function extreme_floats_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'extreme_floats_content_width', 640 );
}
add_action( 'after_setup_theme', 'extreme_floats_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function extreme_floats_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'extreme-floats' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'extreme-floats' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'extreme_floats_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function extreme_floats_scripts() {
	wp_enqueue_style( 'extreme-floats-style', get_stylesheet_uri(), array(), _S_VERSION );
	//Enqueue Google Map Js
	wp_enqueue_script('google-map', get_template_directory_uri() . '/js/googlemap.js', 
		array('jquery', 'google-map-api'), _S_VERSION, true);
	wp_enqueue_script('google-map-api', 
		"https://maps.googleapis.com/maps/api/js?key=AIzaSyDf_6yBAZez8S6x04eX_fZY254psuUL_Hw", 
		array(), _S_VERSION, true);

	wp_style_add_data( 'extreme-floats-style', 'rtl', 'replace' );

	wp_enqueue_script( 'extreme-floats-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	wp_enqueue_script( 'gsap-js', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.10.0/gsap.min.js', array(), false, true );
	wp_enqueue_script( 'gsap-js-st', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.10.0/ScrollTrigger.min.js', array(), false, true );
	wp_enqueue_script( 'gsap-js-obs', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.10.0/Observer.min.js', array(), false, true );
    wp_enqueue_script( 'gsap-js-custom', get_stylesheet_directory_uri() . '/js/gsap.js', array(), false, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'extreme_floats_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

// cpt-taxonomy
require get_template_directory() .'/inc/cpt-taxonomy.php';

// Disables WooCommerce Sidebar
function disable_woo_commerce_sidebar() {
	remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10); 
}add_action('init', 'disable_woo_commerce_sidebar');

// Disable Zoom, Slider & Lightbox @ Single Product
function bbloomer_remove_zoom_lightbox_theme_support() { 
    remove_theme_support( 'wc-product-gallery-zoom' );
    remove_theme_support( 'wc-product-gallery-lightbox' );
    remove_theme_support( 'wc-product-gallery-slider' );
}

add_action( 'wp', 'bbloomer_remove_zoom_lightbox_theme_support', 99 );

// Google Map ACF
function my_acf_google_map_api( $api){
	$api['key'] = 'AIzaSyDf_6yBAZez8S6x04eX_fZY254psuUL_Hw';
	return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');

function wporg_add_dashboard_widgets() {
	wp_add_dashboard_widget('new_widget', 'Site Tutorial', 'new_widget_function');
}
add_action( 'wp_dashboard_setup', 'wporg_add_dashboard_widgets' );

function new_widget_function() {
	echo "<p>Site Content Tutorial</p>";
	echo "<iframe width='380' height='280' src='https://www.youtube.com/embed/FGgtKUAcbFI' allowfullscreen></iframe>";
}