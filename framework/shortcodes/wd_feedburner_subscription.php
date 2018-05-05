<?php
/**
 * Shortcode: tvlgiao_wpdance_feedburner_subscription
 */
if(!function_exists('tvlgiao_wpdance_feedburner_subscription_function')){
	function tvlgiao_wpdance_feedburner_subscription_function($atts,$content){
		extract(shortcode_atts(array(
			'title'					=> esc_html__("Sign up for Our Newsletter", 'wpdance')
			,'intro_text'			=> esc_html__("A newsletter is a regularly distributed publication generally", 'wpdance')
			,'button_text'			=> esc_html__("Subscribe", 'wpdance')
			,'feedburner_id'		=> esc_html__("WpComic-Manga", 'wpdance')
			,'class'				=> ''
		),$atts));
		ob_start(); ?>
		<div class="subscribe_widget <?php echo esc_attr( $class ); ?>">
			<?php if($title != "") : ?>
				<div class="wd-subscribe-header">
					<h2><?php echo esc_attr( $title ); ?></h2>
				</div>
			<?php endif; ?>
			<?php echo ($intro_text) ? '<div class="subscribe_intro_text">'.esc_html($intro_text).'</div>':'' ?>		
			<div class="subscribe_form">
				<form action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo esc_attr($feedburner_id); ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
					<p class="subscribe-email"><input type="text" name="email" class="subscribe_email" value="" placeholder="<?php esc_html_e('enter your email address','wpdance');?>" /></p>
					<input type="hidden" value="<?php echo esc_attr($feedburner_id);?>" name="uri"/>
					<input type="hidden" value="<?php echo get_bloginfo( 'name' );?>" name="title"/>
					<input type="hidden" name="loc" value="en_US"/>
					<button class="button" type="submit" title="Subscribe"><!-- <?php echo esc_attr($button_text); ?> --><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
					<p class="hidden">Delivered by <a href="#" target="_blank">FeedBurner</a></p>
				</form>
			</div>
		</div>
		<script type="text/javascript">
			jQuery(document).ready(function(){
				"use strict";
				var subscribe_input = jQuery(".subscribe_widget input.subscribe_email");
				var value_default = subscribe_input.attr('data-default');
				subscribe_input.val(value_default);
				if( jQuery(this).val() === "" ) jQuery(this).val(value_default);
				subscribe_input.click(function(){
					if( jQuery(this).val() === value_default ) jQuery(this).val("");
				});
				subscribe_input.blur(function(){
					if( jQuery(this).val() === "" ) jQuery(this).val(value_default);
				});
			});
		</script>
		<?php
		$output = ob_get_contents();
		ob_end_clean();
		wp_reset_query();
		return $output;
	}
}
add_shortcode('tvlgiao_wpdance_feedburner_subscription','tvlgiao_wpdance_feedburner_subscription_function');
?>