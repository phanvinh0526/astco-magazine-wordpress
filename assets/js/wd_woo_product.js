//****************************************************************//
/*						WOO PRODUCT JS							  */
//****************************************************************//
if (typeof checkIfTouchDevice != 'function') { 
    function checkIfTouchDevice(){
        touchDevice = !!("ontouchstart" in window) ? 1 : 0; 
		if( jQuery.browser.wd_mobile ) {
			touchDevice = 1;
		}
		return touchDevice;      
    }
}
// Zoo Product
function set_cloud_zoom(){
	var clz_width = jQuery('#qs-zoom,.wd-qs-cloud-zoom,.cloud-zoom, .cloud-zoom-gallery').width();
	var clz_img_width = jQuery('#qs-zoom,.wd-qs-cloud-zoom,.cloud-zoom, .cloud-zoom-gallery').children('img').width();
	var cl_zoom = jQuery('#qs-zoom,.wd-qs-cloud-zoom,.cloud-zoom, .cloud-zoom-gallery').not('.on_pc');
	var temp = (clz_width-clz_img_width)/2;
	if(cl_zoom.length > 0 ){
		cl_zoom.data('zoom',null).siblings('.mousetrap').unbind().remove();
		cl_zoom.CloudZoom({ 
			adjustX:temp	
		});
	}
}

function change_cart_items_mobile(){
	var html_cart = jQuery( '.wd_tini_cart_wrapper .cart_size_value_head').html();
	jQuery('.mobile_cart_container .cart_size_value_head').html('');
	jQuery('.mobile_cart_container .cart_size_value_head').html(html_cart);
	/*
	var _cart_items = parseInt(jQuery( ".wd_tini_cart_wrapper .cart_size_value_head:first .num_item" ).text());
	_cart_items = isNaN(_cart_items) ? 0 : _cart_items;
	jQuery('.mobile_cart_container .cart_size_value_head .num_item').text(_cart_items);
	*/
}
jQuery(document).ready(function($) {
	"use strict";
	var on_touch = checkIfTouchDevice();
	set_cloud_zoom();

	// Select Color
	jQuery('body').on('click', '.variations_form .wd-select-option', function(e){
		var val = jQuery(this).attr('data-value');
		var _this = jQuery(this);
		
		var color_select = jQuery(this).parents('.value').find('select');
		color_select.trigger('focusin');
		if(color_select.find('option[value='+val+']').length !== 0) {
			color_select.val( val ).change();
			_this.parent('.wd_color_image_swap').find('.wd-select-option').removeClass('selected');
			_this.addClass('selected');
		}			
	});
	jQuery('.variations_form').on('click', '.reset_variations', function(e){
	
		jQuery(this).parents('.variations').find('.wd_color_image_swap .wd-select-option.selected').removeClass('selected');
	});
					
	jQuery('body').on('change', '.variations_form .variations select', function(e){
		jQuery('.variations_form .variations .wd_color_image_swap').parents('.value').find('select').trigger('focusin');
			jQuery('.variations_form .variations .wd_color_image_swap .wd-select-option').each(function(i,e){
				var val = jQuery(this).attr('data-value');
				var _this = jQuery(this);
				var op_elemend = jQuery(this).parents('.value').find('select option[value='+val+']');
				if(op_elemend.length == 0) {
					_this.hide();
				} else {
					_this.show();
				}
				
			});
			
	});
	
	jQuery('body').on('show_variation', '.variations_form .variations .single_variation_wrap', function(e){
		jQuery('.variations_form ').find( '.single_variation' ).parent().parent('.single_variation_wrap').removeClass('no-price');
		if(jQuery('.variations_form ').find( '.single_variation' ).html() == ''){
			jQuery('.variations_form ').find( '.single_variation' ).parent().parent('.single_variation_wrap').addClass('no-price');
		}
	});


	/*--------------------------------------------------------------------------*/
	/*						AJAX ADD TO CART CHANGE CART VIEW   				*/
	/*--------------------------------------------------------------------------*/
	jQuery('body').bind( 'adding_to_cart', function() {
		jQuery('.cart_dropdown').addClass('disabled working');
	} );		
    	      
	jQuery('.add_to_cart_button').live('click',function(event){
		var _li_prod = jQuery(this).parent().parent().parent().parent();
		_li_prod.trigger('wd_adding_to_cart');
	});	

	jQuery('li.product').each(function(index,value){
		
		jQuery(value).bind('wd_added_to_cart', function() {
			var _loading_mark_up = jQuery(value).find('.loading-mark-up').remove();
			jQuery(value).removeClass('adding_to_cart').addClass('added_to_cart').append('<span class="loading-text"></span>');//Successfully added to your shopping cart
			var _load_text = jQuery(value).find('.loading-text').css({'width' : jQuery(value).width()+'px','height' : jQuery(value).height()+'px'}).delay(1500).fadeOut();
			setTimeout(function(){
				_load_text.hide().remove();
			},1500);
			//delete view cart		
			jQuery('.list_add_to_cart .added_to_cart').remove();
			
			var _current_currency = jQuery.cookie('woocommerce_current_currency');
		});	
	});	
	
	
	jQuery('body').bind( 'added_to_cart wd_added_to_cart_on_idevice', function(event) {
		if( typeof _ajax_uri == "undefined" ){
			return;
		}
			
		var _added_btn = jQuery('ul.products li.product,div.products div.product').find('.add_to_cart_button.added').removeClass('added').addClass('added_btn');
		var _added_li = _added_btn.parent().parent().parent();
		_added_li.each(function(index,value){
			jQuery(value).trigger('wd_added_to_cart');
		});
		
		jQuery('.wd_tini_cart_wrapper').addClass('loading-cart');
		
		jQuery.ajax({
			type : 'POST'
			,url : _ajax_uri	
			,data : {action : 'update_tini_cart'}
			,success : function(respones){
				if( jQuery('.shopping-cart-wrapper').length > 0 ){
					jQuery('.shopping-cart-wrapper').html(respones);
					jQuery('.cart_dropdown,.form_drop_down').hide();
					jQuery('body').trigger('mini_cart_change');
					change_cart_items_mobile();
					setTimeout(function(){
						jQuery('.wd_tini_cart_wrapper').removeClass('loading-cart');
					},1000);
				}
			}
		});			
	} );	
	jQuery('.cart_dropdown,.form_drop_down').hide();
	change_cart_items_mobile();	

    jQuery('body').trigger('added_to_cart');

    
}); // End JQuery