<?php
	// Quick Search Business
	vc_map(array(
		'name' 				=> esc_html__("Quick Search Business", 'wpdance'),
		'base' 				=> 'wd_business_quick_search',
		'description' 		=> esc_html__("Quick Search Business", 'wpdance'),
		'category' 			=> esc_html__("WPDance", 'wpdance'),
		"params" => array(
			array(
				'type' 			=> 'textfield',
				'class' 		=> '',
				'heading' 		=> esc_html__("URL ADVANCED SEARCH", 'wpdance'),
				'admin_label' 	=> true,
				'param_name' 	=> 'url_advanced',
				'value' 		=> ''
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