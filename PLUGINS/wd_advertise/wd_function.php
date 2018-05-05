<?php
	add_action('category_add_form_fields','wd_category_post_add_categoryimage');
	add_action('category_edit_form_fields','wd_category_post_edit_categoryimage');
	// Create
	function wd_category_post_add_categoryimage($taxonomy){ ?>
	    <div class="form-field">
	    	<label for="wd_adv_category_id">Select Advertise</label>
			<?php
				$advertise_category = array();
				$advertise_category[esc_html__('All Advertise','wdoutline')] = -1;
				$categories = 	get_terms( 'advertise_category', 
											array('hide_empty' 	=> 0)
										 );
				wp_reset_postdata();
			?>

			<select name="wd_adv_category_id" id="wd_adv_category_id" class="wd_adv_category_id">
				<option value="-1" selected='selected'><?php echo esc_html__('All Advertise','wdoutline'); ?></option> 
				<?php foreach ($categories as $category ) { ?>
					<option value="<?php echo esc_attr($category->term_id);?>"><?php echo esc_attr($category->name);?></option> 
				<?php } ?>
			</select>

			<input type="text" name="wd_adv_category_id_data" id="wd_adv_category_id_data" value="" class="hidden" />	
	    	<br/>
			<label for="image_cate_advertise_url">Image</label>
			<img id="id_tag_image_url_advertise" src="<?php echo ADS_IMAGE.'/image-category.png';?>"  height="180" width="95%"/>
			<input type="text" name="image_cate_advertise_url" id="image_cate_advertise_url" value="" class="hidden" />	
			<p class="description">Click on the text box to add taxonomy/category image.</p>
			<a id="wd_advertise_category_media_lib" href="javascript:void(0);" class="button" rel="image_cate_advertise_url">URL from Media Library</a>
		</div><?php	
	}

	// Edit
	function wd_category_post_edit_categoryimage($taxonomy){ ?>
		<?php
			$_post_config 	= get_option('_category_image_advertise_'.$taxonomy->term_id);
	    	$_default_post_config = array(
				'image_cate_advertise_url' 	=> '',
				'wd_adv_category_id'		=> '-1',
			);
			if( strlen($_post_config) > 0 ){
				$_post_config = unserialize($_post_config);
				if( is_array($_post_config) && count($_post_config) > 0 ){
					$_post_config['image_cate_advertise_url'] 		= ( isset($_post_config['image_cate_advertise_url']) 	&& strlen($_post_config['image_cate_advertise_url']) > 0 ) ? $_post_config['image_cate_advertise_url'] : $_default_post_config['image_cate_advertise_url'];
					$_post_config['wd_adv_category_id'] 			= ( isset($_post_config['wd_adv_category_id']) && strlen($_post_config['wd_adv_category_id']) > 0 ) ? $_post_config['wd_adv_category_id'] : $_default_post_config['wd_adv_category_id'];
				}
			}else{
				$_post_config = $_default_post_config;
			}	
		?>

	    <tr class="form-field">
	    	<th scope="row" valign="top"><label for="wd_adv_category_id">Select Advertise</label></th>
			
			<?php
				$advertise_category = array();
				$advertise_category[esc_html__('All Advertise','wdoutline')] = -1;
				$categories = 	get_terms( 'advertise_category', 
											array('hide_empty' 	=> 0)
										 );
				wp_reset_postdata();
			?>
			<td>
			<select name="wd_adv_category_id" id="wd_adv_category_id" class="wd_adv_category_id">
				<option value="-1" <?php if( strcmp($_post_config["wd_adv_category_id"],'-1') 		== 0 ) echo "selected='selected'";?>><?php echo esc_html__('All Advertise','wdoutline'); ?></option> 
				<?php foreach ($categories as $category ) { ?>
					<option value="<?php echo esc_attr($category->term_id);?>" <?php if( $_post_config["wd_adv_category_id"] == $category->term_id) echo "selected='selected'";?>><?php echo esc_attr($category->name);?></option> 
				<?php } ?>
			</select>
			</td>
		</tr>

		<tr class="form-field">
			<th scope="row" valign="top"><label for="tag-image">Image</label></th>
			<td>
			<?php 
			if( $_post_config["image_cate_advertise_url"] != ''){ 
				$id_image  = $_post_config["image_cate_advertise_url"];
				$image_url = wp_get_attachment_url( $id_image , 'advertise_image_size');
			}else{
				$image_url = ADS_IMAGE.'/image-category.png';
			}
			?>
			<img id="id_tag_image_url_advertise" src="<?php echo esc_url($image_url);?>" width="95%"  height="150"/>
			<br />
			<input type="text" name="image_cate_advertise_url" id="image_cate_advertise_url" value="<?php echo esc_attr($id_image);?>" class="hidden" />
			<a id="wd_advertise_category_media_lib" href="javascript:void(0);" class="button" rel="image_cate_advertise_url">Edit Image</a>
			</td>
		</tr><?php 
	}
	
	// Save
	add_action('edit_term','wd_category_post_save_categoryimage');
	add_action('create_term','wd_category_post_save_categoryimage');
	function wd_category_post_save_categoryimage($term_id){
	    if(isset($_POST['image_cate_advertise_url'])){
	    	$_default_post_config = array(
				'image_cate_advertise_url' 	=> $_POST['image_cate_advertise_url'],
				'wd_adv_category_id'		=> $_POST['wd_adv_category_id'],
			);
			$data_config_category = serialize($_default_post_config);
			update_option('_category_image_advertise_'.$term_id , $data_config_category );
	    }
	}

?>