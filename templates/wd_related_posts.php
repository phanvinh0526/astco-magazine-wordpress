<?php
	$is_slider 		= false;
	$gallery_ids 	= array();
	$galleries 		= wp_get_post_terms($post->ID,'gallery');
	$cate			= get_the_category($post->ID);
	$arr_id_cat		= array();
	foreach ($cate as $c) {
		$cat = get_category($c);
		$arr_id_cat[] .= $cat->term_id;
	}
	if(!is_array($galleries))
		$galleries 	= array();
	foreach($galleries as $gallery){
		if( $gallery->count > 0 ){
			array_push( $gallery_ids,$gallery->term_id );
		}	
	}
	if(!empty($galleries) && count($gallery_ids) > 0 )
		$args = array(
			'post_type'=>$post->post_type,
			'tax_query' => array(
				array(
					'taxonomy'	=> 'gallery',
					'field' 	=> 'id',
					'terms' 	=> $gallery_ids
				)
			),
			'post__not_in'	=> array($post->ID),
			'posts_per_page'=> 6,
		);
	else
		$args = array(
		'post_type'			=> $post->post_type,
		'post__not_in'		=> array($post->ID),
		'posts_per_page'	=> 6,
	);

	$args['tax_query'] = array(
			    	array(
				    	'taxonomy' 		=> 'category',
						'terms' 		=> $arr_id_cat,
						'field' 		=> 'term_id',
						'operator' 		=> 'IN'
					),
	   			);
	$args['meta_key'] 	= '_wd_post_views_count';
	$args['orderby'] 	= 'meta_value_num';
	$args['order'] 		= 'DESC';   			
	wp_reset_postdata();
	$related=new WP_Query($args);
	$count=0;
	$random_id = 'wd-related-wrapper-'.mt_rand();
?>
<div class="wd-related-post related block-wrapper">
	<div class="wd-title-wrapper">
		<h3 class="entry-title heading-title"><span><?php esc_html_e('Bài viết liên quan','wpdance'); ?>
		</span></h3>
	</div>
	<div class="wd-related-wrapper <?php echo esc_attr($random_id); ?>">
		<div class="wd-related-slider">
			<?php if($related->have_posts()) : ?>
				<?php while($related->have_posts()) : $related->the_post(); $count++; global $post;?>
					<div class="wd-col-sm-12 col-sm-12">
						<div class="wd-related-item">
							<div class="wd-thumbnail-post">
								<a class="wd-effect-blog" href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail('medium',array('class' => 'thumbnail-effect-1', 'title'=>get_the_title())); ?>
								</a>
							</div>
							<div class="wd-title-post">
								<h3 class="wd-title-related">
									<a href="<?php the_permalink();?>" class="wd-title-post"><?php echo tvlgiao_wpdance_string_limit_words(get_the_title(),10); ?></a>
								</h3>
							</div>
						</div>
					</div>
				<?php endwhile; // End while ?>
			<?php endif; ?>
		</div>
	</div>
</div>
