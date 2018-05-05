<?php
/*
  Plugin Name: WD Magazine
  Plugin URI: http://www.wpdance.com
  Description: Magazine From WPDance Team
  Version: 1.0.0
  Author: WD Team
  Author URI: http://www.wpdance.com
 */
class WD_Magazine {
	/******************************** PORTFOLIO POST TYPE INIT END *************************************/

	/******************************/
	// Register Magazin post type //
	/******************************/
	public function __construct(){
		$this->constant();

		add_action('init', array($this,'wd_magazine_register') );
		add_theme_support('post-thumbnails', array('magazine'));

		register_activation_hook(__FILE__, array($this,'wd_magazine_activate') );
		register_deactivation_hook(__FILE__, array($this,'wd_magazine_deactivate') );
		
		add_action('admin_enqueue_scripts',array($this,'init_admin_script'));
		add_action('admin_menu', array( $this,'wd_magazine_create_section' ) );
		add_action('save_post', array($this,'wd_magazine_save_data') , 1, 2);
		add_filter( 'archive_template', array($this,'wd_magazine_archive_template') ) ;
		$this->init_trigger();
		$this->wd_magazine_function();
	}
	public function wd_magazine_register() {
		$this->wd_magazine_register_taxonomies();

		$labels = array(
			'name' 					=> __('Magazine Items'),
			'singular_name' 		=> __('Magazine Item'),
			'add_new' 				=> __('Add Magazine Item'),
			'add_new_item' 			=> __('Add New Magazine Item'),
			'edit_item' 			=> __('Edit Magazine Item'),
			'new_item' 				=> __('New Magazine Item'),
			'view_item' 			=> __('View Magazine Item'),
			'search_items' 			=> __('Search Magazine Item'),
			'not_found' 			=> __('No Magazine Items found'),
			'not_found_in_trash' 	=> __('No Magazine Items found in Trash'),
			'parent_item_colon' 	=> '',
			'menu_name' 			=> __('Magazine Items')
		);
		$args = array(
			'labels' 			=> $labels,
			'public' 			=> true,
			'show_ui' 			=> true,
			'capability_type' 	=> 'post',
			'hierarchical' 		=> true,
			'rewrite' 			=> array('slug' => 'magazine'),
			'supports' => array(
				'title',
				'thumbnail',
				'editor',
				'excerpt',
				'custom-fields',
			),
			'menu_position' 	=> 23,
			'menu_icon' 		=> WDP_IMAGE . '/icon.png',
			'taxonomies' 		=> array('magazine_category'),
		);

		register_post_type('magazine', $args);
	}
	public function wd_magazine_register_taxonomies() {
		register_taxonomy( 'magazine_category', array( 'magazine' ), array(
			'hierarchical'      	=> true,
			'labels'           		 => array(
				'name' 				=> esc_html__('Categories Magazine', 'wpdance'),
				'singular_name' 	=> esc_html__('Categories Magazine', 'wpdance'),
 				'search_items'      => esc_html__( 'Search Magazine', 'textdomain' ),
        		'all_items'         => esc_html__( 'All Magazine', 'textdomain' ),            	
            	'new_item'          => esc_html__('Add New', 'wpdance' ),
            	'edit_item'         => esc_html__('Edit Post', 'wpdance' ),
            	'view_item'   		=> esc_html__('View Post', 'wpdance' ),
            	'add_new_item'      => esc_html__('Add New Category Magazine', 'wpdance' ),
				'new_item_name'     => esc_html__( 'New Magazine Name', 'textdomain' ),
            	'menu_name'         => esc_html__( 'Categories Magazine' , 'wpdance' ),       	
			),
			'show_ui'           	=> true,
			'show_admin_column' 	=> true,
			'query_var'         	=> true,
			'rewrite'           	=> array( 'slug' => 'magazine_category' ),				
			'public'				=> true,
		));
	}
	public function wd_magazine_create_section() {
		if(post_type_exists('magazine')) {
			add_meta_box("wp_cp_custom_carousels", esc_html__("Config Magazine", 'wpdance'), array($this,"wd_magazine_show"), "magazine", "normal", "high");
		}
	}
	public function wd_magazine_show(){
		require_once WDP_INCLUDES.'/wd_magazine_meta.php';
	}

	public function wd_magazine_save_data($post_id, $post) {
		if(defined( 'DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;
		if( isset($_POST['custom_post_magazine']) && $_POST['custom_post_magazine'] == "custom_post_magazine" ){
			$_default_post_config = array(
				'magazine_file_url' 		=> isset($_POST['magazine_file_url'])?$_POST['magazine_file_url']: '',
			);
			$ret_str = serialize($_default_post_config);
			update_post_meta($post_id,'_tvlgiao_wpdance_custom_magazie',$ret_str);	
		}
	}

	public function wd_magazine_function(){
		require_once plugin_dir_path( __FILE__ ).'wd_function.php';
	}		
	public function wd_magazine_activate() {
		$this->wd_magazine_register();
		flush_rewrite_rules();
	}
	public function wd_magazine_deactivate() {
		flush_rewrite_rules();
	}
	public function wd_magazine_archive_template($archive_template ){
		global $post;
	
		if ( $post->post_type == 'magazine' ) {
			if(file_exists(plugin_dir_path( __FILE__ ).'/archive-magazine.php')){
				return plugin_dir_path( __FILE__ ).'/archive-magazine.php';
			}
		}
		return $archive_template ;
	}			
	protected function init_trigger(){
		add_image_size('magazine_image_size',200,260,true); 
	}
	public function init_admin_script() {
		if (function_exists('wp_enqueue_media')) {
			wp_register_script('admin_media_lib_35', WDP_JS . '/admin-media-lib-35.js', 'jquery', false,false);
			wp_enqueue_script('admin_media_lib_35');
		} else {
			wp_enqueue_style('thickbox');
			wp_enqueue_script('media-upload');
			wp_enqueue_script('thickbox');
			wp_register_script('admin_media_lib', WDP_JS . '/admin-media-lib.js', 'jquery', false,false);
			wp_enqueue_script('admin_media_lib');
		}

	}	
	public function init_script(){
		wp_enqueue_script('jquery');
	}
	protected function constant(){
		//define('DS',DIRECTORY_SEPARATOR);	
		if( !defined('WDP_BASE') ){
			define('WDP_BASE'		,  	plugins_url( '', __FILE__ )	);
			define('WDP_ASSETS'		,  	plugins_url( '', __FILE__ ).'/assets' );
			define('WDP_INCLUDES'	, 	plugin_dir_path( __FILE__ ).'includes');
			define('WDP_JS'			, 	WDP_ASSETS . '/js'		);
			define('WDP_CSS'		, 	WDP_ASSETS . '/css'		);
			define('WDP_IMAGE'		, 	WDP_ASSETS . '/images'	);
			define('WDP_TEMPLATE' 	, 	dirname(__FILE__) . '/templates'	);
			
		}
	}
}
$_wd_magazine = new WD_Magazine; // Start an instance of the plugin class 
?>