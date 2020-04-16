<?php
namespace IC_elements\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Box_Shadow;
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
class Ic_post_slider extends Widget_Base {

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
		return 'ic-post-slider';
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
		return __( 'IC Post Slider', 'ic-elements' );
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
			'image_box',
			array(
				'label'   => esc_html__( 'Image', 'ic-elements' ),
				'type'    => Controls_Manager::MEDIA,
				'dynamic' => array( 'active' => true ),
			)
		);

		$repeater->add_control(
			'short_title',
			[
				'label' => __( 'Short Title', 'ic-elements' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'relaxation', 'ic-elements' ),
			]
		);
		$repeater->add_control(
			'title',
			[
				'label' => __( 'Title', 'ic-elements' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'It’s Time To Pleasure', 'ic-elements' ),
			]
		);
		$repeater->add_control(
			'description',
			[
				'label' => __( 'Description', 'ic-elements' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'In this lesson you go on an inner peace journey and it becomes clear that you already have all the wisdom to be in balance', 'ic-elements' ),
			]
		);

		$repeater->add_control(
			'btn_title',
			[
				'label' => __( 'Button Label', 'ic-elements' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Enjoy Your Time', 'ic-elements' ),
			]
		);

		$repeater->add_control(
			'button_link',
			[
				'label' => __( 'Button Link', 'ic-elements' ),
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
				'default' => 'style-2',
				'options' => [
					'style-1'  => __( 'Style One', 'ic-elements' ),
					'style-2' => __( 'Style Two', 'ic-elements' ),
				],
			]
		);

		$repeater->add_control(
			'name', [
				'label' => __( 'Navigation Text', 'ic-elements' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => __( 'relaxing', 'ic-elements' ),
			]
		);

		$this->add_control(
			'post_sliders',
			[
				'label' => __( 'Feature Posts', 'ic-elements' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'short_title' => __( 'relaxation', 'ic-elements' ),
						'title' => __( 'It’s Time To Pleasure', 'ic-elements' ),
						'desc' => __( 'In this lesson you go on an inner peace journey and it becomes clear that you already have all the wisdom to be in balance', 'ic-elements' ),
						'name' => __( 'relaxing', 'ic-elements' ),
					],
					[
						'short_title' => __( 'relaxation', 'ic-elements' ),
						'title' => __( 'It’s Time To Pleasure', 'ic-elements' ),
						'desc' => __( 'In this lesson you go on an inner peace journey and it becomes clear that you already have all the wisdom to be in balance', 'ic-elements' ),
						'name' => __( 'relaxing', 'ic-elements' ),
					],
					[
						'short_title' => __( 'relaxation', 'ic-elements' ),
						'title' => __( 'It’s Time To Pleasure', 'ic-elements' ),
						'desc' => __( 'In this lesson you go on an inner peace journey and it becomes clear that you already have all the wisdom to be in balance', 'ic-elements' ),
						'name' => __( 'relaxing', 'ic-elements' ),
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);

		$this->end_controls_section();

		// STYLE SECTION - TITLE
		$this->start_controls_section(
			'image_style',
			[
				'label' => __( 'Image', 'ic-elements' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'bg_color',
			[
				'label' => __( 'Background Color', 'ic-elements' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ic-post-slider-image' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'image_shadow',
				'label' => __( 'Box Shadow', 'ic-elements' ),
				'selector' => '{{WRAPPER}} .ic-post-slider-image',
			]
		);

		$this->end_controls_section();

		// STYLE SECTION - TITLE
		$this->start_controls_section(
			'title_style',
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
					'{{WRAPPER}} .post-slider-content h2' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .post-slider-content h2',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1
			]
		);

		$this->end_controls_section();

		// STYLE SECTION - DESCRIPTION
		$this->start_controls_section(
			'subtitle_style',
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
					'{{WRAPPER}} .post-slider-content h4' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'subtitle_typography',
				'selector' => '{{WRAPPER}} .post-slider-content h4',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1
			]
		);

		$this->end_controls_section();

		// STYLE SECTION - DESCRIPTION
		$this->start_controls_section(
			'description_style',
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
					'{{WRAPPER}} .post-slider-content p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .post-slider-content p',
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

		<?php if ( $settings['post_sliders'] ) : ?>
		<div class="ic-post-slider-main">
			<div class="row post-slider-inner">
				<div class="col-lg-5 col-md-6 col-sm-12">
					<div class="slider ic-post-img-slider">

						<?php foreach (  $settings['post_sliders'] as $key=>$item ) : if(!empty($item['image_box']['url'])) : ?>
						<div class="ic-post-slider-item">
							<div class="ic-post-slider-image">
								<img src="<?php echo $item['image_box']['url']; ?>" alt="Image">
							</div>
						</div>
						<?php endif; endforeach; ?>

					</div>
				</div>
				<div class="col-lg-7 col-md-6 col-sm-12">
					<div class="post-slider-content">
						<div class="slider ic-post-slider">

							<?php foreach (  $settings['post_sliders'] as $key=>$item ) :
								
								$target = $item['button_link']['is_external'] ? ' target="_blank"' : '';
								$nofollow = $item['button_link']['nofollow'] ? ' rel="nofollow"' : '';
							?>
							<div class="post-slider-content-inner">
								<h4 class="ic-post-short-title"><?php echo $item['short_title']; ?></h4>
								<h2 class="ic-post-title"><?php echo $item['title']; ?></h2>
								<p class="ic-post-desc"><?php echo $item['description']; ?></p>

								<a href="<?php echo esc_url($item['button_link']['url']); ?>" <?php echo $target; ?> <?php echo $nofollow; ?> class="<?php if ($item['button_style'] == 'style-1'): ?>custom-btn<?php else: ?>custom-btn-rvs<?php endif; ?>"><?php echo $item['btn_title']; ?></a>
							</div>
							<?php endforeach; ?>

						</div>
						<div class="ic-post-nav">

							<?php $count = 1; foreach (  $settings['post_sliders'] as $key=>$item ) : ?>
								<a href="#" class="ic-nav-single <?php if($count == 1) : ?>ic-active<?php endif; ?>" data-slide="<?php echo $count; ?>">
									<span class="ic-nav-num"><?php echo esc_html($count); ?></span>
									<div class="ic-nav-text"><?php echo $item['name']; ?></div>
								</a>
							<?php $count++; endforeach; ?>

						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
		endif;
	}

	
}