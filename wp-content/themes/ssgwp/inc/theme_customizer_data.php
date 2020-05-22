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
				 
				'header_setting' => array(
					'name' =>  esc_html__( 'Header Setting' , 'hin' ),
					'priority' =>  11,
					'fields' => array(

						array(  
							'name' => esc_html__( 'Logo' , 'hin' ),
							'id' => 'main_logo', 
							'default' => get_template_directory_uri() . '/img/logo.png',
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
							'name' => esc_html__( 'Instagram Url', 'prefab' ),
							'id' => 'topbar_instagram_url',
							'default' => '#',
							'type' => 'text' 
						),
					 
						array(
							'name' => esc_html__( 'Mobile Number', 'hin' ),
							'id' => 'mobile_no',
							'default' => '416.477.2737',
							'type' => 'text' 
						),
						array(
							'name' => esc_html__( 'Email No', 'hin' ),
							'id' => 'email_no',
							'default' => 'contact@thesamplesaleguys.com',
							'type' => 'text' 
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