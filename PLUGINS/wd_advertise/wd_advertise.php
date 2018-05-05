<?php
/*
  Plugin Name: WD Advertise
  Plugin URI: http://www.wpdance.com
  Description: Advertise From WPDance Team
  Version: 1.1.0
  Author: WD Team
  Author URI: http://www.wpdance.com
 */
class WD_Advertise {
	/******************************/
	// Register Advertise post type //
	/******************************/
	public function __construct(){
		$this->constant();

		add_action('init', array($this,'wd_advertise_register'),1);
		add_action('restrict_manage_posts', array($this,'wd_advertise_filter_post_type_by_taxonomy'));
		add_filter('parse_query',array($this,'wd_advertise_convert_id_to_term_in_query'));

		add_theme_support('post-thumbnails', array('advertise'));

		register_activation_hook(__FILE__, array($this,'wd_advertise_activate') );
		register_deactivation_hook(__FILE__, array($this,'wd_advertise_deactivate') );
		
		add_action('admin_enqueue_scripts',array($this,'init_admin_script'));
		add_action('admin_menu', array( $this,'wd_advertise_create_section' ) );
		add_action('save_post', array($this,'wd_advertise_save_data') , 1, 2);
		$this->init_trigger();
		$this->wd_advertise_function();
	}
	public function wd_advertise_register() {
		$this->wd_advertise_register_taxonomies();

		$labels = array(
			'name' 					=> esc_html__('Advertise Items', 'wpdance'),
			'singular_name' 		=> esc_html__('Advertise Item', 'wpdance'),
			'add_new' 				=> esc_html__('Add Advertise Item', 'wpdance'),
			'add_new_item' 			=> esc_html__('Add New Advertise Item', 'wpdance'),
			'edit_item' 			=> esc_html__('Edit Advertise Item', 'wpdance'),
			'new_item' 				=> esc_html__('New Advertise Item', 'wpdance'),
			'view_item' 			=> esc_html__('View Advertise Item', 'wpdance'),
			'search_items' 			=> esc_html__('Search Advertise Item', 'wpdance'),
			'not_found' 			=> esc_html__('No Advertise Items found', 'wpdance'),
			'not_found_in_trash' 	=> esc_html__('No Advertise Items found in Trash', 'wpdance'),
			'parent_item_colon' 	=> '',
			'menu_name' 			=> esc_html__('Advertise Items')
		);
		$args = array(
			'labels' 			=> $labels,
			'public' 			=> true,
			'show_ui' 			=> true,
			'capability_type' 	=> 'post',
			'hierarchical' 		=> true,
			'rewrite' 			=> array('slug' => 'advertise'),
			'supports' => array(
				'title',
				'thumbnail',
			),
			'menu_position' 	=> 25,
			'taxonomies' 		=> array('advertise_category'),
		);

		register_post_type('advertise', $args);
	}

	public function wd_advertise_register_taxonomies() {
		register_taxonomy( 'advertise_category', array( 'advertise' ), array(
			'hierarchical'      	=> true,
			'labels'           		 => array(
				'name' 				=> esc_html__('Categories Advertise', 'wpdance'),
				'singular_name' 	=> esc_html__('Categories Advertise', 'wpdance'),
 				'search_items'      => esc_html__( 'Search Advertise', 'textdomain' ),
        		'all_items'         => esc_html__( 'All Advertise', 'textdomain' ),            	
            	'new_item'          => esc_html__('Add New', 'wpdance' ),
            	'edit_item'         => esc_html__('Edit Post', 'wpdance' ),
            	'view_item'   		=> esc_html__('View Post', 'wpdance' ),
            	'add_new_item'      => esc_html__('Add New Category Advertise', 'wpdance' ),
				'new_item_name'     => esc_html__( 'New Advertise Name', 'textdomain' ),
            	'menu_name'         => esc_html__( 'Categories Advertise' , 'wpdance' ),       	
			),
			'show_ui'           	=> true,
			'show_admin_column' 	=> true,
			'query_var'         	=> true,
			'rewrite'           	=> array( 'slug' => 'advertise_category' ),				
			'public'				=> true,
		));
	}

