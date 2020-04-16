<?php

vc_map( array(
      "name" => __( "Section Title", "my-text-domain" ),
      "base" => "section_shortcode_title",
	   "icon" => get_template_directory_uri() . "/assets/img/akij-group-logo.png",
      "category" => __( "Custom Addons", "my-text-domain"),
      "params" => array(
          
   
         array(
            "type" => "textfield",
            "heading" => __( "Section Title", "my-text-domain" ),
            "param_name" => "section_title", 
            "description" => __( "add title", "my-text-domain" )
         ),
         array(
            "type" => "textarea",
            "heading" => __( "Section Details", "my-text-domain" ),
            "param_name" => "section_details", 
            "description" => __( "add Details", "my-text-domain" )
         ),
 
 
      )
   ) );