<?php
	if(!function_exists ('tvlgiao_wpdance_customize_product')){
		function tvlgiao_wpdance_customize_product($wp_customize){
			/*--------------------------------------------------------------*/
			/*						 CUSTOM PRODUCT  						*/
			/*--------------------------------------------------------------*/
			$wp_customize->add_panel( 'tvlgiao_wpdance_product_config', array(
		        'title' 			=> esc_html__( 'WPDANCE - Product Config', 'wpdance' ),
		        'description' 		=> esc_html__( 'Theme Sidebar Layout', 'wpdance'),
		        'priority' 			=> 520,
		    ));
 			$wp_customize->add_section( 'tvlgiao_wpdance_genneral_product' , array(
 				'title'       		=> esc_html__( 'Genneral Product Config', 'wpdance' ),
 				'description' 		=> esc_html__('Genneral Product Config', 'wpdance') ,
 				'panel'	 			=> 'tvlgiao_wpdance_product_config',
 				'priority'    		=> 5,
 			));
 			$wp_customize->add_section( 'tvlgiao_wpdance_archive_product' , array(
 				'title'       		=> esc_html__( 'Archive Product', 'wpdance' ),
 				'description' 		=> esc_html__('Custom archive product page', 'wpdance'),
 				'panel'	 			=> 'tvlgiao_wpdance_product_config',
 				'priority'    		=> 10,
 			));
 			$wp_customize->add_section( 'tvlgiao_wpdance_single_product' , array(
 				'title'       		=> esc_html__( 'Single Product', 'wpdance' ),
 				'description' 		=> esc_html__('Custom single product page', 'wpdance') ,
 				'panel'	 			=> 'tvlgiao_wpdance_product_config',
 				'priority'    		=> 15,
 			));
 			$wp_customize->add_section( 'tvlgiao_wpdance_cart_product' , array(
 				'title'       		=> esc_html__( 'Page Cart', 'wpdance' ),
 				'description' 		=> esc_html__('Custom page cart product', 'wpdance') ,
 				'panel'	 			=> 'tvlgiao_wpdance_product_config',
 				'priority'    		=> 15,
 			));

 			//---------------------------------------------------------------//
 			/*Get list sidebar*/
 			global $wp_registered_sidebars;
	  		$arr_sidebar = array();
	  		$i = 0;
	  		foreach ( $wp_registered_sidebars as $sidebar ){
	  			if($i==0){
					$default = $sidebar['id'];
					$i++;
				}
	  			$arr_sidebar[$sidebar['id']] = $sidebar['name'];
	  		}
	  		//Genneral Product Config
			$wp_customize->add_setting('tvlgiao_wpdance_genneral_catalog_mode', array(
				'default'        	=> 'no',
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));
			$wp_customize->add_control( 'tvlgiao_wpdance_genneral_catalog_mode_control', array(
				'label'   			=> esc_html__( 'Catalog Mod', 'wpdance' ),
				'description' 		=> esc_html__( 'Enable/Disable Catalog Mod(Hide All "Add To Cart" button on your site)', 'wpdance'),
				'section'  			=> 'tvlgiao_wpdance_genneral_product',
				'settings' 			=> 'tvlgiao_wpdance_genneral_catalog_mode',
				'type'    			=> 'select',
				'choices' 			=> array(
					'no'		=> "Disable",	
					'yes'		=> "Enable"

				)
			));	
			$wp_customize->add_setting('tvlgiao_wpdance_genneral_show_title', array(
				'default'        	=> 'yes',
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));
			$wp_customize->add_control( 'tvlgiao_wpdance_genneral_show_title_control', array(
				'label'   			=> esc_html__( 'Show Title Product', 'wpdance' ),
				'description' 		=> esc_html__( 'Show/Hile title product', 'wpdance'),
				'section'  			=> 'tvlgiao_wpdance_genneral_product',
				'settings' 			=> 'tvlgiao_wpdance_genneral_show_title',
				'type'    			=> 'select',
				'choices' 			=> array(
					'yes'		=> "Show",	
					'no'		=> "Hide"
				)
			));
			$wp_customize->add_setting('tvlgiao_wpdance_genneral_show_rating', array(
				'default'        	=> 'yes',
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));
			$wp_customize->add_control( 'tvlgiao_wpdance_genneral_show_rating_control', array(
				'label'   			=> esc_html__( 'Show Rating Product', 'wpdance' ),
				'description' 		=> esc_html__( 'Show/Hile rating product', 'wpdance'),
				'section'  			=> 'tvlgiao_wpdance_genneral_product',
				'settings' 			=> 'tvlgiao_wpdance_genneral_show_rating',
				'type'    			=> 'select',
				'choices' 			=> array(
					'yes'		=> "Show",	
					'no'		=> "Hide"
				)
			));
			$wp_customize->add_setting('tvlgiao_wpdance_genneral_show_price', array(
				'default'        	=> 'yes',
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));
			$wp_customize->add_control( 'tvlgiao_wpdance_genneral_show_price_control', array(
				'label'   			=> esc_html__( 'Show Price Product', 'wpdance' ),
				'description' 		=> esc_html__( 'Show/Hile price product', 'wpdance'),
				'section'  			=> 'tvlgiao_wpdance_genneral_product',
				'settings' 			=> 'tvlgiao_wpdance_genneral_show_price',
				'type'    			=> 'select',
				'choices' 			=> array(
					'yes'		=> "Show",	
					'no'		=> "Hide"
				)
			));
			$wp_customize->add_setting('tvlgiao_wpdance_genneral_show_meta', array(
				'default'        	=> 'yes',
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));
			$wp_customize->add_control( 'tvlgiao_wpdance_genneral_show_meta_control', array(
				'label'   			=> esc_html__( 'Show Meta Product', 'wpdance' ),
				'description' 		=> esc_html__( 'Show/Hile sale/featured product', 'wpdance'),
				'section'  			=> 'tvlgiao_wpdance_genneral_product',
				'settings' 			=> 'tvlgiao_wpdance_genneral_show_meta',
				'type'    			=> 'select',
				'choices' 			=> array(
					'yes'		=> "Show",	
					'no'		=> "Hide"
				)
			));	 
 			$wp_customize->add_setting('tvlgiao_wpdance_genneral_product_hover_button', array(
        		'default' 			=> 'wd-hover-style-1',
        		'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
       			'capability' 		=> 'edit_theme_options'		
        	));
	  		$wp_customize->add_control( new Theme_Slug_Custom_Radio_Image_Control($wp_customize,'tvlgiao_wpdance_genneral_product_hover_button',array(
            	'label'          	=> esc_html__( 'Select Style Hover Product', 'wpdance' ),
            	'section'        	=> 'tvlgiao_wpdance_genneral_product',
            	'settings'       	=> 'tvlgiao_wpdance_genneral_product_hover_button',
            	'choices'			=> array(
					'wd-hover-style-1' 	=> TVLGIAO_WPDANCE_THEME_IMAGES . '/products/wd-hover-style-1.png',
					'wd-hover-style-2'	=> TVLGIAO_WPDANCE_THEME_IMAGES . '/products/wd-hover-style-2.png',
					'wd-hover-style-3'	=> TVLGIAO_WPDANCE_THEME_IMAGES . '/products/wd-hover-style-3.png'
				)
        	)));

 			//Content Custom Single Product
 			$wp_customize->add_setting('tvlgiao_wpdance_single_product_layout', array(
        		'default' 			=> '0-0-0',
        		'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
       			'capability' 		=> 'edit_theme_options'		
        	));
	  		$wp_customize->add_control( new Theme_Slug_Custom_Radio_Image_Control($wp_customize,'tvlgiao_wpdance_single_product_layout',array(
            	'label'          	=> esc_html__( 'Select the layout', 'wpdance' ),
            	'section'        	=> 'tvlgiao_wpdance_single_product',
            	'settings'       	=> 'tvlgiao_wpdance_single_product_layout',
            	'choices'			=> array(
					'0-0-0' 	=> TVLGIAO_WPDANCE_THEME_IMAGES . '/layouts/wd_fullwidth.png',
					'1-0-0'		=> TVLGIAO_WPDANCE_THEME_IMAGES . '/layouts/wd_left_sidebar.png',
					'0-0-1'		=> TVLGIAO_WPDANCE_THEME_IMAGES . '/layouts/wd_right_sidebar.png',
					'1-0-1'		=> TVLGIAO_WPDANCE_THEME_IMAGES . '/layouts/wd_left_right.png'
				)
        	)));
			$wp_customize->add_setting('tvlgiao_wpdance_single_product_sidebar_left', array(
				'default'        	=> $default,
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));
			$wp_customize->add_control( 'tvlgiao_wpdance_single_product_sidebar_left_select_control', array(
				'label'   			=> 'Select left sidebar',
				'section'  			=> 'tvlgiao_wpdance_single_product',
				'settings' 			=> 'tvlgiao_wpdance_single_product_sidebar_left',
				'type'    			=> 'select',
				'choices' 			=> $arr_sidebar,
			));
			$wp_customize->add_setting('tvlgiao_wpdance_single_product_sidebar_right', array(
				'default'        	=> $default,
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));
			$wp_customize->add_control( 'tvlgiao_wpdance_single_product_sidebar_right_select_control', array(
				'label'   			=> 'Select right sidebar',
				'section'  			=> 'tvlgiao_wpdance_single_product',
				'settings' 			=> 'tvlgiao_wpdance_single_product_sidebar_right',
				'type'    			=> 'select',
				'choices' 			=> $arr_sidebar,
			));
        	$wp_customize->add_setting('tvlgiao_wpdance_single_additional_image', array(
        		'default' 			=> 'bottom',
        		'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
       			'capability' 		=> 'edit_theme_options'		
        	));
			$wp_customize->add_control( 'tvlgiao_wpdance_control_additional_image', array(
				'label'   			=> esc_html__( 'Select the position', 'wpdance' ),
				'section'  			=> 'tvlgiao_wpdance_single_product',
				'settings' 			=> 'tvlgiao_wpdance_single_additional_image',
				'type'    			=> 'select',
				'choices' 			=> array(
					'bottom'	=> "Bottom Thumbnail Image",
					'left'		=> "Left Thumbnail Image"
				)
			));	
        	$wp_customize->add_setting('tvlgiao_wpdance_single_recently_product', array(
        		'default' 			=> 'hide',
        		'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
       			'capability' 		=> 'edit_theme_options'		
        	));
			$wp_customize->add_control( 'tvlgiao_wpdance_control_recently_product', array(
				'label'   			=> esc_html__( 'Show Recent Product', 'wpdance' ),
				'section'  			=> 'tvlgiao_wpdance_single_product',
				'settings' 			=> 'tvlgiao_wpdance_single_recently_product',
				'type'    			=> 'select',
				'choices' 			=> array(
					'hide'	=> "Hide",
					'show'	=> "Show"
				)
			));		
        	$wp_customize->add_setting('tvlgiao_wpdance_single_full_width', array(
        		'default' 			=> 'no',
        		'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
       			'capability' 		=> 'edit_theme_options'		
        	));
			$wp_customize->add_control( 'tvlgiao_wpdance_control_full_width', array(
				'label'   			=> esc_html__( 'Full Content Detail', 'wpdance' ),
				'section'  			=> 'tvlgiao_wpdance_single_product',
				'settings' 			=> 'tvlgiao_wpdance_single_full_width',
				'type'    			=> 'select',
				'description'   	=> esc_html__( 'If you want full width detail, you must select layout the full width', 'wpdance' ),
				'choices' 			=> array(
					'no'	=> "NOT FULL",
					'yes'	=> "FULL"
				)
			));						
        	//Content Custom Archive Product
        	$wp_customize->add_setting('tvlgiao_wpdance_archive_product_layout', array(
        		'default' 			=> '0-0-0',
        		'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
       			'capability' 		=> 'edit_theme_options'		
        	));
	  		$wp_customize->add_control( new Theme_Slug_Custom_Radio_Image_Control($wp_customize,'tvlgiao_wpdance_archive_product_layout',array(
            	'label'          	=> esc_html__( 'Select the layout', 'wpdance' ),
            	'section'        	=> 'tvlgiao_wpdance_archive_product',
            	'settings'       	=> 'tvlgiao_wpdance_archive_product_layout',
            	'choices'			=> array(
					'0-0-0' 	=> TVLGIAO_WPDANCE_THEME_IMAGES . '/layouts/wd_fullwidth.png',
					'1-0-0'		=> TVLGIAO_WPDANCE_THEME_IMAGES . '/layouts/wd_left_sidebar.png',
					'0-0-1'		=> TVLGIAO_WPDANCE_THEME_IMAGES . '/layouts/wd_right_sidebar.png',
					'1-0-1'		=> TVLGIAO_WPDANCE_THEME_IMAGES . '/layouts/wd_left_right.png'
				)
        	)));
        	$wp_customize->add_setting('tvlgiao_wpdance_archive_product_sidebar_left', array(
				'default'        	=> $default,
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));
			$wp_customize->add_control( 'tvlgiao_wpdance_archive_single_sidebar_left_select_control', array(
				'label'   			=> 'Select left sidebar',
				'section'  			=> 'tvlgiao_wpdance_archive_product',
				'settings' 			=> 'tvlgiao_wpdance_archive_product_sidebar_left',
				'type'    			=> 'select',
				'choices' 			=> $arr_sidebar,
			));
			$wp_customize->add_setting('tvlgiao_wpdance_archive_product_sidebar_right', array(
				'default'        	=> $default,
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));
			$wp_customize->add_control( 'tvlgiao_wpdance_archive_single_sidebar_right_select_control', array(
				'label'   			=> 'Select right sidebar',
				'section'  			=> 'tvlgiao_wpdance_archive_product',
				'settings' 			=> 'tvlgiao_wpdance_archive_product_sidebar_right',
				'type'    			=> 'select',
				'choices' 			=> $arr_sidebar,
			));
	  		// Text Copyright 
			$wp_customize->add_setting('tvlgiao_wpdance_archive_number_perpage',array(
		    	'default'           => '15',
		    	'sanitize_callback' => 'tvlgiao_wpdance_sanitize_html'
			));
    
    		$wp_customize->add_control('tvlgiao_wpdance_archive_number_perpage_control',array(
            	'label'         	=> esc_html__( 'Number Product Of Page', 'wpdance' ),
            	'settings'      	=> 'tvlgiao_wpdance_archive_number_perpage',
            	'section'       	=> 'tvlgiao_wpdance_archive_product',
            	'description'   	=> esc_html__( '', 'wpdance' )
        	));
        	$wp_customize->add_setting('tvlgiao_wpdance_archive_columns_product', array(
        		'default' 			=> '3',
        		'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
       			'capability' 		=> 'edit_theme_options'		
        	));
			$wp_customize->add_control( 'tvlgiao_wpdance_control_columns_product', array(
				'label'   			=> esc_html__( 'Columns Product', 'wpdance' ),
				'section'  			=> 'tvlgiao_wpdance_archive_product',
				'settings' 			=> 'tvlgiao_wpdance_archive_columns_product',
				'type'    			=> 'select',
				'choices' 			=> array(
					'2'	=> esc_html__( '2 Columns', 'wpdance' ),
					'3'	=> esc_html__( '3 Columns', 'wpdance' ),
					'4'	=> esc_html__( '4 Columns', 'wpdance' ),
				)
			));

			//Page Cart
			$wp_customize->add_setting('tvlgiao_wpdance_cart_shortcode',array(
		    	'default'           => '',
		    	'sanitize_callback' => 'tvlgiao_wpdance_sanitize_html'
			));
    
    		$wp_customize->add_control('tvlgiao_wpdance_cart_shortcode_control',array(
            	'label'         	=> esc_html__( 'Shortcode Cart', 'wpdance' ),
            	'settings'      	=> 'tvlgiao_wpdance_cart_shortcode',
            	'section'       	=> 'tvlgiao_wpdance_cart_product',
            	'type'          	=> 'textarea',
            	'description'   	=> esc_html__( '', 'wpdance' )
        	));	
		}
	}
	$_actived = apply_filters( 'active_plugins', get_option( 'active_plugins' )  );
	if ( in_array( "woocommerce/woocommerce.php", $_actived ) ) {
		add_action('customize_register','tvlgiao_wpdance_customize_product' );
	}
?>