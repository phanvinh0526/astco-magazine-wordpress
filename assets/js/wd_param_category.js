jQuery(document).ready(function($) {	
	jQuery('.wd-wraper-data-category').on('click','.wd-add-data-category', function(event) {
		var value = jQuery('.category_post_field').val();
		event.preventDefault();
		var id_post   = jQuery('.wd-data-post-cate option:selected').val();
		var name_post = jQuery('.wd-data-post-cate option:selected').text();
		if(value){
			value = value+id_post+','+name_post+'|';
			
		}else{
			value = id_post+','+name_post+'|';
		}
		jQuery('.category_post_field').val(value);
	});
});