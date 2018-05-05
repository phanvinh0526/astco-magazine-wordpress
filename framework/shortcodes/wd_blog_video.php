<?php
/**
 * Shortcode: tvlgiao_wpdance_blog_video
 */
if(!function_exists('tvlgiao_wpdance_blog_video_function')){
	function tvlgiao_wpdance_blog_video_function($atts,$content){
		extract(shortcode_atts(array(
			'id_category'			=> '-1'
			,'number'				=> 6
			,'data_show'			=> 'recent-post'
			,'sort'					=> 'date'
			,'order_by'				=> 'DESC'
			,'number_excerpt'		=> '20'
			,'class'				=> ''
		),$atts));
		$show_detail = 0;
		// New blog
		$args = array(  
			'post_type' 		=> 'post',  
			'posts_per_page' 	=> $number,
			'orderby' 			=> $sort,
			'order'				=> $order_by,
		);
		//Category
		if( $id_category != -1 ){
			$args['tax_query']= array(
					    	array(
							    	'taxonomy' 		=> 'category',
									'terms' 		=> $id_category,
									'field' 		=> 'term_id',
									'operator' 		=> 'IN'
								)
			   			);
		}
		//Most View Products
		if($data_show == 'mostview_blog'){
			$args['meta_key'] 	= '_wd_post_views_count';
			$args['orderby'] 	= 'meta_value_num';
			$args['order'] 		= 'DESC';
		}		
		wp_reset_query();
		$recent_posts = new WP_Query($args);
		$start 		  = 0;
		$number		  = $recent_posts->post_count ;
		$wd_scroll_right = "";
		if($number > 6 ){
			$wd_scroll_right = 'wd-scroll-right';
		}
		ob_start(); ?>
		<?php if ( $recent_posts->have_posts() ) : ?>
			<div class="wd-special-post wd-special-post-video <?php esc_attr($class); ?>">
				<div class="row">
					<?php while( $recent_posts->have_posts() ) : $recent_posts->the_post();global $post; ?>
						<?php
							$_post_config = get_post_meta($post->ID,'_tvlgiao_wpdance_custom_post_config',true);
							if( strlen($_post_config) > 0 ){
								$_post_config = unserialize($_post_config);
							}
						?>
						<?php if($start == 0){ ?>
							<div class="col-sm-16">
								<div class="wd-wrap-content-blog wd-video-left">
									<!-- Post type: Video -->
									<?php if(isset($_post_config['post_type']) && $_post_config['post_type'] == 'video') : ?>
										<div class="wd-video">
											<div class="wd-thumbnail-video">
												<?php the_post_thumbnail('large'); ?>
											</div>
											<?php $url_video    = "#"; ?>
											<?php
												if(isset($_post_config['video_url']) && strlen(trim($_post_config['video_url'])) > 0){
													$url_video =  tvlgiao_wpdance_get_embbed_video(trim($_post_config['video_url']),1200,650);
												}
											?>			
											<a class="tvlgiao_playvideo"><?php esc_html_e('Play Video','wpdance') ?></a>
											<input class="hidden tvlgiao_urlvideo" type="text" value="<?php echo esc_attr($url_video); ?>" id="tvlgiao_urlvideo">			
										</div>
										<div class="wd-info-post">
											<div class="wd-title-post">
												<h2 class="wd-heading-title">
													<a href="<?php the_permalink() ; ?>"><?php the_title(); ?></a>
												</h2>
											</div>
											<div class="wd-_excerpt">
												<?php $excerpt 	= tvlgiao_wpdance_string_limit_words(get_the_excerpt() , $number_excerpt )."..."; echo esc_attr($excerpt); ?>
											</div>
										</div>
									<?php endif; ?>
								</div>

							</div>
							<div class="col-sm-8">
								<div class="wd-content-right <?php echo esc_attr($wd_scroll_right); ?>">
						<?php }else{ ?>
							<div class="wd-wrap-content-blog wd-video-right">
								<!-- Post type: Video -->
								<?php //if(isset($_post_config['post_type']) && $_post_config['post_type'] == 'video') : ?>
									<div class="wd-video">
										<div class="wd-thumbnail-video">
											<?php the_post_thumbnail('medium'); ?>
										</div>
										<?php $url_video    = "#"; ?>
										<?php
											if(isset($_post_config['video_url']) && strlen(trim($_post_config['video_url'])) > 0){
												$url_video =  tvlgiao_wpdance_get_embbed_video(trim($_post_config['video_url']),1200,650);
											}
										?>				
										<a class="tvlgiao_playvideo"><?php esc_html_e('Play Video','wpdance') ?></a>
										<input class="hidden tvlgiao_urlvideo" type="text" value="<?php echo esc_attr($url_video); ?>" id="tvlgiao_urlvideo">			
									</div>
									<div class="wd-info-post">
										<div class="wd-title-post">
											<h2 class="wd-heading-title">
												<a href="<?php the_permalink() ; ?>"><?php the_title(); ?></a>
											</h2>
										</div>
									</div>
								<?php //endif; ?>
							</div>
							<?php  if($start == $number-1) : ?>
									</div>
								</div> <!-- col-sm-8 -->
							<?php endif; ?>	
						<?php } // Endif ?>					
					<?php $start++; endwhile; ?>
				</div>
			</div>
		<?php endif; ?>
		<?php
		$output = ob_get_contents();
		ob_end_clean();
		wp_reset_query();
		return $output;
	}
}
add_shortcode('tvlgiao_wpdance_blog_video','tvlgiao_wpdance_blog_video_function');
?>