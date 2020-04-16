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
class Quick_About extends Widget_Base {

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
	 
	 

        $this->end_controls_section();
        
        $this->start_controls_section(
			'social_content',
			[
                'label' => __( 'Social', 'ic-elements' ),
                'label_block' => true,
			]
		);

        $repeater = new Repeater();

		$repeater->add_control(
			'icon_link', 
			[
				'label' => __( 'Link', 'ic-elements' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'ic-elements' ),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
			]
		);
		$repeater->add_control(
			'icon',
			[
				'label' => __( 'Icon', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::ICON,
				'include' => [
					'fa fa-facebook',
					'fa fa-flickr',
					'fa fa-google-plus',
					'fa fa-instagram',
					'fa fa-linkedin',
					'fa fa-pinterest',
					'fa fa-reddit',
					'fa fa-twitch',
					'fa fa-twitter',
					'fa fa-vimeo',
					'fa fa-youtube',
				],
				'default' => 'fa fa-facebook',
			]
		);
		$this->add_control(
			'social_box_url',
			[
				'label' => __( 'Contact Infos', 'ic-elements' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'icon_link' => __( 'Link Url', 'ic-elements' ),
						'icon' => __( 'Add Icon', 'ic-elements' ),
					],
					 
				],
				'title_field' => '{{{ icon_link }}}',
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
					'{{WRAPPER}} .member-details h2' => 'color: {{VALUE}};'
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'selector' => '{{WRAPPER}} .member-details h2',
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
					'{{WRAPPER}} .member-details h3' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'selector' => '{{WRAPPER}} .member-details h3',
				'name' => 'subtitle_typography',
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
		$settings = $this->get_settings_for_display(); ?>
		 
        <div class="domo-box domo-box-bottom box-shadow">
            <div class="demo-box-1">
                <div class="team-member-image">
                     <?php  echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' ); ?>
                </div>
                <div class="team-member-details">
                    <div class="member-details">
                        <h2><?php echo $settings['title']; ?></h2>
                        <h3><?php echo $settings['subtitle']; ?></h3> 
                    </div>
                   
                    <?php if ( $settings['social_box_url'] ) :
 
                        echo '<div class="team-member-soical-1">';
                            foreach (  $settings['social_box_url'] as $key=>$item ) : 
                              echo '<a href="'. $item['icon_link'] . '"><i class="'. $item['icon'] . '"></i></a>'; 
                            endforeach;
                        echo '</div>';
                    
                    endif;
                    ?>

                </div> 
            </div> 
        </div>  

        <?php
		
	}

}