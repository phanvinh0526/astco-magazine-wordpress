<?php


class VC_Mailchimp_Shortcode {

	//Plugin starting point.
	public static function setup() {

		$class = __CLASS__;
		new $class;
	}


	function __construct() {

		add_action( 'wp_enqueue_scripts', array( $this, 'add_scripts' ) );
		add_action( 'wp_head', array( $this, 'vc_mailhimp_ajax_url' ) );

		add_shortcode( 'vc_mailchimp', array( $this, 'shortcode_vc_mailchimp' ) );
		add_shortcode( 'vc_mailchimp_name_field', array( $this, 'shortcode_vc_mailchimp_name_field' ) );
		add_shortcode( 'vc_mailchimp_email_field', array( $this, 'shortcode_vc_mailchimp_email_field' ) );
		add_shortcode( 'vc_mailchimp_custom_field', array( $this, 'shortcode_vc_mailchimp_custom_field' ) );
		add_shortcode( 'vc_mailchimp_submit_button', array( $this, 'shortcode_vc_mailchimp_submit_button' ) );
		add_shortcode( 'vc_mailchimp_last_name_field', array( $this, 'shortcode_vc_mailchimp_last_name_field' ) );


		add_action( 'wp_ajax_vc_mailchimp_form_submit', array( $this, 'ajax_vc_mailchimp_form_submit' ) );
		add_action( 'wp_ajax_nopriv_vc_mailchimp_form_submit', array( $this, 'ajax_vc_mailchimp_form_submit' ) );


	}

	function add_scripts() {
		wp_enqueue_style( 'vc-mailchimp', VC_MAILCHIMP_URL.'/css/theme.css' );
		wp_enqueue_script( 'vc-mailchimp', VC_MAILCHIMP_URL.'/js/vc-mailchimp.js', array( 'jquery' ), false, false );
		wp_localize_script( 'vc-mailchimp-admin-script', 'vcMailchimp', array( 'admin_ajax_url' => admin_url( 'admin_ajax.php' ) ) );
	}



	function vc_mailhimp_ajax_url() {
?>
		<script type="text/javascript">
		var vcmailhimp_ajaxurl = "<?php echo admin_url( 'admin-ajax.php' ); ?>";
		</script>
		<?php
	}


	/**
	 * Show mailchimp form in frontend
	 *
	 * @author Aman Saini
	 * @since  1.0
	 * @param unknown $atts
	 * @return
	 */
	function shortcode_vc_mailchimp( $atts, $content= null ) {

		$settings = get_option( 'vc_mailchimp_settings' );

		$settings = shortcode_atts( array(
				'type'=>'subscribe',
				'list'=>'',
				'double_optin'=>'0',
				'redirect_url'=>'',
				'email_validation_msg' =>'Please enter a valid email',
				'error_message' => 'Sorry but there is some error in adding your email to our subscriber list.Please try again',
				'success_message' => 'Thanks for subscribing'
			), $atts );
		$error_font_size = !empty( $atts['error_font_size'] )? 'font-size:'.$atts['error_font_size'].';':'';
		$error_font_color = !empty( $atts['error_font_color'] )? 'color:'.$atts['error_font_color'].';':'';
		$success_font_size = !empty( $atts['success_font_size'] )? 'font-size:'.$atts['success_font_size'].';':'';
		$success_font_color = !empty( $atts['success_font_color'] )? 'color:'.$atts['success_font_color'].';':'';

		if ( empty (  $settings['list'] ) ) {
			return 'Please select a list for your form';
		}
		$input_styles = $this->get_input_styles( $atts );

		$form_output ='<div style="'.$input_styles.'" class="vc_mailchimp_form_cont">
		<form method="post" class="vc_mailchimp_form" action="">
		'.do_shortcode( $content ).'
		<div style="'.$error_font_size.$error_font_color.'" class="mc-email-validation-message">'.$settings['email_validation_msg'].'</div>
		<div style="'.$error_font_size.$error_font_color.'" class="mc-error-message">'.$settings['error_message'].'</div>
		<div style="'.$success_font_size.$success_font_color.'" class="mc-success-message">'.$settings['success_message'].'</div>
		<div style="display:none" class="vc-maichimp-debug"></div>
		<input type="hidden" name="double_optin" value="'.$settings['double_optin'].'" >
		<input type="hidden" name="list" value="'.$settings['list'].'" >
		<input type="hidden" class="redirect_url" name="redirect_url" value="'.$settings['redirect_url'].'" >
		<input type="submit" style="display:none !important" class="vc_mailchimp_submit" >
		</form>
		<div style="clear:both"></div>
		</div>';

		return $form_output;

	}

