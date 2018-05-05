<?php
	//Feedburner Subscription
	vc_map(array(
		'name' 				=> esc_html__("Feedburner Subscriptions", 'wpdance'),
		'base' 				=> 'tvlgiao_wpdance_feedburner_subscription',
		'description' 		=> esc_html__("Feedburner Subscriptions", 'wpdance'),
		'category' 			=> esc_html__("WPDance", 'wpdance'),
		'params' => array(
			array(
				'type' 			=> 'textfield',
				'class' 		=> '',
				'heading' 		=> esc_html__("Title", 'wpdance'),
				'description' 	=> esc_html__("Title", 'wpdance'),
				'admin_label' 	=> true,
				'param_name' 	=> 'title',
				'value' 		=> esc_html__("Sign up for Our Newsletter", 'wpdance'),
			),
			array(
				'type' 			=> 'textfield',
				'class' 		=> '',
				'heading' 		=> esc_html__("Enter your Intro Text", 'wpdance'),
				'description' 	=> esc_html__("Intro text", 'wpdance'),
				'admin_label' 	=> true,
				'param_name' 	=> 'intro_text',
				'value' 		=> esc_html__("A newsletter is a regularly distributed publication generally", 'wpdance'),
			),
			array(
				'type' 			=> 'textfield',
				'class' 		=> '',
				'heading' 		=> esc_html__("Enter your Button", 'wpdance'),
				'description' 	=> esc_html__("Button Text", 'wpdance'),
				'admin_label' 	=> true,
				'param_name' 	=> 'button_text',
				'value' 		=> esc_html__("Subscribe", 'wpdance'),
			),
			array(
				'type' 			=> 'textfield',
				'class' 		=> '',
				'heading' 		=> esc_html__("Enter your Feedburner ID", 'wpdance'),
				'description' 	=> esc_html__("", 'wpdance'),
				'admin_label' 	=> true,
				'param_name' 	=> 'feedburner_id',
				'value' 		=> esc_html__("WpComic-Manga", 'wpdance'),
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