<?php
if( function_exists( 'vc_map' ) ) :
vc_map( array(
	"name" => __( "About-v2", 'all-study'),
	"base" => "all_study_about_v2",
	"icon" => "fa fa-font all-study-icon",
	"description" => __("", 'all-study'),
	"class" => "",
	"category" => __( "Custom Addons", 'all-study'),
	"params" => array(
		array(
	        "type"			=> "param_group",
	        "heading"		=> esc_html__( "About", "all-study" ),
	        "param_name"	=> "abouts",
	        "description"	=> esc_html__( "Add your about here", "all-study" ),
	        "params"		=> array(
        		array(
        			"type"			=> "textfield",
        			"heading"		=> esc_html__( "Title", "all-study" ),
        			"param_name"	=> "title",
        			"description" => __("Enter about title here", 'all-study'),
        		),
        		array(
					"type" => "textarea",
					"class" => "",
					"heading" => __("About Info", 'all-study'),
					"param_name" => "info",
					"value" => "",
					"description" => __("Enter about info here", 'all-study'),
				),
	        ),
    	),
		
	)
));  

class WPBakeryShortcode_all_study_about_v2 extends WPBakeryShortcode {
	protected function content( $atts, $content = null ) {
		extract( shortcode_atts( array(
            'abouts' => '',
			'animation' => '',
		), $atts ) );
		//for group field
		$abouts = vc_param_group_parse_atts($atts['abouts']);
        $atts['content'] = $content;
		ob_start();

		all_study_about_v2( $abouts, $animation);
		
        return ob_get_clean();
	}
}
endif;

function all_study_about_v2( $abouts, $animation) { ?>

    <?php if ($abouts) : ?>
	<div class="about-two">
		<div class="left">
			<div class="left-in">
				<ul>
					<?php foreach ($abouts as $about) :?>
					<li>
						<div class="content">
							<h4><?php echo esc_html($about['title']); ?></h4>
							<p><?php echo esc_html($about['info']); ?></p>
						</div>
					</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
  	</div>

<?php endif; }