	function shortcode_vc_mailchimp_name_field( $atts ) {
		$label_styles='';
		$settings = shortcode_atts( array(
				'placeholder'=>'',
				'label'=>'',
				'width'=>'',
				'label_color'=>'',
				'label_position'=>'top',
				'border'=>'0px',
				'color'=>'',
				'background_color'=>'',
				'padding'=>'',
				'border_radius'=>'4px'
			), $atts );
		$class = ( $settings['label_position'] == 'left' )?'mc_inline_label':'';

		$label_styles = empty( $settings['label_color'] )?'':'color:'.$settings['label_color'].';';

		$input_styles = $this->get_input_styles( $atts );

		$form_output ='<div class="'.$class.'"><label style="'.$label_styles.'">'.$settings['label'].'</label><input style="'.$input_styles.'" type="text" name="mc_name" class="mc_name" placeholder="'.$settings['placeholder'].'" ></div>';

		return $form_output;

	}

	function shortcode_vc_mailchimp_last_name_field( $atts ) {
		$label_styles='';
		$settings = shortcode_atts( array(
				'placeholder'=>'',
				'last_label'=>'',
				'width'=>'',
				'label_color'=>'',
				'label_position'=>'top',
				'border'=>'0px',
				'color'=>'',
				'background_color'=>'',
				'padding'=>'',
				'border_radius'=>'4px'
			), $atts );
		$class = ( $settings['label_position'] == 'left' )?'mc_inline_label':'';

		$label_styles = empty( $settings['label_color'] )?'':'color:'.$settings['label_color'].';';

		$input_styles = $this->get_input_styles( $atts );

		$form_output ='<div class="'.$class.'"><label style="'.$label_styles.'">'.$settings['last_label'].'</label><input style="'.$input_styles.'" type="text" name="mc_last_name" class="mc_last_name" placeholder="'.$settings['placeholder'].'" ></div>';

		return $form_output;

	}

	function shortcode_vc_mailchimp_email_field( $atts ) {
		$label_styles='';
		$settings =  shortcode_atts( array(
				'placeholder'=>'',
				'label'=>'',
				'label_color'=>'',
				'width'=>'',
				'label_position'=>'top',
				'border'=>'0px',
				'color'=>'',
				'background_color'=>'',
				'padding'=>'',
				'border_radius'=>'4px'
			), $atts  );

		$class = ( $settings['label_position'] == 'left' )?'mc_inline_label':'';

		$label_styles = empty( $settings['label_color'] )?'':'color:'.$settings['label_color'].';';
		$input_styles = $this->get_input_styles( $atts );

		$form_output ='<div class="'.$class.'"><label style="'.$label_styles.'">'.$settings['label'].'</label><input style="'.$input_styles.'" type="text" name="mc_email" class="mc_email" placeholder="'.$settings['placeholder'].'" ></div>';

		return $form_output;

	}

