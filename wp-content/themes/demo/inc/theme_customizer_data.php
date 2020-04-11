<?php
/** 
 * Hin Customizer data
 */


function theme_customizer( $data ) {
	 return array(
		 'panel' => array(
			'id' => 'hin',
			'name' =>  esc_html__( 'Theme Option' ),
			'priority' =>  10,
			'section' =>  array(
				'topbar_setting' => array(
					'name' =>  esc_html__( 'Topbar Switcher' , 'hin' ),
					'priority' =>  10,
					'fields' => array(
					 
						array(
							'name' => esc_html__( 'Mobile Number', 'hin' ),
							'id' => 'mobile_number',
							'default' => '000,000,000',
							'type' => 'text' 
						),
						array(
							'name' => esc_html__( 'Address', 'hin' ),
							'id' => 'add_address',
							'default' => 'Dhaka Bangladesh',
							'type' => 'text' 
						),
						array(
							'name' => esc_html__( 'Email', 'hin' ),
							'id' => 'add_email',
							'default' => 'Dhaka Bangladesh',
							'type' => 'text' 
						),
						array(
							'name' => esc_html__( 'Button Name', 'hin' ),
							'id' => 'add_button_name',
							'default' => 'Dhaka Bangladesh',
							'type' => 'text' 
						),
						array(
							'name' => esc_html__( 'Button Url', 'hin' ),
							'id' => 'add_button_url',
							'default' => 'Dhaka Bangladesh',
							'type' => 'text' 
						),

					)
				),
				'header_setting' => array(
					'name' =>  esc_html__( 'Header Setting' , 'hin' ),
					'priority' =>  11,
					'fields' => array(

						array(  
							'name' => esc_html__( 'Hin Logo' , 'hin' ),
							'id' => 'hin_logo', 
							'default' => get_template_directory_uri() . '/img/logo/logo.png',
							'type' => 'image',

						),
						array( 

							'name' => esc_html__( 'Hin slag' , 'hin' ),
							'id' => 'hin_slogan', 
							'type' => 'text',
							'default' =>  'Just Another Wordpress Website'

						), 
						array(  
							'name' => esc_html__( 'Breadcrumb Background Image' , 'hin' ),
							'id' => 'hin_breadcrumb_image', 
							'default' => get_template_directory_uri() . '/img/block/hero-block-right.jpg',
							'type' => 'image',

						),
					)
				),

				'Footer_Setting' => array(

					'name' =>  esc_html__( 'Footer Setting' , 'hin' ),
					'priority' =>  11,
					'fields' => array(

						array(
							'name' => esc_html__( 'Facebook Url', 'prefab' ),
							'id' => 'topbar_fb_url',
							'default' => '#',
							'type' => 'text' 
						),
						array(
							'name' => esc_html__( 'Twitter Url', 'prefab' ),
							'id' => 'topbar_twitter_url',
							'default' => '#',
							'type' => 'text' 
						),
						array(
							'name' => esc_html__( 'Google Plus Url', 'prefab' ),
							'id' => 'topbar_google_url',
							'default' => '#',
							'type' => 'text' 
						),
						array(
							'name' => esc_html__( 'Instagram Url', 'prefab' ),
							'id' => 'topbar_instagram_url',
							'default' => '#',
							'type' => 'text' 
						),
						array(
							'name' => esc_html__( 'Google Plus Url', 'prefab' ),
							'id' => 'topbar_google_url',
							'default' => '#',
							'type' => 'text' 
						),
						array(
							'name' => esc_html__( 'Footer Short Details', 'hin' ),
							'id' => 'footer_short_details',
							'default' => 'Ham followed now ecstatic',
							'type' => 'textarea' 
						),
						array(
							'name' => esc_html__( 'Copy Right', 'hin' ),
							'id' => 'copy_right',
							'default' => '2019 All Rights Reserved',
							'type' => 'text' 
						),

					)
				),


			), 
		 )
	);
 }

 add_filter('theme_customizer_data','theme_customizer');