<?php
	if(!function_exists ('tvlgiao_wpdance_customize_styling_option')){
		function tvlgiao_wpdance_customize_styling_option($wp_customize){
			/*--------------------------------------------------------------*/
			/*					 CUSTOM STYLING OPTION						*/
			/*--------------------------------------------------------------*/
		    $wp_customize->add_panel( 'tvlgiao_wpdance_styling_config', array(
		        'title' 			=> esc_html__( 'WPDANCE - Color Setting', 'wpdance' ),
		        'description' 		=> esc_html__( 'Custom body, color in website.', 'wpdance'),
		        'priority' 			=> 525,
		    ));
 			$wp_customize->add_section( 'tvlgiao_wpdance_styling_primary_color_section' , array(
 				'title'       		=> esc_html__( 'Primary Color All Theme', 'wpdance' ),
 				'description' 		=> esc_html__( 'Custom primary color all theme', 'wpdance'),
 				'panel'	 			=> 'tvlgiao_wpdance_styling_config',
 				'priority'    		=> 1,
 			));
 			$wp_customize->add_section( 'tvlgiao_wpdance_styling_custom_general_section' , array(
 				'title'       		=> esc_html__( 'Custom General Color', 'wpdance' ),
 				'description' 		=> esc_html__( 'Custom general color', 'wpdance'),
 				'panel'	 			=> 'tvlgiao_wpdance_styling_config',
 				'priority'    		=> 1,
 			));
 			//---------------------------------------------------------------//
 			//Content Config Site
 			//Background Color
			/*$wp_customize->add_setting( 'tvlgiao_wpdance_body_bg_color', array(
				'default'           => '#ffffff',
				'sanitize_callback' => 'sanitize_hex_color',
				'transport'         => 'postMessage',
			));
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'tvlgiao_wpdance_body_bg_color', array(
				'label'      		=> esc_html__( 'Select background color body tag', 'wpdance' ),
				'section'     		=> 'tvlgiao_wpdance_styling_config',
			))); */
		
        	$wp_customize->add_setting('tvlgiao_wpdance_styling_primary_color', array(
        		'default' 			=> 'color_default',
        		'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
       			'capability' 		=> 'edit_theme_options'		
        	));
	  		$wp_customize->add_control( new Theme_Slug_Custom_Radio_Image_Control($wp_customize,'tvlgiao_wpdance_styling_primary_color',array(
            	'label'          	=> esc_html__( 'Select the layout', 'wpdance' ),
            	'section'        	=> 'tvlgiao_wpdance_styling_primary_color_section',
            	'settings'       	=> 'tvlgiao_wpdance_styling_primary_color',
            	'choices'			=> array(
					'color_default' => TVLGIAO_WPDANCE_THEME_IMAGES . '/styling/color_default.png',
					'color_green'	=> TVLGIAO_WPDANCE_THEME_IMAGES . '/styling/color_green.png'
				)
        	)));
			$xml_file_customize	=  get_theme_mod( 'tvlgiao_wpdance_styling_primary_color' ,'color_default');
			$xml_file 			= $xml_file_customize;
			$objXML_color 		= simplexml_load_file(TVLGIAO_WPDANCE_THEME_WPDANCE."/config_xml/".$xml_file.".xml");
			foreach ($objXML_color->children() as $child) {	 				//items_setting => general
				$title 			= (string)$child->title;
				$section 		= (string)$child->section;
				$description 	= (string)$child->description;
				$wp_customize->add_section( $section , array(
	 				'title'       		=> $title,
	 				'description' 		=> $description,
	 				'panel'	 			=> 'tvlgiao_wpdance_styling_config',
 				));
				foreach ($child->items->children() as $childofchild) { 		//items => item
					$name 	=  (string)$childofchild->name;					//name
					$slug 	=  (string)$childofchild->slug; 				//slug
					$std 	=  (string)$childofchild->std; 					//std
					
					$wp_customize->add_setting( $slug , array(
						'default'           =>  $std,
						'sanitize_callback' => 'sanitize_hex_color',
						'transport'         => 'postMessage',
					));
					$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $slug , array(
						'label'      		=>  $name,
						'section'     		=>  $section,
					)));

				}
			}			
		}
	}
	add_action('customize_register','tvlgiao_wpdance_customize_styling_option' );
?>
