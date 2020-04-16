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
class Ic_Product_slider extends Widget_Base {

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
		return 'ic-product-slider';
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
		return __( 'IC Product Slider', 'ic-elements' );
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
		return 'fas fa-bars';
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

		$select_product_cat_arry = array();
		$select_product_cats = get_terms( 'product_cat' );
		foreach ($select_product_cats as $select_product_cat) :
			$select_product_cat_arry[$select_product_cat->term_id] = $select_product_cat->name;
		endforeach;
		$this->add_control(
			'select_categories',
			[
				'label' => __( 'Categories', 'ic-elements' ),
				'type' => Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => $select_product_cat_arry,
			]
		);

		$this->add_control(
			'post_per_page',
			[
				'label' => __( 'Post Per Page', 'ic-elements' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 100,
				'step' => 1,
				'default' => 5,
			]
		);

		$this->add_control(
			'order',
			[
				'label' => __( 'Order', 'ic-elements' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'ASC',
				'options' => [
					'ASC'  => __( 'Ascending', 'ic-elements' ),
					'DESC' => __( 'Descending', 'ic-elements' ),
				],
			]
		);

		$this->add_control(
			'order_by',
			[
				'label' => __( 'Order By', 'ic-elements' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'date',
				'options' => [
					'none' => __( 'None', 'ic-elements'),
					'type' => __( 'Type', 'ic-elements'),
					'title' => __( 'Title', 'ic-elements'),
					'name' => __( 'Name', 'ic-elements'),
					'date' => __( 'Date', 'ic-elements'),
				],
			]
		);

		$this->add_control(
			'btn_title',
			[
				'label' => __( 'Button Label', 'ic-elements' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'View All Menu', 'ic-elements' ),
			]
		);

		$this->add_control(
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

		$this->add_control(
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
					'{{WRAPPER}} .ic-product-item' => 'text-align: {{VALUE}};',
				],
				'default' => 'left',
				'toggle' => true,
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
			'infinite_slide',
			array(
				'label'        => esc_html__( 'Infinite', 'ic-elements' ),
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

		$this->add_control(
			'slide_to_show',
			array(
				'label'   => esc_html__( 'Slide To Show', 'ic-elements' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 3,
				'min'     => 1,
				'max'     => 8,
				'step'    => 1,
			)
		);

		$this->add_control(
			'slide_to_scroll',
			array(
				'label'   => esc_html__( 'Slide To Scroll', 'ic-elements' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 3,
				'min'     => 1,
				'max'     => 8,
				'step'    => 1,
			)
		);

		$this->end_controls_section();

		// STYLE SECTION - TITLE
		$this->start_controls_section(
			'item_style',
			[
				'label' => __( 'Item', 'ic-elements' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'item_padding',
			array(
				'label'      => __( 'Padding', 'ic-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .ic-product-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Title Color', 'ic-elements' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ic-product-content h4' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __( 'Title Typography', 'ic-elements' ),
				'selector' => '{{WRAPPER}} .ic-product-content h4',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1
			]
		);

		$this->add_control(
			'price_color',
			[
				'label' => __( 'Price Color', 'ic-elements' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ic-product-content span.price' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'price_typography',
				'label' => __( 'Price Typography', 'ic-elements' ),
				'selector' => '{{WRAPPER}} .ic-product-content span.price',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1
			]
		);

		$this->add_control(
			'gapping',
			[
				'label' => __( 'Gapping', 'ic-elements' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .ic-product-content span.price' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
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

		$infinite = ($settings['infinite_slide']) ? $settings['infinite_slide'] : 'false';
		$autoplay = ($settings['slider_autoplay']) ? $settings['slider_autoplay'] : 'false';
		$autoplay_delay = ($settings['slider_autoplay']) ? $settings['slider_autoplay_delay'] : '1200';
		$pauseOnHover = ($settings['pause_on_hover']) ? $settings['pause_on_hover'] : 'false';

		$data = array(
			'"slidesToShow":' . $settings['slide_to_show'],
			'"slidesToScroll":' . $settings['slide_to_scroll'],
			'"infinite":' . $infinite,
			'"autoplay":' . $autoplay,
			'"autoplaySpeed":' . $autoplay_delay,
			'"pauseOnHover":' . $pauseOnHover,
			'"speed":' . $settings['slide_duration'],
			
		);
		$slider_attributes[] = "data-slick='{" . implode(', ',$data) . "}'";
		
		$target = $settings['button_link']['is_external'] ? ' target="_blank"' : '';
		$nofollow = $settings['button_link']['nofollow'] ? ' rel="nofollow"' : '';
		?>

	<div class="ic-product-slider-main ic-menu-custom woocommerce">

		<div class="ic-product-slider" <?php echo implode( ' ', $slider_attributes ); ?>>
			<?php
			if($settings['select_categories']){
				$query_args = array(
					'post_type'           => 'product',
					'post_status'         => 'publish',
					'posts_per_page'      =>  $settings['post_per_page'],
					'tax_query' => array(
						array(
								'taxonomy' => 'product_cat',
								'field' => 'id',
								'terms' => $settings['select_categories']
						)
					),
				  	'order'               => $settings['order'],
				  	'orderby'             => $settings['order_by'],
					'ignore_sticky_posts' => true,
					'offset'              => 0 
				);
			}else{
				$query_args = array(
					'post_type'           => 'product',
					'post_status'         => 'publish',
					'posts_per_page'      =>  $settings['post_per_page'],
				  	'order'               => $settings['order'],
				  	'orderby'             => $settings['order_by'],
					'ignore_sticky_posts' => true,
					'offset'              => 0 
				);
			}
			
			$menu_post = new \WP_Query( $query_args );
			
			$product_count = 0;
			if( $menu_post->have_posts() ): while( $menu_post->have_posts() ): $menu_post->the_post();
			?>

			<div class="ic-product-item" id="product-<?php echo get_the_ID(); ?>">
				<div class="ic-product-image">
				<?php if ( has_post_thumbnail() ){
					the_post_thumbnail();
				} ?>
				</div>
				<div class="ic-product-content">
					<h4><?php the_title(); ?></h4>
					<?php woocommerce_template_loop_price(); ?>
				</div>
			</div>
			
			<?php $product_count++; endwhile; endif;?>
		</div>
		<div class="ic-product_nav">
			<?php if($settings['slide_to_show'] < $product_count) : ?>
			<div class="ic-Prev">
				<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
					width="284.929px" height="284.929px" viewBox="0 0 284.929 284.929" style="enable-background:new 0 0 284.929 284.929;"
					xml:space="preserve">
				<g>
					<g>
						<path d="M165.304,142.468L277.517,30.267c1.902-1.903,2.847-4.093,2.847-6.567c0-2.475-0.951-4.665-2.847-6.567L263.239,2.857
							C261.337,0.955,259.146,0,256.676,0c-2.478,0-4.665,0.955-6.571,2.857L117.057,135.9c-1.903,1.903-2.853,4.093-2.853,6.567
							c0,2.475,0.95,4.664,2.853,6.567l133.048,133.043c1.903,1.906,4.086,2.851,6.564,2.851c2.478,0,4.66-0.947,6.563-2.851
							l14.277-14.267c1.902-1.903,2.851-4.094,2.851-6.57c0-2.472-0.948-4.661-2.851-6.564L165.304,142.468z"/>
						<path d="M55.668,142.468L167.87,30.267c1.903-1.903,2.851-4.093,2.851-6.567c0-2.475-0.947-4.665-2.851-6.567L153.6,2.857
							C151.697,0.955,149.507,0,147.036,0c-2.478,0-4.668,0.955-6.57,2.857L7.417,135.9c-1.903,1.903-2.853,4.093-2.853,6.567
							c0,2.475,0.95,4.664,2.853,6.567l133.048,133.043c1.902,1.906,4.09,2.851,6.57,2.851c2.471,0,4.661-0.947,6.563-2.851
							l14.271-14.267c1.903-1.903,2.851-4.094,2.851-6.57c0-2.472-0.947-4.661-2.851-6.564L55.668,142.468z"/>
					</g>
				</g>
				</svg>
			</div>
			<?php endif; ?>

			<a href="<?php echo esc_url($settings['button_link']['url']); ?>" <?php echo $target; ?> <?php echo $nofollow; ?> class="<?php if ($settings['button_style'] == 'style-1'): ?>custom-btn<?php else: ?>custom-btn-rvs<?php endif; ?>"><?php echo esc_html($settings['btn_title']); ?></a>

			<?php if($settings['slide_to_show'] < $product_count) : ?>
			<div class="ic-Next">
				<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
					width="284.936px" height="284.936px" viewBox="0 0 284.936 284.936" style="enable-background:new 0 0 284.936 284.936;"
					xml:space="preserve">
				<g>
					<g>
						<path d="M277.515,135.9L144.464,2.857C142.565,0.955,140.375,0,137.9,0c-2.472,0-4.659,0.955-6.562,2.857l-14.277,14.275
							c-1.903,1.903-2.853,4.089-2.853,6.567c0,2.478,0.95,4.664,2.853,6.567l112.207,112.204L117.062,254.677
							c-1.903,1.903-2.853,4.093-2.853,6.564c0,2.477,0.95,4.667,2.853,6.57l14.277,14.271c1.902,1.905,4.089,2.854,6.562,2.854
							c2.478,0,4.665-0.951,6.563-2.854l133.051-133.044c1.902-1.902,2.851-4.093,2.851-6.567S279.417,137.807,277.515,135.9z"/>
						<path d="M170.732,142.471c0-2.474-0.947-4.665-2.857-6.571L34.833,2.857C32.931,0.955,30.741,0,28.267,0s-4.665,0.955-6.567,2.857
							L7.426,17.133C5.52,19.036,4.57,21.222,4.57,23.7c0,2.478,0.95,4.664,2.856,6.567L119.63,142.471L7.426,254.677
							c-1.906,1.903-2.856,4.093-2.856,6.564c0,2.477,0.95,4.667,2.856,6.57l14.273,14.271c1.903,1.905,4.093,2.854,6.567,2.854
							s4.664-0.951,6.567-2.854l133.042-133.044C169.785,147.136,170.732,144.945,170.732,142.471z"/>
					</g>
				</g>
				</svg>
			</div>
			<?php endif; ?>

		</div>
	</div>



		<?php
	}
	
}