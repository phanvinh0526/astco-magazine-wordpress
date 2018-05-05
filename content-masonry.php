<?php
	$show_title 	= get_theme_mod('tvlgiao_wpdance_genneral_blog_show_title','1');
	$show_thumbnail = get_theme_mod('tvlgiao_wpdance_genneral_blog_show_thumbnail','1');
	$show_date 		= get_theme_mod('tvlgiao_wpdance_genneral_blog_show_date','1');
	$show_author 	= get_theme_mod('tvlgiao_wpdance_genneral_blog_show_author','1');
	$show_category 	= get_theme_mod('tvlgiao_wpdance_genneral_blog_show_category','1');
	$show_readmore 	= get_theme_mod('tvlgiao_wpdance_genneral_blog_show_read_more','1');
	$show_excerpt 	= get_theme_mod('tvlgiao_wpdance_genneral_blog_show_excerpt','1');
	$number_excerpt = get_theme_mod('tvlgiao_wpdance_genneral_blog_number_excerpt','20');
?>
<?php
	$_post_config = get_post_meta($post->ID,'_tvlgiao_wpdance_custom_post_config',true);
	if( strlen($_post_config) > 0 ){
		$_post_config = unserialize($_post_config);
	}
	$temp 			= isset($_post_config['post_type']) ? ' extra-'.$_post_config['post_type'] : '';
	$show_thumbnail_flash = 1; 
?>

<!-- Post type: Video -->
<?php if(isset($_post_config['post_type']) && $_post_config['post_type'] == 'video' && $show_thumbnail == '1') : ?>
	<div class="wd-video">
		<div class="wd-thumbnail-video">
			<?php the_post_thumbnail(); ?>
		</div>
		<?php
			if(strlen(trim($_post_config['video_url'])) > 0){
				$url_video =  tvlgiao_wpdance_get_embbed_video(trim($_post_config['video_url']),1200,650);
			}
		?>			
		<a class="tvlgiao_playvideo"><?php esc_html_e('Play Video','wpdance') ?></a>
		<input class="hidden" type="text" value="<?php echo esc_attr($url_video); ?>" id="tvlgiao_urlvideo">		
	</div>
<?php $show_thumbnail_flash = 0; endif; ?>

<!-- Post type: Audio -->
<?php if(isset($_post_config['post_type']) && $_post_config['post_type'] == 'audio' && $show_thumbnail == '1') : ?>
	<div class="wd-audio">
		<?php
			if(( strlen(trim($_post_config['audio_soundcloud'])) > 0 || strlen(trim($_post_config['audio_mp3'])) > 0) ){
				$audio_url = trim($_post_config['audio_soundcloud']);
				if (!empty($audio_url) && strlen(trim($_post_config['audio_soundcloud'])) > 0) {
					echo tvlgiao_wpdance_soundcloud_flash_widget('100%','130',$audio_url);
				}
				else {
					$audio_url = trim($_post_config['audio_mp3']);
					if (!empty($audio_url) && strlen(trim($_post_config['audio_mp3'])) > 0) {
						$attr = array(
							'src'      	=> $audio_url,
							'loop'     	=> '',
							'autoplay' 	=> '',
							'preload' 	=> 'none'
							);
						echo wp_audio_shortcode( $attr );
					}
				}
			}
		?>
	</div>
<?php $show_thumbnail_flash = 0; endif; ?>

<!-- Post type: Slider -->
<?php if(isset($_post_config['post_type']) && $_post_config['post_type'] == 'slide' && $show_thumbnail == '1') : ?>
	<div class="slider">
		<?php
			$post_slider = get_post_meta($post->ID,'_tvlgiao_wpdance_post_slider',true);
			$post_slider = unserialize($post_slider);
			if(is_array($post_slider) && count($post_slider) > 0){
				$post_slider_config = get_post_meta($post->ID,'_tvlgiao_wpdance_post_slider_config',true);
				$post_slider_config = unserialize($post_slider_config);
				?>
				<div class="post-slider" data-nav="<?php echo esc_attr($post_slider_config['post_slider_config_nav']); ?>" data-pagi="<?php echo esc_attr($post_slider_config['post_slider_config_pagi']);?>" data-auto="<?php echo esc_attr($post_slider_config['post_slider_config_auto']);?>">
					<ul class="slides">
						<?php foreach( $post_slider as $slide ){ ?>	
							<?php
								$image_attributes = wp_get_attachment_image_src( $slide['id'],'full' );
							?>
							<li><a href="<?php echo esc_url($image_attributes[0]);?>" data-rel="prettyPhoto[product-gallery]"><?php echo wp_get_attachment_image($slide['id'], 'blog_thumb', false);?></a></li>
						<?php } ?>
					</ul>	
				</div>
				<?php
			}
		?>
		<script type="text/javascript">
			if(jQuery('.post-slider').length >0 ){
				jQuery('.post-slider').each(function(){
					var _auto = jQuery(this).attr('data-auto') == 1 ? true : false;
					var _nav = jQuery(this).attr('data-nav') == 1 ? true : false;
					var _pagi = jQuery(this).attr('data-pagi') == 1 ? true : false;
					jQuery(this).flexslider({
						animation: "slide"
						,controlNav: _pagi
						,directionNav: _nav
						,slideshow: _auto
					});
				});
			}
		</script>
	</div>
<?php $show_thumbnail_flash = 0; endif; ?>

