<?php 
	class Tvlgiao_Wpdance_Admin_GeneralTheme extends Tvlgiao_Wpdance_GeneralTheme{
		
		protected $tabs 		= array();	
		protected $arrLayout 	= array();
			
		public function __construct(){
			$this->tvlgiao_wpdance_constants();
			add_action('admin_init',array($this,'tvlgiao_wpdance_load_javascript_style'));
			add_action('admin_enqueue_scripts',array($this,'tvlgiao_wpdance_load_javascript_style'));

		 	/* Load custom field */
			require_once get_template_directory().'/framework/includes/wd_custom_fields.php';
			$classCustomFields 	= 'Tvlgiao_Wpdance_Admin_General_CustomFields';
			$customFields 		= new $classCustomFields();
		}
		public function tvlgiao_wpdance_constants(){
			define('TVLGIAO_WPDANCE_THEME_INCLUDES_JS'		, TVLGIAO_WPDANCE_THEME_INCLUDES_URI . '/js');
			define('TVLGIAO_WPDANCE_THEME_INCLUDES_CSS'		, TVLGIAO_WPDANCE_THEME_INCLUDES_URI . '/css');
			define('TVLGIAO_WPDANCE_THEME_INCLUDES_IMAGES'	, TVLGIAO_WPDANCE_THEME_INCLUDES_URI . '/images');
		}

		public function tvlgiao_wpdance_load_javascript_style(){
			/*----------------- Style ---------------------*/
			wp_register_style( 	'fancybox-css', 			TVLGIAO_WPDANCE_THEME_INCLUDES_CSS .'/jquery.fancybox.css');
			wp_enqueue_style('fancybox-css');
			
			wp_register_style( 'tvlgiao-wpdance-admin', 	TVLGIAO_WPDANCE_THEME_INCLUDES_CSS .'/wd-admin.css');
			wp_enqueue_style('tvlgiao-wpdance-admin');

			/*----------------- Script ---------------------*/
			wp_enqueue_script('jquery');
			wp_enqueue_script("jquery-ui-core");
			wp_enqueue_script("jquery-ui-widget");
			wp_enqueue_script("jquery-ui-tabs");
			wp_enqueue_script("jquery-ui-mouse");
			wp_enqueue_script("jquery-ui-sortable");
			wp_enqueue_script("jquery-ui-slider");
			wp_enqueue_script("jquery-ui-accordion");
			wp_enqueue_script("jquery-effects-core");
			wp_enqueue_script("jquery-effects-slide");
			wp_enqueue_script("jquery-effects-blind");	

			// Custom Post
			wp_register_script( 'tvlgiao-wpdance-post-config-js', 	TVLGIAO_WPDANCE_THEME_INCLUDES_JS .'/wd_custom_post_layout.js');
			wp_enqueue_script(	'tvlgiao-wpdance-post-config-js');

			// Fancy Box, Color Piker
			wp_register_script( 'fancybox_js', 						TVLGIAO_WPDANCE_THEME_INCLUDES_JS .'/jquery.fancybox.pack.js');
			wp_enqueue_script(	'fancybox_js');

			wp_enqueue_script('plupload-all');
			wp_enqueue_script('utils');
			wp_enqueue_script('plupload');
			wp_enqueue_script('plupload-html5');
			wp_enqueue_script('plupload-flash');
			wp_enqueue_script('plupload-silverlight');
			wp_enqueue_script('plupload-html4');
			wp_enqueue_script('media-views');
			wp_enqueue_script('wp-plupload');
			wp_enqueue_script('thickbox');
			wp_enqueue_style('thickbox');
			wp_enqueue_script('media-upload');
		}
	}
?>