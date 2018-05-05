<?php

	if(!function_exists ('tvlgiao_wpdance_customize_header')){
		function tvlgiao_wpdance_customize_header($wp_customize){
			/*--------------------------------------------------------------*/
			/*						 CUSTOM HEADER 							*/
			/*--------------------------------------------------------------*/
		    $wp_customize->add_section( 'tvlgiao_wpdance_header_config' , array(
 				'title'       		=> esc_html__( 'WPDANCE - Header', 'wpdance' ),
 				'description' 		=> esc_html__( 'Custom header site.' , 'wpdance' ),
 				'priority'    		=> 505,
 			));
 			//---------------------------------------------------------------//

 			//Content Config Header

 			$wp_customize->add_setting('tvlgiao_wpdance_header_logo_url', array(
				'default'        	=> TVLGIAO_WPDANCE_THEME_IMAGES.'/wpdance_logo.png',
				'sanitize_callback' => 'esc_url_raw',
				'type' 				=> 'theme_mod'
			));
		    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'tvlgiao_wpdance_header_logo_url', array(
		        'label'    			=> esc_html__( 'Logo', 'wpdance' ),
		        'section'  			=> 'tvlgiao_wpdance_header_config',
		        'settings' 			=> 'tvlgiao_wpdance_header_logo_url',
		    )));

        	$wp_customize->add_setting('tvlgiao_wpdance_header_layout', array(
        		'default' 			=> -1,
        		'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
       			'capability' 		=> 'edit_theme_options'		
        	));
	  		$wp_customize->add_control( new Theme_Slug_Custom_Radio_Image_Control($wp_customize,'tvlgiao_wpdance_header_layout',array(
            	'label'          	=> esc_html__( 'Select the layout', 'wpdance' ),
            	'section'        	=> 'tvlgiao_wpdance_header_config',
            	'settings'       	=> 'tvlgiao_wpdance_header_layout',
            	'choices'			=> tvlgiao_wpdance_get_html_choices('wpdance_header_layout',TVLGIAO_WPDANCE_THEME_IMAGES . '/headers/wd_header_default.jpg','url_image')
        	)));

	  		//Sticky Menu
			$wp_customize->add_setting('tvlgiao_wpdance_header_sticky_menu', array(
				'default'        	=> 'yes',
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));
			$wp_customize->add_control( 'tvlgiao_wpdance_control_header_sticky_menu', array(
				'label'   			=> 'Sticky Menu Header',
				'section'  			=> 'tvlgiao_wpdance_header_config',
				'settings' 			=> 'tvlgiao_wpdance_header_sticky_menu',
				'type'    			=> 'select',
				'choices' 			=> array(
					'1'			=> "YES",
					'0'			=> "NO"
				)
			));

			// Hide Title
			$wp_customize->add_setting('tvlgiao_wpdance_hide_site_title', array(
				'default'        	=> '1',
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));
			$wp_customize->add_control( 'tvlgiao_wpdance_control_hide_site_title', array(
				'label'   			=> 'Hide Site Title',
				'section'  			=> 'tvlgiao_wpdance_header_config',
				'settings' 			=> 'tvlgiao_wpdance_hide_site_title',
				'type'    			=> 'select',
				'choices' 			=> array(
					'1'			=> "YES",
					'0'			=> "NO"
				)
			));
		}
	}
	add_action('customize_register','tvlgiao_wpdance_customize_header' );
?>