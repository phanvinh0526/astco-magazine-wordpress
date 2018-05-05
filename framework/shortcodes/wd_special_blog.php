<?php
/**
 * Shortcode: tvlgiao_special_post
 */
if(!function_exists('tvlgiao_wpdance_special_blog_function')){
	function tvlgiao_wpdance_special_blog_function($atts,$content){
		extract(shortcode_atts(array(
			'id_category'			=> '-1'
			,'data_not_in_cate'		=> ''
			,'number'				=> 6
			,'data_show'			=> 'recent-post'
			,'sort'					=> 'date'
			,'order_by'				=> 'DESC'
			,'show_thumbnail' 		=> '1'
			,'show_author'			=> '1'
			,'show_date'			=> '1'
			,'excerpt'				=> '1'
			,'read_more'			=> '1'
			,'class'				=> ''
		),$atts));
		$show_detail = 0;
		$data_not_in_cate 	= rtrim($data_not_in_cate, "|"); 
		$array_data   		= explode('|', $data_not_in_cate);
		$num_cate_post		= count($array_data);
		$array_id_cate		= array();
		$number_excerpt 	= get_theme_mod('tvlgiao_wpdance_genneral_blog_number_excerpt','20');
		foreach ($array_data as $key => $data_post) {
			$data_cate_post = explode(',', $data_post); 
			$array_id_cate[]  .= $data_cate_post[0];
		}
		// New blog
		$args = array(  
			'post_type' 		=> 'post',  
			'posts_per_page' 	=> $number,
			'orderby' 			=> $sort,
			'order'				=> $order_by,
		);
		//Category
		if( $id_category != -1 ){
			$args['tax_query'] = 
						array(
					    	array(
						    	'taxonomy' 		=> 'category',
								'terms' 		=> $id_category,
								'field' 		=> 'term_id',
								'operator' 		=> 'IN'
							),
			   			);
		}else{
			if($num_cate_post > 0){
				$args['tax_query'] =
						array(
							array(
								'taxonomy' 		=> 'category',
								'field'    		=> 'term_id',
								'terms'    		=> $array_id_cate,
								'operator' 		=> 'NOT IN',
							),
			   			);
			}
		}
		//Most View Products
		if($data_show == 'mostview_blog'){
			$args['meta_key'] 	= '_wd_post_views_count';
			$args['orderby'] 	= 'meta_value_num';
			$args['order'] 		= 'DESC';
		}		
		wp_reset_query();
		$recent_posts = new WP_Query($args);
		ob_start(); ?>
		<?php if ( $recent_posts->have_posts() ) : ?>
			<div class="wd-special-post <?php esc_attr($class); ?>">
				<?php while( $recent_posts->have_posts() ) : $recent_posts->the_post();global $post; ?>
					<div class="wd-content-post">
						<?php if( $show_thumbnail ){ ?>
							<div class="wd-thumbnail-post">
								<?php if(has_post_thumbnail()){ ?>
									<div class="post_thumbnail image">
										<a class="wd-effect-blog" href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail('medium',array('class' => 'thumbnail-effect-1', 'title'=>get_the_title())); ?>
										</a>
									</div>
								<?php } ?>
							</div>
						<?php } ?>
						<div class="wd-infomation-post">
							<?php if($show_date) : ?>
							<div class="wd-date-category">
								<div class="wd-date-post">
									<span><?php the_time('j F, Y'); ?></span>
								</div>
								<div class="wd-category-post">
									<?php custom_list_categories(); ?>
								</div>
							</div>
							<?php endif;?>
							<div class="wd-entry-title">
								<h3><a href="<?php the_permalink(); ?>" title="<?php printf( esc_html__( 'Permalink to %s', 'wpdance' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
									<?php echo esc_attr(get_the_title()); ?>
								</a></h3>
							</div>
							<?php if($excerpt): ?>
								<?php
									$str_excerpt = get_the_excerpt();
									$str_excerpt = wp_strip_all_tags($str_excerpt);
									$str_excerpt = strip_shortcodes($str_excerpt);
									$words = explode(' ', $str_excerpt);
								?>
								<?php if( count($words) > $number_excerpt ) : ?>
									<div class="excerpt"><?php tvlgiao_wpdance_the_excerpt_max_words($number_excerpt); ?><a class="readmore_link" href="<?php the_permalink(); ?>"> ...</a></div>
								<?php else: ?>
									<div class="excerpt"><?php tvlgiao_wpdance_the_excerpt_max_words($number_excerpt); ?></div>
								<?php endif; ?>
							<?php endif; ?>

						</div>
					</div>					
				<?php endwhile; ?>
			</div>
		<?php endif; ?>
		<?php
		$output = ob_get_contents();
		ob_end_clean();
		wp_reset_query();
		return $output;
	}
}
add_shortcode('tvlgiao_wpdance_special_blog','tvlgiao_wpdance_special_blog_function');
?>