<!-- Post type: Gallery -->
<?php if( isset($_post_config['post_type']) && $_post_config['post_type'] == 'gallery' && $show_thumbnail == '1') : ?>
	<div class="wd-gallery">
		<?php
			$post_gallery = get_post_meta($post->ID,'_tvlgiao_wpdance_post_gallery',true);
			$post_gallery = unserialize($post_gallery);
		?>
		<?php if(is_array($post_gallery) && count($post_gallery) > 0){ ?>
		<?php
			$post_gallery_config = get_post_meta($post->ID,'_tvlgiao_wpdance_post_gallery_config',true);
			$post_gallery_config = unserialize($post_gallery_config);
			$id_gallery = 'gallery-'.rand(0,1000).time();	
			//$arr_width = wp_outline_parse_gallery_width($post_gallery_config['gallery_width']);
			//$min_width = wp_outline_find_min_size($arr_width);
			$array_width = $post_gallery_config['gallery_width'];
			$size_arr = explode(',', trim($array_width));
			$arr_width = array();
			foreach($size_arr as $k => $v){
				$arr_temp = explode('_', trim($v));
				$width_percent = round($arr_temp[0] * 100 / $arr_temp[1],3,PHP_ROUND_HALF_DOWN);
				$arr_width[$k] = $width_percent;
			}
			//
			$min = 1000;
			foreach($arr_width as $v => $k){
				if($k < $min)
					$min = $k;
			}
			$min_width  = $min;
		?>
			<div class="post-gallery">
				<div id="<?php echo esc_attr($id_gallery);?>" class="post_mansory" data-min="<?php echo esc_attr($min_width);?>">
					<?php 
						$count = 0;
						foreach( $post_gallery as $_image ){ 
							$image_attributes = wp_get_attachment_image_src( $_image['id'],'full' );
							
					?>
							<div class="gallery_item" data-width="<?php echo esc_attr($arr_width[$count]);?>">
								<a class="thumbnail" data-rel="prettyPhoto[product-gallery]" href="<?php echo esc_url($image_attributes[0]);?>">
									<?php echo wp_get_attachment_image($_image['id'], 'full', false);?>
									<span class="body_color_background"></span>
									<span class="btn_readmore"></span>
								</a>
							</div>
					<?php $count ++; } ?>
				</div>
			</div>
		<?php } ?>
		<script type="text/javascript">
			if(jQuery('.post_mansory').length > 0 ){
				jQuery('.post_mansory').each(function(index,value){
					var wrapper_width = jQuery(this).width();				
					var object_selector = '#'+jQuery(this).attr('id');
					var min_width = jQuery(value).attr('data-min');		
					var item_width = Math.floor(wrapper_width * min_width / 100);
					fix_gallery_item(object_selector,wrapper_width,min_width,item_width);
					
					jQuery(value).imagesLoaded( function() {
						jQuery(value).isotope({
							layoutMode: 'masonry'
							,itemSelector: '.gallery_item'
							,masonry: {
								columnWidth: item_width
							}
						});
					});
				});	
			}
			function fix_gallery_item(object_selector,wrapper_width,min_width,item_width){
				jQuery( object_selector + " div.gallery_item" ).each(function() {
					var item_data_width = 	jQuery(this).attr('data-width');
					var item_width__ = Math.round(item_data_width / min_width) * item_width;
					//var item_width = Math.floor(wrapper_width * item_data_width / 100);
					jQuery( this).css({'width' : item_width__+'px'});
				});
			}	
		</script>	
	</div>
<?php $show_thumbnail_flash = 0; endif; ?>

<!-- Post type: Show Thumbnail -->
<?php if( has_post_thumbnail() && $show_thumbnail_flash == 1 && $show_thumbnail == '1'): ?>
	<div class="wd-thumbnail-post">
		<a class="thumbnail" href="<?php the_permalink(); ?>">
			<?php
				the_post_thumbnail('full');
			?>
		</a>
	</div>
<?php endif; // End If ?>

<div class="wd-info-post">
	<?php if($show_title) : ?>
		<div class="wd-title-post">
			<h2 class="wd-heading-title">
				<a href="<?php the_permalink() ; ?>"><?php the_title(); ?></a>
			</h2>
		</div>
	<?php endif; ?>
	<div class="wd-meta-post">
		<?php if($show_author) : ?>
			<div class="wd-author-post">
				<?php esc_html_e('by ','wpdance'); ?>
				<?php the_author_posts_link(); ?>
			</div>
		<?php endif; ?>
		<?php if($show_category) : ?>
			<div class="wd-category-post">
				<?php esc_html_e('in ','wpdance'); ?>
				<?php the_category(esc_html__(', ', 'wpdance')); ?>
			</div>
		<?php endif; ?>
		<?php 
			//the_time('d/m/Y');
			//the_tags(esc_html__('', 'wpdance'),esc_html__(', ', 'wpdance'));
		?>
	</div>
	<?php if($show_excerpt) : ?>
		<div class="wd-content-detail-post">
			<?php //the_content(); ?>
			<?php $excerpt 	= tvlgiao_wpdance_string_limit_words(get_the_excerpt() , $number_excerpt )."..."; echo esc_attr($excerpt); ?>
		</div>

	<?php endif; ?>
	<?php if($show_readmore) : ?>
		<div class="readmore">
			<a class="readmore_link" href="<?php the_permalink(); ?>"><?php esc_html_e('read more','wpdance') ?></a>
		</div>
	<?php endif; ?>
</div>
