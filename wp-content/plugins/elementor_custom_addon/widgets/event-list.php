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
class Event_List extends Widget_Base {

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
		return 'Event List';
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
		return __( 'Event Details', 'ic-elements' );
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
			'eventdetails',
			[
				'label' => __( 'Event Details', 'ic-elements' ),
			]
        );
        
     
		$this->add_control(
			'eventtitle', [
				'label' => __( 'Event Title', 'ic-elements' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);
		$this->add_control(
			'locone', [
				'label' => __( 'Location 1', 'ic-elements' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Type your Location', 'ic-elements' ),
			]
        );
        $this->add_control(
			'loctwo', [
				'label' => __( 'Location 2', 'ic-elements' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Type your Location', 'ic-elements' ),
			]
		);
        
        $this->add_control(
			'eventmonth', [
				'label' => __( 'Event Month', 'ic-elements' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Type Month', 'ic-elements' ),
			]
		);
     
        $this->add_control(
			'eventdate', [
				'label' => __( 'Event Date', 'ic-elements' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Type Date', 'ic-elements' ),
			]
        );
        
        
        $this->add_control(
			'eventdetail', [
				'label' => __( 'Event Details', 'ic-elements' ),
				'type' => Controls_Manager::TEXTAREA,
                'placeholder' => __( 'Type Details', 'ic-elements' ),
 			]
        );

        $this->add_control(
			'eventbookingnumber', [
				'label' => __( 'Event Booking Number', 'ic-elements' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Type Shedule', 'ic-elements' ),
			]
        );

      

        $repeater = new Repeater();

		$repeater->add_control(
			'sheduledays', [
				'label' => __( 'Shedule Days', 'ic-elements' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);
     
        $repeater->add_control(
			'sheduledate', [
				'label' => __( 'Shedule Date', 'ic-elements' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
			]
        );
        
        $repeater->add_control(
			'sheduledatehour', [
				'label' => __( 'Shedule Hour', 'ic-elements' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

        $this->add_control(
			'eventshedulerepeat',
			[
				'label' => __( 'Event Shedule', 'ic-elements' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'eventshedule' => __( 'Event Title', 'ic-elements' ), 
                    ],
           
                
					 
				],
				'title_field' => '{{{ eventshedule }}}',
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
		 
         <div class="single-event-date-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-9 col-md-9">
                    <div class="events-block-text media">
                        <div class="events-block-date">
                            <ul>
                                <li><?php echo $settings['eventmonth']; ?></li>
                                <li><?php echo $settings['eventdate']; ?></li> 
                            </ul> 
                        </div>
                        <div class="events-block-name">
                            <h2><?php echo $settings['eventtitle']; ?></h2>
                            <h6><b><?php echo $settings['locone']; ?></b><?php echo $settings['loctwo']; ?></h6> 
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="single-map">
                        <a href="#" class="btn-3">view in maps </a>
                    </div>
                </div> 
            </div> 
            <div class="row">
                <div class="col-lg-12">
                    <div class="single-event-time-content ">
                        <div class="single-event-time">
                            <i class="far fa-clock"></i>
                            <?php if ($settings['eventshedulerepeat']):

                            echo '<ul>';
                            foreach ($settings['eventshedulerepeat'] as $key => $item):
                                echo '<li>' . $item['sheduledays'] . '</li>';
                                echo '<li>' . $item['sheduledate'] . '</li>';
                                echo '<li>' . $item['sheduledatehour'] . '</li>';
                            endforeach; 	
                            echo '</ul> ';
                            
                            endif; ?> 
                            <a href="#" class="btn-3">ADD TO CALENDAR</a>
                        </div>
                        <div class="single-event-time-text">
                            <p><?php echo $settings['eventdetail']; ?></p>
                            <a href="#" class="btn-3"><?php echo $settings['eventbookingnumber']; ?></a>  
                            <h6>share with friends</h6>  
                            <ul>
                                <li><a href="#"><i class="fa fa-link"></i></a></li>
                                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fab fa-facebook-messenger"></i></a></li>
                                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-envelope"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    <?php
		
	}

}