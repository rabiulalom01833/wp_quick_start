<?php
/*
Plugin Name: Custom Addon

*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


// Defines
define( 'Stock_ACC_URL', WP_PLUGIN_URL . '/' . plugin_basename( dirname( __FILE__ ) ) . '/' );
define( 'Stock_ACC_PATH', plugin_dir_path( __FILE__ ) );

add_action('init','full_slide');

function full_slide(){
	register_post_type('full_slide',array(
		'labels'=> array(
			'name'=> __('Full Slider'),
			'singular_name'=> __('Add Feature Box')
		),
		'supports'=> array('title','thumbnail','editor'),
		'public'=> true,
		'show_uri'=> true,
	));
	
}

add_action('init','carousel_testimonail');

function carousel_testimonail(){
	register_post_type('clienttestimonailwp',array(
		'labels'=> array(
			'name'=> __('Testimonial'),
			'singular_name'=> __('Add Testimonial')
		),
		'supports'=> array('title','editor','thumbnail'),
		'public'=> true,
		'show_uri'=> true,
	));
	
}

// Print shortcode in widgets
add_filter('widget_text','do_shortcode');


// Loading Visual Composer blocks addons
require_once( Stock_ACC_PATH . 'vc-addons/vc-blocks-load.php' );

// Theme shortcodes
require_once( Stock_ACC_PATH . 'theme-shortcodes/theme-shortcode.php' );
require_once( Stock_ACC_PATH . 'theme-shortcodes/section-title.php' ); 
require_once( Stock_ACC_PATH . 'theme-shortcodes/carousel.php' ); 
require_once( Stock_ACC_PATH . 'theme-shortcodes/full-slides-shortcode.php' ); 
require_once( Stock_ACC_PATH . 'theme-shortcodes/service-wp.php' ); 
 
 


// Shortcodes depended on Visual Composer
include_once(ABSPATH .'wp-admin/includes/plugin.php');
if(is_plugin_active('js_composer/js_composer.php')){
	 require_once( Stock_ACC_PATH . 'theme-shortcodes/theme-shortcode.php' );
}

// Register stock toolkit files
function Stock_toolkit_files(){

     
}
add_action('wp_enqueue_scripts', 'Stock_toolkit_files');