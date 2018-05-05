<?php
/**
 * Shortcode: tvlgiao_wpdance_slider_banner_image
 */

if (!function_exists('tvlgiao_wpdance_slider_banner_image_function')) {
	function tvlgiao_wpdance_slider_banner_image_function($atts) {
		extract(shortcode_atts(array(
			'number_image'		=> '5',
			'bg_image'			=> '',
			'link_url_1'		=> '',
			'new_tab_1'			=> '0',
			'link_url_2'		=> '',
			'new_tab_2'			=> '0',
			'link_url_3'		=> '',
			'new_tab_3'			=> '0',
			'link_url_4'		=> '',
			'new_tab_4'			=> '0',
			'link_url_5'		=> '',
			'new_tab_5'			=> '0',
			'pausetime'			=> '3000',
			'class' 			=> '',
		), $atts));
		$array_image 	= explode(',',$bg_image); 

		$i = 0;
		$imglink_array = array();
		foreach($array_image as $_image)
	    {	
	        $img_url = wp_get_attachment_image_src($_image, "full");
	        $imglink_array[$i] = $img_url[0];
	        $i++;
	    }
	    $random_id = 'wd_banner_slider'.mt_rand();
		ob_start(); ?>
			<div id="<?php echo esc_attr($random_id); ?>" class="wd-banner-slider <?php echo esc_attr($class); ?>">
			    <div id="slider" class="nivoSlider">
			    	<?php for($i= 0; $i < $number_image; $i++) { ?>
			    		
			    		<?php 
			    			$link_url = 'link_url_'.($i+1); 
			    			$new_tab  = 'new_tab_'.($i+1);
			    			$_new_tab = "";
			    			if(${$new_tab}){$_new_tab = 'target="_blank"';};
			    		?>		    	
			    		<a href="<?php echo ${$link_url}; ?>" <?php echo $_new_tab; ?>>
			    			<img src="<?php echo esc_url($imglink_array[$i]);?>" data-thumb="<?php echo esc_url($imglink_array[$i]);?>" alt=""/></a>
			    		</a>	
			    	
			    	<?php }; ?>
           	 	</div>				
			</div>
			<script type="text/javascript">
			    jQuery(document).ready(function($) {
			    	var $_this = jQuery('#<?php echo esc_attr( $random_id ); ?>');
			        $_this.find('#slider').nivoSlider({
						animSpeed: 500,                   // Slide transition speed 
						pauseTime: <?php echo $pausetime; ?>,
						controlNav: false,                  // How long each slide will show 
						directionNav: false,
					});
			    });
			</script>
		<?php
		$output = ob_get_contents();
		ob_end_clean();
		wp_reset_postdata();
		return $output;
	}
}
add_shortcode('tvlgiao_wpdance_slider_banner_image', 'tvlgiao_wpdance_slider_banner_image_function');
?>