<?php
	$product_id 		= tvlgiao_wpdance_get_post_by_global();
	$_product_config 	= get_post_meta($product_id,'_tvlgiao_wpdance_custom_product_config',true);
	$_default_product_config = array(
			'layout' 					=> '0'		
	);
	if( strlen($_product_config) > 0 ){
		$_product_config = unserialize($_product_config);
		if( is_array($_product_config) && count($_product_config) > 0 ){
			$_product_config['layout'] 			= ( isset($_product_config['layout']) 	&& strlen($_product_config['layout']) > 0 ) ? $_product_config['layout'] : $_default_product_config['layout'];		
		}
	}else{
		$_product_config = $_default_product_config;
	}
?>
<div class="select-layout area-config area-config1">
	<div class="area-inner">
		<div class="area-inner-0">
			<h3 class="area-title"><?php esc_html_e('Custom Layout','wpdance'); ?></h3>
			<div class="area-content">
				<div class="wd-single-post-layout">
					<label><?php esc_html_e('Page Layout','wpdance'); ?></label>	
					<div class="bg-input select-box ">
						<div class="bg-input-inner config-product">
							<select name="single_layout" id="_single_product_layout">
								<option value="0" 		<?php if( strcmp($_product_config["layout"],'0') == 0 ) echo "selected='selected'";?>>		<?php esc_html_e('Default','wpdance'); ?>			</option>
								<option value="0-0-0" 	<?php if( strcmp($_product_config["layout"],'0-0-0') == 0 ) echo "selected='selected'";?>>	<?php esc_html_e('Fullwidth','wpdance'); ?>		</option>
								<option value="0-0-1" 	<?php if( strcmp($_product_config["layout"],'0-0-1') == 0 ) echo "selected='selected'";?>>	<?php esc_html_e('Right Sidebar','wpdance'); ?>	</option>
								<option value="1-0-0" 	<?php if( strcmp($_product_config["layout"],'1-0-0') == 0 ) echo "selected='selected'";?>>	<?php esc_html_e('Left Sidebar','wpdance'); ?>	</option>
								<option value="1-0-1" 	<?php if( strcmp($_product_config["layout"],'1-0-1') == 0 ) echo "selected='selected'";?>>	<?php esc_html_e('Left & Right Sidebar','wpdance'); ?></option>
							</select>
						</div>
					</div>
				</div>
			</div><!-- .area-content -->
		</div>	
		<div class="clear"></div>
	</div>
	<input type="hidden" name="custom_product_layout" class="change-layout" value="custom_single_product_layout"/>	
</div><!-- .select-layout -->