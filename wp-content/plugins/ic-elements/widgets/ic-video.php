<?php
namespace IC_elements\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class Ic_Video extends Widget_Base {

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
		return 'ic-video-widget';
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
		return __( 'IC Video', 'ic-elements' );
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
		return 'fas fa-video';
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
		return [ 'ic_elements' ];
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
			'section_content',
			[
				'label' => __( 'Content', 'ic-elements' ),
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'ic-elements' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Coriandre,', 'ic-elements' ),
			]
		);

		$this->add_control(
			'subtitle',
			[
				'label' => __( 'Sub Title', 'ic-elements' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'New Indian restaurant "fusion" nestled in the 14th arrondissement', 'ic-elements' ),
			]
		);

		$this->add_control(
			'v_link',
			[
				'label' => __( 'Video Link', 'ic-elements' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '#', 'ic-elements' ),
			]
		);

		$this->add_control(
			'icon',
			array(
				'label' => __( 'Play Icon', 'ic-elements' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fa fa-play',
					'library' => 'regular',
				]
			)
		);

		$this->add_control(
			'play_text',
			[
				'label' => __( 'Play Text', 'ic-elements' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Play Video', 'ic-elements' ),
			]
		);

		$this->end_controls_section();

		// STYLE SECTION - TITLE
		$this->start_controls_section(
			'section_title_style',
			[
				'label' => __( 'Title', 'ic-elements' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Text Color', 'ic-elements' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ic-how-works-video h6' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .ic-how-works-video h6',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1
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

		$youtube_link = $settings['v_link'];
		$youtube_url = str_replace("watch?v=","embed/",$youtube_link);

		echo '<div class="ic-video">';
            echo '<div class="ic-video-inner">';

            	if ($settings['title']) 
            	echo '<h1>'. $settings['title'] .'</h1>';

            	if ($settings['subtitle']) 
            	echo '<h4>'. $settings['subtitle'] .'</h4>';

            
                echo '<a class="ic-video-main" data-rel="lightcase:myCollection" href="'. $youtube_url .'">';

            		echo '<div class="ic-video-icon">';
						 \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] );
					echo '</div>';
	                echo '<span class="ic-video-play-text">'. $settings['play_text'] .'</span>';

                echo '</a>';
            	
            echo '</div> ';
	    echo '</div>';
	    

	}

}