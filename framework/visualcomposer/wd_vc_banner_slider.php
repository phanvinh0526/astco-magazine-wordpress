<?php
	// Banner Image
	vc_map(array(
		'name' 				=> esc_html__("Slider Banner Image", 'wpdance'),
		'base' 				=> 'tvlgiao_wpdance_slider_banner_image',
		'description' 		=> esc_html__("Banner Image", 'wpdance'),
		'category' 			=> esc_html__("WPDance", 'wpdance'),
		"params" => array(
			array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Number Image', 'wpdance' )
				,'param_name' 	=> 'number_image'
				,'admin_label' 	=> true
				,'value' 		=> array(
						'1'			=> '1',
						'2'			=> '2',
						'3'			=> '3',
						'4'			=> '4',
						'5'			=> '5',
						
					)
				,'description' => ''
			),
			array(
				"type" 			=> "attach_images",
				"class" 		=> "",
				"heading" 		=> esc_html__("Background Image", 'wpdance'),
				"param_name" 	=> "bg_image",
				"value" 		=> "",
				"description" 	=> 'Background image banner',
			)
			,array(
				"type" 			=> "textfield",
				"class" 		=> "",
				"heading" 		=> esc_html__("Link Image 01", 'wpdance'),
				"param_name" 	=> "link_url_1",
				"description" 	=> '',
			)
			,array(
				"type" 			=> "checkbox",
				"class" 		=> "",
				"heading" 		=> esc_html__("New Tab Image 01", 'wpdance'),
				"param_name" 	=> "new_tab_1",
				"value" 		=> "1",
				"description" 	=> '',
			)
			,array(
				"type" 			=> "textfield",
				"class" 		=> "",
				"heading" 		=> esc_html__("Link Image 02", 'wpdance'),
				"param_name" 	=> "link_url_2",
				"description" 	=> '',
			)
			,array(
				"type" 			=> "checkbox",
				"class" 		=> "",
				"heading" 		=> esc_html__("New Tab Image 02", 'wpdance'),
				"param_name" 	=> "new_tab_2",
				"value" 		=> "1",
				"description" 	=> '',
			)
			,array(
				"type" 			=> "textfield",
				"class" 		=> "",
				"heading" 		=> esc_html__("Link Image 03", 'wpdance'),
				"param_name" 	=> "link_url_3",
				"description" 	=> '',
			)
			,array(
				"type" 			=> "checkbox",
				"class" 		=> "",
				"heading" 		=> esc_html__("New Tab Image 03", 'wpdance'),
				"param_name" 	=> "new_tab_3",
				"value" 		=> "1",
				"description" 	=> '',
			)
			,array(
				"type" 			=> "textfield",
				"class" 		=> "",
				"heading" 		=> esc_html__("Link Image 04", 'wpdance'),
				"param_name" 	=> "link_url_4",
				"description" 	=> '',
			)
			,array(
				"type" 			=> "checkbox",
				"class" 		=> "",
				"heading" 		=> esc_html__("New Tab Image 04", 'wpdance'),
				"param_name" 	=> "new_tab_4",
				"value" 		=> "1",
				"description" 	=> '',
			)
			,array(
				"type" 			=> "textfield",
				"class" 		=> "",
				"heading" 		=> esc_html__("Link Image 05", 'wpdance'),
				"param_name" 	=> "link_url_5",
				"description" 	=> '',
			)
			,array(
				"type" 			=> "checkbox",
				"class" 		=> "",
				"heading" 		=> esc_html__("New Tab Image 05", 'wpdance'),
				"param_name" 	=> "new_tab_5",
				"value" 		=> "1",
				"description" 	=> '',
			)
			,array(
				'type' 			=> 'textfield',
				'class' 		=> '',
				'heading' 		=> esc_html__("PauseTime", 'wpdance'),
				'description' 	=> esc_html__("PauseTime", 'wpdance'),
				'admin_label' 	=> true,
				'param_name' 	=> 'pausetime',
				'value' 		=> '3000'
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