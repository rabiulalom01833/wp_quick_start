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
class Ic_Wellness extends Widget_Base {

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
		return 'ic-wellness';
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
		return __( 'IC Wellness', 'ic-elements' );
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
		return 'fas fa-spa';
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

        $this->add_control(
            'box_alignment',
            array(
                'label'        => esc_html__( 'Reverse Alignment', 'ic-elements' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'ic-elements' ),
                'label_off'    => esc_html__( 'No', 'ic-elements' ),
                'return_value' => 'true',
                'default'      => 'true',
            )
        );

        $this->add_control(
            'image',
            array(
                'label'   => esc_html__( 'Image', 'ic-elements' ),
                'type'    => Controls_Manager::MEDIA,
                'dynamic' => array( 'active' => true ),
            )
        );
        $this->add_control(
            'title', [
                'label' => __( 'Title', 'ic-elements' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );
        $this->add_control(
            'person', [
                'label' => __( 'Max Person', 'ic-elements' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );
        $this->add_control(
            'price', [
                'label' => __( 'Price', 'ic-elements' ),
                'type' => Controls_Manager::TEXT,
            ]
        );
        $this->add_control(
            'schedule_title', [
                'label' => __( 'Schedule Title', 'ic-elements' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

		$repeater = new Repeater();

        $repeater->add_control(
            'title', [
                'label' => __( 'Title', 'ic-elements' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

		$repeater->add_control(
			'time', [
				'label' => __( 'Time', 'ic-elements' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Time', 'ic-elements' ),
			]
		);


		$this->add_control(
			'schedule_list',
			[
				'label' => __( 'Schedules', 'ic-elements' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'time' => __( '7:15 am – 7:45 am', 'ic-elements' ),
						'title' => __( 'Morning Chakra Meditation', 'ic-elements' ),
					],
					[
						'time' => __( '7:45 am – 8:30 am', 'ic-elements' ),
						'title' => __( 'Cacao Ceremony', 'ic-elements' ),
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);

        $this->add_control(
            'btn_title',
            [
                'label' => __( 'Button Label', 'ic-elements' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Button', 'ic-elements' ),
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
                'type' => Controls_Manager::SELECT,
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
                'label' => __( 'Button Alignment', 'ic-elements' ),
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
                    '{{WRAPPER}} .ic-button-main' => 'text-align: {{VALUE}};',
                ],
                'default' => 'left',
                'toggle' => true,
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
        $button_style = $this->get_settings_for_display('button_style');

        $target = $settings['button_link']['is_external'] ? ' target="_blank"' : '';
        $nofollow = $settings['button_link']['nofollow'] ? ' rel="nofollow"' : '';
		?>

		<div class="ic-wellness">
            <div class="row <?php echo $settings['box_alignment'] == true ? 'row-reverse' :''; ?>">

                <?php if ($settings['image']['url']) : ?>
                <div class="col-lg-6 col-md-12 col-12">
                    <div class="ic-wellness-image">
                        <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'full', 'image' ); ?>
                    </div>
                </div>
                <?php endif; ?>

                <div class="col-lg-6 col-md-12 col-12">
                    <div class="ic-wellness-content">
                        <?php if ($settings['title']) ?>
                        <h3 class="ic-wellness-title"><?php echo $settings['title']; ?></h3>

                        <?php if ($settings['person']) ?>
                        <h3 class="ic-wellness-max-person"><?php echo $settings['person']; ?></h3>

                        <?php if ($settings['price']) ?>
                        <h3 class="ic-wellness-price"><?php echo $settings['price']; ?></h3>

                        <?php if ($settings['schedule_list']) : ?>
                        <div class="ic-wellness-schedule">
                            <h4 class="ic-schedule-title"><?php echo $settings['schedule_title']; ?></h4>
                            <ul class="ic-schedule-list">
                                <?php foreach($settings['schedule_list'] as $key => $item) : if($item['time'] && $item['title']) : ?>
                                <li>
                                    <span class="ic-schedule-time"><?php echo '( ' . $item['time'] . ' )'; ?></span>
                                    <span>-</span>
                                    <span class="ic-schedule-list-title"><?php echo $item['title']; ?></span>
                                </li>
                                <?php endif; endforeach; ?>
                            </ul>
                        </div>
                        <?php endif; ?>

                        <div class="ic-button-main">
                            <a href="<?php echo esc_url($settings['button_link']['url']); ?>" <?php echo $target; ?> <?php echo $nofollow; ?> class="ic-hover-color <?php if ($button_style == 'style-1'): ?>custom-btn<?php else: ?>custom-btn-rvs<?php endif; ?>"><?php echo $settings['btn_title']; ?></a>
                        </div>
                    </div>
                </div>
            </div>
		</div>

<?php
	}
}