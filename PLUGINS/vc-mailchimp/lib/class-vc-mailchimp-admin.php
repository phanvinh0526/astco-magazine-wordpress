<?php
// Admin Settings
class VC_Mailchimp_Admin {

	//Plugin starting point.
	public static function setup() {

		$class = __CLASS__;
		new $class;
	}

	/**
	 * Add necessary hooks and filters functions
	 *
	 * @author Aman Saini
	 * @since  1.0
	 */
	function __construct() {

		// Add VC Mailchimp Settings submenu
		add_action( 'admin_menu', array( $this, 'register_vc_mailchimp_submenu_page' ) );

		add_action( 'admin_init', array( $this, 'initialize_vc_mailchimp_options' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'add_scripts' ) );

		// We safely integrate with VC with this hook
		add_action( 'vc_before_init', array( $this, 'integrateWithVC' ) );

	}

	function add_scripts() {
		wp_enqueue_style( 'mailchimp-admin', VC_MAILCHIMP_URL.'/css/mailchimp-admin.css' );
	}

	/**
	 * [register_mailchimp_submenu_page description]
	 *
	 * @author Aman Saini
	 * @since  1.0
	 * @return [type] [description]
	 */
	function register_vc_mailchimp_submenu_page() {
		add_submenu_page( 'options-general.php', 'VC Mailchimp Settings', 'VC Mailchimp', 'manage_options', 'vc_mailchimp_settings', array( $this, 'vc_mailchimp_settings_callback' ) );
	}

	function vc_mailchimp_settings_callback() {
?>
		<!-- Create a header in the default WordPress 'wrap' container -->
    <div class="wrap">

        <!-- Make a call to the WordPress function for rendering errors when settings are saved. -->
        <?php //settings_errors(); ?>

        <!-- Create the form that will be used to render our options -->
        <form method="post" action="options.php">
            <?php
		settings_fields( 'vc_mailchimp_settings' );

		do_settings_sections( 'vc_mailchimp_settings' );

		submit_button();
?>
        </form>

    </div><!-- /.wrap -->
<?php
	}

	/**
	 * Register settings and fields
	 *
	 * @author Aman Saini
	 * @since  1.0
	 * @return
	 */
	function initialize_vc_mailchimp_options() {

		// If settings don't exist, create them.
		if ( false == get_option( 'vc_mailchimp_settings' ) ) {
			add_option( 'vc_mailchimp_settings' );
		} // end if

		add_settings_section(
			'mailchimp_settings_section',         // ID used to identify this section and with which to register options
			'VC Mailchimp Settings',                  // Title to be displayed on the administration page
			array( $this, 'mailchimp_settings_callback' ), // Callback used to render the description of the section
			'vc_mailchimp_settings'                           // Page on which to add this section of options
		);

		// App ID
		add_settings_field(
			'mailchimp_api_key',                      // ID used to identify the field throughout the theme
			'Mailchimp API Key',                           // The label to the left of the option interface element
			array( $this, 'mailchimp_api_key_callback' ),   // The name of the function responsible for rendering the option interface
			'vc_mailchimp_settings',                          // The page on which this option will be displayed
			'mailchimp_settings_section'

		);
		add_settings_field(
		 'debug',
		 'Enable Debugging',
		 array( $this, 'vc_mailchimp_debug_callback' ),
		 'vc_mailchimp_settings',
		 'mailchimp_settings_section'

		);

		// add_settings_field(
		//  'vc_mailchimp_error_msg',
		//  'Error Text',
		//  array( $this, 'vc_mailchimp_error_msg_callback' ),
		//  'vc_mailchimp_settings',
		//  'mailchimp_settings_section'

		// );


		//register settings
		register_setting( 'vc_mailchimp_settings', 'vc_mailchimp_settings' );

	}

	function mailchimp_settings_callback() {

		echo '';
	}

	function mailchimp_api_key_callback() {

		$options = get_option( 'vc_mailchimp_settings' );

		$api_key = !empty( $options['api_key'] )?$options['api_key']:'';

		// Render the output
		echo '<input type="text" class="regular-text" id="api_key" name="vc_mailchimp_settings[api_key]" value="' . $api_key. '" />';
		echo '<p class="description">Enter your API Key. <a target="_blank" href="http://admin.mailchimp.com/account/api-key-popup">Get your API key</a></p>';
	}

	function vc_mailchimp_debug_callback() {

		$options = get_option( 'vc_mailchimp_settings' );

		$debug = !empty( $options['debug'] )?$options['debug']:'';
		$checked = checked($debug,'yes',false);

		// Render the output
		echo '<input type="checkbox" class="" '.$checked.' id="vc_mailchimp_debug" name="vc_mailchimp_settings[debug]" value="yes" />';
		echo '<p class="description">Enable debugging to see raw response from mailchimp after subscription</p>';
	}

	function vc_mailchimp_error_msg_callback() {

		$options = get_option( 'vc_mailchimp_settings' );

		$vc_mailchimp_error_msg = !empty( $options['vc_mailchimp_error_msg'] )?$options['vc_mailchimp_error_msg']:'Please check your email and try again.';

		// Render the output
		echo '<input type="text" class="regular-text" id="vc_mailchimp_error_msg" name="vc_mailchimp_settings[vc_mailchimp_error_msg]" value="' . $vc_mailchimp_error_msg. '" />';
		echo '<p class="description">Enter the text for error during signup</p>';
	}


	public function integrateWithVC() {

		// Check if Visual Composer is installed
		if ( !defined( 'WPB_VC_VERSION' ) || !function_exists( 'wpb_map' ) ) {

			// Display notice that Visual Compser is required
			add_action( 'admin_notices', array( $this, 'showVcVersionNotice' ) );
			return;
		}

		require VC_MAILCHIMP_DIR.'/lib/class-vc-map.php';

		$vc_map = new VC_Mailchimp_Map();

		$vc_map->map_fields();

	}

	/*
    Show notice if your plugin is activated but Visual Composer is not
    */
	public function showVcVersionNotice() {
		$plugin_data = get_plugin_data( __FILE__ );
		echo '
		<div class="updated">
		  <p>' . sprintf( __( '<strong>%s</strong> requires <strong><a href="http://bit.ly/vcomposer" target="_blank">Visual Composer</a></strong> plugin to be installed and activated on your site.', 'vc_extend' ), 'Visual Composer Icon Tabs' ) . '</p>
		</div>';
	}
}
