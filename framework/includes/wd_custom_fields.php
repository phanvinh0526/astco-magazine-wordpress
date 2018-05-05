<?php 
	class Tvlgiao_Wpdance_Admin_General_CustomFields extends Tvlgiao_Wpdance_Admin_GeneralTheme {
		public function __construct(){
			add_action("admin_init", array($this,"tvlgiao_wpdance_generate_customfields"));
			add_action('save_post', array($this,'tvlgiao_wpdance_save_customfield'));
		}
		public function tvlgiao_wpdance_generate_customfields(){
			// Add shortcode Generator
			add_meta_box("wp_cp_custom_post_layout", esc_html__("Config Post", 'wpdance'), array($this,"tvlgiao_wpdance_post_layout"), "post", "normal", "high");
			// Page
			add_meta_box('wp_cp_custom_page_atts',   esc_html__("Additional Attributes", 'wpdance'), array($this, 'tvlgiao_wpdance_page_configuration'), 'page', 'side', 'default');
			// Product
			add_meta_box("wp_cp_custom_product_layout", esc_html__("Config Product", 'wpdance'), array($this,"tvlgiao_wpdance_product_configuration"), "product", "normal", "high");
			
		}
		// Render
		public function tvlgiao_wpdance_post_layout(){
			require_once get_template_directory().'/framework/includes/metaboxes/wd_custom_post_layout.php';
		}
		public function tvlgiao_wpdance_page_configuration(){
			require_once get_template_directory().'/framework/includes/metaboxes/wd_custom_page_layout.php';
		}
		public function tvlgiao_wpdance_product_configuration(){
			require_once get_template_directory().'/framework/includes/metaboxes/wd_custom_product_layout.php';
		}
		
		// Save Custom
		public function tvlgiao_wpdance_save_customfield($post_id){
			if(defined( 'DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;
			/*--------------------------------------------------------------------------*/
			/*						 SAVE CUSTOM POST LAYOUT 							*/
			/*--------------------------------------------------------------------------*/		
			// Save post custom layout & sidebar and Media
			if( isset($_POST['custom_post_layout']) && $_POST['custom_post_layout'] == "custom_single_post_layout" ){
				$_default_post_config = array(
					'layout' 				=> $_POST['single_layout']
					,'post_type'			=> $_POST['single_post_type']
					,'wd_adv_category_id'	=> $_POST['wd_adv_category_name']
				);
				$_default_post_config['wd_author_post'] = isset($_POST['wd_author_post'])?$_POST['wd_author_post']: '';
				// Audio
				$audio_mp3 			= isset($_POST['audio_mp3'])?$_POST['audio_mp3']: '';
				$audio_soundcloud 	= isset($_POST['audio_soundcloud'])?$_POST['audio_soundcloud']: '';
				if($_POST['single_post_type'] == 'audio') {
					if(strlen($audio_mp3) > 0) 			$_default_post_config['audio_mp3'] 			= $audio_mp3;
					if(strlen($audio_soundcloud) > 0) 	$_default_post_config['audio_soundcloud']	= $audio_soundcloud;
				}
				//Video
				$video_url = isset($_POST['video_url'])?$_POST['video_url']:'';	
				if( $_POST['single_post_type'] == 'video' && strlen($video_url) > 0 ) {
					$_default_post_config['video_url'] = $video_url;
				}
				//Gallery
				$ret_str = serialize($_default_post_config);
				update_post_meta($post_id,'_tvlgiao_wpdance_custom_post_config',$ret_str);	
			}
			// Slider Image
			if( isset($_POST['_sliders_slider']) && $_POST['_sliders_slider'] == 1 ){
				$ret_str = '';
				$element_count = count($_POST['element_id']);
				$ret_arr = array();
				for( $i = 0 ; $i < $element_count ; $i++ ){	
					$temp_arr = array(
						'id' 				=> isset($_POST['element_id'][$i]) 			? $_POST['element_id'][$i] : ''
						,'image_url' 		=> isset($_POST['element_image_url'][$i]) 	? $_POST['element_image_url'][$i]: ''
						,'thumb_url' 		=> isset($_POST['thumb_url'][$i]) 			? $_POST['thumb_url'][$i] : ''
						,'url' 				=> isset($_POST['element_url'][$i]) 		? $_POST['element_url'][$i] : ''
						,'alt' 				=> isset($_POST['element_alt'][$i]) 		? $_POST['element_alt'][$i] : ''
						,'title' 			=> isset($_POST['element_title'][$i]) 		? $_POST['element_title'][$i] : ''
						,'slide_title' 		=> isset($_POST['slide_title'][$i]) 		? $_POST['slide_title'][$i] : ''
						,'slide_content' 	=> isset($_POST['slide_content'][$i]) 		? $_POST['slide_content'][$i] : ''					
					
					);
					array_push( $ret_arr, $temp_arr );
				}
				
				$ret_str = serialize($ret_arr);
				update_post_meta($post_id,'_tvlgiao_wpdance_post_slider',$ret_str);	

				$ret_arr = array(
					'post_slider_config_auto' 	=> isset($_POST['post_slider_config_auto']) ? $_POST['post_slider_config_auto'] : 0
					,'post_slider_config_nav' 	=> isset($_POST['post_slider_config_nav']) 	? $_POST['post_slider_config_nav'] 	: 0
					,'post_slider_config_pagi' 	=> isset($_POST['post_slider_config_pagi']) ? $_POST['post_slider_config_pagi'] : 0
				);
				$ret_str = serialize($ret_arr);
				update_post_meta($post_id,'_tvlgiao_wpdance_post_slider_config',$ret_str);	
			}
			//Gallery Image
			if( isset($_POST['_sliders_gallery']) && $_POST['_sliders_gallery'] == 1 ){
				$ret_str = '';
				$element_count = count($_POST['g_element_id']);
				$ret_arr = array();
				for( $i = 0 ; $i < $element_count ; $i++ ){	
					$temp_arr = array(
						'id' 			=> isset($_POST['g_element_id'][$i]) ? $_POST['g_element_id'][$i] : ''
						,'image_url' 	=> isset($_POST['element_image_url'][$i]) 	? $_POST['element_image_url'][$i]: ''
						,'thumb_url' 	=> isset($_POST['g_thumb_url'][$i]) ? $_POST['g_thumb_url'][$i] : ''
						,'url' 			=> isset($_POST['g_element_url'][$i]) ? $_POST['g_element_url'][$i] : ''
						,'alt' 			=> isset($_POST['g_element_alt'][$i]) ? $_POST['g_element_alt'][$i] : ''
						,'title' 		=> isset($_POST['g_element_title'][$i]) ? $_POST['g_element_title'][$i] : ''
					);
					array_push( $ret_arr, $temp_arr );
				}
				
				$ret_str = serialize($ret_arr);
				update_post_meta($post_id,'_tvlgiao_wpdance_post_gallery',$ret_str);	
				
				
				$ret_arr = array(
					'gallery_width' 	=> isset($_POST['gallery_width']) ? $_POST['gallery_width'] : ''
				);
				$ret_str = serialize($ret_arr);
				update_post_meta($post_id,'_tvlgiao_wpdance_post_gallery_config',$ret_str);
			}
			/*--------------------------------------------------------------------------*/
			/*						 SAVE CUSTOM PAGE LAYOUT 							*/
			/*--------------------------------------------------------------------------*/
			// Custom footer and header page layout
			if( isset($_POST['custom_page_header_footer']) && $_POST['custom_page_header_footer'] == "page_header_footer" ){
				// Header
				if (isset($_POST['wpdance_custom_header'])){
					update_post_meta($post_id, '_tvlgiao_wpdance_custom_header', intval($_POST['wpdance_custom_header']));
				}
				// Footer
				if (isset($_POST['wpdance_custom_footer'])){
					update_post_meta($post_id, '_tvlgiao_wpdance_custom_footer', intval($_POST['wpdance_custom_footer']));
				}
				$_default_page_config = array(
					'layout' 			=> $_POST['single_layout']
				);
				$ret_str = serialize($_default_page_config);
				update_post_meta($post_id,'_tvlgiao_wpdance_custom_page_config',$ret_str);				
			}

			/*--------------------------------------------------------------------------*/
			/*						 SAVE CUSTOM PRODUCT LAYOUT 						*/
			/*--------------------------------------------------------------------------*/
			if( isset($_POST['custom_product_layout']) && $_POST['custom_product_layout'] == "custom_single_product_layout" ){
				$_default_product_config = array(
					'layout' 			=> $_POST['single_layout']
				);
				//Gallery
				$ret_str = serialize($_default_product_config);
				update_post_meta($post_id,'_tvlgiao_wpdance_custom_product_config',$ret_str);	
			}	
		}
	}
?>