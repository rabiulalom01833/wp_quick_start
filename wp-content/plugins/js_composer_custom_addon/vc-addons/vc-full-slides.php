<?php

vc_map( array(
      "name" => __( "Full Slider", "my-text-domain" ),
      "base" => "full_slide",
	   "icon" => get_template_directory_uri() . "/assets/img/akij-group-logo.png",
      "category" => __( "Custom Addons", "my-text-domain"),
      "params" => array(
         array(
            "type" => "textfield",
            "heading" => __( "Count", "my-text-domain" ),
            "param_name" => "count",
            "value" => __( "1", "my-text-domain" ),
            "description" => __( "Type slider number", "my-text-domain" )
         ),
		 
		   
		 
      )
   ) );
   
   
   ?>