<?php
/**
 * Shortcode: tvlgiao_wpdance_adv_sidebar_home
 */

if (!function_exists('tvlgiao_wpdance_adv_sidebar_home_function')) {
	function tvlgiao_wpdance_adv_sidebar_home_function($atts) {
		extract(shortcode_atts(array(
			'id_category'	=> '-1',
			'number_adv'	=> '5',
			'adv_location'	=> '0',
			'class' 		=> ''
		), $atts));
		wp_reset_query();
		// New blog
		$args = array(  
			'post_type' 		=> 'advertise',  
			'posts_per_page' 	=> $number_adv,

		);
		//Category Sidebar
		if($adv_location == 0){
			$args['meta_key']		= '_tvlgiao_wpdance_location_adv';
			$args['meta_value']		= '0';
		}
		//Home Sidebar
		if($adv_location == 1){
			$args['meta_key']		= '_tvlgiao_wpdance_location_adv';
			$args['meta_value']		= '3';
		}
		//Category
		if( $id_category != -1 && $adv_location == 0 ){				
			$args['tax_query']= array(
					    	array(
							    	'taxonomy' 		=> 'advertise_category',
									'terms' 		=> $id_category,
									'field' 		=> 'term_id',
									'operator' 		=> 'IN'
								)
			   			);
		}
		$adv_sidebar_homes 		= new WP_Query( $args );
		ob_start(); ?>
			<div id="wd_adv_sidebar_banner" class="wd_adv_sidebar_banner">				
				<?php
					if( $adv_sidebar_homes->have_posts() ){
						$count = 1;
						while( $adv_sidebar_homes->have_posts() ) : $adv_sidebar_homes->the_post(); global $post;
							$id_post  = get_the_ID();
							$imag_url = get_post_thumbnail_id( $id_post );
							$_post_config 	= get_post_meta($id_post,'_tvlgiao_wpdance_custom_advertise',true);
							$_default_post_config = array(
									'advertise_file_url' 		=> '',
									'advertise_new_window'		=> '0',			
							);
							if( strlen($_post_config) > 0 ){
								$_post_config = unserialize($_post_config);
								if( is_array($_post_config) && count($_post_config) > 0 ){
									foreach($_default_post_config as $key=>$value){
										$_post_config["{$key}"] 		= ( isset($_post_config["{$key}"]) 	&& strlen($_post_config["{$key}"]) > 0 ) ? $_post_config["{$key}"] : $_default_post_config["{$key}"];
									}
								}
							}else{
								$_post_config = $_default_post_config;
							}
							if ($count % 2 == 1) {
								echo do_shortcode('[tvlgiao_wpdance_banner_image bg_image="'.$imag_url.'" link_url="'.esc_url($_post_config['advertise_file_url']).'" open_new_tab="'.$_post_config['advertise_new_window'].'"]');
							}else{
								echo do_shortcode('[tvlgiao_wpdance_banner_image bg_image="'.$imag_url.'" link_url="'.esc_url($_post_config['advertise_file_url']).'" open_new_tab="'.$_post_config['advertise_new_window'].'" wd_effect_banner="wd-banner-effect-02"]');
							}
							$count++;
						endwhile; 
					}; // End have post
				?>
			</div>
		<?php
		$output = ob_get_contents();
		ob_end_clean();
		wp_reset_postdata();
		return $output;
	}
}
add_shortcode('tvlgiao_wpdance_adv_sidebar_home', 'tvlgiao_wpdance_adv_sidebar_home_function');
?>