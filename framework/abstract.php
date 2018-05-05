<?php
	class Tvlgiao_Wpdance_GeneralTheme{
		//Variable
		protected $tvlgiao_wpdance_theme_name		= 'WP Dance';
		protected $tvlgiao_wpdance_theme_slug		= 'wpdance';

		protected $tvlgiao_wpdance_arr_functions 	= array();
		protected $tvlgiao_wpdance_arr_widgets 		= array();
		protected $tvlgiao_wpdance_arr_libs 		= array();
		protected $tvlgiao_wpdance_arr_customize 	= array();
		protected $tvlgiao_wpdance_arrshortcodes 	= array();
		protected $tvlgiao_wpdance_arrvisualcomposer = array();
		//Constructor
		public function __construct(){
			$this->tvlgiao_wpdance_constant();
			$this->tvlgiao_wpdance_init_arr_functions();
			$this->tvlgiao_wpdance_init_arr_widgets();
			$this->tvlgiao_wpdance_init_arr_libs();
			$this->tvlgiao_wpdance_init_arr_customize();
			$this->tvlgiao_wpdance_init_arr_shortcodes();
			$this->tvlgiao_wpdance_init_arr_registervc();
		}
		// Function Setup Theme
		public function tvlgiao_wpdance_init(){
			//After setup theme
			add_action( 'after_setup_theme', array($this,'tvlgiao_wpdance_setup_theme'));
			//Include Lib
			$this->tvlgiao_wpdance_init_libs();
			//Include Function
			$this->tvlgiao_wpdance_init_functions();
			//Include Widget
			$this->tvlgiao_wpdance_init_widgets();
			//Include Customize
			$this->tvlgiao_wpdance_init_customize();
			//Shortcode
			$this->tvlgiao_wpdance_init_shortcodes();
			//Customize Color Styling
			$name = TVLGIAO_WPDANCE_THEME_SLUG.'custom_style';
			if( !get_option( $name ) ) {
				tvlgiao_wpdance_save_custom_style();
			}

			//Load VC
			if($this->tvlgiao_wpdance_checkPluginVC()){
				if ( ! defined( 'ABSPATH' ) ) { exit; }
				add_action("vc_before_init",array($this,'tvlgiao_wpdance_load_visual'));
			}		
			//Call admin
			require_once get_template_directory().'/framework/includes/wd_metaboxes.php';
			$classNameAdmin = 'Tvlgiao_Wpdance_Admin_GeneralTheme';
			$panel 			= new $classNameAdmin();
		}
		// Constant
		protected function tvlgiao_wpdance_constant(){			
			// Default
			define('TVLGIAO_WPDANCE_DS',DIRECTORY_SEPARATOR);	
			define('TVLGIAO_WPDANCE_THEME_NAME'				, $this->tvlgiao_wpdance_theme_name );
			define('TVLGIAO_WPDANCE_THEME_SLUG'				, $this->tvlgiao_wpdance_theme_slug.'_');
			define('TVLGIAO_WPDANCE_THEME_DIR'				, get_template_directory());
			define('TVLGIAO_WPDANCE_THEME_URI'				, get_template_directory_uri());
			define('TVLGIAO_WPDANCE_THEME_ASSET_URI'		, TVLGIAO_WPDANCE_THEME_URI . '/assets');
			// Style-Script-Image
			define('TVLGIAO_WPDANCE_THEME_IMAGES'			, TVLGIAO_WPDANCE_THEME_ASSET_URI . '/images');
			define('TVLGIAO_WPDANCE_THEME_CSS'				, TVLGIAO_WPDANCE_THEME_ASSET_URI . '/css');
			define('TVLGIAO_WPDANCE_THEME_JS'				, TVLGIAO_WPDANCE_THEME_ASSET_URI . '/js');
			define('TVLGIAO_WPDANCE_THEME_FONT'				, TVLGIAO_WPDANCE_THEME_ASSET_URI . '/fonts');
			//Framework Theme
			define('TVLGIAO_WPDANCE_THEME_FRAMEWORK'		, TVLGIAO_WPDANCE_THEME_DIR . '/framework');
			define('TVLGIAO_WPDANCE_THEME_FRAMEWORK_URI'	, TVLGIAO_WPDANCE_THEME_URI . '/framework');
			//Folder in Framework
			define('TVLGIAO_WPDANCE_THEME_FUNCTIONS'		, TVLGIAO_WPDANCE_THEME_FRAMEWORK 		. '/functions');	
			define('TVLGIAO_WPDANCE_THEME_LIB'				, TVLGIAO_WPDANCE_THEME_FRAMEWORK 		. '/lib');
			define('TVLGIAO_WPDANCE_THEME_INCLUDES_PLUGIN'	, TVLGIAO_WPDANCE_THEME_FRAMEWORK 		. '/plugins');
			define('TVLGIAO_WPDANCE_THEME_WIDGETS'			, TVLGIAO_WPDANCE_THEME_FRAMEWORK 		. '/widgets');
			define('TVLGIAO_WPDANCE_THEME_SHORTCODES'		, TVLGIAO_WPDANCE_THEME_FRAMEWORK 		. '/shortcodes');
			define('TVLGIAO_WPDANCE_THEME_REGISTERVC'		, TVLGIAO_WPDANCE_THEME_FRAMEWORK 		. '/visualcomposer');
			define('TVLGIAO_WPDANCE_THEME_INCLUDES'			, TVLGIAO_WPDANCE_THEME_FRAMEWORK 		. '/includes');
			define('TVLGIAO_WPDANCE_THEME_INCLUDES_URI'		, TVLGIAO_WPDANCE_THEME_FRAMEWORK_URI 	. '/includes');
			//Folder WPDANCE
			define('TVLGIAO_WPDANCE_THEME_WPDANCE'			, TVLGIAO_WPDANCE_THEME_FRAMEWORK 	. '/wpdance');
			define('TVLGIAO_WPDANCE_THEME_CUSTOMIZE'		, TVLGIAO_WPDANCE_THEME_WPDANCE 	. '/customize');
		}
		//Include Function
		protected function tvlgiao_wpdance_init_arr_functions(){
			$this->tvlgiao_wpdance_arr_functions = array('wd_register_sidebar','wd_register_tgmpa_plugin','wd_main','wd_pagination','wd_customize_set_custom_css','wd_customize_live_preview_color',
														 'wd_comment_form','wd_customize_styling_style','wd_woo_account','wd_woo_cart','wd_excerpt','wd_soundcloud','wd_counter_views','wd_template_tag',
														 'wd_breadcrumbs','wd_woo_hook','wd_woo_product','wd_custom_style_font','wd_font_customize','wd_customize_set_font','wd_add_param_vc');
		}
		//Include Widget
		protected function tvlgiao_wpdance_init_arr_widgets(){
			$this->tvlgiao_wpdance_arr_widgets = array('wd_social_profiles','wd_special_post','wd_emads','wd_special_products','wd_business_partner','wd_banner_slider');
		}
		//Include Lib
		protected function tvlgiao_wpdance_init_arr_libs(){
			$this->tvlgiao_wpdance_arr_libs = array('class-tgm-plugin-activation','add-control-custom-radio-image','wd-add-control-custom-font');
		}
		//Include Customize
		protected function tvlgiao_wpdance_init_arr_customize(){
			$this->tvlgiao_wpdance_arr_customize = array('wd_customize_sanitize_callback','wd_customize_header','wd_customize_footer','wd_customize_blog','wd_customize_styling_option','wd_customize_theme_option',
														 'wd_customize_product','wd_customize_font');
		}
		protected function tvlgiao_wpdance_init_arr_shortcodes(){
			$this->tvlgiao_wpdance_arrshortcodes = array('wd_post_special_slider','wd_feedburner_subscription','wd_promotion_information','wd_banner_image','wd_special_blog',
														 'wd_category_magazine','wd_blog_video','wd_current_date','wd_search_business','wd_banner_slider','wd_adv_sidebar_home',
														 'wd_add_slider_mobile');
		}

		protected function tvlgiao_wpdance_init_arr_registervc(){
			$this->tvlgiao_wpdance_arrvisualcomposer = array('wd_vc_special_post_slider','wd_vc_feedburner_subscription','wd_vc_promotion_information','wd_vc_banner_image','wd_vc_blog_special',
															 'wd_vc_category_magazine','wd_vc_blog_video','wd_vc_current_date','wd_vc_search_business','wd_vc_banner_slider','wd_vc_adv_sidebar_home',
															 'wd_vc_add_slider_mobile');
		}


		// Load File
		protected function tvlgiao_wpdance_init_functions(){
			foreach($this->tvlgiao_wpdance_arr_functions as $function){
				if(file_exists(TVLGIAO_WPDANCE_THEME_FUNCTIONS."/{$function}.php")){
					require_once TVLGIAO_WPDANCE_THEME_FUNCTIONS."/{$function}.php";
				}	
			}
		}
		protected function tvlgiao_wpdance_init_widgets(){
			foreach($this->tvlgiao_wpdance_arr_widgets as $widget){
				if(file_exists(TVLGIAO_WPDANCE_THEME_WIDGETS."/{$widget}.php")){
					require_once TVLGIAO_WPDANCE_THEME_WIDGETS."/{$widget}.php";
				}
			}
		}
		protected function tvlgiao_wpdance_init_libs(){
			foreach($this->tvlgiao_wpdance_arr_libs as $lib){
				if(file_exists(TVLGIAO_WPDANCE_THEME_LIB. "/{$lib}.php")){
					require_once TVLGIAO_WPDANCE_THEME_LIB. "/{$lib}.php";
				}
			}
		}
		protected function tvlgiao_wpdance_init_customize(){
			foreach($this->tvlgiao_wpdance_arr_customize as $custom){
				if(file_exists(TVLGIAO_WPDANCE_THEME_CUSTOMIZE. "/{$custom}.php")){
					require_once TVLGIAO_WPDANCE_THEME_CUSTOMIZE. "/{$custom}.php";
				}
			}
		}
		protected function  tvlgiao_wpdance_init_shortcodes(){
			foreach($this->tvlgiao_wpdance_arrshortcodes as $shortcode){
				if( file_exists(TVLGIAO_WPDANCE_THEME_SHORTCODES."/{$shortcode}.php") ){
					require_once TVLGIAO_WPDANCE_THEME_SHORTCODES."/{$shortcode}.php";
				}	
			}
		}
		protected function tvlgiao_wpdance_checkPluginVC(){
			$_active_vc = apply_filters('active_plugins',get_option('active_plugins'));
			if(in_array('js_composer/js_composer.php',$_active_vc)){
				return true;
			}else{
				return false;
			}
		}

		public function tvlgiao_wpdance_load_visual(){
			foreach ($this->tvlgiao_wpdance_arrvisualcomposer as $visual) {
				if( file_exists(TVLGIAO_WPDANCE_THEME_REGISTERVC."/{$visual}.php") ){
					require_once TVLGIAO_WPDANCE_THEME_REGISTERVC."/{$visual}.php";
				}
			}
	    }
		//Setup Theme
		public function tvlgiao_wpdance_setup_theme(){
		    global $content_width;
		    if ( !isset($content_width) ) {
		        $content_width = 1170;
		    }
			//Make theme available for translation
			//Translations can be filed in the /languages/ directory
   			load_theme_textdomain('wpdance', get_template_directory() . '/languages');
   			//Import Register Menu
   			$this->tvlgiao_wpdance_register_location_menu();
   			//Import Theme Support
   			$this->tvlgiao_wpdance_theme_support();
   			//Import Google Font
   			add_action('wp_enqueue_scripts',array($this,'tvlgiao_wpdance_slug_fonts_url'));
   			//Import Script / Style
   			add_action('wp_enqueue_scripts',array($this,'tvlgiao_wpdance_add_scripts'));
   			add_action('admin_enqueue_scripts',array($this,'tvlgiao_wpdance_admin_add_scripts'));
		}
		//Register Menu
		public function tvlgiao_wpdance_register_location_menu(){
			register_nav_menus(array(
		        'primary' 			=> esc_html__('Primary', 'wpdance'),
		        'primary_mobile' 	=> esc_html__('Primary Menu Mobile', 'wpdance'),
		        'footer_menu' 		=> esc_html__('Menu Footer', 'wpdance'),
		    ));
		}
		//Theme Support
		public function tvlgiao_wpdance_theme_support(){
			add_image_size('image_size_thumbnail',150,90,true);
			add_image_size('image_size_medium',250,130,true);
			add_image_size('image_size_large',750,435,true);
			add_image_size('image_size_slider',650,370,true);
			// Enable support for Post Formats.
    		add_theme_support('post-formats', array('aside', 'image', 'video', 'quote', 'link'));
			add_theme_support( "title-tag" );
			add_theme_support( 'automatic-feed-links' );
			add_theme_support('woocommerce');
			//remove_filter( 'the_content', 'wpautop' );
			
		}
		//Google Font Theme
		function tvlgiao_wpdance_slug_fonts_url() {
		    $tvlgiao_wpdance_query_args = array(
		        'family' => urlencode('Roboto Condensed:400,400italic,700,700italic|Open Sans:400,600,700,300|Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Dancing Script:400,700')
		    );
		    wp_register_style( 'google-fonts', add_query_arg( $tvlgiao_wpdance_query_args, "//fonts.googleapis.com/css" ), array(), null );
		    wp_enqueue_style( 'google-fonts' );
		}
		//Add Script
		public function tvlgiao_wpdance_add_scripts(){
			/*----------------- Style ---------------------*/
			// LIB
			wp_register_style('bootstrap-css', 				TVLGIAO_WPDANCE_THEME_CSS.'/bootstrap.css');
			wp_enqueue_style('bootstrap-css');
			wp_register_style('font-awesome', 				TVLGIAO_WPDANCE_THEME_CSS.'/font-awesome.min.css');
			wp_enqueue_style('font-awesome');
			wp_register_style('flex-slider-css', 			TVLGIAO_WPDANCE_THEME_CSS.'/flexslider.css');
			wp_enqueue_style('flex-slider-css');
			wp_register_style('owl-carousel-min-css', 		TVLGIAO_WPDANCE_THEME_CSS.'/owl.carousel.min.css');
			wp_enqueue_style('owl-carousel-min-css');
			wp_register_style('cloud-zoom-css', 			TVLGIAO_WPDANCE_THEME_CSS.'/cloud-zoom.css');
			wp_enqueue_style('cloud-zoom-css');
			wp_register_style('nivo-slider-css', 			TVLGIAO_WPDANCE_THEME_CSS.'/nivo-slider.css');
			wp_enqueue_style('nivo-slider-css');
			
			
			// CSS OF THEME
			wp_register_style('tvlgiao-wpdance-style-css', 	TVLGIAO_WPDANCE_THEME_URI.'/style.css');
			wp_enqueue_style('tvlgiao-wpdance-style-css');
			wp_register_style('tvlgiao-wpdance-style-rtl-css', 	TVLGIAO_WPDANCE_THEME_URI.'/style_rtl.css');
			wp_enqueue_style('tvlgiao-wpdance-style-rtl-css');
			/*----------------- Script ---------------------*/
    		// LIB
    		wp_register_script( 'flex-slider-min-js', 		TVLGIAO_WPDANCE_THEME_JS.'/jquery.flexslider-min.js' , array('jquery'));
    		wp_enqueue_script('flex-slider-min-js');
    		wp_register_script( 'imagesloaded-min-js', 		TVLGIAO_WPDANCE_THEME_JS.'/jquery.imagesloaded.min.js');
    		wp_enqueue_script('imagesloaded-min-js');
    		wp_register_script( 'isotope-pkgd-min-js', 		TVLGIAO_WPDANCE_THEME_JS.'/isotope.pkgd.min.js');
    		wp_enqueue_script('isotope-pkgd-min-js');
    		wp_register_script( 'hover-intent-js', 			TVLGIAO_WPDANCE_THEME_JS.'/jquery.hoverIntent.js');
    		wp_enqueue_script('hover-intent-js');
    		wp_register_script( 'owl-carousel-min-js', 		TVLGIAO_WPDANCE_THEME_JS.'/owl.carousel.min.js');
    		wp_enqueue_script('owl-carousel-min-js');
       		wp_register_script( 'cloud-zoom-js', 			TVLGIAO_WPDANCE_THEME_JS.'/cloud-zoom.1.0.2.js');
    		wp_enqueue_script('cloud-zoom-js');
       		wp_register_script( 'jquery-nivo-slider-js', 	TVLGIAO_WPDANCE_THEME_JS.'/jquery.nivo.slider.js');
    		wp_enqueue_script('jquery-nivo-slider-js');    		
    		
    		// JS OF THEME
    		wp_register_script( 'tvlgiao-wpdance-main-js', 	TVLGIAO_WPDANCE_THEME_JS.'/wd_main.js');
    		wp_enqueue_script('tvlgiao-wpdance-main-js');
    		wp_register_script( 'tvlgiao-wpdance-js', 		TVLGIAO_WPDANCE_THEME_JS.'/wd_wpdance.js');
    		wp_enqueue_script('tvlgiao-wpdance-js');
      		wp_register_script( 'tvlgiao-woo-product-js', 	TVLGIAO_WPDANCE_THEME_JS.'/wd_woo_product.js');
    		wp_enqueue_script('tvlgiao-woo-product-js');


		    if (is_singular() && comments_open()) { wp_enqueue_script('comment-reply'); }
			
		}
		//Admin Script
		public function tvlgiao_wpdance_admin_add_scripts(){
			wp_register_style('wd-admin-style', 			TVLGIAO_WPDANCE_THEME_CSS.'/wd_admin_style.css');
			wp_enqueue_style('wd-admin-style');
		}
	}
?>