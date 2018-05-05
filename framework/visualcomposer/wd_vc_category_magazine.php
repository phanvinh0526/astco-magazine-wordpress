<?php
	// Special Blog
	vc_map(array(
		'name' 				=> esc_html__("Category Magazine", 'wpdance'),
		'base' 				=> 'tvlgiao_wpdance_category_magazine',
		'description' 		=> esc_html__("Category Magazine", 'wpdance'),
		'category' 			=> esc_html__("WPDance", 'wpdance'),
		'params' => array(
			array(
				'type' 			=> 'textfield',
				'class' 		=> '',
				'heading' 		=> esc_html__("Columns", 'wpdance'),
				'description'	=> esc_html__("Columns", 'wpdance'),
				'admin_label' 	=> true,
				'param_name' 	=> 'columns',
				'value' 		=> '3'
			),
			array(
				"type" 			=> "dropdown",
				"class" 		=> "",
				"heading" 		=> esc_html__("Is Slider", 'wpdance'),
				"admin_label" 	=> true,
				"param_name" 	=> "is_slider",
				"value" => array(
						'Yes' 		=> '1',
						'No' 		=> '0'
					),
				"description" 	=> ""
			),
			array(
				"type" 			=> "dropdown",
				"class" 		=> "",
				"heading" 		=> esc_html__("Show Nav", 'wpdance'),
				"admin_label" 	=> true,
				"param_name" 	=> "show_nav",
				"value" => array(
						'Yes' 		=> '1',
						'No' 		=> '0'
					),
				"description" 	=> "",
				'dependency'  	=> Array('element' => "is_slider", 'value' => array('1'))
			),
			array(
				"type" 			=> "dropdown",
				"class" 		=> "",
				"heading" 		=> esc_html__("Auto Play", 'wpdance'),
				"admin_label" 	=> true,
				"param_name" 	=> "auto_play",
				"value" => array(
						'Yes' 		=> '1',
						'No' 		=> '0'
					),
				"description" 	=> "",
				'dependency'  	=> Array('element' => "is_slider", 'value' => array('1'))
			),			
			array(
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