	function shortcode_vc_mailchimp_custom_field( $atts ) {
		$label_styles='';
		$settings = shortcode_atts( array(
				'type'=>'text',
				'label'=>'',
				'label_color'=>'',
				'width'=>'',
				'label_position'=>'top',
				'name'=>'',
				'options'=>'',
				'placeholder'=>'',
				'border'=>'0px',
				'color'=>'',
				'background_color'=>'',
				'padding'=>'',
				'border_radius'=>'4px'

			), $atts ) ;

		$class = ( $settings['label_position'] == 'left' )?'mc_inline_label':'';
		$label_styles = empty( $settings['label_color'] )?'':'color:'.$settings['label_color'].';';
		$input_styles = $this->get_input_styles( $atts );
		switch ( $settings['type'] ) {
		case 'text':
			$form_output ='<div class="'.$class.'"><label style="'.$label_styles.'">'.$settings['label'].'</label><input style="'.$input_styles.'" type="'.$settings['type'].'" name="vccus_'.$settings['name'].'" placeholder="'.$settings['placeholder'].'" ></div>';
			break;

		case 'dropdown':

			$form_output ='<div class="'.$class.'">
			<label class="'.$class.'" style="'.$label_styles.'">'.$settings['label'].'</label>
			<select name="vccus_'.$settings['name'].'" >';
			$sel_options = explode( ',', $settings['options'] );

			foreach ( $sel_options as $option ) {
				if ( !empty( $option ) ) {
					$option_data = explode( '|', $option );
					$form_output .='<option value="'.$option_data[1].'" '.selected( $option_data[2], 'true', false ).' >'.$option_data[0].'</option>';
				}
			}

			$form_output .='</select></div>';
			break;

		case 'checkbox':
			$form_output ='<div class="mc_inline_label"><input type="'.$settings['type'].'" name="vccus_'.$settings['name'].'" value="'.$settings['label'].'" placeholder="'.$settings['placeholder'].'" >&nbsp;<label style="'.$label_styles.'">'.$settings['label'].'</label></div>';
			break;

		}


		return $form_output;
	}

	function shortcode_vc_mailchimp_submit_button( $atts ) {

		$output = $txt_style = $border_radius= $color = $text_color = $size = $icon = $target = $href = $el_class = $title = $position = '';
		$attributes = shortcode_atts( array(
				'text' => 'Subscribe',
				'url' => '',
				'target' => '',
				'type' => 'default',
				'outlined' => false,
				'size' => 'medium',
				'icon' => '',
				'text_color' =>'',
				'border_radius'=>'4px',
				'align' => 'left',
				'el_class' => '',
			), $atts );
		$icon_part = '';
		if ( $attributes['icon'] != '' ) {
			$icon_part = '<i class="fa fa-'.$attributes['icon'].'"></i>';
		}

		if ( $attributes['el_class'] != '' ) {
			$attributes['el_class'] = ' '.$attributes['el_class'];
		}
		if ( $attributes['text_color'] != '' ) {
			$txt_style .= 'color:'.$attributes['text_color'].';';
		}
		if ( $attributes['border_radius'] != '' ) {
			$txt_style .= 'border-radius:'.$attributes['border_radius'].';';
			$txt_style .= '-web-border-radius:'.$attributes['border_radius'].';';
			$txt_style .= '-moz-border-radius:'.$attributes['border_radius'].';';
		}else {
			$txt_style .= 'border-radius:0px;';
			$txt_style .= '-web-border-radius:0px;';
			$txt_style .= '-moz-border-radius:0px;';
		}

		$output = '<span  class="vcmailchimp-sub-button-cont align_'.$attributes['align'].$attributes['el_class'].'"><a style="'.$txt_style.'" href="javascript:void(0)"';
		$output .= ( $attributes['target'] == 1 or $attributes['target'] == '_blank' )?' target="_blank"':'';
		$output .= ' class="vc-mailchimp-sub-btn vc_mailchimp_button';
		$output .= ( $attributes['type'] != '' )?' color_'.$attributes['type']:'';
		$output .= ( $attributes['size'] != '' )?' size_'.$attributes['size']:'';
		$output .= ( $attributes['outlined'] == 1 or $attributes['outlined'] == 'yes' )?' outlined':'';
		$output .= ( $el_class != '' )?' '.$el_class:'';
		$output .= '">'.$icon_part.'<span >'.$attributes['text'].'</span></a></span>';
		$output .= '<img class="vc-mailchimp-spinner" src="'.VC_MAILCHIMP_URL.'/css/spinner.gif">';

		return $output ;
	}

