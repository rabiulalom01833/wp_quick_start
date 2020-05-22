<?php

namespace Elementor_Custom_Addon\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class Page_Banner extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.1.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'Page-Banner';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.1.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Page Banner', 'ic-elements' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.1.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'far fa-address-card';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.1.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'Elementor_Custom_Addon' ];
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.1.0
	 *
	 * @access protected
	 */
   
        protected function _register_controls() {
 
            $this->start_controls_section(
                'Page_Banner_here',
                [
                    'label' => __( 'Page Banner', 'ic-elements' ),
                ]
            );
            $this->add_control(
                'pagetitle', [
                    'label' => __( 'Title', 'ic-elements' ),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => true,
                ]
            );
            
            $this->add_control(
                'image',
                array(
                    'label'   => esc_html__( 'Image', 'ic-elements' ),
                    'type'    => Controls_Manager::MEDIA,
                    'default' => array(
                        'url' => Utils::get_placeholder_image_src(),
                    ),
                    'dynamic' => array( 'active' => true ),
                )
            );
    
            $this->add_group_control(
                Group_Control_Image_Size::get_type(),
                [
                    'name' => 'thumbnail', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                    'exclude' => [],
                    'include' => [],
                    'default' => 'full',
                ]
            );
            
          
    
            $this->end_controls_section();
             
        }
    
        /**
         * Render the widget output on the frontend.
         *
         * Written in PHP and used to generate the final HTML.
         *
         * @since 1.1.0
         *
         * @access protected
         */
        protected function render() {
            $settings = $this->get_settings_for_display(); 
            
     
            ?>
             
               
            <!-- echo '<div class="business-hero" style="background:url('.$settings['image']['url'].');background-repeat:no-repeat;">';  
                echo '<div class="container">';
                    echo '<div class="row">';
                        echo '<div class="col-lg-12">';
                            echo '<div class="business-title">';
                                echo '<h1>'.$settings['page_title'].'</h1>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';  -->
    
          <div class="business-hero" style="background:url(<?php echo $settings['image']['url']; ?>);background-repeat:no-repeat;">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="business-title">
                                <h1><?php echo $settings['pagetitle']; ?></h1>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            <?php
            
        }
    
    }