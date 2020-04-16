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
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class Ic_Testimonial extends Widget_Base {

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
		return 'ic-testimonial';
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
		return __( 'Testimonial', 'ic-elements' );
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
		return 'fa fa-quote-right';
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

		$repeater = new Repeater();

		$repeater->add_control(
			'icon',
			array(
				'label' => __( 'Icons', 'ic-elements' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fa fa-quote-right',
					'library' => 'regular',
				]
			)
		);
		$repeater->add_control(
			'image',
			array(
				'label'   => esc_html__( 'Image', 'ic-elements' ),
				'type'    => Controls_Manager::MEDIA,
				'dynamic' => array( 'active' => true ),
			)
		);
		$repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail', 
				'exclude' => [],
				'include' => [],
				'default' => 'ic-testimonial',
			]
		);
		$repeater->add_control(
			'description', [
				'label' => __( 'Description', 'ic-elements' ),
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => __( 'Type your description here', 'ic-elements' ),
			]
		);
		$repeater->add_control(
			'name', [
				'label' => __( 'Name', 'ic-elements' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'designation', [
				'label' => __( 'Designation', 'ic-elements' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);
		$this->add_control(
			'testimonial_lists',
			[
				'label' => __( 'Testimonials', 'ic-elements' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'description' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, se eiusmod tempor incididunt labore ettinum dolore magna aliqua. Quis ipsum suspendisse ultrices gravida.', 'ic-elements' ),
						'name' => __( 'Danielle Romero', 'ic-elements' ),
						'designation' => __( 'Yogi', 'ic-elements' ),
					],
					[
						'description' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, se eiusmod tempor incididunt labore ettinum dolore magna aliqua. Quis ipsum suspendisse ultrices gravida.', 'ic-elements' ),
						'name' => __( 'Danielle Romero', 'ic-elements' ),
						'designation' => __( 'Yogi', 'ic-elements' ),
					],
					[
						'description' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, se eiusmod tempor incididunt labore ettinum dolore magna aliqua. Quis ipsum suspendisse ultrices gravida.', 'ic-elements' ),
						'name' => __( 'Danielle Romero', 'ic-elements' ),
						'designation' => __( 'Yogi', 'ic-elements' ),
					],
				],
				'title_field' => '{{{ name }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'slider_settings',
			[
				'label' => __( 'Slider Settings', 'ic-elements' ),
			]
		);

		$this->add_control(
			'slider_autoplay',
			array(
				'label'        => esc_html__( 'Use autoplay?', 'ic-elements' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'ic-elements' ),
				'label_off'    => esc_html__( 'No', 'ic-elements' ),
				'return_value' => 'true',
				'default'      => 'true',
			)
		);

		$this->add_control(
			'slider_autoplay_delay',
			array(
				'label'   => esc_html__( 'Autoplay delay(ms)', 'ic-elements' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 3000,
				'min'     => 1000,
				'max'     => 10000,
				'step'    => 100,
				'condition' => array(
					'slider_autoplay' => 'true',
				),
			)
		);

		$this->add_control(
			'pause_on_hover',
			array(
				'label'        => esc_html__( 'Pause On Hover', 'ic-elements' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'ic-elements' ),
				'label_off'    => esc_html__( 'No', 'ic-elements' ),
				'return_value' => 'true',
				'default'      => 'true',
			)
		);

		$this->add_control(
			'slide_duration',
			array(
				'label'   => esc_html__( 'Slide Duration(ms)', 'ic-elements' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 1000,
				'min'     => 100,
				'max'     => 8000,
				'step'    => 100,
			)
		);

		$this->end_controls_section();

		// STYLE SECTION - TITLE
		$this->start_controls_section(
			'section_icon_style',
			[
				'label' => __( 'Icon', 'ic-elements' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'icon-color',
			[
				'label' => __( 'Color', 'ic-elements' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ic-testimonial-icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .ic-testimonial-icon svg .st0' => 'fill: {{VALUE}};'
				],
			]
		);

		$this->add_control(
			'width',
			[
				'label' => __( 'Width', 'ic-elements' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 250,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 150,
				],
				'selectors' => [
					'{{WRAPPER}} .ic-testimonial-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .ic-testimonial-icon svg' => 'width: {{SIZE}}{{UNIT}}; height:{{SIZE}}{{UNIT}};'
				],
			]
		);
		
		$this->end_controls_section();

		// STYLE SECTION - TITLE
		$this->start_controls_section(
			'section_title_style',
			[
				'label' => __( 'Title', 'ic-elements' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Text Color', 'ic-elements' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ic-testimonial-name a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .ic-testimonial-name span' => 'color: {{VALUE}};'
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'selector' => '{{WRAPPER}} .ic-testimonial-name',
				'name' => 'title_typography',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1
			]
		);
		
		$this->end_controls_section();

		// STYLE SECTION - SUB TITLE
		$this->start_controls_section(
			'section_description_style',
			[
				'label' 		=> __( 'Description', 'ic-elements' ),
				'tab' 			=> Controls_Manager::TAB_STYLE
			]
		);
		$this->add_control(
			'description_color',
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
				'selector' => '{{WRAPPER}} p',
				'name' => 'description_typography',
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

		$slider_attributes = array();

		$autoplay = ($settings['slider_autoplay']) ? $settings['slider_autoplay'] : 'false';
		$pauseOnHover = ($settings['pause_on_hover']) ? $settings['pause_on_hover'] : 'false';

		$data = array(
			'"autoplay":' . $autoplay,
			'"autoplaySpeed":' . $settings['slider_autoplay_delay'],
			'"pauseOnHover":' . $pauseOnHover,
			'"speed":' . $settings['slide_duration'],
			
		);
		$slider_attributes[] = "data-slick='{" . implode(', ',$data) . "}'";

		if ( $settings['testimonial_lists'] ) : 

		echo '<div class="ic-testimonial">';
			echo '<div class="ic-testimonial-slider">';
				foreach (  $settings['testimonial_lists'] as $key=>$item ) : 
				
					echo '<div class="ic-testimonaial-item">';
						echo '<div class="ic-testimonial-icon">';
								\Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] );
						echo '</div>';
						echo '<p>'. esc_html($item['description']) .'</p>';
					echo '</div>';

				endforeach; 
			echo '</div>';

			echo '<div class="ic-testimonial-nav-main">';
                echo '<div class="ic-testimonial-prev"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 477.175 477.175" style="enable-background:new 0 0 477.175 477.175;" xml:space="preserve"><g><path d="M360.731,229.075l-225.1-225.1c-5.3-5.3-13.8-5.3-19.1,0s-5.3,13.8,0,19.1l215.5,215.5l-215.5,215.5 c-5.3,5.3-5.3,13.8,0,19.1c2.6,2.6,6.1,4,9.5,4c3.4,0,6.9-1.3,9.5-4l225.1-225.1C365.931,242.875,365.931,234.275,360.731,229.075z "/></g></svg></div>';
                echo '<div class="ic-testimonial-nav" '. implode( ' ', $slider_attributes ) .'>';
                    foreach (  $settings['testimonial_lists'] as $key=>$item ) :
                        echo '<div class="ic-nav-item">';

                                if ($item['image']['url'] ) :
                                echo '<div class="ic-testimonial-image">';
                                    echo Group_Control_Image_Size::get_attachment_image_html( $item, 'thumbnail', 'image' );
                                echo '</div>';
                                endif;

                            echo '<div class="ic-testimonial-meta">';
                                echo '<h2>'. esc_html($item['name']) .'</h2>';
                                echo '<span>'. esc_html($item['designation']) .'</span>';
                            echo '</div>';

                        echo '</div>';
                    endforeach;
                echo '</div>';
                echo '<div class="ic-testimonial-next"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 477.175 477.175" style="enable-background:new 0 0 477.175 477.175;" xml:space="preserve"><g><path d="M360.731,229.075l-225.1-225.1c-5.3-5.3-13.8-5.3-19.1,0s-5.3,13.8,0,19.1l215.5,215.5l-215.5,215.5 c-5.3,5.3-5.3,13.8,0,19.1c2.6,2.6,6.1,4,9.5,4c3.4,0,6.9-1.3,9.5-4l225.1-225.1C365.931,242.875,365.931,234.275,360.731,229.075z "/></g></svg></div>';
            echo '</div>';
		echo '</div>';

		endif;
	}

}