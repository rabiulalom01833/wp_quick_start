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
class Contact_Us extends Widget_Base {

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
		return 'Contact-Us';
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
		return __( 'Contact Us', 'ic-elements' );
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
                'mobileno', [
                    'label' => __( 'Mobile No', 'ic-elements' ),
                    'type' => Controls_Manager::TEXT,
                    'show_external' => true,
                    'placeholder' => __( 'Type your Location', 'ic-elements' ),
                ]
            );

            $this->add_control(
                'display', [
                    'label' => __( 'Display None', 'ic-elements' ),
                    'type' => Controls_Manager::TEXT,
                    'show_external' => true,
                    'placeholder' => __( 'Type your display', 'ic-elements' ),
                ]
            );
    
            $repeater = new Repeater();

            $repeater->add_control(
                'address_location', [
                    'label' => __( 'Address Location', 'ic-elements' ),
                    'type' => Controls_Manager::TEXT,
                    'show_external' => true,
                    'placeholder' => __( 'Type your Location', 'ic-elements' ),
                ]
            );

            $repeater->add_control(
                'address_mail', [
                    'label' => __( 'Email No', 'ic-elements' ),
                    'type' => Controls_Manager::TEXT,
                    'show_external' => true,
                    'placeholder' => __( 'Type your Email', 'ic-elements' ),
                ]
            );
            
             
    
            $this->add_control(
                'addressrepeater',
                [
                    'label' => __( 'Event', 'ic-elements' ),
                    'type' => Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),
                    'default' => [
                        [
                            'address_location' => __( 'Event Title', 'ic-elements' ),
                            'address_mail' => __( 'Event Location 1', 'ic-elements' ), 
                        ],
               
                    
                         
                    ],
                    'title_field' => '{{{ address_location }}}',
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
             
            
             <div class="contact-dettles"> 
                 <?php if ($settings['addressrepeater']):
                        foreach ($settings['addressrepeater'] as $key => $item):
                        echo '<div class="contact-item">';
                            echo '<h6>'.$item['address_location'].'</h6>';
                            echo '<p>'.$item['address_mail'] .'</p>';
                        echo '</div>';
                        endforeach; 
                 endif; ?>  
                <a href="#" class="btn-3" style="display:<?php echo $settings['display']; ?>"><?php echo $settings['mobileno']; ?></a>  
            </div>
            
            <?php


        }
    
    }