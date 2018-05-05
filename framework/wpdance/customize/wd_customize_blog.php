<?php
	if(!function_exists ('tvlgiao_wpdance_customize_blog')){
		function tvlgiao_wpdance_customize_blog($wp_customize){
			/*--------------------------------------------------------------*/
			/*						 CUSTOM BLOG 	 						*/
			/*--------------------------------------------------------------*/
			$wp_customize->add_panel( 'tvlgiao_wpdance_blog_config', array(
		        'title' 			=> esc_html__( 'WPDANCE - Blog Config', 'wpdance' ),
		        'description' 		=> esc_html__( 'Theme Sidebar Layout', 'wpdance'),
		        'priority' 			=> 515,
		    ));
 			$wp_customize->add_section( 'tvlgiao_wpdance_genneral_blog' , array(
 				'title'       		=> esc_html__( 'Genneral Blog Config', 'wpdance' ),
 				'description' 		=> esc_html__('Genneral Blog Config', 'wpdance') ,
 				'panel'	 			=> 'tvlgiao_wpdance_blog_config',
 				'priority'    		=> 5,
 			));
 			$wp_customize->add_section( 'tvlgiao_wpdance_default_page' , array(
 				'title'       		=> esc_html__( 'Page Default', 'wpdance' ),
 				'description' 		=> esc_html__('Custom page blog page', 'wpdance'),
 				'panel'	 			=> 'tvlgiao_wpdance_blog_config',
 				'priority'    		=> 10,
 			));
 			$wp_customize->add_section( 'tvlgiao_wpdance_default_blog' , array(
 				'title'       		=> esc_html__( 'Blog Default', 'wpdance' ),
 				'description' 		=> esc_html__('Custom default blog page', 'wpdance'),
 				'panel'	 			=> 'tvlgiao_wpdance_blog_config',
 				'priority'    		=> 15,
 			));
 			$wp_customize->add_section( 'tvlgiao_wpdance_archive_blog' , array(
 				'title'       		=> esc_html__( 'Archive Blog', 'wpdance' ),
 				'description' 		=> esc_html__('Custom archive blog page', 'wpdance'),
 				'panel'	 			=> 'tvlgiao_wpdance_blog_config',
 				'priority'    		=> 20,
 			));
 			$wp_customize->add_section( 'tvlgiao_wpdance_single_blog' , array(
 				'title'       		=> esc_html__( 'Single Blog', 'wpdance' ),
 				'description' 		=> esc_html__('Custom single blog page', 'wpdance') ,
 				'panel'	 			=> 'tvlgiao_wpdance_blog_config',
 				'priority'    		=> 25,
 			));

 			//---------------------------------------------------------------//
 			//						Genneral Blog Config 					 //
			$wp_customize->add_setting('tvlgiao_wpdance_genneral_blog_show_title', array(
				'default'        	=> '1',
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));
			$wp_customize->add_control( 'tvlgiao_wpdance_genneral_blog_show_title_control', array(
				'label'   			=> esc_html__( 'Show Title Blog', 'wpdance' ),
				'description' 		=> esc_html__( 'Show/Hile title blog', 'wpdance'),
				'section'  			=> 'tvlgiao_wpdance_genneral_blog',
				'settings' 			=> 'tvlgiao_wpdance_genneral_blog_show_title',
				'type'    			=> 'select',
				'choices' 			=> array(
					'1'		=> "Show",	
					'0'		=> "Hide"
				)
			)); 
			$wp_customize->add_setting('tvlgiao_wpdance_genneral_blog_show_thumbnail', array(
				'default'        	=> '1',
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));
			$wp_customize->add_control( 'tvlgiao_wpdance_genneral_blog_show_thumbnail_control', array(
				'label'   			=> esc_html__( 'Show Thumbnail Blog', 'wpdance' ),
				'description' 		=> esc_html__( 'Show/Hile thumbnail blog', 'wpdance'),
				'section'  			=> 'tvlgiao_wpdance_genneral_blog',
				'settings' 			=> 'tvlgiao_wpdance_genneral_blog_show_thumbnail',
				'type'    			=> 'select',
				'choices' 			=> array(
					'1'		=> "Show",	
					'0'		=> "Hide"
				)
			));
			$wp_customize->add_setting('tvlgiao_wpdance_genneral_blog_show_date', array(
				'default'        	=> '1',
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));
			$wp_customize->add_control( 'tvlgiao_wpdance_genneral_blog_show_date_control', array(
				'label'   			=> esc_html__( 'Show Date Blog', 'wpdance' ),
				'description' 		=> esc_html__( 'Show/Hile date blog', 'wpdance'),
				'section'  			=> 'tvlgiao_wpdance_genneral_blog',
				'settings' 			=> 'tvlgiao_wpdance_genneral_blog_show_date',
				'type'    			=> 'select',
				'choices' 			=> array(
					'1'		=> "Show",	
					'0'		=> "Hide"
				)
			));
			$wp_customize->add_setting('tvlgiao_wpdance_genneral_blog_show_author', array(
				'default'        	=> '1',
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));
			$wp_customize->add_control( 'tvlgiao_wpdance_genneral_blog_show_author_control', array(
				'label'   			=> esc_html__( 'Show Author Blog', 'wpdance' ),
				'description' 		=> esc_html__( 'Show/Hile author blog', 'wpdance'),
				'section'  			=> 'tvlgiao_wpdance_genneral_blog',
				'settings' 			=> 'tvlgiao_wpdance_genneral_blog_show_author',
				'type'    			=> 'select',
				'choices' 			=> array(
					'1'		=> "Show",	
					'0'		=> "Hide"
				)
			)); 
			$wp_customize->add_setting('tvlgiao_wpdance_genneral_blog_show_category', array(
				'default'        	=> '1',
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));
			$wp_customize->add_control( 'tvlgiao_wpdance_genneral_blog_show_category_control', array(
				'label'   			=> esc_html__( 'Show Category Blog', 'wpdance' ),
				'description' 		=> esc_html__( 'Show/Hile category blog', 'wpdance'),
				'section'  			=> 'tvlgiao_wpdance_genneral_blog',
				'settings' 			=> 'tvlgiao_wpdance_genneral_blog_show_category',
				'type'    			=> 'select',
				'choices' 			=> array(
					'1'		=> "Show",	
					'0'		=> "Hide"
				)
			));   
			$wp_customize->add_setting('tvlgiao_wpdance_genneral_blog_show_excerpt', array(
				'default'        	=> '1',
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));
			$wp_customize->add_control( 'tvlgiao_wpdance_genneral_blog_show_excerpt_control', array(
				'label'   			=> esc_html__( 'Show Excerpt Blog', 'wpdance' ),
				'description' 		=> esc_html__( 'Show/Hile excerpt blog', 'wpdance'),
				'section'  			=> 'tvlgiao_wpdance_genneral_blog',
				'settings' 			=> 'tvlgiao_wpdance_genneral_blog_show_excerpt',
				'type'    			=> 'select',
				'choices' 			=> array(
					'1'		=> "Show",	
					'0'		=> "Hide"
				)
			)); 
			$wp_customize->add_setting('tvlgiao_wpdance_genneral_blog_show_read_more', array(
				'default'        	=> '1',
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));
			$wp_customize->add_control( 'tvlgiao_wpdance_genneral_blog_show_read_more_control', array(
				'label'   			=> esc_html__( 'Show Read More Blog', 'wpdance' ),
				'description' 		=> esc_html__( 'Show/Hile read more blog', 'wpdance'),
				'section'  			=> 'tvlgiao_wpdance_genneral_blog',
				'settings' 			=> 'tvlgiao_wpdance_genneral_blog_show_read_more',
				'type'    			=> 'select',
				'choices' 			=> array(
					'1'		=> "Show",	
					'0'		=> "Hide"
				)
			));   			

			$wp_customize->add_setting('tvlgiao_wpdance_genneral_blog_number_excerpt',array(
		    	'default'           => '20',
		    	'sanitize_callback' => 'tvlgiao_wpdance_sanitize_html'
			));
    
    		$wp_customize->add_control('tvlgiao_wpdance_footer_copyright_text_control',array(
            	'label'         	=> esc_html__( 'Number Excerpt Word', 'wpdance' ),
            	'settings'      	=> 'tvlgiao_wpdance_genneral_blog_number_excerpt',
            	'section'       	=> 'tvlgiao_wpdance_genneral_blog',
            	'type'          	=> 'textarea',
            	'description'   	=> esc_html__( '', 'wpdance' )
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
 			//Content Custom Single Blog
 			$wp_customize->add_setting('tvlgiao_wpdance_single_blog_layout', array(
        		'default' 			=> '0-0-0',
        		'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
       			'capability' 		=> 'edit_theme_options'		
        	));
	  		$wp_customize->add_control( new Theme_Slug_Custom_Radio_Image_Control($wp_customize,'tvlgiao_wpdance_single_blog_layout',array(
            	'label'          	=> esc_html__( 'Select the layout', 'wpdance' ),
            	'section'        	=> 'tvlgiao_wpdance_single_blog',
            	'settings'       	=> 'tvlgiao_wpdance_single_blog_layout',
            	'choices'			=> array(
					'0-0-0' 	=> TVLGIAO_WPDANCE_THEME_IMAGES . '/layouts/wd_fullwidth.png',
					'1-0-0'		=> TVLGIAO_WPDANCE_THEME_IMAGES . '/layouts/wd_left_sidebar.png',
					'0-0-1'		=> TVLGIAO_WPDANCE_THEME_IMAGES . '/layouts/wd_right_sidebar.png',
					'1-0-1'		=> TVLGIAO_WPDANCE_THEME_IMAGES . '/layouts/wd_left_right.png'
				)
        	)));
			$wp_customize->add_setting('tvlgiao_wpdance_single_blog_sidebar_left', array(
				'default'        	=> $default,
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));
			$wp_customize->add_control( 'tvlgiao_wpdance_single_sidebar_left_select_control', array(
				'label'   			=> 'Select left sidebar',
				'section'  			=> 'tvlgiao_wpdance_single_blog',
				'settings' 			=> 'tvlgiao_wpdance_single_blog_sidebar_left',
				'type'    			=> 'select',
				'choices' 			=> $arr_sidebar,
			));
			$wp_customize->add_setting('tvlgiao_wpdance_single_blog_sidebar_right', array(
				'default'        	=> $default,
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));
			$wp_customize->add_control( 'tvlgiao_wpdance_single_sidebar_right_select_control', array(
				'label'   			=> 'Select right sidebar',
				'section'  			=> 'tvlgiao_wpdance_single_blog',
				'settings' 			=> 'tvlgiao_wpdance_single_blog_sidebar_right',
				'type'    			=> 'select',
				'choices' 			=> $arr_sidebar,
			));

        	//Content Custom Archive Blog
        	$wp_customize->add_setting('tvlgiao_wpdance_archive_blog_layout', array(
        		'default' 			=> '0-0-0',
        		'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
       			'capability' 		=> 'edit_theme_options'		
        	));
	  		$wp_customize->add_control( new Theme_Slug_Custom_Radio_Image_Control($wp_customize,'tvlgiao_wpdance_archive_blog_layout',array(
            	'label'          	=> esc_html__( 'Select the layout', 'wpdance' ),
            	'section'        	=> 'tvlgiao_wpdance_archive_blog',
            	'settings'       	=> 'tvlgiao_wpdance_archive_blog_layout',
            	'choices'			=> array(
					'0-0-0' 	=> TVLGIAO_WPDANCE_THEME_IMAGES . '/layouts/wd_fullwidth.png',
					'1-0-0'		=> TVLGIAO_WPDANCE_THEME_IMAGES . '/layouts/wd_left_sidebar.png',
					'0-0-1'		=> TVLGIAO_WPDANCE_THEME_IMAGES . '/layouts/wd_right_sidebar.png',
					'1-0-1'		=> TVLGIAO_WPDANCE_THEME_IMAGES . '/layouts/wd_left_right.png'
				)
        	)));
        	$wp_customize->add_setting('tvlgiao_wpdance_archive_blog_sidebar_left', array(
				'default'        	=> $default,
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));
			$wp_customize->add_control( 'tvlgiao_wpdance_archive_sidebar_left_select_control', array(
				'label'   			=> 'Select left sidebar',
				'section'  			=> 'tvlgiao_wpdance_archive_blog',
				'settings' 			=> 'tvlgiao_wpdance_archive_blog_sidebar_left',
				'type'    			=> 'select',
				'choices' 			=> $arr_sidebar,
			));
			$wp_customize->add_setting('tvlgiao_wpdance_archive_blog_sidebar_right', array(
				'default'        	=> $default,
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));
			$wp_customize->add_control( 'tvlgiao_wpdance_archive_sidebar_right_select_control', array(
				'label'   			=> 'Select right sidebar',
				'section'  			=> 'tvlgiao_wpdance_archive_blog',
				'settings' 			=> 'tvlgiao_wpdance_archive_blog_sidebar_right',
				'type'    			=> 'select',
				'choices' 			=> $arr_sidebar,
			));
        	//Content Custom Defaule Blog
        	$wp_customize->add_setting('tvlgiao_wpdance_default_blog_layout', array(
        		'default' 			=> '0-0-0',
        		'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
       			'capability' 		=> 'edit_theme_options'		
        	));
	  		$wp_customize->add_control( new Theme_Slug_Custom_Radio_Image_Control($wp_customize,'tvlgiao_wpdance_default_blog_layout',array(
            	'label'          	=> esc_html__( 'Select the layout', 'wpdance' ),
            	'section'        	=> 'tvlgiao_wpdance_default_blog',
            	'settings'       	=> 'tvlgiao_wpdance_default_blog_layout',
            	'choices'			=> array(
					'0-0-0' 	=> TVLGIAO_WPDANCE_THEME_IMAGES . '/layouts/wd_fullwidth.png',
					'1-0-0'		=> TVLGIAO_WPDANCE_THEME_IMAGES . '/layouts/wd_left_sidebar.png',
					'0-0-1'		=> TVLGIAO_WPDANCE_THEME_IMAGES . '/layouts/wd_right_sidebar.png',
					'1-0-1'		=> TVLGIAO_WPDANCE_THEME_IMAGES . '/layouts/wd_left_right.png'
				)
        	)));
        	$wp_customize->add_setting('tvlgiao_wpdance_default_blog_sidebar_left', array(
				'default'        	=> $default,
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));
			$wp_customize->add_control( 'tvlgiao_wpdance_defaule_slidebar_left_select_control', array(
				'label'   			=> 'Select left sidebar',
				'section'  			=> 'tvlgiao_wpdance_default_blog',
				'settings' 			=> 'tvlgiao_wpdance_default_blog_sidebar_left',
				'type'    			=> 'select',
				'choices' 			=> $arr_sidebar,
			));
			$wp_customize->add_setting('tvlgiao_wpdance_default_blog_sidebar_right', array(
				'default'        	=> $default,
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));
			$wp_customize->add_control( 'tvlgiao_wpdance_defaule_slidebar_right_select_control', array(
				'label'   			=> 'Select right sidebar',
				'section'  			=> 'tvlgiao_wpdance_default_blog',
				'settings' 			=> 'tvlgiao_wpdance_default_blog_sidebar_right',
				'type'    			=> 'select',
				'choices' 			=> $arr_sidebar,
			));
        	//Content Custom Page Default
        	$wp_customize->add_setting('tvlgiao_wpdance_default_page_layout', array(
        		'default' 			=> '0-0-0',
        		'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
       			'capability' 		=> 'edit_theme_options'		
        	));
	  		$wp_customize->add_control( new Theme_Slug_Custom_Radio_Image_Control($wp_customize,'tvlgiao_wpdance_default_page_layout',array(
            	'label'          	=> esc_html__( 'Select the layout', 'wpdance' ),
            	'section'        	=> 'tvlgiao_wpdance_default_page',
            	'settings'       	=> 'tvlgiao_wpdance_default_page_layout',
            	'choices'			=> array(
					'0-0-0' 	=> TVLGIAO_WPDANCE_THEME_IMAGES . '/layouts/wd_fullwidth.png',
					'1-0-0'		=> TVLGIAO_WPDANCE_THEME_IMAGES . '/layouts/wd_left_sidebar.png',
					'0-0-1'		=> TVLGIAO_WPDANCE_THEME_IMAGES . '/layouts/wd_right_sidebar.png',
					'1-0-1'		=> TVLGIAO_WPDANCE_THEME_IMAGES . '/layouts/wd_left_right.png'
				)
        	)));
        	$wp_customize->add_setting('tvlgiao_wpdance_default_page_sidebar_left', array(
				'default'        	=> $default,
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));
			$wp_customize->add_control( 'tvlgiao_wpdance_defaule_page_left_sidebar_select_control', array(
				'label'   			=> 'Select left sidebar',
				'section'  			=> 'tvlgiao_wpdance_default_page',
				'settings' 			=> 'tvlgiao_wpdance_default_page_sidebar_left',
				'type'    			=> 'select',
				'choices' 			=> $arr_sidebar,
			));
			$wp_customize->add_setting('tvlgiao_wpdance_default_page_sidebar_right', array(
				'default'        	=> $default,
				'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
				'capability' 		=> 'edit_theme_options'
			));
			$wp_customize->add_control( 'tvlgiao_wpdance_defaule_page_right_sidebar_select_control', array(
				'label'   			=> 'Select right sidebar',
				'section'  			=> 'tvlgiao_wpdance_default_page',
				'settings' 			=> 'tvlgiao_wpdance_default_page_sidebar_right',
				'type'    			=> 'select',
				'choices' 			=> $arr_sidebar,
			));

		}
	}
	add_action('customize_register','tvlgiao_wpdance_customize_blog' );
?>