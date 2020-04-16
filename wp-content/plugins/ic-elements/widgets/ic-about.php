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
class Ic_About extends Widget_Base {

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
		return 'ic-about';
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
		return __( 'IC About', 'ic-elements' );
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
			'section_image',
			[
				'label' => __( 'Image', 'ic-elements' ),
			]
		);
		$this->add_control(
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

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail', // // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
				'exclude' => [],
				'include' => [],
				'default' => 'full',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'ic-elements' ),
			]
		);
		$this->add_control(
			'title', [
				'label' => __( 'Title', 'ic-elements' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);
		$this->add_control(
			'subtitle', [
				'label' => __( 'Sub Title', 'ic-elements' ),
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => __( 'Type your Sub Title here', 'ic-elements' ),
			]
		);
		$this->add_control(
			'description', [
				'label' => __( 'Description', 'ic-elements' ),
				'type' => Controls_Manager::WYSIWYG,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => __( 'Type your description here', 'ic-elements' ),
				'label_block' => true,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_button',
			[
				'label' => __( 'Buttons', 'ic-elements' ),
			]
		);
		$this->add_control(
			'button_switch',
			[
				'label' => __( 'Show Buttons', 'ic-elements' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'ic-elements' ),
				'label_off' => __( 'No', 'ic-elements' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);
		$this->start_controls_tabs( 'tabs_button_content' );

		$this->start_controls_tab(
			'tab_button_content_one',
			array(
				'label' => esc_html__( 'Button One', 'ic-elements' ),
			)
		);

		$this->add_control(
			'button_label_one',
			array(
				'label'       => esc_html__( 'Button Label Text', 'ic-elements' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Book A Table', 'ic-elements' ),
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'button_url_one',
			array(
				'label' => esc_html__( 'Button Link', 'ic-elements' ),
				'type' => Controls_Manager::URL,
				'placeholder' => 'https://your-link.com',
				'default' => array(
					'url' => '#',
				),
				'separator' => 'before',
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'button_style_one',
			[
				'label' => __( 'Button Style', 'ic-elements' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => [
					'style-1'  => __( 'Style One', 'ic-elements' ),
					'style-2' => __( 'Style Two', 'ic-elements' ),
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_content_two',
			array(
				'label' => esc_html__( 'Button Two', 'ic-elements' ),
			)
		);

		$this->add_control(
			'button_label_two',
			array(
				'label'       => esc_html__( 'Button Label Text', 'ic-elements' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Order Online', 'ic-elements' ),
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'button_url_two',
			array(
				'label' => esc_html__( 'Button Link', 'ic-elements' ),
				'type' => Controls_Manager::URL,
				'placeholder' => 'https://your-link.com',
				'default' => array(
					'url' => '#',
				),
				'separator' => 'before',
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'button_style_two',
			[
				'label' => __( 'Button Style', 'ic-elements' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => [
					'style-1'  => __( 'Style One', 'ic-elements' ),
					'style-2' => __( 'Style Two', 'ic-elements' ),
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

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
					'{{WRAPPER}} .ic-about-content h2' => 'color: {{VALUE}};'
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'selector' => '{{WRAPPER}} .ic-about-content h2',
				'name' => 'title_typography',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1
			]
		);
		
		$this->end_controls_section();

		// STYLE SECTION - SUB TITLE
		$this->start_controls_section(
			'section_subtitle_style',
			[
				'label' 		=> __( 'Sub Title', 'ic-elements' ),
				'tab' 			=> Controls_Manager::TAB_STYLE
			]
		);
		$this->add_control(
			'subtitle_color',
			[
				'label' => __( 'Text Color', 'ic-elements' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ic-about-content h4' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'selector' => '{{WRAPPER}} .ic-about-content h4',
				'name' => 'subtitle_typography',
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
					'{{WRAPPER}} .ic-about-desc' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'selector' => '{{WRAPPER}} .ic-about-desc',
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
		$button_switch = $this->get_settings_for_display('button_switch');
		$button_style_one = $this->get_settings_for_display('button_style_one');
		$button_style_two = $this->get_settings_for_display('button_style_two');

		$target_one = $settings['button_url_one']['is_external'] ? ' target="_blank"' : '';
		$nofollow_one = $settings['button_url_one']['nofollow'] ? ' rel="nofollow"' : '';
		$target_two = $settings['button_url_two']['is_external'] ? ' target="_blank"' : '';
		$nofollow_two = $settings['button_url_two']['nofollow'] ? ' rel="nofollow"' : '';

		echo '<div class="ic-about">';
			echo '<div class="row ic-about-inner">';
				echo '<div class="col-lg-6 col-md-12 col-sm-12">';
					echo '<div class="ic-about-content">';

						if ($settings['title']  && $settings['subtitle']) 
						echo '<div class="ic-about-header">';

							if ($settings['title'] )
							echo '<h2>'. esc_html($settings['title']) .'</h2>';

							if ($settings['subtitle'] )
							echo '<h4>'. esc_html($settings['subtitle']) .'</h4>';

						echo '</div>';

						if ($settings['description'] )
						echo '<div class="ic-about-desc">'. $settings['description'] .'</div>';

						if ($button_switch == 'yes') :
						echo '<div class="ic-button-main">';
							$btn_cls_one = $button_style_one == 'style-1' ? 'custom-btn' : 'custom-btn-rvs';
							$btn_cls_two = $button_style_two == 'style-1' ? 'custom-btn' : 'custom-btn-rvs';

							echo '<a href="'. esc_url($settings['button_url_one']['url']) .'" class="'. $btn_cls_one .'"'. $target_one . $nofollow_one .'>';
							 	echo $settings['button_label_one'];
							echo '</a>';

							echo '<a href="'. esc_url($settings['button_url_two']['url']) .'" class="'. $btn_cls_two .'"'. $target_two . $nofollow_two .'>';
							 	echo $settings['button_label_two'];
							echo '</a>';

				        echo '</div>';
				        endif;
					echo '</div>';
				echo '</div>';

				if ($settings['image']['url'] ) : 
				echo '<div class="col-lg-6 col-md-12 col-sm-12">';
					echo '<div class="ic-about-image">';

						 echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' ); 

					echo '</div>';
				echo '</div>';
				 endif; 
			echo '</div>';
		echo '</div>';
		
	}

}