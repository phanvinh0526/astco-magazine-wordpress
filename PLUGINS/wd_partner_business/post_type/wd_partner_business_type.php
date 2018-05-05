<?php
function register_partner_business(){
	register_post_type('partner_business', array(
		'labels' => array(
                'name' 					=> esc_html_x('Business', 'post type general name','wpdance'),
                'singular_name' 		=> esc_html_x('Business', 'post type singular name','wpdance'),
                'add_new' 				=> esc_html_x('Add Business', 'Team','wpdance'),
                'add_new_item' 			=> esc_html__('Add Business','wpdance'),
                'edit_item' 			=> esc_html__('Edit Business','wpdance'),
                'new_item' 				=> esc_html__('New Business','wpdance'),
                'view_item' 			=> esc_html__('View Business','wpdance'),
                'search_items' 			=> esc_html__('Search Business','wpdance'),
                'not_found' 			=> esc_html__('No business found','wpdance'),
                'not_found_in_trash' 	=> esc_html__('No business found in Trash','wpdance'),
                'parent_item_colon' 	=> '',
                'menu_name' 			=> esc_html__('Business','wpdance'),
		),
		'taxonomies' 			=> array(''),
		'singular_label' 		=> esc_html__('Partner Business','wpdance'),
		'public' 				=> true,
		'publicly_queryable' 	=> true,
		'exclude_from_search' 	=> true,
		'show_ui' 				=> true,
		'show_in_menu' 			=> true,
		'capability_type' 		=> 'page',
		'hierarchical' 			=> false,
		'has_archive' 			=> false,
		'rewrite' 				=>  array('slug'  =>  'partner_business'),
		'query_var' 			=> true,
		'can_export' 			=> true,
		'show_in_nav_menus' 	=> false,
	));	
}
add_action('init','register_partner_business');
?>