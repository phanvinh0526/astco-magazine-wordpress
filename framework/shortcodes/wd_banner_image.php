<?php
/**
 * Shortcode: tvlgiao_wpdance_banner_image
 */

if (!function_exists('tvlgiao_wpdance_banner_image_function')) {
	function tvlgiao_wpdance_banner_image_function($atts) {
		extract(shortcode_atts(array(
			'bg_image'			=> '1'
			,'wd_effect_banner'	=> 'wd-banner-effect-01'
			,'open_new_tab'		=> '0'
			,'button_text'		=> ''
			,'link_url'			=> "#"
			,'button_class'		=> ''
			,'top'				=> ''
			,'right'			=> ''
			,'bottom'			=> ''
			,'left'				=> ''
			,'class' 			=> ''
		), $atts));
		$image_url 	= wp_get_attachment_image_src($bg_image, "full");
		$title		= get_bloginfo('name');
		$imgSrc 	= $image_url[0];
		ob_start(); ?>
			<div class="wd-shortcode-banner <?php echo esc_attr($class); ?> <?php echo esc_attr($wd_effect_banner); ?> ">				
				<div class="wd-image-banner">
					<?php 	
						$_new_tab 		= ""; if($open_new_tab){ $_new_tab = 'target="_blank"'; }; 
						$_effect_line	= ""; if($wd_effect_banner == 'wd-banner-effect-01') $_effect_line	= "effect-line"; 

					?>
					<a href="<?php echo esc_url($link_url);?>" <?php echo $_new_tab; ?> class="<?php echo $_effect_line; ?>">
						<img alt="<?php echo esc_attr($title);?>" title="<?php echo esc_attr($title);?>" class="img" src="<?php echo esc_url($imgSrc)?>" />
						<?php if($wd_effect_banner == 'wd-banner-effect-02') : ?>
							<span class="hover hover1">test</span>
							<span class="hover hover2">test</span>
							<span class="hover hover3">test</span>
							<span class="hover hover4">test</span>
						<?php endif; ?>
					</a>
				</div>
				<?php if($button_text !== '' ):?>
					<div class="wd-button-banner" style="top: <?php echo esc_attr($top);?>;left: <?php echo esc_attr($left);?>; right: <?php echo esc_attr($right);?>; bottom: <?php echo esc_attr($bottom);?>;">
						<a class="wd-button-bn <?php echo esc_attr($button_class)?>" <?php echo $_new_tab; ?> href="<?php echo esc_url($link_url)?>" title="<?php echo esc_attr($title);?>" style="font-size: <?php echo esc_attr($button_text_size);?>;"><?php echo esc_attr($button_text);?></a>
					</div>
				<?php endif;?>
			</div>
		<?php
		$output = ob_get_contents();
		ob_end_clean();
		wp_reset_postdata();
		return $output;
	}
}
add_shortcode('tvlgiao_wpdance_banner_image', 'tvlgiao_wpdance_banner_image_function');
?>