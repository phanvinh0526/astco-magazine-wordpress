<?php
	add_action('magazine_category_add_form_fields','wd_magazine_add_categoryimage');
	add_action('magazine_category_edit_form_fields','wd_magazine_edit_categoryimage');
	// Create
	function wd_magazine_add_categoryimage($taxonomy){ ?>
	    <div class="form-field">
			<label for="image_cate_magazine_url">Image</label>
			<img id="id_tag_image_url_magazine" src="" width="120"  height="150"/>
			<input type="text" name="image_cate_magazine_url" id="image_cate_magazine_url" value="" class="hidden" />	
			<p class="description">Click on the text box to add taxonomy/category image.</p>
			<a id="wd_magazine_category_media_lib" href="javascript:void(0);" class="button" rel="image_cate_magazine_url">URL from Media Library</a>
		</div><?php	
	}

	// Edit
	function wd_magazine_edit_categoryimage($taxonomy){ ?>
		<tr class="form-field">
			<th scope="row" valign="top"><label for="tag-image">Image</label></th>
			<td>
			<?php 
			if(get_option('_category_image_magazine_'.$taxonomy->term_id) != ''){ ?>
				<?php
					$id_image  = get_option('_category_image_magazine_'.$taxonomy->term_id);
					$image_url = wp_get_attachment_url( $id_image , 'magazine_image_size');
				?>
				<img id="id_tag_image_url_magazine" src="<?php echo esc_url($image_url);?>" width="120"  height="150"/>
			<?php }else{ ?>
				<img id="id_tag_image_url_magazine" src="<?php echo WDP_IMAGE.'/image-category.png';?>" width="180" />	
			<?php } ?><br />
			<input type="text" name="image_cate_magazine_url" id="image_cate_magazine_url" value="<?php echo get_option('_category_image_magazine_'.$taxonomy->term_id); ?>" class="hidden" />
			<a id="wd_magazine_category_media_lib" href="javascript:void(0);" class="button" rel="image_cate_magazine_url">Edit Image</a>
			</td>
		</tr><?php 
	}
	
	// Save
	add_action('edit_term','wd_magazine_save_categoryimage');
	add_action('create_term','wd_magazine_save_categoryimage');
	function wd_magazine_save_categoryimage($term_id){
	    if(isset($_POST['image_cate_magazine_url'])){
	    	update_option('tantantantan',$_POST['image_cate_magazine_url']);
			update_option('_category_image_magazine_'.$term_id,$_POST['image_cate_magazine_url'] );
	    }
	}

	function wd_magazine_set_posts_per_page( $query ) {
	  	if ( is_post_type_archive( 'magazine' ) ) {
			$query->set( 'posts_per_page', '1' );
	 	}
	}
	add_action( 'pre_get_posts', 'wd_magazine_set_posts_per_page' );	
?>