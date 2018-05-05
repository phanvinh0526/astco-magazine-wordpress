<?php
/**
 * Shortcode: tvlgiao_wpdance_special_blog_slider
 */
if(!function_exists('tvlgiao_wpdance_special_blog_slider_function')){
	function tvlgiao_wpdance_special_blog_slider_function($atts,$content){
		extract(shortcode_atts(array(
			'number'				=> 6
			,'data_slider_home'		=> ''
			,'data_post'			=> 'recent-post'
			,'excerpt'				=> '1'
			,'number_excerpt'		=> '20'
			,'show_nav'				=> '1'
			,'auto_play'			=> '1'
			,'class'				=> ''
		),$atts));
		$show_detail = 0;
		$args = array(
			'post_type'				=> 'post'
			,'ignore_sticky_posts'	=> 1
			,'posts_per_page'		=> $number
			,'post_status'			=> 'publish'
		);
		if($data_post == 'most-view'){
			$args['meta_key'] 		= '_wd_post_views_count';
			$args['orderby'] 		= 'meta_value_num';
			$args['order'] 			= 'DESC';
		}
		wp_reset_query();
		$recent_posts = new WP_Query($args);
		$num_post =  $recent_posts->post_count;
		$data_slider_home 	= rtrim($data_slider_home, "|"); 
		$array_data   		= explode('|', $data_slider_home);
		$num_post			= count($array_data);
		if( $num_post < 2 ){ $is_slider = 0; }
		$random_id = 'wd_special_post'.mt_rand();
		ob_start(); ?>
		<?php if ( $recent_posts->have_posts() ) :  ?>
			<div id="<?php echo esc_attr( $random_id ); ?>" class="owl-carousel wd_special_post_wrapper <?php echo esc_attr( $class ); ?>">
				<?php foreach ($array_data as $key => $data_post) { ?>
					<?php $data_single_post = explode(',', $data_post); ?>
					<?php $_post = get_post( $data_single_post[1]); global $post;?>
					<div class="wd-content-post-home">
						<div class="wd-thumbnail-post">
							<?php if ( has_post_thumbnail( $_post->ID ) ) { ?>
								<div class="post_thumbnail image">
									<a class="wd-effect-blog" href="<?php echo get_permalink( $_post->ID ); ?>">
										<?php if($_post->post_type == "partner_business"){ ?>
											<?php
								    			$image_gallery 	= get_post_meta($_post->ID, '_easy_image_gallery', true );
    											$attachments 	= array_filter( explode( ',', $image_gallery ) );
    											echo wp_get_attachment_image( $attachments[0], 'image_size_slider' );
											?>
										<?php }else{ ?>
											<?php echo get_the_post_thumbnail( $_post->ID, 'image_size_slider',array('class' => 'thumbnail-effect-1', 'title'=>get_the_title()) ); ?>			
										<?php }; // End if ?>		
									</a>
								</div>
							<?php } ?>
						</div>					
						<div class="wd-infomation-post">
							<div class="wd-entry-title">
								<a href="<?php echo get_permalink( $_post->ID ); ?>" title="<?php printf( esc_html__( 'Permalink to %s', 'wpdance' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
									<?php echo esc_attr($_post->post_title); ?>
								</a>
							</div>
							<?php if($excerpt): ?>
								<div class="excerpt"><?php tvlgiao_wpdance_the_excerpt_max_words($number_excerpt,$_post); ?><a class="readmore_link" href="<?php echo get_permalink( $_post->ID ); ?>"></a></div>
							<?php endif; ?>							
						</div>
					</div>
				<?php } // End foreach ?>					
			</div>
		<?php endif; //Have Post?>

		<script type="text/javascript">
			jQuery(document).ready(function($) {
		 
				var time = 7; // time in seconds
		 
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
		wp_reset_query();
		return $output;
	}
}
add_shortcode('tvlgiao_wpdance_special_blog_slider','tvlgiao_wpdance_special_blog_slider_function');
?>