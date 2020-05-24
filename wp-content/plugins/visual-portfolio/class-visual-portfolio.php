<?php
/**
 * Plugin Name:  Visual Portfolio
 * Description:  Portfolio post type with visual editor
 * Version:      1.16.2
 * Author:       nK
 * Author URI:   https://nkdev.info
 * License:      GPLv2 or later
 * License URI:  https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:  visual-portfolio
 *
 * @package visual-portfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Visual Portfolio Class
 */
class Visual_Portfolio {
    /**
     * The single class instance.
     *
     * @var $instance
     */
    private static $instance = null;

    /**
     * Main Instance
     * Ensures only one instance of this class exists in memory at any one time.
     */
    public static function instance() {
        if ( is_null( self::$instance ) ) {
            self::$instance = new self();
            self::$instance->init_options();
            self::$instance->init_hooks();
        }
        return self::$instance;
    }

    /**
     * Path to the plugin directory
     *
     * @var $plugin_path
     */
    public $plugin_path;

    /**
     * URL to the plugin directory
     *
     * @var $plugin_url
     */
    public $plugin_url;

    /**
     * Plugin name
     *
     * @var $plugin_name
     */
    public $plugin_name;

    /**
     * Plugin version
     *
     * @var $plugin_version
     */
    public $plugin_version;

    /**
     * Plugin slug
     *
     * @var $plugin_slug
     */
    public $plugin_slug;

    /**
     * Plugin name sanitized
     *
     * @var $plugin_name_sanitized
     */
    public $plugin_name_sanitized;

    /**
     * Visual_Portfolio constructor.
     */
    public function __construct() {
        /* We do nothing here! */
    }

    /**
     * Init options
     */
    public function init_options() {
        $this->plugin_path = plugin_dir_path( __FILE__ );
        $this->plugin_url  = plugin_dir_url( __FILE__ );

        // load textdomain.
        load_plugin_textdomain( 'visual-portfolio', false, basename( dirname( __FILE__ ) ) . '/languages' );

        // include helper files.
        $this->include_dependencies();

        // register images sizes.
        $this->add_image_sizes();

        // init classes.
        new Visual_Portfolio_Settings();
        new Visual_Portfolio_Rest();
        new Visual_Portfolio_Get();
        new Visual_Portfolio_Shortcode();
        new Visual_Portfolio_Preview();
        new Visual_Portfolio_Admin();
        new Visual_Portfolio_TinyMCE();
        new Visual_Portfolio_VC();
        new Visual_Portfolio_Elementor();
    }

    /**
     * Init hooks
     */
    public function init_hooks() {
        add_action( 'admin_init', array( $this, 'admin_init' ) );
    }

    /**
     * Activation Hook
     */
    public function activation_hook() {
        flush_rewrite_rules();
    }

    /**
     * Deactivation Hook
     */
    public function deactivation_hook() {
        flush_rewrite_rules();
    }

    /**
     * Init variables
     */
    public function admin_init() {
        // get current plugin data.
        $data                        = get_plugin_data( __FILE__ );
        $this->plugin_name           = $data['Name'];
        $this->plugin_version        = $data['Version'];
        $this->plugin_slug           = plugin_basename( __FILE__, '.php' );
        $this->plugin_name_sanitized = basename( __FILE__, '.php' );
    }

