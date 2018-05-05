<?php
	wp_reset_postdata();
	wp_reset_query();
	$blog_category = array();
	$blog_category[esc_html__('All Category','wdoutline')] = -1;
	$admin_lang = defined('ICL_LANGUAGE_CODE') ? ICL_LANGUAGE_CODE : 'en';
	$categories = 	get_terms( 'category', 
								array(	'hide_empty' 	=> 0,
								 	  	'lang' 			=> $admin_lang,
	        							'cache_domain' 	=> $admin_lang)
							 );

	foreach ($categories as $category ) {
		$blog_category[$category->slug] = $category->term_id;
	}
	
	// Special Blog
	vc_map(array(
		'name' 				=> esc_html__("Special Blog", 'wpdance'),
		'base' 				=> 'tvlgiao_wpdance_special_blog',
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
                "type" 			=> "category_post",
                "class" 		=> "",
                "heading" 		=> esc_html__("Not In Category", 'wpdance'),
                "param_name" 	=> "data_not_in_cate",
                "value" 		=> '',
                "description" 	=> esc_html__("Choose category", 'wpdance'),
                'dependency'  	=> Array('element' => "id_category", 'value' => array('-1'))
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
				"type" 			=> "dropdown",
				"class" 		=> "",
				"heading" 		=> esc_html__("Show Thumbnail", 'wpdance'),
				"admin_label" 	=> true,
				"param_name" 	=> "show_thumbnail",
				"value" => array(
						'Yes' 		=> '1',
						'No' 		=> '0'
					),
				"description" 	=> "",
				'dependency'  		=> Array('element' => "style_home_footer", 'value' => array('style-footer'))
			),
			array(
				"type" 			=> "dropdown",
				"class" 		=> "",
				"heading" 		=> esc_html__("Show Author", 'wpdance'),
				"admin_label" 	=> true,
				"param_name" 	=> "show_author",
				"value" => array(
						'Yes' 		=> '1',
						'No' 		=> '0'
					),
				"description" 	=> "",
			),
			array(
				"type" 			=> "dropdown",
				"class" 		=> "",
				"heading" 		=> esc_html__("Show Date", 'wpdance'),
				"admin_label" 	=> true,
				"param_name" 	=> "show_date",
				"value" => array(
						'Yes' 		=> '1',
						'No' 		=> '0'
					),
				"description" 	=> "",
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
			),
			array(
				"type" 			=> "dropdown",
				"class" 		=> "",
				"heading" 		=> esc_html__("Show Readmore", 'wpdance'),
				"admin_label" 	=> true,
				"param_name" 	=> "read_more",
				"value" => array(
						'Yes' 		=> '1',
						'No' 		=> '0'
					),
				"description" 	=> "",
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