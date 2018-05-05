<?php
	vc_add_shortcode_param('data_slider_post', 'tvlgiao_wpdance_param_vc_custom_setting', TVLGIAO_WPDANCE_THEME_JS.'/wd_param_custom.js');
	function tvlgiao_wpdance_param_vc_custom_setting( $settings, $value ) {
		$query_post 	= new WP_Query(array('post_type' => 'post','posts_per_page'=>-1));
		$query_business = new WP_Query(array('post_type' => 'partner_business','posts_per_page'=>-1));
		$_data_slider = '<span>Nhập từ khóa tìm kiếm</span></br/>';
		$_data_slider .= '<p><input type="search" id="searchBox"></p>';
		$_data_slider .= '<select id="wd_category_se"class="wd-data-post">';
			//Post Type Post
			$_data_slider .= '<optgroup label="Select Post">';
			if ($query_post->have_posts() ) {
				while ($query_post->have_posts() ){$query_post->the_post();
					$_data_slider .= '<option value="po,'.get_the_id().'">'.get_the_title().'</option>';
				} // End while
				wp_reset_postdata();
			}
			$_data_slider .= '</optgroup>';									
			//Post Tyle Business		
			$_data_slider .= '<optgroup label="Select Business">';
			if ($query_business->have_posts() ) {
				while ($query_business->have_posts() ){$query_business->the_post();
					$_data_slider .= '<option value="bu,'.get_the_id().'">'.get_the_title().'</option>';
				} // End while
				wp_reset_postdata();
			}
			$_data_slider .= '</optgroup>';	
			
		$_data_slider .='</select>';
		#content of param
		$out = '<div class="wd-wraper-data-slider">';
		$out .='<textarea rows="4" cols="50" type="text" class="value_category_shortcodegrid wpb_vc_param_value wpb-textinput ' .esc_attr( $settings['param_name'] ) . ' ' .esc_attr( $settings['type'] ).'_field" name="' . esc_attr( $settings['param_name'] ) . '">' . esc_attr( $value ) . '</textarea>';
	    $out .= '<div class="wd-select-data">'.$_data_slider.'<button type="button" class="btn btn-info active wd-add-data-slider">'.esc_html__('ADD DATA SLIDER','wdportfolio' ).'</button></div>' ;
	    $out .= '</div>';//end div container
		return $out; // This is html markup that will be outputted in content elements edit form
	}

	vc_add_shortcode_param('category_post', 'tvlgiao_wpdance_param_vc_custom_category_post', TVLGIAO_WPDANCE_THEME_JS.'/wd_param_category.js');
	function tvlgiao_wpdance_param_vc_custom_category_post( $settings, $value ) {
		$categories = 	get_terms( 'category', array(	'hide_empty' 	=> 0 ));
		$_data_slider = '<select class="wd-data-post-cate">';
			foreach ($categories as $category ) {
				$_data_slider .= '<option value="'.$category->term_id.'">'.$category->name.'</option>';
			} // End while
			wp_reset_postdata();
		$_data_slider .='</select>';
		#content of param
		$out 	 = '<div class="wd-wraper-data-category">';
		$out 	.='<textarea rows="2" cols="50" type="text" class="value_category_shortcodegrid wpb_vc_param_value wpb-textinput ' .esc_attr( $settings['param_name'] ) . ' ' .esc_attr( $settings['type'] ).'_field" name="' . esc_attr( $settings['param_name'] ) . '">' . esc_attr( $value ) . '</textarea>';
	    $out 	.= '<div class="wd-select-data">'.$_data_slider.'<br/><button type="button" class="btn btn-info active wd-add-data-category">'.esc_html__('Select Category','wdportfolio' ).'</button></div>' ;
	    $out 	.= '</div>';//end div container
		return $out; // This is html markup that will be outputted in content elements edit form
	}
?>