    /**
     * Add image sizes.
     */
    public function add_image_sizes() {
        $sm       = Visual_Portfolio_Settings::get_option( 'sm', 'vp_images', false ) ? Visual_Portfolio_Settings::get_option( 'sm', 'vp_images', false ) : 500;
        $md       = Visual_Portfolio_Settings::get_option( 'md', 'vp_images', false ) ? Visual_Portfolio_Settings::get_option( 'md', 'vp_images', false ) : 800;
        $lg       = Visual_Portfolio_Settings::get_option( 'lg', 'vp_images', false ) ? Visual_Portfolio_Settings::get_option( 'lg', 'vp_images', false ) : 1280;
        $xl       = Visual_Portfolio_Settings::get_option( 'xl', 'vp_images', false ) ? Visual_Portfolio_Settings::get_option( 'xl', 'vp_images', false ) : 1920;
        $sm_popup = Visual_Portfolio_Settings::get_option( 'sm_popup', 'vp_images', false ) ? Visual_Portfolio_Settings::get_option( 'sm_popup', 'vp_images', false ) : 500;
        $md_popup = Visual_Portfolio_Settings::get_option( 'md_popup', 'vp_images', false ) ? Visual_Portfolio_Settings::get_option( 'md_popup', 'vp_images', false ) : 800;
        $xl_popup = Visual_Portfolio_Settings::get_option( 'xl_popup', 'vp_images', false ) ? Visual_Portfolio_Settings::get_option( 'xl_popup', 'vp_images', false ) : 1920;

        // custom image sizes.
        add_image_size( 'vp_sm', $sm, $sm );
        add_image_size( 'vp_md', $md, $md );
        add_image_size( 'vp_lg', $lg, $lg );
        add_image_size( 'vp_xl', $xl, $xl );
        add_image_size( 'vp_sm_popup', $sm_popup, $sm_popup );
        add_image_size( 'vp_md_popup', $md_popup, $md_popup );
        add_image_size( 'vp_xl_popup', $xl_popup, $xl_popup );

        add_filter( 'image_size_names_choose', array( $this, 'image_size_names_choose' ) );
    }

    /**
     * Custom image sizes
     *
     * @param array $sizes - registered image sizes.
     *
     * @return array
     */
    public function image_size_names_choose( $sizes ) {
        return array_merge(
            $sizes,
            array(
                'vp_sm' => esc_html__( 'Small (VP)', 'visual-portfolio' ),
                'vp_md' => esc_html__( 'Medium (VP)', 'visual-portfolio' ),
                'vp_lg' => esc_html__( 'Large (VP)', 'visual-portfolio' ),
                'vp_xl' => esc_html__( 'Extra Large (VP)', 'visual-portfolio' ),
            )
        );
    }

    /**
     * Include dependencies
     */
    private function include_dependencies() {
        require_once $this->plugin_path . 'classes/class-assets.php';
        require_once $this->plugin_path . 'classes/class-extend.php';
        require_once $this->plugin_path . 'classes/class-images.php';
        require_once $this->plugin_path . 'classes/class-settings.php';
        require_once $this->plugin_path . 'classes/class-rest.php';
        require_once $this->plugin_path . 'classes/class-get-portfolio.php';
        require_once $this->plugin_path . 'classes/class-shortcode.php';
        require_once $this->plugin_path . 'classes/class-preview.php';
        require_once $this->plugin_path . 'classes/class-admin.php';
        require_once $this->plugin_path . 'classes/class-controls.php';
        require_once $this->plugin_path . 'classes/class-tinymce.php';
        require_once $this->plugin_path . 'classes/class-vc.php';
        require_once $this->plugin_path . 'classes/class-elementor.php';
        require_once $this->plugin_path . 'classes/class-supported-themes.php';
        require_once $this->plugin_path . 'classes/class-migration.php';
    }

    /**
     * Include template
     *
     * @param string $template_name file name.
     * @param array  $args args for template.
     */
    public function include_template( $template_name, $args = array() ) {
        if ( ! empty( $args ) && is_array( $args ) ) {
	        // phpcs:ignore
            extract( $args );
        }

        // template in theme folder.
        $template = locate_template( array( '/visual-portfolio/' . $template_name . '.php' ) );

        // default template.
        if ( ! $template ) {
            $template = $this->plugin_path . 'templates/' . $template_name . '.php';
        }

        // Allow 3rd party plugin filter template file from their plugin.
        $template = apply_filters( 'vpf_include_template', $template, $template_name, $args );

        if ( file_exists( $template ) ) {
            include $template;
        }
    }

