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
class client_testimonial extends Widget_Base {

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
		return 'client testimonial';
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
		return __( 'client testimonial', 'ic-elements' );
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
                'client_testimonial',
                [
                    'label' => __( 'client testimonial', 'ic-elements' ),
                ]
            );
            
            $this->add_control(
                'client_title', [
                    'label' => __( 'Section Title', 'ic-elements' ),
                    'type' => Controls_Manager::TEXT,
                    'show_external' => true,
                    'placeholder' => __( 'Type your Title', 'ic-elements' ),
                ]
            );

         
    
            $repeater = new Repeater();

            $repeater->add_control(
                'client_review', [
                    'label' => __( 'Client Review', 'ic-elements' ),
                    'type' => Controls_Manager::TEXTAREA,
                    'show_external' => true,
                    'placeholder' => __( 'Type your Review', 'ic-elements' ),
                ]
            );

              
            
            $repeater->add_control(
                'client_name', [
                    'label' => __( 'Client Name', 'ic-elements' ),
                    'type' => Controls_Manager::TEXT,
                    'show_external' => true,
                    'placeholder' => __( 'Type your Name', 'ic-elements' ),
                ]
            );


            $repeater->add_control(
                'client_position', [
                    'label' => __( 'Client Position', 'ic-elements' ),
                    'type' => Controls_Manager::TEXT,
                    'show_external' => true,
                    'placeholder' => __( 'Type your Position', 'ic-elements' ),
                ]
            );

    
            $this->add_control(
                'clientrepeat',
                [
                    'label' => __( 'Client Tesimonial', 'ic-elements' ),
                    'type' => Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),
                    'default' => [
                        [
                            'client_review' => __( 'client review', 'ic-elements' ),
                            'client_name' => __( 'client Name', 'ic-elements' ), 
                            'client_position' => __( 'client Position', 'ic-elements' ), 
                        ],
               
                    
                         
                    ],
                    'title_field' => '{{{ client_review }}}',
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
             


            <div class="client-testimonials-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="client-testimonial-title">
                        <h5><?php echo $settings['client_title']; ?></h5>
                    </div>
                </div>
                <div class="col-lg-12">
                    <?php if ($settings['clientrepeat']):
                     echo '<div class="clients-testimonials-slider owl-carousel owl-theme">';
                       
                        foreach ($settings['clientrepeat'] as $key => $item):
                            echo '<div class="client-testimonial-item">';
                            echo '<p class="client-text">'.$item['client_review'].'</p>';
                                 echo '<div class="client-name">';
                                            echo '~ '.$item['client_name'].'
                                          <span>'.$item['client_position']. '</span>';
                                 echo '</div>';
                            echo '</div>';
                        endforeach; 
                       
                        echo ' </div>';
                     endif; ?>  
                </div>
            </div>
        </div>
    </div>

            <?php


        }
    
    }