<?php
	global $post;
	$post_id 		= $post->ID;
	$_post_config 	= get_post_meta($post_id,'_tvlgiao_wpdance_custom_partner_business',true);
	$_default_post_config = array(
			'wd_author_post'			=> '',
			'business_address' 			=> '',
			'business_phone'			=> '',
			'business_time'				=> '',
			'business_map'				=> '',
			'company_facebook'			=> '',
			'company_google'			=> '',
			'company_twitter'			=> '',			
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
	$_data_map_google = get_post_meta($post_id,'_tvlgiao_wpdance_custom_partner_map_google',true);
	if( strpos($_data_map_google, "iframe") == false  ){
		$_data_map_google = esc_html__('Map embed iframe...','wpdance');
	}
?>
<div class="select-layout area-config area-config1" id="wd-business-meta">
	<h4 class="area-title"><?php esc_html_e('Author','wpdance'); ?></h4>
	<div class="global_sub slider_sub business_address">
		<p>
			<label><?php esc_html_e('Author Post','wpdance');?> </label>
			<input type="text" name="wd_author_post" id="wd_author_post" value="<?php echo strlen($_post_config['wd_author_post'])? esc_attr($_post_config['wd_author_post']): ''; ?>" />
		</p>
	</div>
	<br/><hr/>	
	<!-- Address -->
	<h4 class="area-title"><?php esc_html_e('Conpany Infomation','wpdance'); ?></h4>
	<div class="global_sub slider_sub business_address">
		<p>
			<label><?php esc_html_e('Company Address','wpdance');?> </label>
			<input type="text" name="business_address" id="business_address" value="<?php echo strlen($_post_config['business_address'])? esc_attr($_post_config['business_address']): ''; ?>" />
		</p>
	</div>
	<!-- Address -->
	<div class="global_sub slider_sub business_phone">
		<p>
			<label><?php esc_html_e('Company Telephone Number','wpdance');?> </label>
			<input type="text" name="business_phone" id="business_phone" value="<?php echo strlen($_post_config['business_phone'])? esc_attr($_post_config['business_phone']): ''; ?>" />
		</p>
	</div>
	<!-- Time Work -->
	<div class="global_sub slider_sub business_time">
		<p>
			<label><?php esc_html_e('Company Work Time','wpdance');?> </label>
			<input type="text" name="business_time" id="business_time" value="<?php echo strlen($_post_config['business_time'])? esc_attr($_post_config['business_time']): ''; ?>" />
		</p>
	</div>
	<!-- Map -->
	<div class="global_sub slider_sub business_map">
		<p>
			<label><?php esc_html_e('Company Map API Google','wpdance');?> </label>
			<input type="text" name="business_map" id="business_map" value="<?php echo strlen($_post_config['business_map'])? esc_attr($_post_config['business_map']): ''; ?>" />
		</p>
	</div>
	<br/><hr/>
	<h4 class="area-title"><?php esc_html_e('Conpany Social','wpdance'); ?></h4>
	<div class="global_sub slider_sub company_facebook">
		<p>
			<label><?php esc_html_e('Company Facebook Social','wpdance');?> </label>
			<input type="text" name="company_facebook" id="company_facebook" value="<?php echo strlen($_post_config['company_facebook'])? esc_url($_post_config['company_facebook']): ''; ?>" />
		</p>
	</div>
	<div class="global_sub slider_sub company_google">
		<p>
			<label><?php esc_html_e('Company Google Social','wpdance');?> </label>
			<input type="text" name="company_google" id="company_google" value="<?php echo strlen($_post_config['company_google'])? esc_url($_post_config['company_google']): ''; ?>" />
		</p>
	</div>
	<div class="global_sub slider_sub company_twitter">
		<p>
			<label><?php esc_html_e('Company Twitter Social','wpdance');?> </label>
			<input type="text" name="company_twitter" id="company_twitter" value="<?php echo strlen($_post_config['company_twitter'])? esc_url($_post_config['company_twitter']): ''; ?>" />
		</p>
	</div>
	<br/><hr/>
	<h4 class="area-title"><?php esc_html_e('Map Google','wpdance'); ?></h4>
	<div class="wd-company-map">
		<div class="wd-company-map-textrea">
			<textarea name="company_map_google" class="widefat" cols="20" rows="18"><?php echo esc_textarea($_data_map_google); ?></textarea><br/><br/>
			<span class="description"><?php esc_html_e('Visit','wpdance'); ?></span>
			<a href="https://www.google.com/maps" target="_blank">Google maps</a>
			<span class="description"><?php esc_html_e('to create your map (Step by step: 1) Find location 2) Click the cog symbol in the lower right corner and select "Share or embed map" 3) On modal window select "Embed map" 4) Copy iframe code and paste it)','wpdance'); ?></span>
		</div>
		<div class="wd-company-map-data">
			<?php echo $_data_map_google; ?>
		</div>
		<div class="clear"></div>
	</div>
	<input type="hidden" name="custom_business_partner" class="change-layout" value="custom_partner_business"/>	
</div>