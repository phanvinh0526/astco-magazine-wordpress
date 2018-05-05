<?php
/**
 * Shortcode: tvlgiao_wpdance_category_magazine
 */

if (!function_exists('tvlgiao_wpdance_category_magazine_function')) {
	function tvlgiao_wpdance_category_magazine_function($atts) {
		extract(shortcode_atts(array(
			'columns'		=> '3',
			'is_slider'		=> '1',
			'show_nav'		=> '1',
			'auto_play'		=> '1',
			'class' 		=> ''			
		), $atts));
		$categories = 	get_terms( 'magazine_category', 
									array('hide_empty' 	=> 0)
								);
		wp_reset_postdata();
		$span_class = "";
		if(!$is_slider){
			$span_class = "col-sm-".(24/$columns);
		}
		$random_id = 'wd_cat_magazine'.mt_rand();
		ob_start(); ?>
		<div id="<?php echo esc_attr($random_id); ?>" class="wd-category-magazine">
			<div class="wd-content-slider">
				<?php foreach ($categories as $cat ) { ?>
					<?php
						$title_category 	= $cat->name;
						$id_category 		= $cat->term_id;
						$id_image			=get_option('_category_image_magazine_'.$id_category); 
					?>
					<div class="wd-content-cat-magazine <?php echo esc_attr($span_class); ?>">
						<a href="<?php echo get_category_link($id_category); ?>">
							<div class="wd-image-cat">
								<?php echo wp_get_attachment_image( $id_image, 'magazine_image_size'); ?>
							</div>
							<h2><?php echo $title_category; ?></h2>
						</a>
					</div>
				<?php } // End foreach?>
			</div>
		</div>
		<?php if( $is_slider ) : ?>
			<script type="text/javascript">
				jQuery(document).ready(function(){
					"use strict";						
					var $_this = jQuery('#<?php echo esc_attr( $random_id ); ?>');
					var _auto_play = <?php echo esc_attr( $auto_play ); ?> == 1;
					var owl = $_this.find('.wd-content-slider').owlCarousel({
								loop : true
								,items : 1
								,nav : true
								,dots : false
								,navSpeed : 1000
								,slideBy: 1
								,rtl:jQuery('body').hasClass('rtl')
								,navRewind: false
								,autoplay: _auto_play
								,autoplayTimeout: 5000
								,autoplayHoverPause: true
								,autoplaySpeed: false
								,mouseDrag: true
								,touchDrag: true
								,responsiveBaseElement: $_this
								,responsiveRefreshRate: 1000
								,responsive:{
									0:{
										items : 1
									},
									300:{
										items : <?php echo $columns - 1  ?>
									},
									579:{
										items : <?php echo $columns ?>
									},
									767:{
										items : <?php echo $columns ?>
									},
									1100:{
										items : <?php echo $columns ?>
									}
								}
								,onInitialized: function(){
								}
							});
				});
			</script>
		<?php endif; // End if	 
		$output = ob_get_contents();
		ob_end_clean();
		wp_reset_postdata();
		return $output;
	}
}
add_shortcode('tvlgiao_wpdance_category_magazine', 'tvlgiao_wpdance_category_magazine_function');
?>