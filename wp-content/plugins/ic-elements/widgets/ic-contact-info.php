<?php
namespace IC_elements\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
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
class Ic_contact_info extends Widget_Base {

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
		return 'ic-contact-info';
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
		return __( 'IC Contact Info', 'ic-elements' );
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
		return 'fas fa-address-book';
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
			'head_title',
			[
				'label' => __( 'Title', 'ic-elements' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Location & Hours', 'ic-elements' ),
			]
		);
		
		$repeater = new Repeater();

		$repeater->add_control(
			'title',
			[
				'label' => __( 'Title', 'ic-elements' ),
				'type' => Controls_Manager::TEXT,
			]
		);
		$repeater->add_control(
			'description', [
				'label' => __( 'Description', 'ic-elements' ),
				'type' => Controls_Manager::WYSIWYG,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => __( 'Type description here', 'ic-elements' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'contact_infos',
			[
				'label' => __( 'Contact Infos', 'ic-elements' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'title' => __( 'Address', 'ic-elements' ),
						'description' => __( '104, rue de l\'Ouest, 75014', 'ic-elements' ),
					],
					[
						'title' => __( 'Hours', 'ic-elements' ),
						'description' => __( 'Mardi–Samedi: 12h-15h/19h-23hDimanche: 10h-15h (brunch)/19h-23h', 'ic-elements' ),
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);


		$this->end_controls_section();

		// STYLE SECTION - TITLE
		$this->start_controls_section(
			'sim_title_style',
			[
				'label' => __( 'Title', 'ic-elements' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'sim_title_color',
			[
				'label' => __( 'Text Color', 'ic-elements' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ic-contact-header h2' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'sim_title_typography',
				'selector' => '{{WRAPPER}} .ic-contact-header h2',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1
			]
		);

		
		$this->end_controls_section();

		// STYLE SECTION - DESCRIPTION
		$this->start_controls_section(
			'items_style',
			[
				'label' 		=> __( 'Items', 'ic-elements' ),
				'tab' 			=> Controls_Manager::TAB_STYLE
			]
		);
		$this->add_control(
			'item_title_color',
			[
				'label' => __( 'Title Color', 'ic-elements' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ic-cont-item h4' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => __( 'Title Typography', 'ic-elements' ),
				'name' => 'item_title_typography',
				'selector' => '{{WRAPPER}} .ic-cont-item h4',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1
			]
		);
		$this->add_control(
			'item_description_color',
			[
				'label' => __( 'Description Color', 'ic-elements' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ic-cont-item p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => __( 'Description Typography', 'ic-elements' ),
				'name' => 'item_description_typography',
				'selector' => '{{WRAPPER}} .ic-cont-item p',
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

		if ( $settings['contact_infos'] ) :

		echo '<div class="ic-contact">';
            echo '<div class="ic-contact-header">';
                echo '<h2>'. $settings['head_title']. '</h2>';
            echo '</div>';
            echo '<div class="ic-cont-items">';
            	foreach (  $settings['contact_infos'] as $key=>$item ) : 
            	echo '<div class="ic-cont-item">';
	                echo '<h4>'. $item['title'] . '</h4>';
	                echo '<div class="ic-cont-address">';
	                    echo $item['description'];
	                echo '</div>';
	            echo '</div>';
            	endforeach;
            echo '</div>';
	    echo '</div>';
		endif;
	}

	
}