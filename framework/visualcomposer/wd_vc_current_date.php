<?php
	// Banner Image
	vc_map(array(
		'name' 				=> esc_html__("Current Date", 'wpdance'),
		'base' 				=> 'tvlgiao_wpdance_current_date',
		'description' 		=> esc_html__("Current Date", 'wpdance'),
		'category' 			=> esc_html__("WPDance", 'wpdance'),
		"params" => array(
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