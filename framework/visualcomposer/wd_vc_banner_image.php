<?php
	// Banner Image
	vc_map(array(
		'name' 				=> esc_html__("Banner Image", 'wpdance'),
		'base' 				=> 'tvlgiao_wpdance_banner_image',
		'description' 		=> esc_html__("Banner Image", 'wpdance'),
		'category' 			=> esc_html__("WPDance", 'wpdance'),
		"params" => array(
			array(
				"type" 			=> "attach_image",
				"class" 		=> "",
				"heading" 		=> esc_html__("Background Image", 'wpdance'),
				"param_name" 	=> "bg_image",
				"value" 		=> "",
				"description" 	=> 'Background image banner',
			),
			array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Style Effect', 'wpdance' )
				,'param_name' 	=> 'wd_effect_banner'
				,'admin_label' 	=> true
				,'value' 		=> array(
						'Style 01'			=> 'wd-banner-effect-01',
						'Style 02'			=> 'wd-banner-effect-02',					
					)
				,'description' => ''
			)
			,array(
				"type" 			=> "checkbox",
				"class" 		=> "",
				"heading" 		=> esc_html__("open New Tab", 'wpdance'),
				"param_name" 	=> "open_new_tab",
				"value" 		=> "1",
				"description" 	=> '',
			)
			,array(
				"type" 			=> "textfield",
				"class" 		=> "",
				"heading" 		=> esc_html__("Button text", 'wpdance'),
				"param_name" 	=> "button_text",
				"description" 	=> '',
			)
			,array(
				"type" 			=> "textfield",
				"class" 		=> "",
				"heading" 		=> esc_html__("Link Button", 'wpdance'),
				"param_name" 	=> "link_url",
				"description" 	=> '',
			)
			,array(
				"type" 			=> "textfield",
				"class" 		=> "",
				"heading" 		=> esc_html__("Button class", 'wpdance'),
				"param_name" 	=> "button_class",
				"description" 	=> '',
			)
			,array(
				"type" 			=> "textfield",
				"class" 		=> "",
				"heading" 		=> esc_html__("Top", 'wpdance'),
				"param_name" 	=> "top",
				"description" 	=> esc_html__("ex: 5%", 'wpdance')
			)
			,array(
				"type" 			=> "textfield",
				"class"			=> "",
				"heading" 		=> esc_html__("Right", 'wpdance'),
				"param_name" 	=> "right",
				"description" 	=> esc_html__("ex: 5%", 'wpdance')
			)
			,array(
				"type" 			=> "textfield",
				"class"			=> "",
				"heading" 		=> esc_html__("Bottom", 'wpdance'),
				"param_name" 	=> "bottom",
				"description" 	=> esc_html__("ex: 5%", 'wpdance')
			)
			,array(
				"type" 			=> "textfield",
				"class"			=> "",
				"heading" 		=> esc_html__("Left", 'wpdance'),
				"param_name" 	=> "left",
				"description" 	=> esc_html__("ex: 5%", 'wpdance')
			)
			,array(
				'type' 			=> 'textfield',
				'class' 		=> '',
				'heading' 		=> esc_html__("Extra class name", 'wpdance'),
				'description'	=> esc_html__("Style particular content element differently - add a class name and refer to it in custom CSS.", 'wpdance'),
				'admin_label' 	=> true,
				'param_name' 	=> 'class',
				'value' 		=> ''
			)
		)
	));
?>