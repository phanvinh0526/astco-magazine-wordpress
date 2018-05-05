<?php
/**
 * Shortcode: tvlgiao_wpdance_promotion_information
 */

if (!function_exists('tvlgiao_wpdance_promotion_information_function')) {
	function tvlgiao_wpdance_promotion_information_function($atts) {
		extract(shortcode_atts(array(
			'id_category'				=> '-1'
			,'data_show'				=> 'recent_blog'
			,'number_blogs'				=> '12'
			,'sort'						=> 'date'
			,'order_by'					=> 'DESC'
			,'class'					=> ''

		), $atts));
		wp_reset_query();
		// New blog
		$args = array(  
			'post_type' 		=> 'post',  
			'posts_per_page' 	=> $number_blogs,
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
		//Most Comment
		if($data_show == 'comment_blog'){
			$args['orderby']		= 'comment_count';
		}	
		$special_blogs 		= new WP_Query( $args );
		ob_start(); ?>
		<?php if( $special_blogs->have_posts() ) :?>
			<div class='wd-promotion-information <?php esc_html_e($class); ?>'>
				<?php while( $special_blogs->have_posts() ) : $special_blogs->the_post(); global $post; ?>
					<div class="wd-content-post new-information">
						<h4 class="wd-heading-title">
							<a href="<?php the_permalink() ; ?>"><?php the_title(); ?></a>
						</h4>
					</div>					
				<?php endwhile; ?>			
			</div>
		<?php endif;// End have post ?>
		<?php
		$content = ob_get_contents();
		ob_end_clean();
		wp_reset_postdata();
		return $content;
	}
}
add_shortcode('tvlgiao_wpdance_promotion_information', 'tvlgiao_wpdance_promotion_information_function');
?>