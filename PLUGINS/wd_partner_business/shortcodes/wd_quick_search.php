<?php
/**
 * Shortcode: tvlgiao_wpdance_banner_image
 */

	if (!function_exists('wd_business_quick_search_function')) {
		function wd_business_quick_search_function($atts) {
			extract(shortcode_atts(array(
				'url_advanced' 	=> '',
				'class'			=> ''
			), $atts));
			ob_start(); ?>
				<div class="wd-bus-quick-search">

					<div class="input-group">
						<form action='<?php echo esc_url( home_url( '/' ).'quick-search/' ); ?>' method="get" id="quick-searchform">
							<input type="hidden" name="search" value="quick-search">
							<div class="search-field-input">
								<input name="key_word" id="quick-search" autocomplete="off" placeholder="Tên doanh nghiệp ..."/>
			                </div>
			                <button class="search-field-button" type="submit" onClick="return quick_search_checkform();"><i class="fa fa-search"></i></button>
		            	</form>
		            	
					</div>
					<a style="color: rgba(255, 0, 0, 0.65); text-align: right; font-weight: 700; padding-left: 10px" href="<?php echo esc_url( home_url( '/' ).'?search=select_category' ); ?>">Tìm Kiếm Nâng Cao</a>
				</div>
				<script type="text/javascript">
						function quick_search_checkform(){
							
							if($('#quick-search').val() == ""){
								alert("Xin vui lòng nhập từ khóa tìm kiếm.");
								return false;
							}else{
								return true;	
							}
						}
					jQuery(document).ready(function($) {

						var quick_search_options = {	
							url: function(phrase) {
								return "<?php echo esc_url( home_url( '/' ).'quick-search/?search=data-post&format=json' ); ?>";
							},
							list: {
								onKeyEnterEvent: function(){
									$("#quick-search").val(($("#quick-search").getSelectedItemData().name));
									$("#quick-searchform").submit();
								},
								onClickEvent: function(){
									$("#quick-search").val(($("#quick-search").getSelectedItemData().name));
									$("#quick-searchform").submit();
								},
								showAnimation: {
									type: "fade", //normal|slide|fade
									time: 300,
									callback: function() {}
								},
								hideAnimation: {
									type: "slide", //normal|slide|fade
									time: 200,
									callback: function() {}
								},
								maxNumberOfElements: 8
							},
							requestDelay: 400,
							getValue: "name"
						};	
						$("#quick-search").easyAutocomplete(quick_search_options);
					});
				</script>
			<?php
			$output = ob_get_contents();
			ob_end_clean();
			wp_reset_postdata();
			return $output;
		}
	}
	add_shortcode('wd_business_quick_search', 'wd_business_quick_search_function');
?>