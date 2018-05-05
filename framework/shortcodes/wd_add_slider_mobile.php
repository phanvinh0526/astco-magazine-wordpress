<?php
/**
 * Shortcode: tvlgiao_wpdance_adv_sidebar_mobile
 */

if (!function_exists('tvlgiao_wpdance_adv_sidebar_mobile_function')) {
	function tvlgiao_wpdance_adv_sidebar_mobile_function($atts) {
		extract(shortcode_atts(array(
			'id_category'	=> '-1',
			'number_adv'	=> '5',
			'adv_location'	=> '0',
			'class' 		=> ''
		), $atts));
		wp_reset_query();
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
		$random_id = 'wd_adv_mobile_'.mt_rand();
		ob_start(); ?>
		<div id="wd_adv_mobile">
			<div id="<?php echo esc_attr($random_id); ?>" class="owl-carousel wd_adv_mobile">				
				
				<?php
					if( $adv_sidebar_homes->have_posts() ){
						while( $adv_sidebar_homes->have_posts() ) : $adv_sidebar_homes->the_post(); global $post;
							$id_post  = get_the_ID();
							$imag_url = get_the_post_thumbnail_url($post, 'full');
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
							if($_post_config['advertise_new_window']){$_new_tab = 'target="_blank"';};
							?>
							<div class="wd_per_slider_adv">
					    		<a href="<?php echo $_post_config['advertise_file_url']; ?>" <?php echo $_new_tab; ?>>
					    			<img src="<?php echo esc_url($imag_url);?>" data-thumb="<?php echo esc_url($imag_url);?>" alt=""/>
					    		</a>
				    		</div>
			    		<?php					
						endwhile; 
					}; // End have post
				?>
				
			</div>
		</div>
			<script type="text/javascript">
			jQuery(document).ready(function($) {
		 
				var time = 3; // time in seconds
		 
				var $progressBar,
				    $bar, 
				    $elem, 
				    isPause, 
				    tick,
				    percentTime;
				var $_this = jQuery('#<?php echo esc_attr( $random_id ); ?>');
				// Init the carousel
				$_this.owlCarousel({
					smartSpeed : 500,				
					loop: true,
					nav: true,
					items: 1,
					onInitialized: progressBar,
					onTranslated: moved,
					onDrag: pauseOnDragging
				});

				// Init progressBar where elem is $("#owl-demo")
				function progressBar(){    
				    // build progress bar elements
				    buildProgressBar();
				    // start counting
				    start();
				}

				// create div#progressBar and div#bar then prepend to $("#owl-demo")
				function buildProgressBar(){
				    $progressBar = $("<div>",{
				        id:"progressBar"
				    });
				    
				    $bar = $("<div>",{
				        id:"bar"
				    });
				    
				    $progressBar.append($bar).prependTo($("#<?php echo esc_attr( $random_id ); ?>"));
				}

				function start() {
				    // reset timer
				    percentTime = 0;
				    isPause = false;
				    // run interval every 0.01 second
				    tick = setInterval(interval, 10);
				};

				function interval() {
				    if(isPause === false){
				        percentTime += 1 / time;
				        
				        $bar.css({
				            width: percentTime+"%"
				        });
				        
				        // if percentTime is equal or greater than 100
				        if(percentTime >= 100){
				            // slide to next item 
				            $("#<?php echo esc_attr( $random_id ); ?>").trigger("next.owl.carousel");
				            percentTime = 0; // give the carousel at least the animation time ;)
				        }
				    }
				}

				// pause while dragging 
				function pauseOnDragging(){
				    isPause = true;
				}

				// moved callback
				function moved(){
					// clear interval
					clearTimeout(tick);
					// start again
					start();
				}
			});
			</script>
			<style>
				.owl-carousel .item {
					height: 200px;
					background: #4DC7A0;
					padding: 1rem;
				}

				#bar {
					width: 0%;
					max-width: 100%;
					height: 1px;
					background: #980b0e;
				}

				#progressBar {
					width: 100%;
					background: #EDEDED;
				}
			</style>
		<?php
		$output = ob_get_contents();
		ob_end_clean();
		wp_reset_postdata();
		return $output;
	}
}
add_shortcode('tvlgiao_wpdance_adv_sidebar_mobile', 'tvlgiao_wpdance_adv_sidebar_mobile_function');
?>