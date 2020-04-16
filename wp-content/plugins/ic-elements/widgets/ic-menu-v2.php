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
class Ic_Menu_v2 extends Widget_Base {

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
		return 'ic-menu-v2';
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
		return __( 'IC Menu v2', 'ic-elements' );
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

		$repeater = new Repeater();

		$repeater->add_control(
			'day',
			[
				'label' => __( 'Day', 'ic-elements' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'Saturday',
				'options' => [
					'Saturday'  => __( 'Saturday', 'ic-elements' ),
					'Sunday' => __( 'Sunday', 'ic-elements' ),
					'Monday' => __( 'Monday', 'ic-elements' ),
					'Tuesday' => __( 'Tuesday', 'ic-elements' ),
					'Wednesday' => __( 'Wednesday', 'ic-elements' ),
					'Thursday' => __( 'Thursday', 'ic-elements' ),
					'Friday' => __( 'Friday', 'ic-elements' ),
				],
			]
		);

		$product_args = array('post_type' => 'product', 'posts_per_page' =>  -1,);
		$product_list = get_posts( $product_args );
		
		foreach ($product_list as $single_item) {
			$select_product_cat_arry[$single_item->ID] = $single_item->post_title;
		}

		$repeater->add_control(
			'select_product',
			[
				'label' => __( 'Product', 'ic-elements' ),
				'type' => Controls_Manager::SELECT,
				'options' => $select_product_cat_arry,
			]
		);

		$this->add_control(
			'menu_lists',
			[
				'label' => __( 'Special Menu', 'ic-elements' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ day }}}',
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
	if( $settings['menu_lists']) :?>

	<div class="ic-menu-section ic-menu-v2 woocommerce">
	    <div class="ic-menu-inner row">
            <?php foreach ($settings['menu_lists'] as $key => $item) :
            	$post_id = $item['select_product'];

            	$product = wc_get_product( $post_id );
            	if(defined('FW')) :
			        $accompaniment = fw_get_db_post_option($post_id,'accompaniment');
			        $drink = fw_get_db_post_option($post_id,'drink');
			    endif;
            ?>

            <div class="ic-product-item col-lg-6 col-md-12 col-12">
            	<div class="ic-product-image">
					<?php
            			$post_thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'ic-menu-2' );
						
					 if ( $post_thumb ){ ?>
						<img src="<?php echo esc_url($post_thumb[0]); ?>" alt="">
					<?php }else{
						?><img src="//placehold.it/148x153?text=<?php get_the_title( $post_id ); ?>" alt="<?php get_the_title( $post_id ); ?>"><?php
					} ?>
				</div>
                <div class="ic-product-content">
                    <h2><?php echo esc_html($item['day']); ?></h2>
                    <h4><span><?php echo esc_html__('Dish: ','le-resto'); ?></span><?php echo get_the_title( $post_id ); ?></h4>

                    <?php if ($accompaniment): ?>
                    	<h5><span><?php echo esc_html__('Accompaniment: ','le-resto'); ?></span><?php echo esc_html($accompaniment); ?></h5>
                    <?php endif; ?>
                    
                    <?php if ($drink): ?>
                    	<h6><span><?php echo esc_html__('Drink: ','le-resto'); ?></span><?php echo esc_html($drink); ?></h6>
                    <?php endif ?>
                    
                    
                    <span><?php echo esc_html__('Only ','le-resto'), $product->get_price(), get_woocommerce_currency_symbol(); ?></span>
                </div>
            </div>
            <?php endforeach;?>
	    </div>
	</div>
			
	<?php
	endif;
	}
	
}