    /**
     * Find css template file
     *
     * @param string $template_name file name.
     * @return string
     */
    public function find_template_styles( $template_name ) {
        $template = '';

        if ( file_exists( get_stylesheet_directory() . '/visual-portfolio/' . $template_name . '.css' ) ) {
            // Child Theme (or just theme).
            $template = trailingslashit( get_stylesheet_directory_uri() ) . 'visual-portfolio/' . $template_name . '.css';
        } elseif ( file_exists( get_template_directory() . '/visual-portfolio/' . $template_name . '.css' ) ) {
            // Parent Theme (when parent exists).
            $template = trailingslashit( get_template_directory_uri() ) . 'visual-portfolio/' . $template_name . '.css';
        } elseif ( file_exists( $this->plugin_path . 'templates/' . $template_name . '.css' ) ) {
            // Default file in plugin folder.
            $template = $this->plugin_url . 'templates/' . $template_name . '.css';
        }

        return $template;
    }

    /**
     * Include template style
     *
     * @param string           $handle style handle name.
     * @param string           $template_name file name.
     * @param array            $deps dependencies array.
     * @param string|bool|null $ver version string.
     * @param string           $media media string.
     */
    public function include_template_style( $handle, $template_name, $deps = array(), $ver = false, $media = 'all' ) {
        $template = $this->find_template_styles( $template_name );

        // maybe find minified style.
        if ( ! $template ) {
            $template = $this->find_template_styles( $template_name . '.min' );
        }

        // Allow 3rd party plugin filter template file from their plugin.
        $template = apply_filters( 'vpf_include_template_style', $template, $template_name, $deps, $ver, $media );

        if ( $template ) {
            wp_enqueue_style( $handle, $template, $deps, $ver, $media );
        }
    }

    /**
     * Get oEmbed data
     *
     * @param string $url - url of oembed.
     * @param int    $width - width of oembed.
     * @param int    $height - height of oembed.
     *
     * @return array|bool|false|object
     */
    public function get_oembed_data( $url, $width = null, $height = null ) {
        $cache_name = 'vp_oembed_data_' . $url . ( $width ? $width : '' ) . ( $height ? $height : '' );
        $cached     = get_transient( $cache_name );

        if ( $cached ) {
            return $cached;
        }

        if ( function_exists( '_wp_oembed_get_object' ) ) {
            require_once ABSPATH . WPINC . '/class-oembed.php';
        }

        $args = array();
        if ( $width ) {
            $args['width'] = $width;
        }
        if ( $height ) {
            $args['height'] = $height;
        }

        // If height is not given, but the width is, use 1080p aspect ratio. And vice versa.
        if ( $width && ! $height ) {
            $args['height'] = $width * ( 1080 / 1920 );
        }
        if ( ! $width && $height ) {
            $args['width'] = $height * ( 1920 / 1080 );
        }

        $oembed   = _wp_oembed_get_object();
        $provider = $oembed->get_provider( $url, $args );
        $data     = $oembed->fetch( $provider, $url, $args );

        if ( $data ) {
            $data = (array) $data;
            if ( ! isset( $data['url'] ) ) {
                $data['url'] = $url;
            }
            if ( ! isset( $data['provider'] ) ) {
                $data['provider'] = $provider;
            }

            // Convert url to hostname, eg: "youtube" instead of "https://youtube.com/".
            $data['provider-name'] = pathinfo( str_replace( array( 'www.' ), '', parse_url( $url, PHP_URL_HOST ) ), PATHINFO_FILENAME );

            // save cache.
            set_transient( $cache_name, $data, DAY_IN_SECONDS );

            return $data;
        }

        return false;
    }
}

/**
 * Function works with the Visual_Portfolio class instance
 *
 * @return object Visual_Portfolio
 */
function visual_portfolio() {
    return Visual_Portfolio::instance();
}
add_action( 'plugins_loaded', 'visual_portfolio' );

register_deactivation_hook( __FILE__, array( visual_portfolio(), 'activation_hook' ) );
register_activation_hook( __FILE__, array( visual_portfolio(), 'deactivation_hook' ) );
