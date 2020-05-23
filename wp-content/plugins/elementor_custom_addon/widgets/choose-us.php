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
class Choose_Us extends Widget_Base {

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
		return 'Choose Us';
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
		return __( 'Choose Us', 'ic-elements' );
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
                'Choose_Us',
                [
                    'label' => __( 'Page Banner', 'ic-elements' ),
                ]
            );
            
            $this->add_control(
                'section_title', [
                    'label' => __( 'Section Title', 'ic-elements' ),
                    'type' => Controls_Manager::TEXT,
                    'show_external' => true,
                    'placeholder' => __( 'Type your Title', 'ic-elements' ),
                ]
            );

         
    
            $repeater = new Repeater();

            $repeater->add_control(
                'section_number', [
                    'label' => __( 'Number No', 'ic-elements' ),
                    'type' => Controls_Manager::TEXT,
                    'show_external' => true,
                    'placeholder' => __( 'Type your Number', 'ic-elements' ),
                ]
            );

            $repeater->add_control(
                'section_details', [
                    'label' => __( 'Email Details', 'ic-elements' ),
                    'type' => Controls_Manager::TEXTAREA,
                    'show_external' => true,
                    'placeholder' => __( 'Type your Email', 'ic-elements' ),
                ]
            );
            
             
    
            $this->add_control(
                'chooserepeater',
                [
                    'label' => __( 'Event', 'ic-elements' ),
                    'type' => Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),
                    'default' => [
                        [
                            'section_number' => __( 'Section Number', 'ic-elements' ),
                            'section_details' => __( 'Section Details', 'ic-elements' ), 
                        ],
               
                    
                         
                    ],
                    'title_field' => '{{{ section_number }}}',
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
             
             

            <div class="reasons-brands-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="reasons-brands-title">
                                <h5><?php echo $settings['section_title']; ?></h5>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="reasons-brands-content">
                            <?php if ($settings['chooserepeater']):
                                foreach ($settings['chooserepeater'] as $key => $item):
                                    echo '<div class="reasons-brands-item">';
                                        echo '<div class="reasons-brands-number">'.$item['section_number'].'</div>';
                                        echo '<div class="reasons-brands-text"> '.$item['section_details'].'</div> ';
                                    echo '</div>';
                                endforeach; 
                            endif; ?>  
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <?php


        }
    
    }