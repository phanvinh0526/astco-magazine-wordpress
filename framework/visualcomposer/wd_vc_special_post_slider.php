<?php
	// Special Blog
	vc_map(array(
		'name' 				=> esc_html__("Special Post Slider", 'wpdance'),
		'base' 				=> 'tvlgiao_wpdance_special_blog_slider',
		'description' 		=> esc_html__("Display info slider home", 'wpdance'),
		'category' 			=> esc_html__("WPDance", 'wpdance'),
		'params' => array(
			array(
				'type' 			=> 'textfield',
				'class' 		=> '',
				'heading' 		=> esc_html__("Number Post", 'wpdance'),
				'description' 	=> esc_html__("number", 'wpdance'),
				'admin_label' 	=> true,
				'param_name' 	=> 'number',
				'value' 		=> '6'
			),
            array(
                "type" 			=> "data_slider_post",
                "class" 		=> "",
                "heading" 		=> esc_html__("Insert Post In Slider", 'wpdance'),
                "param_name" 	=> "data_slider_home",
                "value" 		=> '',
                "description" 	=> esc_html__("Chose post and business partner", 'wpdance'),
            ),			
			array(
				"type" 			=> "dropdown",
				"class" 		=> "",
				"heading" 		=> esc_html__("Data Show", 'wpdance'),
				"admin_label" 	=> true,
				"param_name" 	=> "data_post",
				"value" => array(
						'Recent Post' 		=> 'recent-post',
						'Most View Post' 	=> 'most-view'
					),
				"description" 	=> ""
			),
			array(
				"type" 			=> "dropdown",
				"class" 		=> "",
				"heading" 		=> esc_html__("Show Excerpt", 'wpdance'),
				"admin_label" 	=> true,
				"param_name" 	=> "excerpt",
				"value" => array(
						'Yes' 		=> '1',
						'No' 		=> '0'
					),
				"description" 	=> "",
				'dependency'  		=> Array('element' => "style_home_footer", 'value' => array('style-footer'))
			),
			array(
				'type' 			=> 'textfield',
				'class' 		=> '',
				'heading' 		=> esc_html__("Number Excerpt", 'wpdance'),
				'description' 	=> esc_html__("number excerpt", 'wpdance'),
				'admin_label' 	=> true,
				'param_name' 	=> 'number_excerpt',
				'value' 		=> '20',
				'dependency'  		=> Array('element' => "style_home_footer", 'value' => array('style-footer'))
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