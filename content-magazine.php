<?php
	$_post_config 	= get_post_meta($post->ID,'_tvlgiao_wpdance_custom_magazie',true);
	if( strlen($_post_config) > 0 ){
		$_post_config = unserialize($_post_config);
	}	
?>
<div class="wd-wrap-content-magazine col-sm-8">
	
	<div class="wd-image-magazine">
		<?php the_post_thumbnail('magazine_image_size'); ?>
	</div>
	<div class="wd-magazine-info">
		<div class="wd-view-download">
			<span class="wd-maga-view"><a href="<?php echo esc_url($_post_config['magazine_file_url']); ?>" target="_blank" ><?php esc_html_e('Down Load','wpdance');?></a></span>
		</div>
		<div class="wd-title-magazine">
			<h2 class="wd-heading-title"><?php the_title(); ?></h2>
		</div>
	</div>
</div>