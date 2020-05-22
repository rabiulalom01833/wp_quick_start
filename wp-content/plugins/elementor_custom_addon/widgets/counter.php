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
class Counter extends Widget_Base {

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
		return 'counter';
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
		return __( 'Counter', 'ic-elements' );
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
			'simple_sales_title',
			[
				'label' => __( 'Simple Sales Title', 'ic-elements' ),
			]
        );
        
         
        $repeater = new Repeater();

         
		$repeater->add_control(
			'countername', [
				'label' => __( 'Counter Title', 'ic-elements' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'counternumber', [
				'label' => __( 'Counter Number', 'ic-elements' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Type Counter Title', 'ic-elements' ),
			]
		);
	
        $repeater->add_control(
			'counter_icon',
			[
				'label' => __( 'Social Icon', 'text-domain' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'solid',
				],
				 
			]
        );
      
        
        
        $this->add_control(
			'counternamerepater',
			[
				'label' => __( 'Event', 'ic-elements' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'countername' => __( 'Event Title', 'ic-elements' ),
						'counternumber' => __( 'Event Location 1', 'ic-elements' ),
						'counter_icon' => __( 'Event Location 2', 'ic-elements' ),
					 
                    ],
           
                
					 
				],
				'title_field' => '{{{ countername }}}',
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
		 
          
        

        <div class="stats-area"> 
            <div class="container"> 
             <?php if ($settings['counternamerepater']):
                echo '<div class="row">';
                    foreach ($settings['counternamerepater'] as $key => $item):
                    echo '<div class="col-lg-3 col-6">';
                        echo '<div class="stats-item">';
                        \Elementor\Icons_Manager::render_icon ( $item['counter_icon'], [ 'aria-hidden' => 'true' ] );
                            echo '<h2 class="counter">' . $item['countername'] . '</h2>';
                            echo '<p>' . $item['counternumber'] . '</p>';
                        echo '</div>';
                    echo '</div> ';
                    endforeach; 
                echo '</div>';
                 endif; ?>  
         </div> 
        </div> 

        <?php
		
	}

}