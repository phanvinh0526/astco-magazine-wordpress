<?php
/*
  Plugin Name: WD Partner Business
  Plugin URI: http://astco.com/
  Description: Team From WPDance Team
  Version: 1.0.0
  Author: WD Team
  Author URI: http://astco.com/
*/
class WD_PARTNER_BUSINESS {
	public function __construct(){

		$this->constant();
		$this->wd_partner_business_register();

		add_theme_support('post-thumbnails');
		add_post_type_support( 'partner_business', 'thumbnail' );
		add_post_type_support( 'partner_business', 'comments' );
		add_post_type_support( 'partner_business', 'excerpt' );
		add_action('admin_menu', array( $this,'wd_partner_business_create_section' ) );
		add_action('save_post', array($this,'wd_partner_business_save_customfield') , 1, 2);
		add_filter('single_template',array($this,'wd_partner_business_single_partner_business'));
		add_action('wp_enqueue_scripts',array($this,'wd_partner_business_add_scripts'),0);
		$this->wd_include_file_shortcode();
		register_activation_hook(__FILE__, array($this,'wd_partner_business_activate') );
		register_deactivation_hook(__FILE__, array($this,'wd_partner_business_deactivate') );
	}

	public function wd_include_file_shortcode(){
		require_once plugin_dir_path( __FILE__ ).'/wd_functions.php';
		//Visual
		require_once WDT_VISUAL.'/wd_vc_advanced_search.php';
		require_once WDT_VISUAL.'/wd_vc_quick_search.php';
		//Shortcode
		require_once WDT_SHORTCODE.'/wd_advanced_search.php';
		require_once WDT_SHORTCODE.'/wd_quick_search.php';
	}
	public function wd_partner_business_activate() {
		$this->wd_partner_business_register();
		flush_rewrite_rules();
	}
	public function wd_partner_business_deactivate() {
		flush_rewrite_rules();
	}	
	public function wd_partner_business_register() {
		 require_once WDT_TYPES."/wd_partner_business_type.php";
	}
	public function wd_partner_business_create_section() {
		if(post_type_exists('partner_business')) {
			add_meta_box("wp_cp_custom_carousels", esc_html__("Config Partner Business", 'wpdance'), array($this,"wd_partner_business_show"), "partner_business", "normal", "high");
		}
	}
	public function wd_partner_business_show(){
		require_once WDT_INCLUDES.'/wd_business_meta.php';
	}
	public function wd_partner_business_save_customfield($post_id){
		if(defined( 'DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;
		if( isset($_POST['custom_business_partner']) && $_POST['custom_business_partner'] == "custom_partner_business" ){
			$_default_post_config = array(
				'wd_author_post'			=> isset($_POST['wd_author_post'])?$_POST['wd_author_post']: '',
				'business_address' 			=> isset($_POST['business_address'])?$_POST['business_address']: '',
				'business_phone'			=> isset($_POST['business_phone'])?$_POST['business_phone']: '',
				'business_time'				=> isset($_POST['business_time'])?$_POST['business_time']: '',
				'business_map'				=> isset($_POST['business_map'])?$_POST['business_map']: '',
				'company_facebook'			=> isset($_POST['company_facebook'])?$_POST['company_facebook']: '',
				'company_google'			=> isset($_POST['company_google'])?$_POST['company_google']: '',
				'company_twitter'			=> isset($_POST['company_twitter'])?$_POST['company_twitter']: '',
			);
			$ret_str = serialize($_default_post_config);
			update_post_meta($post_id,'_tvlgiao_wpdance_custom_partner_business',$ret_str);
			update_post_meta($post_id,'_tvlgiao_wpdance_custom_partner_map_google',$_POST['company_map_google']);	
		}
	}
	public function wd_partner_business_single_partner_business($single){
		global $post,$wp_query;
	
		if($post->post_type == 'partner_business'){
			if(file_exists(plugin_dir_path( __FILE__ ).'/single-partner-business.php')){
				return plugin_dir_path( __FILE__ ).'/single-partner-business.php';
			}
		}
		return $single;
	}	
	//Add Script
	public function wd_partner_business_add_scripts(){
		wp_register_style('easy-autocomplete-min-css', 			WDT_CSS.'/easy-autocomplete.min.css');
		wp_enqueue_style('easy-autocomplete-min-css');

		wp_register_style('style-business-css', 				WDT_CSS.'/style_business.css', 1000);
		wp_enqueue_style('style-business-css');

	   	wp_register_script( 'jquery-min-1-12-2-js', 				WDT_JS.'/jquery-1.11.2.min.js' );
		wp_enqueue_script('jquery-min-1-12-2-js');
	   	wp_register_script( 'bootstrap-min-js', 				WDT_JS.'/bootstrap.min.js' , array('jquery'));
		wp_enqueue_script('bootstrap-min-js');
		wp_register_script( 'jquery-easy-autocomplete-min-js', 	WDT_JS.'/jquery.easy-autocomplete.min.js', array('jquery'));
		wp_enqueue_script('jquery-easy-autocomplete-min-js');
   
	}
	protected function constant(){
		//define('DS',DIRECTORY_SEPARATOR);	
		define('WDT_BASE'		,  	plugins_url( '', __FILE__ )		);
		define('WDT_JS'			, 	WDT_BASE . '/assets/js'		);
		define('WDT_CSS'		, 	WDT_BASE . '/assets/css'		);
		define('WDT_IMAGE'		, 	WDT_BASE . '/assets/images'	);
		define('WDT_TEMPLATE' 	, 	dirname(__FILE__) . '/templates'	);
		define('WDT_TYPES'		, 	plugin_dir_path( __FILE__ ) . 'post_type'		);
		define('WDT_INCLUDES'	, 	plugin_dir_path( __FILE__ ) . 'includes'		);
		define('WDT_VISUAL'		, 	plugin_dir_path( __FILE__ ) . 'visualcomposers'		);
		define('WDT_SHORTCODE'	, 	plugin_dir_path( __FILE__ ) . 'shortcodes'		);
	}
}
$_wd_partner_business = new WD_PARTNER_BUSINESS; // Start an instance of the plugin class 


?>