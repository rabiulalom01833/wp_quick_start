<?php
/**
 * Supported themes.
 *
 * @package visual-portfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class Visual_Portfolio_Supported_Themes
 */
class Visual_Portfolio_Supported_Themes {
    /**
     * Visual_Portfolio_Supported_Themes constructor.
     */
    public function __construct() {
        add_action( 'wp_enqueue_scripts', array( $this, 'wp_enqueue_scripts' ) );
    }

    /**
     * Get Theme Compatibility Style
     */
    public function get_theme_compatibility_style() {
        $result = false;

        switch ( get_template() ) {
            case 'twentytwenty':
                $result = array(
                    'name' => 'vpf-twentytwenty',
                    'url'  => visual_portfolio()->plugin_url . 'assets/css/theme-twentytwenty.min.css',
                );
                break;
            case 'twentynineteen':
                $result = array(
                    'name' => 'vpf-twentynineteen',
                    'url'  => visual_portfolio()->plugin_url . 'assets/css/theme-twentynineteen.min.css',
                );
                break;
            case 'twentysixteen':
                $result = array(
                    'name' => 'vpf-twentysixteen',
                    'url'  => visual_portfolio()->plugin_url . 'assets/css/theme-twentysixteen.min.css',
                );
                break;
            case 'twentyseventeen':
                $result = array(
                    'name' => 'vpf-twentyseventeen',
                    'url'  => visual_portfolio()->plugin_url . 'assets/css/theme-twentyseventeen.min.css',
                );
                break;
        }

        return $result;
    }

    /**
     * Enqueue styles
     */
    public function wp_enqueue_scripts() {
        $theme_compat = $this->get_theme_compatibility_style();
        if ( $theme_compat ) {
            wp_enqueue_style( $theme_compat['name'], $theme_compat['url'], array(), '1.16.2' );
        }
    }
}

new Visual_Portfolio_Supported_Themes();
