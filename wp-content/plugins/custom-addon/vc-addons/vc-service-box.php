<?php

vc_map( array(
      "name" => __( "Service Box", "my-text-domain" ),
      "base" => "service_boxs_details",
	   "icon" => get_template_directory_uri() . "/assets/img/akij-group-logo.png",
      "category" => __( "Custom Addons", "my-text-domain"),
      "params" => array(
          
   
         array(
            "type" => "attach_image",
            "heading" => __( "Services Image", "my-text-domain" ),
            "param_name" => "service_img", 
            "description" => __( "add Image", "my-text-domain" )
         ),

         array(
            "type" => "textfield",
            "heading" => __( "Services Title", "my-text-domain" ),
            "param_name" => "section_title_inner", 
            "description" => __( "add title", "my-text-domain" )
         ),

         array(
            "type" => "textfield",
            "heading" => __( "Services Sub Title", "my-text-domain" ),
            "param_name" => "section_sub_title_inner", 
            "description" => __( "add Sub title", "my-text-domain" )
         ),

         array(
            "type" => "textfield",
            "heading" => __( "See More page link", "my-text-domain" ),
            "param_name" => "read_more_url", 
            "description" => __( "add link", "my-text-domain" )
         ),

 
      )
   ) );