<?php
namespace IC_elements;

/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.2.0
 */
class Plugin {

	/**
	 * Instance
	 *
	 * @since 1.2.0
	 * @access private
	 * @static
	 *
	 * @var Plugin The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 * @return Plugin An instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Include Widgets files
	 *
	 * Load widgets files
	 *
	 * @since 1.2.0
	 * @access private
	 */
	private function include_widgets_files() {
		//require_once( __DIR__ . '/widgets/hello-world.php' );
		//require_once( __DIR__ . '/widgets/inline-editing.php' );

		// All Operational Widges
		require_once( __DIR__ . '/widgets/ic-button.php' );
		require_once( __DIR__ . '/widgets/ic-header.php' );
		require_once( __DIR__ . '/widgets/ic-slider.php' );
		require_once( __DIR__ . '/widgets/ic-product-slider.php' );
		require_once( __DIR__ . '/widgets/ic-blog.php' );
		require_once( __DIR__ . '/widgets/ic-reservation.php' );
		require_once( __DIR__ . '/widgets/ic-product.php' );
		require_once( __DIR__ . '/widgets/ic-menu.php' );
		require_once( __DIR__ . '/widgets/ic-menu-v2.php' );
		require_once( __DIR__ . '/widgets/ic-testimonials.php' );
		require_once( __DIR__ . '/widgets/ic-post-slider.php' );
		require_once( __DIR__ . '/widgets/ic-text-editor.php' );
		require_once( __DIR__ . '/widgets/ic-contact-info.php' );
		require_once( __DIR__ . '/widgets/ic-contact-form.php' );
		require_once( __DIR__ . '/widgets/ic-wellness.php' );
	}

	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function register_widgets() {
		// Its is now safe to include Widgets files
		$this->include_widgets_files();

		// Register Widgets
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Ic_Button() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Ic_Header() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Ic_Slider() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Ic_Product_slider() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Ic_Blog() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Ic_reservation() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Ic_Product() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Ic_Menu() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Ic_Menu_v2() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Ic_Testimonial() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Ic_text_editor() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Ic_post_slider() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Ic_contact_info() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Ic_contact_form() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Ic_Wellness() );
	}

	/**
	 *  Plugin class constructor
	 *
	 * Register plugin action hooks and filters
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function __construct() {

		// Creating a New Category
		add_action( 'elementor/elements/categories_registered', [ $this, 'add_elementor_widget_categories' ] );

		// Register widgets
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );
	}



	/**
	 *  Creating New Elementor Widget Categories
	 *
	 * Register custom elementor categories
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function add_elementor_widget_categories( $elements_manager ) {

		$elements_manager->add_category(
			'ic_elements',
			[
				'title' => __( 'IC Elements', 'plugin-name' ),
				'icon' => 'fa fa-plug',
			]
		);
	
	}
}

// Instantiate Plugin Class
Plugin::instance();