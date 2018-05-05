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

	vc_map(array(
			"name"				=> esc_html__("Promotion Information",'wpdance'),
			"base"				=> 'tvlgiao_wpdance_promotion_information',
			'description' 		=> esc_html__("Promotion Information", 'wpdance'),
			"category"			=> esc_html__("WPDance",'wpdance'),
			"params"=>array(	
				array(
					'type' 			=> 'dropdown'
					,'heading' 		=> esc_html__( 'Select Category', 'wdoutline' )
					,'param_name' 	=> 'id_category'
					,'admin_label' 	=> true
					,'value' 		=> $blog_category
					,'description' 	=> ''
				)
				,array(
					'type' 			=> 'dropdown'
					,'heading' 		=> esc_html__( 'Data Show', 'wpdance' )
					,'param_name' 	=> 'data_show'
					,'admin_label' 	=> true
					,'value' 		=> array(
							'Recent Blog'		=> 'recent_blog'
							,'Most View Blog'	=> 'mostview_blog'
							,'Most Comment'		=> 'comment_blog'
						)
					,'description' => ''
				)
				,array(
					'type'			=> 'textfield'
					,'heading' 		=> esc_html__( 'Number of blogs', 'wdoutline' )
					,'param_name' 	=> 'number_blogs'
					,'admin_label' 	=> true
					,'value' 		=> '12'
				)
				,array(
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
				)
				,array(
					'type' 			=> 'dropdown'
					,'heading' 		=> esc_html__( 'Order By', 'wpdance' )
					,'param_name' 	=> 'order_by'
					,'admin_label' 	=> true
					,'value' 		=> array(
							'DESC'		=> 'DESC'
							,'ASC'		=> 'ASC'
						)
					,'description' => ''
				)
				,array(
					'type' 			=> 'textfield',
					'class' 		=> '',
					'heading' 		=> esc_html__("Extra class name", 'woocommerce'),
					'description'	=> esc_html__("Style particular content element differently - add a class name and refer to it in custom CSS.", 'woocommerce'),
					'admin_label' 	=> true,
					'param_name' 	=> 'class',
					'value' 		=> ''
				)
			)
		)
	);
?>