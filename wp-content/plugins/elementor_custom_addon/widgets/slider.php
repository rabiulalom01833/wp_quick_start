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
class Full_Slider extends Widget_Base {

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
		return 'Full-Slider';
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
		return __( 'Full Slider', 'ic-elements' );
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
			'Full_Sliders',
			[
                'label' => __( 'Full Slider', 'ic-elements' ),
                'label_block' => true,
			]
		);


        $repeater = new Repeater();

       	$repeater->add_control(
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

        $repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
				'exclude' => [],
				'include' => [],
				'default' => 'full',
			]
        );
        
        $repeater->add_control(
			'title', [
				'label' => __( 'Title', 'ic-elements' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'subtitle', [
				'label' => __( 'Sub Title', 'ic-elements' ),
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => __( 'Type your Sub Title here', 'ic-elements' ),
			]
		);
        
		$this->add_control(
			'slider_repeat',
			[
				'label' => __( 'Slider', 'ic-elements' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'image' => __( 'Slider Image', 'ic-elements' ),
						'title' => __( 'Add Slider', 'ic-elements' ),
						'subtitle' => __( 'Slider Sub Title', 'ic-elements' ),
					],
					 
				],
				'title_field' => '{{{ title }}}',
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

      <?php if ( $settings['slider_repeat'] ) :  
		 echo '<div id="main_slider" class="owl-carousel owl-theme full-slides-shortcode">';
            foreach (  $settings['slider_repeat'] as $key=>$item ) : 
                echo '<div class="item item-img-1" style="background:url();"';

                    echo '<div class="slider_table">';
                        echo ' <div class="slider_table_Cell lefts">';
                            echo ' <div class="container">';
                                echo '<div class="row">';
                                    echo ' <div class="col-xl-12 col-lg-12 col-md-12 col-12">  ';
                                        echo ' <h2>'. $item['title'] . '</h2>';
                                        echo ' <p>'. $item['subtitle'] . '</p>';
                                        echo ' <a href="https://www.akij.net/our-companies/"><button class="btn-read">Our Companies</button></a>';
                                        echo ' </div>';
                                    echo ' </div>';
                                echo '  </div>';
                            echo '</div>';
                        echo '</div>';
                    echo ' </div>';
            endforeach;
                echo '</div>';	 
         endif; ?>

        <?php
		
	}

}