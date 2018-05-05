<?php
	if(!function_exists ('tvlgiao_wpdance_customize_footer')){
		function tvlgiao_wpdance_customize_footer($wp_customize){
			/*--------------------------------------------------------------*/
			/*						 CUSTOM FOOTER	 						*/
			/*--------------------------------------------------------------*/
			$wp_customize->add_section( 'tvlgiao_wpdance_footer_config' , array(
 				'title'       		=> esc_html__( 'WPDANCE - Footer', 'wpdance' ),
 				'description' 		=> 'Custom footer site.',
 				'priority'    		=> 510,
 			));
			/*--------------------------------------------------------------*/
			/*						 CONTENT CONFIG FOOTER 					*/
			/*--------------------------------------------------------------*/
			// Layout Footer
 			$wp_customize->add_setting('tvlgiao_wpdance_footer_layout', array(
        		'default' 			=> -1,
        		'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
       			'capability' 		=> 'edit_theme_options'		
        	));
	  		$wp_customize->add_control( new Theme_Slug_Custom_Radio_Image_Control($wp_customize,'tvlgiao_wpdance_footer_layout',array(
            	'label'          	=> esc_html__( 'Select the layout', 'wpdance' ),
            	'section'        	=> 'tvlgiao_wpdance_footer_config',
            	'settings'       	=> 'tvlgiao_wpdance_footer_layout',
            	'choices'			=> tvlgiao_wpdance_get_html_choices('wpdance_footer_layout',TVLGIAO_WPDANCE_THEME_IMAGES.'/footers/wd_footer_default.jpg','url_image')
        	)));
	  		// Text Copyright 
			$wp_customize->add_setting('tvlgiao_wpdance_footer_copyright_text',array(
		    	'default'           => sprintf(__( 'Copyright %s. All rights reserved.', 'wpdance' ), esc_html( get_bloginfo('name')) ),
		    	'sanitize_callback' => 'tvlgiao_wpdance_sanitize_html'
			));
    
    		$wp_customize->add_control('tvlgiao_wpdance_footer_copyright_text_control',array(
            	'label'         	=> esc_html__( 'Footer copyright text', 'wpdance' ),
            	'settings'      	=> 'tvlgiao_wpdance_footer_copyright_text',
            	'section'       	=> 'tvlgiao_wpdance_footer_config',
            	'type'          	=> 'textarea',
            	'description'   	=> esc_html__( 'Copyright or other text to be displayed in the site footer. HTML allowed.', 'wpdance' )
        	));
		}
	}
	add_action('customize_register','tvlgiao_wpdance_customize_footer' );
?>