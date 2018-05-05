<?php
/**
 * Shortcode: tvlgiao_wpdance_adv_search_business
 */

if (!function_exists('tvlgiao_wpdance_adv_search_business_function')) {
	function tvlgiao_wpdance_adv_search_business_function($atts) {
		extract(shortcode_atts(array(
				'class'		=> '',
			), $atts));
		
		// Data Category Business
		global $wpdb;
		$category_name = "Ăn Uống";
		if(isset($_GET['cateid'])){
			$cateid = $_GET['cateid'];
		}else{
			$cateid = 1;
		}
		$sql 			= "SELECT id, keywords FROM astco_category WHERE id LIKE '".$cateid."%'";
		$cat_keywords 	= $wpdb->get_results($sql);

		// Get Data Search
		if(isset($_GET['key_word']) && isset($_GET['cat_keyword']) && isset($_GET['country']) && isset($_GET['state']) && isset($_GET['suburb'])){
			$key_word 		= isset($_GET['key_word']) ? $_GET['key_word'] : "";
			$cat_keyword 	= isset($_GET['cat_keyword']) ? $_GET['cat_keyword'] : "";
			$country 		= isset($_GET['country']) ? $_GET['country'] : "";
			$state 			= isset($_GET['state']) ? $_GET['state'] : "";
			$suburb 		= isset($_GET['suburb']) ? $_GET['suburb'] : "";

		    $sql_country = "select DISTINCT b.country from astco_business b
		            join (astco_business_category bc, astco_category c)
		            on (c.id=".$cat_keyword." and c.id=bc.keyword_id and bc.bus_id=b.id)";
		    $sql_state = "select DISTINCT b.state from astco_business b
		            join (astco_business_category bc, astco_category c)
		            on (c.id=".$cat_keyword." and c.id=bc.keyword_id and bc.bus_id=b.id)";
		    $sql_suburb = "select DISTINCT b.suburb from astco_business b
		            join (astco_business_category bc, astco_category c)
		            on (c.id=".$cat_keyword." and c.id=bc.keyword_id and bc.bus_id=b.id)";
		    $res_country 	= $wpdb->get_results($sql_country);
		    $res_state 		= $wpdb->get_results($sql_state);
		    $res_suburb		= $wpdb->get_results($sql_suburb);

		}
		ob_start(); ?>
			<div class="wd-bus-advance-search">
				<h2 class="wd-heading-business">Tìm Kiếm Nâng Cao</h2>
				<div class="input-group">
					<form action='<?php echo esc_url( home_url( '/' ).'advanced_search/' ); ?>' method="get" id="advanced_search">
						<!-- Tên Doanh Nghiệp -->
						<div class="form-group">
							<label>Tên Doanh Nghiệp: </label>
							<input name="key_word" id="advanced-search" class="form-control" autocomplete="off" placeholder="Tên doanh nghiệp..." value="<?php echo $_GET['key_word']; ?>"/>	
						</div>
						<!-- Ngành Kinh Doanh -->
						<div class="form-group">
							<label>Ngành Kinh Doanh: </label>
							<select name="cat_keyword" class="input-large form-control" id="keyword_selection">
			                    <option value="">--- Ngành Kinh Doanh --- </option>
			                    <?php
									foreach($cat_keywords as $cat_keyword){
										$select = "";
										if( $cat_keyword->id == $_GET['cat_keyword'] ) $select = "selected";	
								        echo '<option value="'.$cat_keyword->id.'" '.$select.'>'.$cat_keyword->keywords.'</option>';
								    }; 
							    ?>
							</select>
						</div>
						<!-- Khu vực -->
						<div id="wd-data-busi">
							<div class="wd-container-loader">
								<div class="wd-loader"></div>
							</div>
							<div id="region">

					            <div class="form-group">
					            	<label>Quốc Gia: </label>
					                <select name="country" class="input-large form-control" <?php  if(!isset($res_country)) echo 'disabled'; ?> id="com_nation">
					                    <option value="">--- Quốc gia --- </option>
					                    <?php
						                    if(isset($res_country)){
						                    	$selected = '';             	
									       		foreach($res_country as $country){
									       			if( $country->country == $_GET['country'] ) $select = "selected";			
										            echo '<option value="'.$country->country.'" '.$select.' >'.$country->country.'</option>';
										        }
										    }
					                    ?>
									 </select>
								</div>

					            <div class="form-group">
					            	<label>Tiểu Bang: </label>
					                <select name="state" class="input-large form-control" <?php  if(!isset($res_state)) echo 'disabled'; ?> id="com_state">
					                    <option value="">--- Tiểu bang --- </option>
					                    <?php
						                    if(isset($res_state)){
						                    	$selected = '';             	
									       		foreach($res_state as $state){
									       			if( $state->state == $_GET['state'] ) $select = "selected";			
										            echo '<option value="'.$state->state.'" '.$select.' >'.$state->state.'</option>';
										        }
										    }
					                    ?>
									 </select>
								</div>
								
					            <div class="form-group">
					            	<label>Quận Huyện: </label>
					                <select name="suburb" class="input-large form-control" <?php  if(!isset($res_suburb)) echo 'disabled'; ?> id="com_suburb">
					                    <option value="">--- Quận / Huyện --- </option>
					                    <?php
						                    if(isset($res_suburb)){
						                    	$selected = '';             	
									       		foreach($res_suburb as $suburb){
									       			if( $suburb->suburb == $_GET['suburb'] ) $select = "selected";			
										            echo '<option value="'.$suburb->suburb.'" '.$select.' >'.$suburb->suburb.'</option>';
										        }
										    }
					                    ?>
									 </select>
								</div>
							</div>
						</div>
						<!-- Submit Form -->
						<input type="hidden" name="search" value="advanced-search">
						<input type="hidden" name="cateid" value="<?php echo $cateid; ?>">
						<div class="wd-input-submit">
		                	<input type="submit" value="Tìm Kiếm">		                
		            	</div>
	            	</form>
				</div>
			</div>
			<script type="text/javascript">
			jQuery(document).ready(function($) {
				$('#keyword_selection').change(function(){
					// ID
					var dnID = $('#keyword_selection').val();

					// Send ajax
					var request = $.ajax({
					
						url: "<?php echo esc_url( home_url( '/' ).'quick-search/?searchType=load_combobox' ); ?>",
						method: "GET",
						data: { id : dnID },
						dataType: "html",
						beforeSend: function() {
							$('.wd-container-loader').css("display", "block");
						}
					});
					request.done(function( msg ) {
						$('#region').html(msg);
						$('.wd-container-loader').css("display", "none");
					});

					request.fail(function( jqXHR, textStatus ) {
						alert( "Request failed: " + textStatus );
					});
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
add_shortcode('tvlgiao_wpdance_adv_search_business', 'tvlgiao_wpdance_adv_search_business_function');
?>