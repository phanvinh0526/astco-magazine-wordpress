<?php
	$blog_category = array();
	$blog_category[esc_html__('All Category','wdoutline')] = -1;
	$categories = 	get_terms( 'category', 
								array('hide_empty' 	=> 0)
							 );
	foreach ($categories as $category ) {
		$blog_category[$category->slug] = $category->term_id;
	}
	wp_reset_postdata();
	// Special Blog
	vc_map(array(
		'name' 				=> esc_html__("Video Post", 'wpdance'),
		'base' 				=> 'tvlgiao_wpdance_blog_video',
		'description' 		=> esc_html__("Display info contact, email, telephone", 'wpdance'),
		'category' 			=> esc_html__("WPDance", 'wpdance'),
		'params' => array(
			array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Select Category', 'wdoutline' )
				,'param_name' 	=> 'id_category'
				,'admin_label' 	=> true
				,'value' 		=> $blog_category
				,'description' 	=> ''
			),
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
				"type" 			=> "dropdown",
				"class" 		=> "",
				"heading" 		=> esc_html__("Data Show", 'wpdance'),
				"admin_label" 	=> true,
				"param_name" 	=> "data_show",
				"value" => array(
						'Recent Post' 		=> 'recent-post',
						'Most View Post' 	=> 'most-view'
					),
				"description" 	=> ""
			),
			array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Sort By', 'wpdance' )
				,'param_name' 	=> 'sort'
				,'admin_label' 	=> true
				,'value' 		=> array(
						'Date'		=> 'date'
						,'Name'		=> 'name'
						,'Slug'		=> 'slug'
					)
				,'description' => ''
			),
			array(
				'type' 			=> 'dropdown'
				,'heading' 		=> esc_html__( 'Order By', 'wpdance' )
				,'param_name' 	=> 'order_by'
				,'admin_label' 	=> true
				,'value' 		=> array(
						'DESC'		=> 'DESC'
						,'ASC'		=> 'ASC'
					)
				,'description' => ''
			),			
			array(
				'type' 			=> 'textfield',
				'class' 		=> '',
				'heading' 		=> esc_html__("Number Excerpt", 'wpdance'),
				'description' 	=> esc_html__("number excerpt", 'wpdance'),
				'admin_label' 	=> true,
				'param_name' 	=> 'number_excerpt',
				'value' 		=> '20',
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