<?php
/**
 * demo functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package demo
 */

if ( ! function_exists( 'demo_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function demo_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on demo, use a find and replace
		 * to change 'demo' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'demo', get_template_directory() . '/languages' );

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
		register_nav_menus( array(
			'topmenu' => esc_html__( 'Top Menu', 'demo' ),
			'footermenu' => esc_html__( 'Footer Menu', 'demo' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'demo_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'demo_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function demo_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'demo_content_width', 640 );
}
add_action( 'after_setup_theme', 'demo_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function demo_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'demo' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'demo' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'demo_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function demo_scripts() {

	wp_enqueue_style( 'main-style', get_stylesheet_uri() );
	wp_enqueue_style( 'carousel', get_template_directory_uri() . '/assets/css/carousel.min.css','1.0', true ); 
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css','1.0', true );
	wp_enqueue_style( 'style', get_template_directory_uri() . '/assets/css/style.css','1.0', true );
 	wp_enqueue_style( 'responsive', get_template_directory_uri() . '/assets/css/responsive.css','1.0', true );
	wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/assets/css/all.min.css','1.0', true ); 

    

	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '20151215', true );
	wp_enqueue_script( 'popper', get_template_directory_uri() . '/assets/js/popper.min.js', array('jquery'), '20151215', true );
	wp_enqueue_script( 'carousel', get_template_directory_uri() . '/assets/js/carousel.min.js', array('jquery'), '20151215', true );
 	wp_enqueue_script( 'counter', get_template_directory_uri() . '/assets/js/counter.js', array('jquery'), '20151215', true );
  	wp_enqueue_script( 'script', get_template_directory_uri() . '/assets/js/script.js', array('jquery'), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'demo_scripts' );



function wpb_user_count() { 
	$usercount = count_users();
	$result = $usercount['total_users']; 
	return $result; 
	} 
	// Creating a shortcode to display user count
	add_shortcode('user_count', 'wpb_user_count');





	
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


function mytheme_customize_register( $wp_customize ) {
	//All our sections, settings, and controls will be added here
  
	$wp_customize->remove_section( 'title_tagline');
	$wp_customize->remove_section( 'colors');
	$wp_customize->remove_section( 'header_image');
	$wp_customize->remove_section( 'background_image');
	$wp_customize->remove_panel( 'nav_menus');
	$wp_customize->remove_section( 'static_front_page');
	$wp_customize->remove_panel( 'widgets');
  
  }
  add_action( 'customize_register', 'mytheme_customize_register',50 );

require_once get_template_directory() . '/inc/theme_customizer.php';
require_once get_template_directory() . '/inc/theme_customizer_data.php';
 