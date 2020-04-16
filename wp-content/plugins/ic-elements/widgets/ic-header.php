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
class Ic_Header extends Widget_Base {

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
		return 'ic-header-widget';
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
		return __( 'IC Header', 'ic-elements' );
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
		return 'fas fa-heading';
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
			'short_title',
			[
				'label' => __( 'Short Title', 'ic-elements' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'Section Short Title', 'ic-elements' ),
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'ic-elements' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'Section Title', 'ic-elements' ),
			]
		);

		$this->add_control(
			'desc',
			[
				'label' => __( 'Description', 'ic-elements' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, se  eiusmod tempor incididunt dolore magna aliqua. Quis ipsum suspendisse ultrices gravida commodo viverra maecenas ', 'ic-elements' ),
			]
		);

		$this->add_control(
			'text_align',
			[
				'label' => __( 'Alignment', 'ic-elements' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'ic-elements' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'ic-elements' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'ic-elements' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
				'default' => 'center',
				'toggle' => true,
			]
		);

		$this->add_responsive_control(
			'width',
			[
				'label' => __( 'Width', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => [
					'size' => 65,
					'unit' => '%',
				],
				'tablet_default' => [
					'size' => 100,
					'unit' => '%',
				],
				'mobile_default' => [
					'size' => 100,
					'unit' => '%',
				],
				'selectors' => [
					'{{WRAPPER}} .ic-section-header' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'position',
			[
				'label' => __( 'Position', 'ic-elements' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'ic-center',
				'options' => [
					'ic-left'  => __( 'Left', 'ic-elements' ),
					'ic-right' => __( 'Right', 'ic-elements' ),
					'ic-center' => __( 'Center', 'ic-elements' ),
				],
			]
		);

		$this->end_controls_section();

		// STYLE SECTION - TITLE
		$this->start_controls_section(
			'short_title_style',
			[
				'label' => __( 'Short Title', 'ic-elements' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'short_title_transform',
			[
				'label' => __( 'Text Style', 'ic-elements' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'lowercase',
				'options' => [
					'lowercase'  => __( 'Lowercase', 'ic-elements' ),
					'uppercase' => __( 'Uppercase', 'ic-elements' ),
					'capitalize' => __( 'Capitalize', 'ic-elements' ),
				],
				'selectors' => [
					'{{WRAPPER}} h4' => 'text-transform: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'short_title_color',
			[
				'label' => __( 'Text Color', 'ic-elements' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} h4' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'short_title_typography',
				'selector' => '{{WRAPPER}} h4',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1
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
			'title_transform',
			[
				'label' => __( 'Text Style', 'ic-elements' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'capitalize',
				'options' => [
					'lowercase'  => __( 'Lowercase', 'ic-elements' ),
					'uppercase' => __( 'Uppercase', 'ic-elements' ),
					'capitalize' => __( 'Capitalize', 'ic-elements' ),
				],
				'selectors' => [
					'{{WRAPPER}} h2' => 'text-transform: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Text Color', 'ic-elements' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} h2' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} h2',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1
			]
		);
		
		$this->end_controls_section();

		// STYLE SECTION - TITLE
		$this->start_controls_section(
			'section_desc_style',
			[
				'label' => __( 'Description', 'ic-elements' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'desc_color',
			[
				'label' => __( 'Text Color', 'ic-elements' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'desc_typography',
				'selector' => '{{WRAPPER}} p',
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
		
		//<!-- ===== banner Part HTML Start ===== -->
		echo '<div class="ic-section-header '. $settings['position'] .'">';

				echo ($settings['short_title']) ? '<h4>'. $settings['short_title']. '</h4>' : '';
				
				echo ($settings['title']) ? '<h2>'. $settings['title'] .'</h2>' : '';
				
				echo ($settings['desc']) ? '<p>'. $settings['desc'] .'</p>' : '';
				
        echo '</div>';
		//<!-- ===== banner Part HTML End ===== -->
	}


}