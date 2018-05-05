<?php
/**
 * Shortcode: tvlgiao_wpdance_business
 */

if (!function_exists('tvlgiao_wpdance_business_function')) {
	function tvlgiao_wpdance_business_function($atts) {
		extract(shortcode_atts(array(
			'class' 		=> ''
		), $atts));
		$query_search = esc_html__( 'Search business here....' , 'wpdance');
		if(get_search_query() != "" && $_GET['post_type'] == 'partner_business'){
			$query_search = get_search_query();
		}
		$id   = 'searchform-'.mt_rand();
		ob_start(); ?>
		    <form role="search" method="get" id="<?php echo esc_attr($id); ?>" class="searchform" action="<?php echo home_url( '/' ); ?>" >
		    	<input type="text" placeholder="<?php echo esc_attr($query_search); ?>" name="s" />
		    	<input type="hidden" name="post_type" value="partner_business">
		    	<button type="submit" title="Search"><i class="fa fa-search"></i></button>
		    </form>			
		<?php
		$output = ob_get_contents();
		ob_end_clean();
		wp_reset_postdata();
		return $output;
	}
}
add_shortcode('tvlgiao_wpdance_business', 'tvlgiao_wpdance_business_function');
?>