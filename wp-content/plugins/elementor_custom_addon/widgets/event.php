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
class Event extends Widget_Base {

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
		return 'event';
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
		return __( 'Event', 'ic-elements' );
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
			'event',
			[
				'label' => __( 'Event', 'ic-elements' ),
			]
        );
        
        $repeater = new Repeater();

		$repeater->add_control(
			'eventtitle', [
				'label' => __( 'Event Title', 'ic-elements' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'locone', [
				'label' => __( 'Location 1', 'ic-elements' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Type your Location', 'ic-elements' ),
			]
        );
        $repeater->add_control(
			'loctwo', [
				'label' => __( 'Location 2', 'ic-elements' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Type your Location', 'ic-elements' ),
			]
		);
        
        $repeater->add_control(
			'eventmonth', [
				'label' => __( 'Event Month', 'ic-elements' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Type Month', 'ic-elements' ),
			]
		);
     
        $repeater->add_control(
			'eventdate', [
				'label' => __( 'Event Date', 'ic-elements' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Type Month', 'ic-elements' ),
			]
        );
        
        $repeater->add_control(
			'image',
			array(
				'label'   => esc_html__( 'Event Image', 'ic-elements' ),
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
			'more_info', 
			[
				'label' => __( 'Event Link', 'ic-elements' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'ic-elements' ),
				'show_external' => true,
				'default' => [
					'url' => '', 
				],
			]
        );
        

        $this->add_control(
			'eventrepetar',
			[
				'label' => __( 'Event', 'ic-elements' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'eventtitle' => __( 'Event Title', 'ic-elements' ),
						'locone' => __( 'Event Location 1', 'ic-elements' ),
						'loctwo' => __( 'Event Location 2', 'ic-elements' ),
						'eventmonth' => __( 'Event Month', 'ic-elements' ),
						'eventdate' => __( 'Event Date', 'ic-elements' ),
						'image' => __( 'Event Image', 'ic-elements' ),
						'more_info' => __( 'Event Button Url', 'ic-elements' ),
						 
                    ],
           
                
					 
				],
				'title_field' => '{{{ eventtitle }}}',
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
        
        $target = $settings['more_info']['is_external'] ? ' target="_blank"' : '';
		$nofollow = $settings['more_info']['nofollow'] ? ' rel="nofollow"' : '';
        ?>
		  
          <div class="events-block-area">
    <div class="container-fluid">
    <?php if ($settings['eventrepetar']):
        echo '<div class="row">';
          
				foreach ($settings['eventrepetar'] as $key => $item):
					echo '<div class="col-lg-6">';
						echo '<div class="events-block-item">';
                            echo '<div class="events-img">';
                            echo '<img src="' . $item['image']['url'] . '" alt="">';
                            echo '<a href="' . $item['more_info']['url'] . '" class="btn-1">More Info</a>';
						echo '</div>';
						echo '<div class="events-block-text media">';
                            echo ' <div class="events-block-date">';
                                echo '<ul>';
                                    echo '<li>' . $item['eventmonth'] . '</li>';
                                    echo '<li>' . $item['eventdate'] . '</li>';
                                echo ' </ul> ';
                            echo '</div>';
						    echo ' <div class="events-block-name">';
                                echo ' <h2>' . $item['eventtitle'] . '</h2>';
                                echo ' <h6><b>' . $item['locone'] . '</b> ' . $item['loctwo'] . '</h6>';
                            echo '</div>';
                            echo '</div>';
						echo ' </div>';
					echo '</div>';
				endforeach; 	
                echo '</div>';
    endif; ?>  
    </div>
</div>


        <?php
		
	}

}