<?php
	wp_reset_postdata();
	$adv_category = array();
	$adv_category[esc_html__('All Category','wdoutline')] = -1;
	$categories = 	get_terms( 'advertise_category' );

	foreach ($categories as $category ) {
		$adv_category[$category->slug] = $category->term_id;
	}
	// Banner Image
	vc_map(array(
		'name' 				=> esc_html__("Adv Sidebar Mobile", 'wpdance'),
		'base' 				=> 'tvlgiao_wpdance_adv_sidebar_mobile',
		'description' 		=> esc_html__("Adv Sidebar Mobile", 'wpdance'),
		'category' 			=> esc_html__("WPDance", 'wpdance'),
		"params" => array(
			array(
				'type' 			=> 'dropdown',
				'heading' 		=> esc_html__( 'Select Category', 'wdoutline' ),
				'param_name' 	=> 'id_category',
				'admin_label' 	=> true,
				'value' 		=> $adv_category,
				'description' 	=> ''
			),
			array(
				"type" 			=> "textfield",
				"class" 		=> "",
				"heading" 		=> esc_html__("Number Adv", 'wpdance'),
				"param_name" 	=> "number_adv",
				"value" 		=> "5",
				"description" 	=> '',
			),
			array(
				"type" 			=> "dropdown",
				"class" 		=> "",
				"heading" 		=> esc_html__("Select Location", 'wpdance'),
				"admin_label" 	=> true,
				"param_name" 	=> "adv_location",
				"value" => array(
						'Category Sidebar' 	=> '0',
						'Home Sidebar' 		=> '1'
					),
				"description" 	=> ""
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