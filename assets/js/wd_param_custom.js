jQuery(document).ready(function($) {
	
	jQuery('.wd-wraper-data-slider').on('click','.wd-add-data-slider', function(event) {
		var value = jQuery('.data_slider_post_field').val();
		event.preventDefault();
		var id_post   = jQuery('.wd-data-post option:selected').val();
		var name_post = jQuery('.wd-data-post option:selected').text();
		if(value){
			value = value+id_post+','+name_post+'|';
			
		}else{
			value = id_post+','+name_post+'|';
		}
		jQuery('.data_slider_post_field').val(value);
	});

	jQuery('.wd-wraper-data-category').on('click','.wd-add-data-category', function(event) {
		alert("tan");
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

searchBox = document.querySelector("#searchBox");
wd_category_se = document.querySelector("#wd_category_se");
var when = "keyup"; //You can change this to keydown, keypress or change
var searchbox_check = document.getElementById("searchBox");
if(searchbox_check){
	searchBox.addEventListener("keyup", function (e) {
	    var text = e.target.value; //searchBox value
	    var options = wd_category_se.options; //select options
	    for (var i = 0; i < options.length; i++) {
	        var option = options[i]; //current option
	        var optionText = option.text; //option text ("Somalia")
	        var lowerOptionText = optionText.toLowerCase(); //option text lowercased for case insensitive testing
	        var lowerText = text.toLowerCase(); //searchBox value lowercased for case insensitive testing
	        var regex = new RegExp("^" + text, "i"); //regExp, explained in post
	        var match = optionText.match(regex); //test if regExp is true
	        var contains = lowerOptionText.indexOf(lowerText) != -1; //test if searchBox value is contained by the option text
	        if (match || contains) { //if one or the other goes through
	            option.selected = true; //select that option
	            return; //prevent other code inside this event from executing
	        }
	        searchBox.selectedIndex = 0; //if nothing matches it selects the default option
	    }
	});
}