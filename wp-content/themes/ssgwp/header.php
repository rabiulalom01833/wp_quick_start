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
	 
	$main_logo = get_theme_mod('main_logo', $logo);

	?>
</head>

<body <?php body_class(); ?>>
 

    <div class="header-menu">
        <div class="top-logo">
            <a href="index.html" class="header-logo">
            <img src="<?php print esc_url($main_logo); ?>" alt="">
            </a>
        </div>
        <div class="nav-button"></div>
        <nav class="top-nav">
            <div class="container">  

                <?php 
                                        
                    wp_nav_menu(array(
                        'theme_location'=>'topmenu', 
                    ));
                
                ?>
                <?php 
                                        
                    wp_nav_menu(array(
                        'theme_location'=>'footermenu', 
                        'menu_class'=>'mobile-footer'
                    ));
                
                ?>
                
            </div>
        </nav>
    </div>
   