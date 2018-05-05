<?php
	if(!function_exists ('tvlgiao_wpdance_customize_theme_option')){
		function tvlgiao_wpdance_customize_theme_option($wp_customize){
			/*--------------------------------------------------------------*/
			/*					 CUSTOM STYLING OPTION						*/
			/*--------------------------------------------------------------*/
		    $wp_customize->add_panel( 'tvlgiao_wpdance_theme_option', array(
		        'title' 			=> esc_html__( 'WPDANCE - Theme Option', 'wpdance' ),
		        'description' 		=> esc_html__( 'Custom theme.', 'wpdance'),
		        'priority' 			=> 500,
		    ));
 			$wp_customize->add_section( 'tvlgiao_wpdance_breadcrumb_section' , array(
 				'title'       		=> esc_html__( 'Breadcrumb Config', 'wpdance' ),
 				'description' 		=> esc_html__( '', 'wpdance'),
 				'panel'	 			=> 'tvlgiao_wpdance_theme_option',
 				'priority'    		=> 1,
 			));
 			$wp_customize->add_section( 'tvlgiao_wpdance_page_404' , array(
 				'title'       		=> esc_html__( 'Page 404 Config', 'wpdance' ),
 				'description' 		=> esc_html__( '', 'wpdance'),
 				'panel'	 			=> 'tvlgiao_wpdance_theme_option',
 				'priority'    		=> 1,
 			));
			$wp_customize->add_section( 'tvlgiao_wpdance_scroll_button_section' , array(
 				'title'       		=> esc_html__( 'Scroll Button', 'wpdance' ),
 				'description' 		=> esc_html__( 'Scroll Button', 'wpdance'),
 				'panel'	 			=> 'tvlgiao_wpdance_theme_option',
 				'priority'    		=> 1,
 			));
			$wp_customize->add_section( 'tvlgiao_wpdance_adv_custom_section' , array(
 				'title'       		=> esc_html__( 'Advertise', 'wpdance' ),
 				'description' 		=> esc_html__( 'Advertise', 'wpdance'),
 				'panel'	 			=> 'tvlgiao_wpdance_theme_option',
 				'priority'    		=> 1,
 			));
			/*--------------------------------------------------------------*/
			/*					 CONTENT CONFIG 							*/
			/*--------------------------------------------------------------*/
			$wp_customize->add_setting('tvlgiao_wpdance_breadcrumb', array(
        		'default' 			=> 'breadcrumb_default',
        		'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
       			'capability' 		=> 'edit_theme_options'		
        	));
	  		$wp_customize->add_control( new Theme_Slug_Custom_Radio_Image_Control($wp_customize,'tvlgiao_wpdance_breadcrumb',array(
            	'label'          	=> esc_html__( 'Select the layout breadcrumb', 'wpdance' ),
            	'section'        	=> 'tvlgiao_wpdance_breadcrumb_section',
            	'settings'       	=> 'tvlgiao_wpdance_breadcrumb',
            	'choices'			=> array(
					'breadcrumb_default' 	=> TVLGIAO_WPDANCE_THEME_IMAGES . '/breadcrumb/breadcrumb_default.png',
					'breadcrumb_banner'		=> TVLGIAO_WPDANCE_THEME_IMAGES . '/breadcrumb/breadcrumb_banner.png'
				)
        	)));
 			$wp_customize->add_setting('tvlgiao_wpdance_banner_breadcrumb', array(
				'default'        	=> TVLGIAO_WPDANCE_THEME_IMAGES.'/baner_breadcrumb.jpg',
				'sanitize_callback' => 'esc_url_raw',
				'type' 				=> 'theme_mod'
			));
		    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'tvlgiao_wpdance_banner_breadcrumb', array(
		        'label'    			=> esc_html__( 'Banner Breadcrumb', 'wpdance' ),
		        'section'  			=> 'tvlgiao_wpdance_breadcrumb_section',
		        'settings' 			=> 'tvlgiao_wpdance_banner_breadcrumb',
		    )));

		    /*Page 404*/
			$wp_customize->add_setting('tvlgiao_wpdance_page_404_select_style', array(
				'default'        	=> 'bg_color',
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));
			$wp_customize->add_control( 'tvlgiao_wpdance_control_header_sticky_menu', array(
				'label'   			=> esc_html__( 'Background Image Or Color', 'wpdance' ),
				'section'  			=> 'tvlgiao_wpdance_page_404',
				'settings' 			=> 'tvlgiao_wpdance_page_404_select_style',
				'type'    			=> 'select',
				'choices' 			=> array(
					'bg_image'			=> esc_html__( 'Background Image', 'wpdance' ),
					'bg_color'			=> esc_html__( 'Background Color', 'wpdance' ),
				)
			));
			$wp_customize->add_setting( 'tvlgiao_wpdance_page_404_bg_color' , array(
				'default'           =>  "#fff",
				'sanitize_callback' => 'sanitize_hex_color',
				'transport'         => 'postMessage',
			));
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'tvlgiao_wpdance_page_404_bg_color' , array(
				'label'      		=>  esc_html__( 'Select Color Background', 'wpdance' ),
		        'section'  			=> 'tvlgiao_wpdance_page_404',
		        'settings' 			=> 'tvlgiao_wpdance_page_404_bg_color',
			)));
 			$wp_customize->add_setting('tvlgiao_wpdance_page_404_bg_image', array(
				'default'        	=> TVLGIAO_WPDANCE_THEME_IMAGES.'/bg_404.jpg',
				'sanitize_callback' => 'esc_url_raw',
				'type' 				=> 'theme_mod'
			));
		    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'tvlgiao_wpdance_page_404_bg_image', array(
		        'label'    			=> esc_html__('Select Background Image', 'wpdance' ),
		        'section'  			=> 'tvlgiao_wpdance_page_404',
		        'settings' 			=> 'tvlgiao_wpdance_page_404_bg_image',
		    )));
		    /* Scroll Button */
			$wp_customize->add_setting('tvlgiao_wpdance_scroll_button', array(
				'default'        	=> 'no',
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));
			$wp_customize->add_control( 'tvlgiao_wpdance_scroll_button_control', array(
				'label'   			=> esc_html__('Scroll Button', 'wpdance'),
				'description' 		=> esc_html__('Enable/Disable scroll button in website', 'wpdance'),
				'section'  			=> 'tvlgiao_wpdance_scroll_button_section',
				'settings' 			=> 'tvlgiao_wpdance_scroll_button',
				'type'    			=> 'select',
				'choices' 			=> array(
					'no'		=> "Disable",	
					'yes'		=> "Enable"
				)
			));
			/* Adv */
			$wp_customize->add_setting('tvlgiao_wpdance_adv_number',array(
		    	'default'           => '5',
		    	'sanitize_callback' => 'tvlgiao_wpdance_sanitize_html'
			));
    
    		$wp_customize->add_control('tvlgiao_wpdance_adv_number_control',array(
            	'label'         	=> esc_html__( 'Number Adv', 'wpdance' ),
            	'settings'      	=> 'tvlgiao_wpdance_adv_number',
            	'section'       	=> 'tvlgiao_wpdance_adv_custom_section',
            	'type'          	=> 'textarea',
            	'description'   	=> esc_html__( '', 'wpdance' )
        	));

		}
	}
	add_action('customize_register','tvlgiao_wpdance_customize_theme_option' );
?>
