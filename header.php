<?php
/**
 * The Header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package Wordpress
 * @since wpdance
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

	<meta charset="<?php bloginfo( 'charset' ); ?>"/>
	
	<meta name="viewport" content="width=device-width, initial-scale=1"/>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	
	<meta name="google-site-verification" content="QV563q1bZvkitvaLignqzEVoTMA6mwlSt2DbRQpzagE" />
	
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
	<link href="https://fonts.googleapis.com/css?family=Merriweather" rel="stylesheet">

</head>
<body <?php body_class(); ?>>
<div id="loader-wrapper">
	<div id="loader"></div>
</div>	
<div class="body-wrapper">
<header id="header" class="header">
	<div class="hidden-xs hidden-sm"><?php do_action('tvlgiao_wpdance_header_init_action'); ?></div>
	<div class="header-mobile visible-xs visible-sm"><?php do_action('tvlgiao_wpdance_menu_mobile') ?></div>
</header> <!-- END HEADER  -->
<div>
	<div class="popup">
	    <div class="wrapper-popup">
	       <div class="video-frame">
		       <div class="video-content">
			        <iframe allowFullScreen>
			            <p><?php esc_html_e('Your browser does not support iframes.','wpdance'); ?></p>
			        </iframe>
				<div class="close">X</div>
			   </div>
		   </div>
	    </div>
	</div>