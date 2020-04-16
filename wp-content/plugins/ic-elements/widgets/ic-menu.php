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
class Ic_Menu extends Widget_Base {

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
		return 'ic-menu';
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
		return __( 'IC Menu', 'ic-elements' );
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
		$select_product_cats = get_terms( array(
		    'taxonomy' 	 => 'product_cat',
		    'hide_empty' => true,
		    'order'  => 'DESC',
		    'orderby'  => 'none'
		) );
		foreach ($select_product_cats as $select_product_cat) :
			$select_product_cat_arry[$select_product_cat->term_id] = $select_product_cat->name;
		endforeach;
		$this->add_control(
			'categories',
			[
				'label' => __( 'Categories', 'ic-elements' ),
				'type' => Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => $select_product_cat_arry,
			]
		);

		$this->add_control(
			'order_btn',
			array(
				'label' => __( 'Order Button', 'ic-elements' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'hide',
				'options' => [
					'show'  => __( 'Show', 'ic-elements' ),
					'hide' => __( 'Hide', 'ic-elements' ),
				],
			)
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
					'{{WRAPPER}} h4' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} h4',
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
					'{{WRAPPER}} p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
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

		if($settings['categories']) :

		foreach ( $settings['categories'] as $key => $category ) {

			$single_cat['id'] = $category;
			$single_cat['name'] = get_the_category_by_ID($category);
			$menu_terms[$key] = $single_cat;
			
		}
		$currentcat = $settings['categories'][0];

		?>
		<div class="ic-menu-section ic-menu-custom woocommerce button-<?php echo $settings['order_btn']; ?>">
		    <div class="ic-menu-content">
		        <div class="nav-button ic-menu-normal">

		            <?php $count = 0; foreach($menu_terms as $menu_term): ?>
		            <div class="ic-menu-item">
		                <div class="ic-menu-inner">
		                    <a href="#"  data-multi-id="no" data-term-id="<?php echo esc_attr($menu_term['id']); ?>" class="cat <?php if($count == 0): ?>active <?php endif; ?>"><?php echo esc_html($menu_term['name']); ?></a>
		                </div>
		            </div>
		            <?php $count++; endforeach; ?>

		        </div>
		        <div class="nav-button ic-menu-normal ic-mobile">
	              <ul class="ic-menu-wrapper nav nav-tabs" id="ic-menu-mobile-tab" role="tablist">
					<?php $count = 0; foreach($menu_terms as $menu_term): ?>
	                <li class="nav-item ic-menu-inner">
	                  	<a class="nav-link cat <?php if($count == 0): ?>active <?php endif; ?>" href="#"  data-multi-id="no" data-term-id="<?php echo esc_attr($menu_term['id']); ?>" ><?php echo esc_html($menu_term['name']); ?></a>
		                
	                </li>
					<?php $count++; endforeach; ?>
	              </ul>
		        </div>
		    </div>
		    <div class="tab-content">
		        <div class="spiner"></div>
		        <div class="taxonomy-tab-posts row">
	                <?php
	                $query_args = array(
	                    'post_type'           => 'product',
	                    'post_status'         => 'publish',
	                    'posts_per_page'      =>  -1,  
	                    'order'               => 'ASC',
	                    'orderby'             => 'date',
	                    'tax_query' => array(
	                        array(
	                            'taxonomy' => 'product_cat',
	                            'field' => 'id',
	                            'terms' => $currentcat,
	                        )
	                    ),     
	                    'ignore_sticky_posts' => true,
	                    'offset'              => 0 
	                );
	                $menu_post1 = new \WP_Query( $query_args );
	                
	                if( $menu_post1->have_posts() ): while( $menu_post1->have_posts() ): $menu_post1->the_post(); 

	                ?>
	                <div class="ic-product-item col-lg-6 col-md-12 col-12" id="product-<?php echo get_the_ID(); ?>">
	                	<div class="ic-product-image">
							<?php if ( has_post_thumbnail() ){
								the_post_thumbnail('ic-menu-2');
							}else{
								?><img src="//placehold.it/148x153?text=<?php the_title(); ?>" alt="<?php the_title(); ?>"><?php
							} ?>
						</div>
	                    <div class="ic-product-content">
                            <h4><?php the_title(); ?></h4>
                        	<?php if(has_excerpt()){
					            echo the_excerpt();
					        }else{
					            echo wp_trim_words(get_the_content(), 15,'...');
					        } ?>
                            <span class="d-block"><?php echo esc_html__('Only ','le-resto'), woocommerce_template_loop_price(); ?></span>
                            <?php if ($settings['order_btn'] == 'show'): ?>
                            	<div class="ic-product-order"><?php woocommerce_template_loop_add_to_cart(); ?></div>
                            <?php endif ?>
                            
	                    </div>
	                </div>
	                <?php endwhile; endif;?>

	            </div>
		    </div>
		</div>

	<?php
	endif;
	}
	
}