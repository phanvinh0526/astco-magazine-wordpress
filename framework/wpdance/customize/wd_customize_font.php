<?php
	if(!function_exists ('tvlgiao_wpdance_customize_font')){
		function tvlgiao_wpdance_customize_font($wp_customize){
			/*--------------------------------------------------------------*/
			/*					 CUSTOM STYLING OPTION						*/
			/*--------------------------------------------------------------*/
		    $wp_customize->add_panel( 'tvlgiao_wpdance_font_config', array(
		        'title' 			=> esc_html__( 'WPDANCE - Font Setting', 'wpdance' ),
		        'description' 		=> esc_html__( 'Custom font in website.', 'wpdance'),
		        'priority' 			=> 530,
		    ));
			
 			//---------------------------------------------------------------//
 			//Content Config Site
 			//Background Color
 			global $tvlgiao_wpdance_google_fonts;
			$xml_file 			= 'font_config';
			$objXML_font 		= simplexml_load_file(TVLGIAO_WPDANCE_THEME_WPDANCE."/config_xml/".$xml_file.".xml");
			foreach ($objXML_font->children() as $child) {	 				//items_setting => general
				$title 			= (string)$child->title;
				$section 		= (string)$child->section;
				$description 	= (string)$child->description;
				$wp_customize->add_section( $section , array(
	 				'title'       		=> $title,
	 				'description' 		=> $description,
	 				'panel'	 			=> 'tvlgiao_wpdance_font_config',
 				));	
				foreach ($child->items->children() as $childofchild) { 			//items => item
					$name 	 		=  (string)$childofchild->name;					//name
					$slug 	 		=  (string)$childofchild->slug; 					//slug
					$std 	 		=  (string)$childofchild->std;
					$description 	=  (string)$childofchild->description; 					//std
					$control =  (string)$slug."_control";
					$wp_customize->add_setting( $slug , array(
						'default'           =>  $std,
						'sanitize_callback' => 'tvlgiao_wpdance_sanitize_text',
						'capability' 		=> 'edit_theme_options'
					));
					$wp_customize->add_control( new Tvlgiao_Wpdance_Custom_Font_Control($wp_customize, $control ,array(
						'label'   			=> $name,
						'section'  			=> $section,
						'description' 		=> $description,
						'settings' 			=> $slug,
						'choices' 			=> $tvlgiao_wpdance_google_fonts,
					)));
				}
			}			
		}
	}
	add_action('customize_register','tvlgiao_wpdance_customize_font' );
?>