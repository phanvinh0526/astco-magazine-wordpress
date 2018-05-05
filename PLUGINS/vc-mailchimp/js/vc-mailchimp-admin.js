(function($){

$(function(){

			$('.wh-color-picker').wpColorPicker({
				change: function(event, ui){

					wh_update_hidden_border_field(ui);
				}
			});

			$(document).on('change','.wpb_el_type_vc_mailchimp_border_field select,.wpb_el_type_vc_mailchimp_border_field .wh-color-picker',function(){
				wh_update_hidden_border_field();
			})

//Add New List Option
	$(document).on( 'click', '.vc-mailchimp-field-add-list-option', function(event){

		event.preventDefault();
		var x = $(".vc-mailchimp-field-list-option").length;
		 new_index =x+1;

		    var options= '<table class="list-options" id="list-option-table-'+new_index+'">';
		   	    options+= '<tbody>';
			    options+= '<tr>';
				options+='<td class="vc-mailchimp-delete-list-option-td">';
				options+='<a href="#" class="vc-mailchimp-remove-list-option"><span class="dashicons dashicons-dismiss"></span></a>';
				options+='</td>';
				options+='<td class="vc-mailchimp-list-option-label-td">';
				options+='Label: <input type="text"  class="vc-mailchimp-field-list-option-label" value="">';
				options+='</td>';
				options+='<td class="vc-mailchimp-list-option-value-td">';
				options+='<span class="" >Value: <input type="text" class="vc-mailchimp-field-list-option-value"></span>';
				options+='</td>';
				options+='<td class="vc-mailchimp-list-option-selected-td">';
				options+='<label >Selected<input type="checkbox" value="1" class="vc-mailchimp-field-list-option-selected" ></label>';
				options+='</td>';
				options+='<td class="vc-mailchimp-list-option-drag-td">';
			//	options+='<span class="vc-mailchimp-drag"><span class="dashicons dashicons-menu"></span></span>';
				options+='</td>';
			    options+='</tr>';
			    options+= '</tbody>';
		        options+='</table>';

				$(".vc-mailchimp-field-list-option").append(options);

	})

	// remove option
	$(document).on('click','.vc-mailchimp-remove-list-option',function(){
			$(this).parent().parent().parent().fadeOut('slow',function(){
				$(this).remove();
				cal_options()
			});

	})

		$(document).on("keyup keypress blur change",".vc-mailchimp-field-list-option-label,.vc-mailchimp-field-list-option-value,.vc-mailchimp-field-list-option-selected",function(){
				cal_options();
		})





}) // document.ready ends here

	/**
	 * Adds the value of options to the hidden field
	 *
	 * @author Aman Saini
	 * @since  1.0
	 * @return {[type]}
	 */
	function cal_options(){
			var x = $(".vc-mailchimp-field-list-option").length;
 				 if( x > 0 ){
 				 	var input_values ='';
 				 	$(".vc-mailchimp-field-list-option table").each(function(index){
 				 		var label = $(this).find('.vc-mailchimp-field-list-option-label').val();
 				 		var value = $(this).find('.vc-mailchimp-field-list-option-value').val();
 				 		var selected = $(this).find('.vc-mailchimp-field-list-option-selected').is(':checked');
 				 		input_values+=label+'|'+value+'|'+selected+',';
 				 	})
 				 	var final_values = input_values.slice(0, - 1);
 				 	$('.options').val(final_values);
 				 }
	}

	function wh_update_hidden_border_field( picker ){
		var bdr_width = $('.wpb_el_type_vc_mailchimp_border_field .border_width').val();
		var bdr_style = $('.wpb_el_type_vc_mailchimp_border_field .border_style').val();
		var bdr_color = $('.wpb_el_type_vc_mailchimp_border_field .border_color').val();
		 if( typeof picker !='undefined' ){
		 	var bdr_color = picker.color.toString()
		 }
		$('.vc_mailchimp_border_field_field').val(bdr_width+'|'+bdr_style+'|'+bdr_color)
	}

})(jQuery)