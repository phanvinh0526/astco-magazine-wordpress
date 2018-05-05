<?php


class VC_Mailchimp_Map {

	function __construct() {
		if ( function_exists( 'add_shortcode_param' ) ) {
			add_shortcode_param( 'vc_mailchimp_options_field', array( $this, 'options_field' ), VC_MAILCHIMP_URL."/js/vc-mailchimp-admin.js" );
			add_shortcode_param( 'vc_mailchimp_border_field', array( $this, 'border_field' ), VC_MAILCHIMP_URL."/js/vc-mailchimp-admin.js"  );
		}
	}


	public function map_fields() {


		// Mailchimp Form Container
		vc_map( array(
				"name" => __( "Mailchimp Form Container", "vc_mailchimp" ),
				"base" => "vc_mailchimp",
				"icon" => "icon-mc-form",
				"is_container"=>true,
				"as_parent" => array( 'except' => 'vc_mailchimp' ),
				"category" => __( "Mailchimp", "vc_mailchimp" ),
				"description" => __( 'Add Maichimp Subscribe Form', 'vc_mailchimp' ),
				"content_element" => true,
				"show_settings_on_create" => true,
				"params" => array(
					// array(
					//  "type" => "dropdown",
					//  "heading" => __( "Form Type", "vc_mailchimp" ),
					//  "param_name" => "type",
					//  "value" => array( 'Subscribe'=>'subscribe', 'Unsubscribe'=>'unsubscribe' ),
					//  "description" => __( "Select wether you want to subscribe users or unsubcribe users with this form. ", "vc_mailchimp" ),
					//  "admin_label" => true
					// ),

					array(
						"type" => "dropdown",
						"heading" => __( "List", "vc_mailchimp" ),
						"param_name" => "list",
						"value" => $this->vc_mailchimp_get_mailchimp_lists(),
						"description" => __( "Select List. ", "vc_mailchimp" ),
						"admin_label" => true
					),
					array(
						"type" => "checkbox",
						"heading" => __( "Enable Double Opt-in", "vc_mailchimp" ),
						"param_name" => "double_optin",
						'value' => array( __( 'Enable', 'vc_mailchimp' ) => '1' ),
						"description" => __( "Enable double optin for subscriptions.", "vc_mailchimp" ),

					),
					array(
						"type" => "href",
						"heading" => __( "Redirect Url", "vc_mailchimp" ),
						"param_name" => "redirect_url",
						"description" => __( "Enter the page url where users should be rediected after successful subscription.", "vc_mailchimp" ),

					),
					array(
						"type" => "textfield",
						"heading" => __( "Width", "vc_mailchimp" ),
						"param_name" => "width",
						"value" => '',
						"description" => __( "Form Width in px or % e.g 200px or 90%", "vc_mailchimp" ),
						"admin_label" => false,
						"edit_field_class" => "vc_col-sm-6 vc_column",
					),
					array(
						"type" => "textfield",
						"heading" => __( "Height", "vc_mailchimp" ),
						"param_name" => "height",
						"value" => '',
						"description" => __( "Form Height in px or % e.g 200px or 90%", "vc_mailchimp" ),
						"admin_label" => false,
						"edit_field_class" => "vc_col-sm-6 vc_column",
					),
					array(
						"type" => "textfield",
						"heading" => __( "Margin", "vc_mailchimp" ),
						"param_name" => "margin",
						"value" => '',
						"description" => __( "Form Margin in px or % e.g 200px or 90%", "vc_mailchimp" ),
						"admin_label" => false,
						"edit_field_class" => "vc_col-sm-6 vc_column",
					),
					array(
						"type" => "textfield",
						"heading" => __( "Padding", "vc_mailchimp" ),
						"param_name" => "padding",
						"value" => '',
						"description" => __( "Form Padding in px or % e.g 200px or 90%", "vc_mailchimp" ),
						"admin_label" => false,
						"edit_field_class" => "vc_col-sm-6 vc_column",
					),
					array(
						"type" => "colorpicker",
						"heading" => __( "Background Color", "vc_mailchimp" ),
						"param_name" => "background_color",
						"value" => '',
						"description" => __( "Form background color", "vc_mailchimp" ),
						"admin_label" => false,
						"edit_field_class" => "vc_col-sm-6 vc_column",
					),
					array(
						"type" => "vc_mailchimp_border_field",
						"heading" => __( "Border", "vc_mailchimp" ),
						"param_name" => "border",
						"value" => '',
						"description" => __( "Form Border", "vc_mailchimp" ),
						"admin_label" => false,
						"edit_field_class" => "vc_col-sm-6 vc_column",
					),
					array(
						"type" => "textfield",
						"heading" => __( "Border Radius", "vc_mailchimp" ),
						"param_name" => "border_radius",
						"value" => '',
						"description" => __( "Form Border Radius in px, makes round corners", "vc_mailchimp" ),
						"admin_label" => false,
						"edit_field_class" => "vc_col-sm-6 vc_column",
					),
					array(
						"type" => "dropdown",
						"heading" => __( "Fields Align", "vc_mailchimp" ),
						"param_name" => "align",
						"value" => array( 'Left'=>'left', 'Center'=>'center', 'Right'=>'right' ),
						"admin_label" => false,
						"edit_field_class" => "vc_col-sm-6 vc_column",
						"description" => __( "Set Fields Alignment", "vc_mailchimp" ),
					),

					array(
						"type" => "textfield",
						"heading" => __( "Valid Email Error Message", "vc_mailchimp" ),
						"param_name" => "email_validation_msg",
						"value" => 'Please enter a valid email',
						"description" => __( "Error to show if email field is empty or unvalid", "vc_mailchimp" ),
						"admin_label" => false,

					),

					array(
						"type" => "textfield",
						"heading" => __( "Error Message", "vc_mailchimp" ),
						"param_name" => "error_message",
						"value" => 'Sorry but there is some error in adding your email to our subscriber list.Please try again',
						"description" => __( "General Error message", "vc_mailchimp" ),
						"admin_label" => false,

					),
					array(
						"type" => "textfield",
						"heading" => __( "Error Message Font Size", "vc_mailchimp" ),
						"param_name" => "error_font_size",
						"value" => '',
						"description" => __( "Font size in px, em or % e.g 12px or 90%", "vc_mailchimp" ),
						"admin_label" => false,
						"edit_field_class" => "vc_col-sm-6 vc_column",
					),
					array(
						"type" => "colorpicker",
						"heading" => __( "Error Message Font Color", "vc_mailchimp" ),
						"param_name" => "error_font_color",
						"value" => '',
						"description" => __( "", "vc_mailchimp" ),
						"admin_label" => false,
						"edit_field_class" => "vc_col-sm-6 vc_column",
					),
					array(
						"type" => "textfield",
						"heading" => __( "Success Message", "vc_mailchimp" ),
						"param_name" => "success_message",
						"value" => 'Thanks for subscribing',
						"description" => __( "", "vc_mailchimp" ),
						"admin_label" => false,

					),

					array(
						"type" => "textfield",
						"heading" => __( "Success Message Font Size", "vc_mailchimp" ),
						"param_name" => "success_font_size",
						"value" => '',
						"description" => __( "Font size in px, em or % e.g 12px or 90%", "vc_mailchimp" ),
						"admin_label" => false,
						"edit_field_class" => "vc_col-sm-6 vc_column",
					),
					array(
						"type" => "colorpicker",
						"heading" => __( "Success Message Font Color", "vc_mailchimp" ),
						"param_name" => "success_font_color",
						"value" => '',
						"description" => __( "", "vc_mailchimp" ),
						"admin_label" => false,
						"edit_field_class" => "vc_col-sm-6 vc_column",
					),
				),
				"js_view" => 'VcColumnView'

			) );

		// Name Field
		vc_map( array(
				"name" => __( "First Name", "vc_mailchimp" ),
				"base" => "vc_mailchimp_name_field",
				"icon" => "icon-mc-name",
				// "as_child" => array( 'only' => 'vc_mailchimp' ),
				"category" => __( "Mailchimp", "vc_mailchimp" ),
				"description" => __( 'Mailchimp Name Field', 'vc_mailchimp' ),
				"params" => array(
					array(
						"type" => "textfield",
						"heading" => __( "Label", "vc_mailchimp" ),
						"param_name" => "label",
						"value" => '',
						"description" => __( "Field Label to show in form ", "vc_mailchimp" ),
						"admin_label" => true
					),
					array(
						"type" => "colorpicker",
						"heading" => __( "Label Font Color", "vc_mailchimp" ),
						"param_name" => "label_color",
						"value" => '',
						"description" => __( "Set Label text color ", "vc_mailchimp" ),
						"edit_field_class" => "vc_col-sm-6 vc_column",
					),

					array(
						"type" => "dropdown",
						"heading" => __( "Label Position", "vc_mailchimp" ),
						"param_name" => "label_position",
						"value" => array( 'Top'=>'top', 'Left'=>'left' ),
						"admin_label" => false,
						"edit_field_class" => "vc_col-sm-6 vc_column",
						"description" => __( "Set Label position ", "vc_mailchimp" ),
					),
					array(
						"type" => "textfield",
						"heading" => __( "Placeholder", "vc_mailchimp" ),
						"param_name" => "placeholder",
						"value" => '',
						"description" => __( "Placeholder to show inside Name Field ", "vc_mailchimp" ),
						"admin_label" => false
					),
					array(
						"type" => "textfield",
						"heading" => __( "Input Box Width", "vc_mailchimp" ),
						"param_name" => "width",
						"value" => '',
						"description" => __( "Width of Input Box in px or % e.g 200px or 90%", "vc_mailchimp" ),
						"admin_label" => false,
						"edit_field_class" => "vc_col-sm-6 vc_column",
					),

					array(
						"type" => "textfield",
						"heading" => __( "Input Box Padding", "js_composer" ),
						"param_name" => "padding",
						"description" => 'Leave empty to use theme default e.g 5px',
						"edit_field_class" => "vc_col-sm-6 vc_column",
					),


					array(
						"type" => "colorpicker",
						"heading" => __( "Input Box Font Color ", "js_composer" ),
						"param_name" => "color",
						"description" => 'Leave empty to use theme default',
						"edit_field_class" => "vc_col-sm-6 vc_column",
					),
					array(
						"type" => "colorpicker",
						"heading" => __( "Input Box Background Color", "js_composer" ),
						"param_name" => "background_color",
						"description" => 'Leave empty to use theme default',
						"edit_field_class" => "vc_col-sm-6 vc_column",
					),

					array(
						"type" => "vc_mailchimp_border_field",
						"heading" => __( "Input Box Border", "js_composer" ),
						"param_name" => "border",
						"value" =>'',
						"description" => 'Set input Box border',
						"edit_field_class" => "vc_col-sm-6 vc_column",
					),
					array(
						"type" => "textfield",
						"heading" => __( "Border Radius", "js_composer" ),
						"param_name" => "border_radius",
						"value" =>'4px',
						"description" => 'Makes input box with round corner e.g 4px ',
						"edit_field_class" => "vc_col-sm-6 vc_column",
					),


				),

			) );

//last name field
vc_map( array(
				"name" => __( "Last Name", "vc_mailchimp" ),
				"base" => "vc_mailchimp_last_name_field",
				"icon" => "icon-mc-lname",
				// "as_child" => array( 'only' => 'vc_mailchimp' ),
				"category" => __( "Mailchimp", "vc_mailchimp" ),
				"description" => __( 'Mailchimp Last Name Field', 'vc_mailchimp' ),
				"params" => array(
					array(
						"type" => "textfield",
						"heading" => __( "Label", "vc_mailchimp" ),
						"param_name" => "last_label",
						"value" => '',
						"description" => __( "Field Label to show in form ", "vc_mailchimp" ),
						"admin_label" => true
					),
					array(
						"type" => "colorpicker",
						"heading" => __( "Label Font Color", "vc_mailchimp" ),
						"param_name" => "label_color",
						"value" => '',
						"description" => __( "Set Label text color ", "vc_mailchimp" ),
						"edit_field_class" => "vc_col-sm-6 vc_column",
					),

					array(
						"type" => "dropdown",
						"heading" => __( "Label Position", "vc_mailchimp" ),
						"param_name" => "label_position",
						"value" => array( 'Top'=>'top', 'Left'=>'left' ),
						"admin_label" => false,
						"edit_field_class" => "vc_col-sm-6 vc_column",
						"description" => __( "Set Label position ", "vc_mailchimp" ),
					),
					array(
						"type" => "textfield",
						"heading" => __( "Placeholder", "vc_mailchimp" ),
						"param_name" => "placeholder",
						"value" => '',
						"description" => __( "Placeholder to show inside Name Field ", "vc_mailchimp" ),
						"admin_label" => false
					),
					array(
						"type" => "textfield",
						"heading" => __( "Input Box Width", "vc_mailchimp" ),
						"param_name" => "width",
						"value" => '',
						"description" => __( "Width of Input Box in px or % e.g 200px or 90%", "vc_mailchimp" ),
						"admin_label" => false,
						"edit_field_class" => "vc_col-sm-6 vc_column",
					),

					array(
						"type" => "textfield",
						"heading" => __( "Input Box Padding", "js_composer" ),
						"param_name" => "padding",
						"description" => 'Leave empty to use theme default e.g 5px',
						"edit_field_class" => "vc_col-sm-6 vc_column",
					),


					array(
						"type" => "colorpicker",
						"heading" => __( "Input Box Font Color ", "js_composer" ),
						"param_name" => "color",
						"description" => 'Leave empty to use theme default',
						"edit_field_class" => "vc_col-sm-6 vc_column",
					),
					array(
						"type" => "colorpicker",
						"heading" => __( "Input Box Background Color", "js_composer" ),
						"param_name" => "background_color",
						"description" => 'Leave empty to use theme default',
						"edit_field_class" => "vc_col-sm-6 vc_column",
					),

					array(
						"type" => "vc_mailchimp_border_field",
						"heading" => __( "Input Box Border", "js_composer" ),
						"param_name" => "border",
						"value" =>'',
						"description" => 'Set input Box border',
						"edit_field_class" => "vc_col-sm-6 vc_column",
					),
					array(
						"type" => "textfield",
						"heading" => __( "Border Radius", "js_composer" ),
						"param_name" => "border_radius",
						"value" =>'4px',
						"description" => 'Makes input box with round corner e.g 4px ',
						"edit_field_class" => "vc_col-sm-6 vc_column",
					),


				),

			) );

		// Email Field
		vc_map( array(
				"name" => __( "Email Field", "vc_mailchimp" ),
				"base" => "vc_mailchimp_email_field",
				"icon" => "icon-mc-email",
				// "as_child" => array( 'only' => 'vc_mailchimp' ),
				"category" => __( "Mailchimp", "vc_mailchimp" ),
				"description" => __( 'Mailchimp Email Field', 'vc_mailchimp' ),
				"params" => array(
					array(
						"type" => "textfield",
						"heading" => __( "Label", "vc_mailchimp" ),
						"param_name" => "label",
						"value" => '',
						"description" => __( "Field Label to show in form ", "vc_mailchimp" ),
						"admin_label" => true
					),

					array(
						"type" => "dropdown",
						"heading" => __( "Label Position", "vc_mailchimp" ),
						"param_name" => "label_position",
						"value" => array( 'Top'=>'top', 'Left'=>'left' ),
						"admin_label" => false,
						"edit_field_class" => "vc_col-sm-6 vc_column",
						"description" => __( "Set Label position ", "vc_mailchimp" ),
					),
					array(
						"type" => "colorpicker",
						"heading" => __( "Label Font Color", "vc_mailchimp" ),
						"param_name" => "label_color",
						"value" => '',
						"description" => __( "Set Label text color ", "vc_mailchimp" ),
						"edit_field_class" => "vc_col-sm-6 vc_column",
					),

					array(
						"type" => "textfield",
						"heading" => __( "Placeholder", "vc_mailchimp" ),
						"param_name" => "placeholder",
						"value" => '',
						"description" => __( "Placeholder to show inside Email Field ", "vc_mailchimp" ),
						"admin_label" => false
					),
					array(
						"type" => "textfield",
						"heading" => __( "Input Box Width", "vc_mailchimp" ),
						"param_name" => "width",
						"value" => '',
						"description" => __( "Width of Input Box in px or % e.g 200px or 90%", "vc_mailchimp" ),
						"admin_label" => false,
						"edit_field_class" => "vc_col-sm-6 vc_column",
					),
					array(
						"type" => "textfield",
						"heading" => __( "Input Box Padding", "js_composer" ),
						"param_name" => "padding",
						"description" => 'Leave empty to use theme default e.g 5px',
						"edit_field_class" => "vc_col-sm-6 vc_column",
					),



					array(
						"type" => "colorpicker",
						"heading" => __( "Input Box Font Color ", "js_composer" ),
						"param_name" => "color",
						"description" => 'Leave empty to use theme default',
						"edit_field_class" => "vc_col-sm-6 vc_column",
					),
					array(
						"type" => "colorpicker",
						"heading" => __( "Input Box Background Color", "js_composer" ),
						"param_name" => "background_color",
						"description" => 'Leave empty to use theme default',
						"edit_field_class" => "vc_col-sm-6 vc_column",
					),
					array(
						"type" => "vc_mailchimp_border_field",
						"heading" => __( "Input Box Border", "js_composer" ),
						"param_name" => "border",
						"value" =>'',
						"description" => 'Set input Box border',
						"edit_field_class" => "vc_col-sm-6 vc_column",
					),
					array(
						"type" => "textfield",
						"heading" => __( "Border Radius", "js_composer" ),
						"param_name" => "border_radius",
						"value" =>'4px',
						"description" => 'Makes input box with round corner e.g 4px ',
						"edit_field_class" => "vc_col-sm-6 vc_column",
					),

				),

			) );

		// Custom Field
		vc_map( array(
				"name" => __( "Custom Field", "vc_mailchimp" ),
				"base" => "vc_mailchimp_custom_field",
				"icon" => "icon-mc-custom",
				"category" => __( "Mailchimp", "vc_mailchimp" ),
				"description" => __( 'Mailchimp Custom Field', 'vc_mailchimp' ),
				"params" => array(

					array(
						"type" => "dropdown",
						"heading" => __( "Field Type", "vc_mailchimp" ),
						"param_name" => "type",
						"value" => array( 'Text'=>'text', 'Dropdown'=>'dropdown', 'Checkbox'=>'checkbox' ),
						"description" => __( "Select field type to add. ", "vc_mailchimp" ),
						"admin_label" => true
					),

					array(
						"type" => "vc_mailchimp_options_field",
						"heading" => __( "Options", "vc_mailchimp" ),
						"param_name" => "options",
						"description" => __( "Add options for this field. ", "vc_mailchimp" ),
						"admin_label" => false,
						"dependency" => array(
							'element' => 'type',
							'value' => array( 'dropdown' )
						)
					),
					array(
						"type" => "textfield",
						"heading" => __( "Label", "vc_mailchimp" ),
						"param_name" => "label",
						"value" => '',
						"description" => __( "Field Label to show in form ", "vc_mailchimp" ),
						"admin_label" => true
					),
					array(
						"type" => "dropdown",
						"heading" => __( "Label Position", "vc_mailchimp" ),
						"param_name" => "label_position",
						"value" => array( 'Top'=>'top', 'Left'=>'left' ),
						"admin_label" => false,
						"edit_field_class" => "vc_col-sm-6 vc_column",
						"description" => __( "Set Label position ", "vc_mailchimp" ),
						"dependency" => array(
							'element' => 'type',
							'value' => array( 'dropdown', 'text' )
						)
					),
					array(
						"type" => "colorpicker",
						"heading" => __( "Field Label Font Color", "vc_mailchimp" ),
						"param_name" => "label_color",
						"value" => '',
						"description" => __( "Set Label text color ", "vc_mailchimp" ),
						"edit_field_class" => "vc_col-sm-6 vc_column",
					),

					array(
						"type" => "textfield",
						"heading" => __( "Mailchimp Field Name", "vc_mailchimp" ),
						"param_name" => "name",
						"value" => '',
						"description" => __( "Enter the field name exactly same as you added in Mailchimp.", "vc_mailchimp" ),
					),
					array(
						"type" => "textfield",
						"heading" => __( "Placeholder", "vc_mailchimp" ),
						"param_name" => "placeholder",
						"value" => '',
						"description" => __( "Placeholder to show inside  Field ", "vc_mailchimp" ),
					),
					array(
						"type" => "textfield",
						"heading" => __( "Input Box Width", "vc_mailchimp" ),
						"param_name" => "width",
						"value" => '',
						"description" => __( "Width of Input Box in px or % e.g 200px or 90%", "vc_mailchimp" ),
						"admin_label" => false,
						"edit_field_class" => "vc_col-sm-6 vc_column",
						"dependency" => array(
							'element' => 'type',
							'value' => array( 'text' )
						)
					),
					array(
						"type" => "textfield",
						"heading" => __( "Input Box Padding", "js_composer" ),
						"param_name" => "padding",
						"description" => 'Leave empty to use theme default e.g 5px',
						"edit_field_class" => "vc_col-sm-6 vc_column",
						"dependency" => array(
							'element' => 'type',
							'value' => array(  'text' )
						)
					),





					array(
						"type" => "colorpicker",
						"heading" => __( "Input Box Font Color ", "js_composer" ),
						"param_name" => "color",
						"description" => 'Leave empty to use theme default',
						"edit_field_class" => "vc_col-sm-6 vc_column",
						"dependency" => array(
							'element' => 'type',
							'value' => array( 'text' )
						)
					),
					array(
						"type" => "colorpicker",
						"heading" => __( "Input Box Background Color", "js_composer" ),
						"param_name" => "background_color",
						"description" => 'Leave empty to use theme default',
						"edit_field_class" => "vc_col-sm-6 vc_column",
						"dependency" => array(
							'element' => 'type',
							'value' => array( 'text' )
						)
					),
					array(
						"type" => "vc_mailchimp_border_field",
						"heading" => __( "Border", "js_composer" ),
						"param_name" => "border",
						"value" =>'',
						"description" => 'Set input Box border',
						"dependency" => array(
							'element' => 'type',
							'value' => array( 'text' )
						)
					),

					array(
						"type" => "textfield",
						"heading" => __( "Border Radius", "js_composer" ),
						"param_name" => "border_radius",
						"value" =>'4px',
						"description" => 'Makes input box with round corner e.g 4px ',
						"edit_field_class" => "vc_col-sm-6 vc_column",
						"dependency" => array(
							'element' => 'type',
							'value' => array(  'text' )
						)
					),

				),

			) );

		// Submit Button

		vc_map( array(
				'name' => __( 'Submit Button', 'js_composer' ),
				'base' => 'vc_mailchimp_submit_button',
				'icon' => 'icon-mc-submit',
				"category" => __( "Mailchimp", "vc_mailchimp" ),
				'description' => __( 'Place susbcribe button in your form ', 'js_composer' ),
				"params" => array(
					array(
						"type" => "textfield",
						"heading" => __( "Button Label", "js_composer" ),
						"holder" => "button",
						"class" => "wpb_button",
						"param_name" => "text",
						"value" => __( "Subscribe", "js_composer" ),
						"description" => '',
						"edit_field_class" => "vc_col-sm-6 vc_column",
					),

					array(
						"type" => "dropdown",
						"heading" => __( "Button Color", "js_composer" ),
						"param_name" => "type",
						"value" => array( __( "White", "js_composer" ) => "white", __( "Pink", "js_composer" ) => "pink", __( "Blue", "js_composer" ) => "blue", __( "Green", "js_composer" ) => "green", __( "Yellow", "js_composer" ) => "yellow", __( "Purple", "js_composer" ) => "purple", __( "Red", "js_composer" ) => "red", __( "Lime", "js_composer" ) => "lime", __( "Navy", "js_composer" ) => "navy", __( "Cream", "js_composer" ) => "cream", __( "Brown", "js_composer" ) => "brown", __( "Midnight", "js_composer" ) => "midnight", __( "Teal", "js_composer" ) => "teal", __( "Transparent", "js_composer" ) => "transparent" ),
						"description" => '',
						"edit_field_class" => "vc_col-sm-6 vc_column",
					),
					array(
						"type" => 'checkbox',
						"heading" => __( "Button Style", "js_composer" ),
						"param_name" => "outlined",
						"value" => array( __( "Apply Outlined Style to the Button", "js_composer" ) => 'yes' ),
						"description" => '',
						"edit_field_class" => "vc_col-sm-6 vc_column",
					),
					array(
						"type" => 'colorpicker',
						"heading" => __( "Button Text Color", "js_composer" ),
						"param_name" => "text_color",
						"description" => 'Button Text Color',
						"edit_field_class" => "vc_col-sm-6 vc_column",
					),
					array(
						"type" => "textfield",
						"heading" => __( "Button Icon (optional)", "js_composer" ),
						"param_name" => "icon",
						"description" => sprintf( __( 'FontAwesome Icon name. %s', "js_composer" ), '<a href="http://fontawesome.io/icons/" target="_blank">Full list of icons</a>' ),
						// "edit_field_class" => "vc_col-sm-6 vc_column",
					),

					array(
						"type" => "dropdown",
						"heading" => __( "Button Size", "js_composer" ),
						"param_name" => "size",
						"value" => array( __( "Medium", "js_composer" ) => "medium", __( "Small", "js_composer" ) => "small", __( "Large", "js_composer" ) => "big" ),
						"description" => '',
						"edit_field_class" => "vc_col-sm-6 vc_column",
					),
					array(
						"type" => "textfield",
						"heading" => __( "Button Width", "js_composer" ),
						"param_name" => "width",
						"value" =>'',
						"description" => 'Set button width in px or % e.g 200px or 100%. ',
						"edit_field_class" => "vc_col-sm-6 vc_column",
					),
					array(
						"type" => "dropdown",
						"heading" => __( "Button Alignment", "js_composer" ),
						"param_name" => "align",
						"value" => array( __( 'Left', "js_composer" ) => "left", __( 'Center', "js_composer" ) => "center", __( 'Right', "js_composer" ) => "right" ),
						"description" => '',
						"edit_field_class" => "vc_col-sm-6 vc_column",
					),
					array(
						"type" => "textfield",
						"heading" => __( "Border Radius", "js_composer" ),
						"param_name" => "border_radius",
						"value" =>'4px',
						"description" => '',
						"edit_field_class" => "vc_col-sm-6 vc_column",
					),

					array(
						'type' => 'textfield',
						'heading' => __( 'Extra class name', 'js_composer' ),
						'param_name' => 'el_class',
						'description' => __( 'If you wish to style button differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
					),
				),
				"js_view" => 'VcButtonView'
			) );

	}

	function options_field( $settings, $value ) {
		$dependency = vc_generate_dependencies_attributes( $settings );
		$x=1;

		$html= '<div class="my_param_block">'
			.'<input name="'.$settings['param_name']
			.'" class="wpb_vc_param_value wpb-textinput '
			.$settings['param_name'].' '.$settings['type'].'_field" type="hidden" value="'
			.$value.'" ' . $dependency . '/>'
			.'</div>
			<div class="vc_mailchimp_options_cont">
			<div id="vc_mailchimp_field_list_option" class="vc-mailchimp-field-list-option " >';

		if ( !empty( $value ) ) {
			$options = explode( ',', $value );

			foreach ( $options as $option ) {
				$option_data = explode( '|', $option );

				$html.= '<table class="list-options" id="list-option-table-'.$x.'">
								<tr>
									<td class="vc-mailchimp-delete-list-option-td">
										<a href="#"  class="vc-mailchimp-remove-list-option"><span class="dashicons dashicons-dismiss"></span></a>
									</td>
									<td class="vc-mailchimp-list-option-label-td">
									Label: <input type="text"  class="vc-mailchimp-field-list-option-label" value="'.$option_data[0].'">
									</td>
									<td class="vc-mailchimp-list-option-value-td">
										<span >
										Value: <input type="text" class="vc-mailchimp-field-list-option-value" value="'.$option_data[1].'"></span>
									</td>
									<td class="vc-mailchimp-list-option-selected-td">
										<label>Selected <input type="checkbox" value="1" class="vc-mailchimp-field-list-option-selected" '.checked( 'true', $option_data[2], true ).'></label>
									</td>
									<td class="vc-mailchimp-list-option-drag-td">
										<!--<span class="vc-mailchimp-drag"><span class="dashicons dashicons-menu"></span></span> -->
									</td>
								</tr>
							</table>';
				$x++;
			}

		}else {

			$html.= '<table class="list-options " id="list-option-table-1">
							<tr>
								<td class="vc-mailchimp-delete-list-option-td">
									<a href="#"  class="vc-mailchimp-remove-list-option"><span class="dashicons dashicons-dismiss"></span></a>
								</td>
								<td class="vc-mailchimp-list-option-label-td">
								Label: <input type="text"  class="vc-mailchimp-field-list-option-label" value="">
								</td>
								<td class="vc-mailchimp-list-option-value-td">
									<span >
									Value: <input type="text" class="vc-mailchimp-field-list-option-value" value=""></span>
								</td>
								<td class="vc-mailchimp-list-option-selected-td">
									<label >Selected <input type="checkbox" value="1" class="vc-mailchimp-field-list-option-selected" ></label>
								</td>
								<td class="vc-mailchimp-list-option-drag-td">
									<!--<span class="vc-mailchimp-drag"><span class="dashicons dashicons-menu"></span></span> -->
								</td>
							</tr>
						</table>';
		}

		$html.= '</div></div>
		<a href="javascript:void(0)"  class="vc-mailchimp-field-add-list-option button-secondary">Add New</a>';

		return $html;

	}

	function border_field(  $settings, $value ) {
		$border_width = $border_style = $border_color ='';
		$dependency = vc_generate_dependencies_attributes( $settings );

		$html= '<div class="border_field_block">'
			.'<input name="'.$settings['param_name']
			.'" class="wpb_vc_param_value wpb-textinput '
			.$settings['param_name'].' '.$settings['type'].'_field" type="hidden" value="'
			.$value.'" ' . $dependency . '/>'
			.'</div>';

		if ( !empty( $value ) ) {

			$border_array = explode( '|', $value );
			$border_width = empty( $border_array[0] )?'':$border_array[0];
			$border_style = empty( $border_array[1] )?'':$border_array[1];
			$border_color = empty( $border_array[2] )?'':$border_array[2];

		}

		$html.='<select style="width:60px;vertical-align: top;" class="border_width">
					<option '.selected( $border_width, '0px' ).' value="0px">0px</option>
					<option '.selected( $border_width, '1px' ).' value="1px">1px</option>
					<option '.selected( $border_width, '2px' ).' value="2px">2px</option>
					<option '.selected( $border_width, '3px' ).' value="3px">3px</option>
					<option '.selected( $border_width, '4px' ).' value="4px">4px</option>
					<option '.selected( $border_width, '5px' ).' value="5px">5px</option>
					<option '.selected( $border_width, '6px' ).' value="6px">6px</option>
					<option '.selected( $border_width, '7px' ).' value="7px">7px</option>
					<option '.selected( $border_width, '8px' ).' value="8px">8px</option>
					<option '.selected( $border_width, '9px' ).' value="9px">9px</option>
					<option '.selected( $border_width, '10px' ).' value="10px">10px</option>
				</select>
				<select style="width:90px;vertical-align: top;"  class="border_style">
					<option '.selected( $border_style, 'solid' ).' value="solid">solid</option>
					<option '.selected( $border_style, 'dotted' ).' value="dotted">dotted</option>
					<option '.selected( $border_style, 'dashed' ).' value="dashed">dashed</option>
					<option '.selected( $border_style, 'double' ).' value="double">double</option>
					<option '.selected( $border_style, 'groove' ).' value="groove">groove</option>
					<option '.selected( $border_style, 'ridge' ).' value="ridge">ridge</option>
					<option '.selected( $border_style, 'inset' ).' value="inset">inset</option>
					<option '.selected( $border_style, 'outset' ).' value="outset">outset</option>
				</select>
				<input type="text" class="border_color wh-color-picker" value="'.$border_color.'" >';
		return $html;

	}


	/**
	 *  Get List from MailChimp
	 */
	public function vc_mailchimp_get_mailchimp_lists(  ) {

		$settings = get_option( 'vc_mailchimp_settings' );
		$mailchimp_lists['Select List'] ='';

		if ( ! class_exists( 'Mailchimp' ) ) {
			require_once VC_MAILCHIMP_DIR.'/Mailchimp.php';
		}

		if(empty( $settings['api_key'] ) ){
			return $error['The API key you have entered appears to be invalid'];
		}else{
			$apikey = $settings['api_key'];
		}

		try {

			$verify_ssl = false;

			$opts = array(
				'debug' => defined( 'WP_DEBUG' ) && WP_DEBUG,
				'ssl_verifypeer' => $verify_ssl,
			);

			$api       = new Mailchimp( trim( $apikey ), $opts );
			$list_data = $api->call( 'lists/list', array( 'limit' => 100 ) );
			if ( $list_data ) {
				foreach ( $list_data['data'] as $key => $list ) {
					$mailchimp_lists[$list['name']] =$list['id'] ;
				}
			}
			//set_transient( 'vc_mailchimp_lists', $lists, 60*60*60 );

		} catch( Exception $e ) {

			$mailchimp_lists['The API key you have entered appears to be invalid']='';

		}
		return $mailchimp_lists;
	}

}

//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_Vc_Mailchimp extends WPBakeryShortCodesContainer {
	}
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_Vc_Mailchimp_Name_Field extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Vc_Mailchimp_Email_Field extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Vc_Mailchimp_Custom_Field extends WPBakeryShortCode {
	}
	class WPBakeryShortCode_Vc_Mailchimp_Submit_Button extends WPBakeryShortCode {
	}
}
