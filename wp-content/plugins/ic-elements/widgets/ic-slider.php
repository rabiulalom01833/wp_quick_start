<?php
namespace IC_elements\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.1.0
 */
class Ic_Slider extends Widget_Base {

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
		return 'ic-slider-widget';
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
		return __( 'IC Slider', 'ic-elements' );
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
		return 'fas fa-sliders-h';
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
			'name', [
				'label' => __( 'Slider Name', 'ic-elements' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'image_box',
			array(
				'label'   => esc_html__( 'Image', 'ic-elements' ),
				'type'    => Controls_Manager::MEDIA,
				'dynamic' => array( 'active' => true ),
			)
		);

		$repeater->add_control(
			'image_nav',
			array(
				'label'   => esc_html__( 'Image', 'ic-elements' ),
				'type'    => Controls_Manager::MEDIA,
				'dynamic' => array( 'active' => true ),
			)
		);

		$repeater->add_control(
			'short_title', [
				'label' => __( 'Short Title', 'ic-elements' ),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'title', [
				'label' => __( 'Title', 'ic-elements' ),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'desc', [
				'label' => __( 'Description', 'ic-elements' ),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'btn_title',
			[
				'label' => __( 'Label', 'ic-elements' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Join With Us', 'ic-elements' ),
			]
		);

		$repeater->add_control(
			'button_link',
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
			'button_style',
			[
				'label' => __( 'Button Style', 'ic-elements' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => [
					'style-1'  => __( 'Style One', 'ic-elements' ),
					'style-2' => __( 'Style Two', 'ic-elements' ),
				],
			]
		);
		
		$this->add_control(
			'slider_list',
			[
				'label' => __( 'Sliders', 'ic-elements' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'name' => __( 'Foods', 'ic-elements' ),
						'short_title' => __( 'The Feel - Be - Connect', 'ic-elements' ),
						'title' => __( 'Framework is central', 'ic-elements' ),
						'desc' => __( 'Various aspects of yoga philosophy are discussed in combination with mindfulness, meditation, movement and self-examination.', 'ic-elements' ),
					],
					[
						'name' => __( 'Foods', 'ic-elements' ),
						'short_title' => __( 'The Feel - Be - Connect', 'ic-elements' ),
						'title' => __( 'Framework is central', 'ic-elements' ),
						'desc' => __( 'Various aspects of yoga philosophy are discussed in combination with mindfulness, meditation, movement and self-examination.', 'ic-elements' ),
					],
					[
						'name' => __( 'Foods', 'ic-elements' ),
						'short_title' => __( 'The Feel - Be - Connect', 'ic-elements' ),
						'title' => __( 'Framework is central', 'ic-elements' ),
						'desc' => __( 'Various aspects of yoga philosophy are discussed in combination with mindfulness, meditation, movement and self-examination.', 'ic-elements' ),
					],
				],
				'title_field' => '{{{ name }}}',
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
					'.ic-slider-content-inner h1' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '.ic-slider-content-inner h1',
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
					'.ic-slider-content-inner h6' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'subtitle_typography',
				'selector' => '.ic-slider-content-inner h6',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_button_style',
			[
				'label' 		=> __( 'Button Style', 'ic-elements' ),
				'tab' 			=> Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'label' => __( 'Button Typography', 'ic-elements' ),
				'selector' => '{{WRAPPER}}  a.custom-btn',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'label' => __( 'Border', 'ic-elements' ),
				'selector' => '{{WRAPPER}}  a.custom-btn',
			]
		);

		$this->add_responsive_control(
			'border_radius',
			[
				'label' => __( 'Border Radius', 'ic-elements' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}}  a.custom-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'button_padding',
			array(
				'label'      => __( 'Padding', 'ic-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}}  a.custom-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'button_margin',
			array(
				'label'      => __( 'Margin', 'ic-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}}  a.custom-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
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
		<!-- ===== banner Part HTML Start ===== -->
		<?php if ( $settings['slider_list'] ) : ?>
		<div class="ic-slider">
			<div class="ic-slider-gallery-inner">
				<div class="ic_slick_slider" id="ic-banner-slider">

				<?php $count = 1; foreach (  $settings['slider_list'] as $key=>$item ) :

					$target = $item['button_link']['is_external'] ? ' target="_blank"' : '';
					$nofollow = $item['button_link']['nofollow'] ? ' rel="nofollow"' : '';
					?>
					<div class="ic_slider_item ic-banner-item-<?php echo $count; ?>" style="background-image: url(<?php echo $item['image_box']['url']; ?>);">
						<div class="ic-banner-content">
							<div class="container">
								<div class="ic-banner-inner">
									<h4 class="ic-banner-short-title"><?php echo esc_html($item['short_title']); ?></h4>
									<h1 class="ic-banner-title"><?php echo esc_html($item['title']); ?></h1>
									<p class="ic-banner-desc"><?php echo esc_html($item['desc']); ?></p>
									<a href="<?php echo esc_url($item['button_link']['url']); ?>" <?php echo $target; ?> <?php echo $nofollow; ?> class="<?php if ($item['button_style'] == 'style-1'): ?>custom-btn<?php else: ?>custom-btn-rvs<?php endif; ?>"><?php echo $item['btn_title']; ?></a>
								</div>
							</div>
						</div>
					</div>
					<?php $count++; endforeach; ?>
					
				</div>
				<div class="slick_slider_nav">
					<div class="ic-nav-container-inner">
						<div class="PrevArrows">
							<div class="slick_slider_nav_item">

							<?php $count = 1; foreach (  $settings['slider_list'] as $key => $item ) :

								$new_key = $key - 1;
								if ($key == 0) {
									$new_key = count($settings['slider_list']) - 1;
								}
								?>
								<div class="item">
									<?php if(!empty($settings['slider_list'][$new_key]['image_nav']['url'])){
										echo Group_Control_Image_Size::get_attachment_image_html( $settings['slider_list'][$new_key], 'ic-slider-nav', 'image_nav' );
									}else{
										echo Group_Control_Image_Size::get_attachment_image_html( $settings['slider_list'][$new_key], 'ic-slider-nav', 'image_box' );
									} ?>
									<div class="ic-slider-nav-cont">
										<img src="<?php echo get_template_directory_uri(); ?>/images/right-arrow.png" class="ic-banner-arrow" alt="arrow">
										<p><?php echo esc_html($settings['slider_list'][$new_key]['name']); ?></p>
									</div>
								</div>
							<?php $count++; endforeach; ?>

							</div>
						</div>

						<div class="NextArrows">
							<div class="slick_slider_nav_item">

							<?php $count = 1; foreach (  $settings['slider_list'] as $key=>$item ) : 
							
								$new_key = $key + 1;
								if ($key == count($settings['slider_list']) - 1) {
									$new_key = 0;
								}
								?>
								<div class="item">
									<?php if(!empty($settings['slider_list'][$new_key]['image_nav']['url'])){
										echo Group_Control_Image_Size::get_attachment_image_html( $settings['slider_list'][$new_key], 'ic-slider-nav', 'image_nav' );
									}else{
										echo Group_Control_Image_Size::get_attachment_image_html( $settings['slider_list'][$new_key], 'ic-slider-nav', 'image_box' );
									} ?>
									<div class="ic-slider-nav-cont">
										<p><?php echo esc_html($settings['slider_list'][$new_key]['name']); ?></p>
										<img src="<?php echo get_template_directory_uri(); ?>/images/right-arrow.png" class="ic-banner-arrow" alt="arrow">
									</div>
								</div>
							<?php $count++; endforeach; ?>

							</div>
						</div>
					</div>
				</div>
				<div class="ic-post-nav ic-slider-mobile-nav">
					<div class="container">
						<?php $count = 1; foreach (  $settings['slider_list'] as $key=>$item ) : ?>
							<a href="#" class="ic-slider-single <?php if($count == 1) : ?>ic-active<?php endif; ?>" data-slide="<?php echo $count; ?>">
								<span class="ic-nav-num"><?php echo esc_html($count); ?></span>
								<div class="ic-nav-text"><?php echo $item['name']; ?></div>
							</a>
						<?php $count++; endforeach; ?>
					</div>
				</div>
			</div>
		</div>
		<!-- ===== banner Part HTML End ===== -->
		<?php
		endif;
	}

}