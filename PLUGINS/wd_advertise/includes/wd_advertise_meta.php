<?php
	global $post;
	$post_id 		= $post->ID;
	$_post_config 	= get_post_meta($post_id,'_tvlgiao_wpdance_custom_advertise',true);
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
	// Location
	$_location_adv 		= get_post_meta($post_id,'_tvlgiao_wpdance_location_adv',true);
	// Add Sidebar
	$_adv_sidebar_home 	= get_post_meta($post_id,'_tvlgiao_wpdance_adv_sidebar_home',true);
	
?>
<div id="wd_advertise_file" class="wd_advertise_file select-layout area-config area-config1">
	<div class="global_sub slider_sub advertise_file_url ">
		<div class="area-content">
			<label><?php esc_html_e('Insert Url','wpdance');?> </label>
			<input type="text" name="advertise_file_url" id="advertise_file_url" value="<?php echo strlen($_post_config['advertise_file_url'])? esc_attr($_post_config['advertise_file_url']): ''; ?>" />
		</div><!-- .area-content -->
		<div class="wd-location area-content">
			<label><?php esc_html_e('Location Selection','wpdance'); ?></label>	
			<select name="advertise_location" id="_advertise_location">
				<option value="0" 	<?php if( strcmp($_location_adv,'0') == 0 ) echo "selected='selected'";?>>	<?php esc_html_e('Adv Category Sidebar','wpdance'); ?>			</option>
				<option value="1" 	<?php if( strcmp($_location_adv,'1') == 0 ) echo "selected='selected'";?>>	<?php esc_html_e('Adv Category Header','wpdance'); ?>	</option>
				<option value="2" 	<?php if( strcmp($_location_adv,'2') == 0 ) echo "selected='selected'";?>>	<?php esc_html_e('Adv Home Header','wpdance'); ?>		</option>
				<option value="3" 	<?php if( strcmp($_location_adv,'3') == 0 ) echo "selected='selected'";?>>	<?php esc_html_e('Adv Home Sidebar','wpdance'); ?>		</option>
			</select>
		</div>
		<div class="area-content">
			<label><?php esc_html_e('Open New Window','wpdance');?> </label>
			<input type="checkbox" name="advertise_new_window" id="advertise_new_window" value="1" <?php if( strcmp($_post_config['advertise_new_window'],'1') == 0 ) echo "checked";?> />New Tab<br/>
		</div><!-- .area-content -->
		<div class="wd-note area-content">
			<span><?php esc_html_e('Size of Advertise (Width x Height)','wpdance'); ?></span>
			<ul>
				<li><span>Adv Category Sidebar:</span> 330px X 280px</li>
				<li><span>Adv Category Header:</span> 630px X 90px</li>
				<li><span>Adv Home Header:</span> 630px X 90px</li>
				<li><span>Adv Home Sidebar:</span> 330px X 280px</li>
			</ul>
		</div>
	</div>
	<input type="hidden" name="custom_post_advertise" class="change-layout" value="custom_post_advertise"/>	
</div>