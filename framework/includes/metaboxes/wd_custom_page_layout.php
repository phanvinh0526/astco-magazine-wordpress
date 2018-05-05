<?php
	//global $post;
	//$post_id 			= $post->ID;
	$post_id  			= tvlgiao_wpdance_get_post_by_global();
	$html_header 		= tvlgiao_wpdance_get_html_choices('wpdance_header_layout',__('Select Header', 'wpdance'),'name');
	$html_footer 		= tvlgiao_wpdance_get_html_choices('wpdance_footer_layout',__('Select Footer', 'wpdance'),'name');
	$values 			= get_post_custom($post_id);

	// Slug meta key
	$meta_key_header 	= '_tvlgiao_wpdance_custom_header';
	$meta_key_footer	= '_tvlgiao_wpdance_custom_footer';

	// Config Page
	$_page_config 	= get_post_meta($post_id,'_tvlgiao_wpdance_custom_page_config',true);
	$_default_page_config = array(
			'layout' 					=> '0'			
	);
	if( strlen($_page_config) > 0 ){
		$_page_config = unserialize($_page_config);
		if( is_array($_page_config) && count($_page_config) > 0 ){
			$_page_config['layout'] 			= ( isset($_page_config['layout']) 	&& strlen($_page_config['layout']) > 0 ) ? $_page_config['layout'] : $_default_page_config['layout'];
		}
	}else{
		$_page_config = $_default_page_config;
	}
?>
<div id="wd-custom-page-id" class="wd-config-header-footer">
	<!-- Custom Header Layout -->
	<p><strong><?php esc_html_e('Custom Header: ', 'wpdance') ?></strong></p>
	<label class="screen-reader-text" for="wpdance_custom_header"><?php esc_html_e('Custom Header', 'wpdance') ?></label>
	<select name="wpdance_custom_header" id="wpdance_custom_header">
		<?php foreach ($html_header as $id => $title): ?>
			<?php $selected = selected($values["{$meta_key_header}"][0], $id, false); ?>
			<option value="<?php echo esc_html($id) ?>" <?php echo esc_attr($selected) ?>><?php echo esc_html($title) ?></option>
		<?php endforeach; ?>
	</select>
	
	<!-- Custom Footer Layout -->
	<p><strong><?php esc_html_e('Custom Footer: ', 'wpdance') ?></strong></p>
	<label class="screen-reader-text" for="wpdance_custom_footer"><?php esc_html_e('Custom Footer', 'wpdance') ?></label>
	<select name="wpdance_custom_footer" id="wpdance_custom_footer">
		<?php foreach ($html_footer as $id => $title): ?>
			<?php $selected = selected($values["{$meta_key_footer}"][0], $id, false); ?>
			<option value="<?php echo esc_html($id) ?>" <?php echo esc_attr($selected) ?>><?php echo esc_html($title) ?></option>
		<?php endforeach; ?>
	</select>
	<div class="area-inner-1">
		<h3 class="area-title"><?php esc_html_e('Custom Layout','wpdance'); ?></h3>
		<div class="area-content">
			<div class="wd-single-post-layout">
				<label><?php esc_html_e('Page Layout','wpdance'); ?></label>	
				<div class="bg-input select-box ">
					<div class="bg-input-inner config-product">
						<select name="single_layout" id="_single_post_layout">
							<option value="0" 		<?php if( strcmp($_page_config["layout"],'0') == 0 ) echo "selected='selected'";?>>		<?php esc_html_e('Default','wpdance'); ?>		</option>
							<option value="0-0-0" 	<?php if( strcmp($_page_config["layout"],'0-0-0') == 0 ) echo "selected='selected'";?>>	<?php esc_html_e('Fullwidth','wpdance'); ?>		</option>
							<option value="0-0-1" 	<?php if( strcmp($_page_config["layout"],'0-0-1') == 0 ) echo "selected='selected'";?>>	<?php esc_html_e('Right Sidebar','wpdance'); ?>	</option>
							<option value="1-0-0" 	<?php if( strcmp($_page_config["layout"],'1-0-0') == 0 ) echo "selected='selected'";?>>	<?php esc_html_e('Left Sidebar','wpdance'); ?>	</option>
							<option value="1-0-1" 	<?php if( strcmp($_page_config["layout"],'1-0-1') == 0 ) echo "selected='selected'";?>>	<?php esc_html_e('Left & Right Sidebar','wpdance'); ?></option>
						</select>
					</div>
				</div>
			</div>
		</div><!-- .area-content -->
	</div>	
	<input type="hidden" name="custom_page_header_footer" class="change-layout" value="page_header_footer"/>
</div>