<?php
/**
 * Shortcode: tvlgiao_wpdance_current_date
 */

if (!function_exists('tvlgiao_wpdance_current_date_function')) {
	function tvlgiao_wpdance_current_date_function($atts) {
		extract(shortcode_atts(array(
			'class' 		=> ''
		), $atts));
		ob_start(); ?>
			<?php
				$thu 	= date("l");
				$date  	= date("d");
				$month  = date("m");
				$year 	= date("Y");
				//if(pll_current_language() == 'vi'){
					switch($thu){
					    case "Monday":
					        $thu = "Thứ Hai";
					        break;
					    case "Tuesday":
					        $thu = "Thứ Ba";
					        break;
					    case "Wednesday":
					        $thu = "Thứ Tư";
					        break;
					    case "Thursday":
					        $thu = "Thứ Năm";
					        break;
					    case "Friday":
					        $thu = "Thứ Sáu";
					        break;
					    case "Saturday":
					        $thu = "Thứ Bảy";
					        break;
					    case "Sunday":
					        $thu = "Chủ Nhật";
					        break;
					}
				//}
				$string_date = $thu.", ".$date."/".$month."/".$year;	
			?>
			<div class="wd-date-time">
				<div class="row">
					<div class="col-sm-24">
						<span class="wd-date"><?php echo esc_attr($string_date);  ?></span>
						<span class="wd-time"> GMT + 10 </span>
					</div>	
				</div>
			</div>
		<?php
		$output = ob_get_contents();
		ob_end_clean();
		wp_reset_postdata();
		return $output;
	}
}
add_shortcode('tvlgiao_wpdance_current_date', 'tvlgiao_wpdance_current_date_function');
?>