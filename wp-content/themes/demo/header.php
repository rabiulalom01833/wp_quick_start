<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package demo
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,500;0,600;0,700;0,900;1,200;1,300&display=swap" rel="stylesheet">
	<?php wp_head();
	
	$mobile_number = get_theme_mod('mobile_number','000,000,00');
    $add_address = get_theme_mod('add_address','Dhaka Bangladesh');
    $add_email = get_theme_mod('add_email','abc@gmail.com');
    $add_button_name = get_theme_mod('add_button_name','Demo Button');
    $add_button_url = get_theme_mod('add_button_url','Type url');
	$logo = get_template_directory_uri() .'./img/home1/logo.png';
	$hin_logo = get_theme_mod('hin_logo', $logo);

	?>
</head>

<body <?php body_class(); ?>>
 
<header class="header-top-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 col-sm-9">
                <div class="header-content">
                    <ul class="header-contact">
                        <li>
                            <i class="fas fa-phone"></i>
                            <a href="#"><?php print esc_html__($mobile_number); ?></a>
                        </li>
                        <li>
                            <i class="fas fa-map-marker-alt"></i>
                            <a href="#"><?php print esc_html__($add_address); ?></a>
                        </li>
                        <li>
                            <i class="far fa-envelope"></i>
                            <a href="#"><?php print esc_html__($add_email); ?></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-2 col-sm-3">
                <a href="<?php print esc_url($add_button_url); ?>" class="header-top-right-text text-center">
                     <?php print esc_html__($add_button_name); ?>
                </a>
            </div>
        </div>
    </div>
</header>

<nav class="navbar navbar-expand-lg navbar-light menu-blog" id="navigation">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="<?php print esc_url($hin_logo); ?>" alt="">
            </a>

            <div class="collapse navbar-collapse"> 
                <?php 
                                        
                    wp_nav_menu(array(
                        'theme_location'=>'primary',
                        'menu_class'=>'nav navbar-nav ml-auto', 
                    ));
                    
                ?>
            </div>  

            
        </div>
    </nav>
    