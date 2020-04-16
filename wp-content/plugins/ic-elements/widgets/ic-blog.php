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
class Ic_Blog extends Widget_Base {

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
		return 'ic-blog';
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
		return __( 'IC Blog', 'ic-elements' );
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
		return 'fas fa-book';
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

		$select_blog_cat_arry = array();
		$select_blog_cats = get_terms( 'category' );
		foreach ($select_blog_cats as $select_blog_cat) :
			$select_blog_cat_arry[$select_blog_cat->term_id] = $select_blog_cat->name;
		endforeach;
		$this->add_control(
			'select_categories',
			[
				'label' => __( 'Categories', 'ic-elements' ),
				'type' => Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => $select_blog_cat_arry,
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
				'default' => 3,
			]
		);

        $this->add_control(
            'blog_column',
            [
                'label' => __( 'Column', 'ic-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => '3',
                'options' => [
                    '2' => __( '2 Column', 'ic-elements'),
                    '3' => __( '3 Column', 'ic-elements'),
                ],
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
			'pagination',
			array(
				'label'        => esc_html__( 'Pagination', 'ic-elements' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'ic-elements' ),
				'label_off'    => esc_html__( 'Hide', 'ic-elements' ),
				'return_value' => 'true',
				'default'      => 'true',
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

		$this->add_responsive_control(
			'item_padding',
			array(
				'label'      => __( 'Margin', 'ic-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .ic-product-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

	<div class="ic-blog-main">
      <div class="ic-blog-inner row">
         
			<?php
			$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
			if($settings['select_categories']){
				$query_args = array(
					'post_type'           => 'post',
					'post_status'         => 'publish',
					'posts_per_page'      =>  $settings['post_per_page'],
					'tax_query' => array(
						array(
							'taxonomy' => 'category',
							'field' => 'id',
							'terms' => $settings['select_categories']
						)
					),
					'paged' 					 => $paged,
				  	'order'               => $settings['order'],
				  	'orderby'             => $settings['order_by'],
				);
			}else{
				$query_args = array(
					'post_type'           => 'post',
					'post_status'         => 'publish',
					'paged' 					 => $paged,
					'posts_per_page'      => $settings['post_per_page'],
				  	'order'               => $settings['order'],
				  	'orderby'             => $settings['order_by'],
				);
			}
			
			$blog_post = new \WP_Query( $query_args );
			
			if( $blog_post->have_posts() ): while( $blog_post->have_posts() ): $blog_post->the_post();

            if ($settings['blog_column'] == '2'){
                $blog_class = 'col-lg-6 col-md-12 col-12 ic-blog-item';
            }else{
                $blog_class = 'col-lg-4 col-md-6 col-12 ic-blog-item';
            }
            ?>
			
				<div class="<?php echo esc_attr($blog_class); ?>">
					<div class="ic-blog-item-inner" id="ic-blog-<?php echo get_the_ID(); ?>">

						<?php if(has_post_thumbnail()) : ?>
						<a href="<?php the_permalink(); ?>">
							<div class="ic-blog-image">
								<?php the_post_thumbnail('ic-blog');?>
							</div>
						</a>
						<?php else : ?>
							<a href="<?php the_permalink(); ?>">
								<div class="ic-blog-image">
									<img src="//placehold.it/350x357?text=<?php the_title(); ?>" alt="<?php the_title(); ?>">
								</div>
							</a>
						<?php endif; ?>

						<div class="ic-blog-content">
							<?php echo ic_blog_post_meta(); ?>
							<h4>
								<a href="<?php the_permalink(); ?>">
									<?php the_title(); ?>
								</a>
							</h4>
						</div>
						
					</div>
				</div>
			
       	<?php endwhile; endif; ?>
      
		</div>

		<?php if($settings['pagination']) : ?>
		<div class="ic-blog-pagination">
			<?php 
				echo paginate_links( array(
					'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
					'total'        => $blog_post->max_num_pages,
					'current'      => max( 1, get_query_var( 'paged' ) ),
					'format'       => '?paged=%#%',
					'type'         => 'list',
					'prev_text'   => __('<i class="fa fa-angle-double-right" aria-hidden="true"></i>','le-resto'),
					'next_text'   => __('<i class="fa fa-angle-double-right" aria-hidden="true"></i>','le-resto'),
				) );
			?>
		</div>
		<?php endif; ?>
	</div>
<?php
	}
	
}