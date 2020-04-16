<?php
namespace IC_elements\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
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
class Ic_Product extends Widget_Base {

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
		return 'ic-product';
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
		return __( 'IC Product', 'ic-elements' );
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
		return 'fas fa-cart-plus';
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
		    'order'  	 => 'ASC',
	        'orderby' 	 => 'date',
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
			'image1',
			array(
				'label'   => esc_html__( 'Image One', 'ic-elements' ),
				'type'    => Controls_Manager::MEDIA,
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'image2',
			array(
				'label'   => esc_html__( 'Image Two', 'ic-elements' ),
				'type'    => Controls_Manager::MEDIA,
				'dynamic' => array( 'active' => true ),
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
		<div class="ic-product-section ic-menu-custom woocommerce button-<?php echo $settings['order_btn']; ?>">
			<div class="container">
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
						<?php $count = 0; foreach($menu_terms as $menu_term):?>
		                <li class="nav-item ic-menu-inner">
			                  <a class="nav-link cat <?php if($count == 0): ?>active <?php endif; ?>" href="#"  data-multi-id="no" data-term-id="<?php echo esc_attr($menu_term['id']); ?>" ><?php echo esc_html($menu_term['name']); ?></a>
			                
		                </li>
						<?php $count++; endforeach; ?>
		              </ul>
			        </div>
			    </div>
			    <div class="tab-content">
			        <div class="spiner"></div>
			        <div class="taxonomy-tab-posts">
			        	<div class="ic-product-cat">
			        		<h2><?php echo get_the_category_by_ID($settings['categories'][0]); ?></h2>
			        	</div>
                        <div class="ic-product-responsive-table">
                            <table class="w-100">
					            <colgroup>
					                <col style="width:20%">
					                <col style="width:60%">
					                <col style="width:20%">
					            </colgroup>
                                <thead>
                                	<tr>
                                		<th><?php echo esc_html__('Product ID','le-resto'); ?></th>
		                                <th><?php echo esc_html__('Product Name','le-resto'); ?></th>
		                                <th><?php echo esc_html__('Product Price','le-resto'); ?></th>
                                	</tr>
                                </thead>
                                <tbody>
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

                                    if(defined('FW')) :
                                        $code = fw_get_db_post_option(get_the_ID(),'code');
                                    endif;
                                    ?>


                                    <tr>
                                        <td class="ic-first-td"><?php echo esc_html($code); ?></td>
                                        <td class="ic-second-td"><?php the_title(); ?></td>
                                        <td class="ic-third-td"><?php echo woocommerce_template_loop_price(); ?></td>
                                    </tr>
                                <?php endwhile; endif;?>
                                </tbody>
                            </table>
                        </div>
		            </div>
			    </div>
			</div>
			<div class="ic-product-bg">
				<div class="ic-image-one">
					<?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'full', 'image1' ); ?>
				</div>
				<div class="ic-image-two">
					<?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'full', 'image2' ); ?>
				</div>
			</div>
		</div>
		
	<?php
	endif;
	}
	
}