<?php
	global $post;
	$post_id 		= $post->ID;
	$_post_config 	= get_post_meta($post_id,'_tvlgiao_wpdance_custom_magazie',true);
	$_default_post_config = array(
			'magazine_file_url' 			=> '',			
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
?>
<div class="select-layout area-config area-config1" id="id_magazine_meta">
	<!-- Address -->
	<div class="global_sub slider_sub magazine_file_url">
		<p>
			<label><?php esc_html_e('Insert File Magazine (PDF)','wpdance');?> </label>
			<input type="text" name="magazine_file_url" id="magazine_file_url" value="<?php echo strlen($_post_config['magazine_file_url'])? esc_attr($_post_config['magazine_file_url']): ''; ?>" />
			<a id="wd_magazine_media_lib" href="javascript:void(0);" class="button" rel="magazine_file_url">URL from Media Library</a>
			<p><?php _e('Enter URL for the magazine file', 'wpdance')?></p>

		</p>
	</div>
	<input type="hidden" name="custom_post_magazine" class="change-layout" value="custom_post_magazine"/>	
</div>