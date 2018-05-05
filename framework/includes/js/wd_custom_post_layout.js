function sort_list_images(){
	jQuery( ".sortable" ).sortable();
}
jQuery(document).ready(function($){
	// Extra Media Post
	if(jQuery("select.global_config").length > 0 ){
		
		var $_list = jQuery( "select.global_config" );
		
		$_list.each(function(){
			var $_val1 = jQuery(this).val();
			var $_config1 = jQuery(this).attr('data-config');
			$_config1 += $_val1;
			jQuery($_config1).show();
			
			jQuery(this).on( "change", function() {
				var $_val = jQuery(this).find("option:selected").val();
				var $_config = jQuery(this).attr('data-config');
				var $_sub = $_config + 'sub';
				
				$_config += $_val;
				jQuery($_sub).hide();
				jQuery($_config).show();
			});
			
		});
    }

	// Extra Slider Post
	
	clear_button = $('.clear-all-slides');
	
	$('.sortable').each(function(index,value){
		if($(value).find('li').length > 0){
			$(this).parent('.sortable-wrapper').siblings('.clear-all-slides').show();
		} else {
			$(this).parent('.sortable-wrapper').siblings('.clear-all-slides').hide();
		}
	});
	
	/*if( $('.sortable > li').length > 0 )
		clear_button.show();
	else
		clear_button.hide();
	*/
	clear_button.click(function(event){
		$(this).siblings('.sortable-wrapper').children('.sortable').html('');
		$(this).hide();
	});
	
	count_id = Math.floor((Math.random() * 1000) + 1);
	count_id = parseInt(count_id); 
	var ready_lightbox = false;
	fancy = $(".preview-img-edit").fancybox({
		'minWidth' : 450
		,'minHeight' : 450
		,beforeLoad : function(){
			if(	ready_lightbox ){
			}			
		}
		,beforeClose  : function(){
			ready_lightbox = false;
		}
	});

	$(".save-slide").live('click',function(){
		$('.fancybox-close').trigger('click');
	});	

	

	$( ".sortable" ).disableSelection();	
	sort_list_images();
	var _custom_media = true;
	if(typeof wp.media.editor !== "undefined"){
		_orig_send_attachment = wp.media.editor.send.attachment;
	}	
	
	// for extra slider post
	$('.stag-metabox-table').click(function(e) {
		var send_attachment_bkp = wp.media.editor.send.attachment;
		var button = $(this);
		var sortable = $(this).siblings('.sortable-wrapper').children('.sortable');
		var ___clear_button = $(this).siblings('.clear-all-slides');
		_custom_media = true;
		wp.media.editor.send.attachment = function(props, attachment){
			var thumb_url = '';
			if( typeof(attachment.sizes.thumbnail) !== 'undefined' ){
				thumb_url = attachment.sizes.thumbnail.url;
			}else{
				thumb_url = attachment.sizes[props.size].url;
			}
			//var insert_url = attachment.sizes[props.size].url;
			var insert_url = attachment.sizes['full'].url;
			var link_url = props.linkUrl;
			if( props.link == 'file' ){
				link_url = attachment.url;
			}
			if( props.link == 'post' ){
				link_url = attachment.link;
			}	
			if( props.link == 'none' ){
				link_url = '#';
			}					
			var image_title = attachment.title;
			var slide_description = attachment.description; 
			var image_alt = attachment.alt;		
			build_html = '';
			
			count_id = attachment.id;
			if ( _custom_media ) {
				//count_id = count_id + 1;
				build_html += '<div id="image-value' + count_id + '" class="hidden lightbox-image">';
				build_html += '<img  class="lightbox-preview-img" src="' + insert_url + '" alt="' + image_alt + '" title="' + image_title + '">';
				build_html += '<input type="hidden" value="' + count_id + '" name="element_id[]" class="inline-element element_id">';
				build_html += '<input type="hidden" value="' + thumb_url + '" name="thumb_url[]" id="thumb_url" class="inline-element element_thumb">';
				build_html += '<input type="hidden" value="' + insert_url + '" id="element_image_url" name="element_image_url[]" class="inline-element insert_url">';
				build_html += '<p><span class="label">Slide Url</span><input type="text" value="' + link_url + '" name="element_url[]" class="inline-element link_url"></p>';
				build_html += '<p><span class="label">Image Title</span><input type="text" value="' + image_title + '" name="element_title[]" class="inline-element image_title "></p>';
				build_html += '<p><span class="label">Image Alt</span><input type="text" value="' + image_alt + '" name="element_alt[]" class="inline-element image_alt"></p>';
				build_html += '<p><span class="label">Slide Title</span><input type="text" value="' + image_title + '" name="slide_title[]" class="inline-element slide_title"></p>';
				build_html += '<p><span class="label">Slide Contents</span><textarea name="slide_content[]" class="inline-element slide_content">'+slide_description+'</textarea></p>';
				build_html += '<div class="btn fancy-button-wrapper"><a href="javascript:void(0)" class="button save-slide" name="save-slide"/>Save</a>';
				build_html += '<a href="javascript:void(0)" class="button save-slide" name="close-slide"/>Close</a></div>';
				build_html += '</div>';
				
				
				build_html += '<p class="image-wrappper">';
				build_html += '<img  class="preview-img" src="' + thumb_url + '" alt="' + image_alt + '" title="' + image_title + '" width="120" height="120">';
				build_html += '<a href="#image-value' + count_id + '" class="preview-img-edit">Edit</a>';
				build_html += '<a href="javascript:void(0)" class="preview-img-remove">Del</a>';
				build_html += '</p>';
				
				jQuery('<li class="ui-state-default"></li>').html(build_html).appendTo(sortable);
				___clear_button.show();

			} else {
				return _orig_send_attachment.apply( this, [props, attachment] );
			};
		}
		wp.media.editor.open(button);
		sort_list_images();
		
		return false;
	});
	
	//for extra gallery post
	$('.stag-metabox-table-gallery').click(function(e) {
		var send_attachment_bkp = wp.media.editor.send.attachment;
		var button = $(this);
		var sortable = $(this).siblings('.sortable-wrapper').children('.sortable');
		var ___clear_button = $(this).siblings('.clear-all-slides');
		_custom_media = true;
		wp.media.editor.send.attachment = function(props, attachment){
			var thumb_url = '';
			if( typeof(attachment.sizes.thumbnail) !== 'undefined' ){
				thumb_url = attachment.sizes.thumbnail.url;
			}else{
				thumb_url = attachment.sizes[props.size].url;
			}
			var insert_url = attachment.sizes['full'].url;
			var link_url = props.linkUrl;
			if( props.link == 'file' ){
				link_url = attachment.url;
			}
			if( props.link == 'post' ){
				link_url = attachment.link;
			}	
			if( props.link == 'none' ){
				link_url = '#';
			}		
			
			var image_title = attachment.title;
			var slide_description = attachment.description; 
			var image_alt = attachment.alt;		
			build_html = '';
			
			count_id = attachment.id;
			if ( _custom_media ) {	
				build_html += '<input type="hidden" value="' + count_id + '" name="g_element_id[]" class="inline-element element_id">';						
				build_html += '<input type="hidden" value="' + thumb_url + '" name="g_thumb_url[]" class="inline-element element_thumb">';
				build_html += '<input type="hidden" value="' + link_url + '" name="g_element_url[]" class="inline-element link_url">';
				build_html += '<input type="hidden" value="' + image_title + '" name="g_element_title[]" class="inline-element image_title ">';
				build_html += '<input type="hidden" value="' + image_alt + '" name="g_element_alt[]" class="inline-element image_alt">';
				build_html += '<input type="hidden" value="' + insert_url + '" id="element_image_url" name="element_image_url[]" class="inline-element insert_url">';
				
				build_html += '<p class="image-wrappper">';
				build_html += '<img  class="preview-img" src="' + thumb_url + '" alt="' + image_alt + '" title="' + image_title + '" width="120" height="120">';
				build_html += '<a href="javascript:void(0)" class="preview-img-remove">Del</a>';
				build_html += '</p>';
				
				jQuery('<li class="ui-state-default"></li>').html(build_html).appendTo(sortable);
				___clear_button.show();

			} else {
				return _orig_send_attachment.apply( this, [props, attachment] );
			};
		}
		wp.media.editor.open(button);
		sort_list_images();
		
		return false;
	});
	
	//bind editor upload image
	$('.add_media').on('click', function(){
		_custom_media = false;
	});
	
	//remove thumb function
	$('.image-wrappper > .preview-img-remove').live('click',function(){
		var $_this = $(this);
		var sortable = $(this).closest('.sortable');
		var _clear_button = $(this).closest('.sortable-wrapper').siblings('.clear-all-slides');
		$(this).parent().parent().remove();
		if( sortable.find('li').length > 0 ){
			_clear_button.show();
		} else {
			_clear_button.hide();			
		}	
		sort_list_images();
	});
	$( "#menu-posts-wpdance_html ul.wp-submenu li:last-child").addClass('wd-add-category-html-rm');
});