	function wd_advertise_filter_post_type_by_taxonomy() {
		global $typenow;
		$post_type = 'advertise'; // change to your post type
		$taxonomy  = 'advertise_category'; // change to your taxonomy
		if ($typenow == $post_type) {
			$selected      = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';
			$info_taxonomy = get_taxonomy($taxonomy);
			wp_dropdown_categories(array(
				'show_option_all' => __("Show All {$info_taxonomy->label}"),
				'taxonomy'        => $taxonomy,
				'name'            => $taxonomy,
				'orderby'         => 'name',
				'selected'        => $selected,
				'show_count'      => true,
				'hide_empty'      => true,
			));
		};
	}

	function wd_advertise_convert_id_to_term_in_query($query) {
		global $pagenow;
		$post_type = 'advertise'; // change to your post type
		$taxonomy  = 'advertise_category'; // change to your taxonomy
		$q_vars    = &$query->query_vars;
		if ( $pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0 ) {
			$term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
			$q_vars[$taxonomy] = $term->slug;
		}
	}
	public function wd_advertise_create_section() {
		if(post_type_exists('advertise')) {
			add_meta_box("wp_cp_custom_carousels", esc_html__("Config Advertise", 'wpdance'), array($this,"wd_advertise_show"), "advertise", "normal", "high");
		}
	}
	public function wd_advertise_show(){
		require_once ADS_INCLUDES.'/wd_advertise_meta.php';
	}

	public function wd_advertise_save_data($post_id, $post) {
		if(defined( 'DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;
		if( isset($_POST['custom_post_advertise']) && $_POST['custom_post_advertise'] == "custom_post_advertise" ){
			$_default_post_config = array(
				'advertise_file_url' 		=> isset($_POST['advertise_file_url'])?$_POST['advertise_file_url']: '',
				'advertise_new_window'		=> isset($_POST['advertise_new_window'])?$_POST['advertise_new_window']: '0',
			);
			$ret_str = serialize($_default_post_config);
			update_post_meta($post_id,'_tvlgiao_wpdance_custom_advertise',$ret_str);
			// Location
			$adv_location 		= isset($_POST['advertise_location'])?$_POST['advertise_location']: '0';
			update_post_meta($post_id,'_tvlgiao_wpdance_location_adv',$adv_location);
			// Sidebar Home
			$adv_sidebar_home 	= isset($_POST['advertise_sidebar_home'])?$_POST['advertise_sidebar_home']: '0';	
			update_post_meta($post_id,'_tvlgiao_wpdance_adv_sidebar_home',$adv_sidebar_home);
		}
	}

	public function wd_advertise_function(){
		require_once plugin_dir_path( __FILE__ ).'wd_function.php';
	}		
	public function wd_advertise_activate() {
		$this->wd_advertise_register();
		flush_rewrite_rules();
	}
	public function wd_advertise_deactivate() {
		flush_rewrite_rules();
	}
		
	protected function init_trigger(){
		
	}
	public function init_admin_script() {
		if (function_exists('wp_enqueue_media')) {
			wp_register_script('admin_media_lib_adv_35', ADS_JS . '/admin-media-lib-35.js', 'jquery', false,false);
			wp_enqueue_script('admin_media_lib_adv_35');
		} else {
			wp_enqueue_style('thickbox');
			wp_enqueue_script('media-upload');
			wp_enqueue_script('thickbox');
			wp_register_script('admin_media_lib', ADS_JS . '/admin-media-lib.js', 'jquery', false,false);
			wp_enqueue_script('admin_media_lib');
		}
	}	
	public function init_script(){
		wp_enqueue_script('jquery');
	}
	protected function constant(){
		//define('DS',DIRECTORY_SEPARATOR);	
		if( !defined('ADS_BASE') ){
			define('ADS_BASE'		,  	plugins_url( '', __FILE__ )	);
			define('ADS_ASSETS'		,  	plugins_url( '', __FILE__ ).'/assets' );
			define('ADS_INCLUDES'	, 	plugin_dir_path( __FILE__ ).'includes');
			define('ADS_JS'			, 	ADS_ASSETS . '/js'		);
			define('ADS_CSS'		, 	ADS_ASSETS . '/css'		);
			define('ADS_IMAGE'		, 	ADS_ASSETS . '/images'	);
			define('ADS_TEMPLATE' 	, 	dirname(__FILE__) . '/templates'	);
			
		}
	}
}
$_wd_advertise = new WD_Advertise; // Start an instance of the plugin class 
?>