	function get_input_styles( $attr ) {

		if ( empty( $attr ) ) {
			return;
		}
		$input_styles = '';
		$input_styles.= empty( $attr['color'] )?'':'color:'. $attr['color'].';';
		$input_styles.= empty( $attr['background_color'] )?'':'background-color:'. $attr['background_color'].';';
		$input_styles.= empty( $attr['padding'] )?'':'padding:'. $attr['padding'].';';
		$input_styles.= empty( $attr['width'] )?'':'width:'. $attr['width'].';';
		$input_styles.= empty( $attr['height'] )?'':'height:'. $attr['height'].';';
		$input_styles.= empty( $attr['margin'] )?'':'margin:'. $attr['margin'].';';
		$input_styles.= empty( $attr['align'] )?'':'text-align:'. $attr['align'].';';
		if ( !empty( $attr['border_radius'] ) ) {
			$input_styles .= 'border-radius:'.$attr['border_radius'].';';
			$input_styles .= '-web-border-radius:'.$attr['border_radius'].';';
			$input_styles .= '-moz-border-radius:'.$attr['border_radius'].';';
		}else {
			$input_styles .= 'border-radius:0px;';
			$input_styles .= '-web-border-radius:0px;';
			$input_styles .= '-moz-border-radius:0px;';
		}

		if ( !empty( $attr['border'] ) ) {
			$border_array = explode( '|', $attr['border'] );
			if ( $border_array[0] == '0px' ) {
				$input_styles.= 'border:0px solid #fff;';
			}
			elseif ( !empty( $border_array[2] ) ) {
				$input_styles.= 'border:'. $border_array[0].' '. $border_array[1].' '.$border_array[2].';';
			}
		}

		return $input_styles;

	}

	/**
	 * Add user to mailchimp list on form submit
	 *
	 * @author Aman Saini
	 * @since  1.0
	 * @return [type]
	 */
	function ajax_vc_mailchimp_form_submit() {

		$settings = get_option( 'vc_mailchimp_settings' );
		$apikey = !empty( $settings['api_key'] )?$settings['api_key']:'';
		$debug  = !empty( $settings['debug'] )?true:false;

		if ( ! class_exists( 'Mailchimp' ) ) {
			require_once VC_MAILCHIMP_DIR.'/Mailchimp.php';
		}

		if ( empty( $apikey ) ) {
			echo  'The API key you have entered appears to be invalid';
			die;
		}

		$verify_ssl = false;

		$opts = array(
			//'debug' => defined( 'WP_DEBUG' ) && WP_DEBUG,
			'debug' =>true,
			'ssl_verifypeer' => $verify_ssl,
		);

		$api = new Mailchimp( trim( $apikey ), $opts );

		$params = array();
		parse_str( $_POST['formdata'], $params );

		$fname = !empty( $params['mc_name'] )?$params['mc_name']:'';
		$lname = !empty( $params['mc_last_name'] )?$params['mc_last_name']:'';

		$merge_vars =array('FNAME' => $fname, 'LNAME' =>$lname);

		if ( $params['double_optin'] == '1' ) {
			$double_optin=true;
		}else {
			$double_optin=false;
		}
		// look for custom fields
		foreach ( $params as $key => $field_value ) {
			$start = substr( $key, 0, 5 );
			if ( $start == 'vccus' ) {
				$field_name = substr( $key, 6 );
				$merge_vars[$field_name] = $field_value;
			}
		}

		// if email is not empty
		if ( !empty( $params['mc_email'] ) ) {

			try {
				$result = $api->call( 'lists/subscribe', array(
						'id'                =>  $params['list'],
						'email'             => array( 'email' => $params['mc_email'] ),
						'merge_vars'        => $merge_vars,
						'double_optin'      => $double_optin,
						'update_existing'   => true,
						'replace_interests' => false,
						'send_welcome'      => false,
					) );

			} catch( Mailchimp_Error $e ) {
				$response = $this->get_response( $debug, $e, true );

			} catch( Exception $e ) {
				$response = $this->get_response( $debug, $e, true );
			}

			if(!empty($response)){
				echo $response;
			}else{

				echo $this->get_response( $debug, $result, false );
			}

		}
		die;

	}

	public function get_response( $debug, $result, $error ) {
		if ( $debug ) {
			if ( $error ) {
				// exception
				$response =  json_encode( array( 'response'=>$result->getMessage(), 'debug'=>'true', ) );
			}else {
				$response =  json_encode( array( 'response'=>$result, 'debug'=>'true', ) );
			}
		}else {
			if ( !$error ) {
				$response =  json_encode( array( 'response'=>'success', 'debug'=>'false' ) );
			}else {
				$response =  json_encode( array( 'response'=>'failed', 'debug'=>'false' ) );
			}
		}
		return $response;

	}

}// Class Ends
