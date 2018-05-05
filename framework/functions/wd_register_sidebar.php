<?php
	if(!function_exists ('tvlgiao_wpdance_register_sidebar')){
		function tvlgiao_wpdance_register_sidebar(){
			register_sidebar(array(
		        'name' 				=> esc_html__('Sidebar', 'wpdance'),
		        'id' 				=> 'sidebar',
		        'description'   	=> esc_html__( 'Main sidebar that appears on the left.', 'wpdance' ),
		        'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		        'after_widget' 		=> '</aside>',
		        'before_title' 		=> '<h2 class="widget-title">',
		        'after_title' 		=> '</h2>',
		    ));
		    //Header Sidebar
		    register_sidebar(array(
		        'name' 				=> esc_html__('Header Top Content', 'wpdance'),
		        'id' 				=> 'header_top_content',
		        'description'   	=> esc_html__( 'Text infomation, languages, search, login....', 'wpdance' ),
		        'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		        'after_widget' 		=> '</aside>',
		        'before_title' 		=> '<h2 class="widget-title">',
		        'after_title' 		=> '</h2>',
		    ));
		    register_sidebar(array(
		        'name' 				=> esc_html__('Header Info Content', 'wpdance'),
		        'id' 				=> 'header_info_content',
		        'description'   	=> esc_html__( 'Header Info Content', 'wpdance' ),
		        'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		        'after_widget' 		=> '</aside>',
		        'before_title' 		=> '<h2 class="widget-title">',
		        'after_title' 		=> '</h2>',
		    ));
		    register_sidebar(array(
		        'name' 				=> esc_html__('Header Slogan ASTCO', 'wpdance'),
		        'id' 				=> 'header_slogan_astco',
		        'description'   	=> esc_html__( 'Header Slogan ASTCO', 'wpdance' ),
		        'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		        'after_widget' 		=> '</aside>',
		        'before_title' 		=> '<h2 class="widget-title">',
		        'after_title' 		=> '</h2>',
		    ));
		    //Footer
		    register_sidebar(array(
		        'name' 				=> esc_html__('Footer Top Content 01', 'wpdance'),
		        'id' 				=> 'footer_top_content_01',
		        'description'   	=> esc_html__( 'Content footer top 01', 'wpdance' ),
		        'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		        'after_widget' 		=> '</aside>',
		        'before_title' 		=> '<h2 class="widget-title">',
		        'after_title' 		=> '</h2>',
		    ));
		    register_sidebar(array(
		        'name' 				=> esc_html__('Footer Top Content 02', 'wpdance'),
		        'id' 				=> 'footer_top_content_02',
		        'description'   	=> esc_html__( 'Content footer top 02', 'wpdance' ),
		        'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		        'after_widget' 		=> '</aside>',
		        'before_title' 		=> '<h2 class="widget-title">',
		        'after_title' 		=> '</h2>',
		    ));
		    register_sidebar(array(
		        'name' 				=> esc_html__('Footer Bottom Content', 'wpdance'),
		        'id' 				=> 'footer_bottom_content',
		        'description'   	=> esc_html__( 'Footer Bottom Content', 'wpdance' ),
		        'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		        'after_widget' 		=> '</aside>',
		        'before_title' 		=> '<h2 class="widget-title">',
		        'after_title' 		=> '</h2>',
		    ));
		    // Banner
		    register_sidebar(array(
		        'name' 				=> esc_html__('BANNER VI - Sidebar left business', 'wpdance'),
		        'id' 				=> 'banner-vi-left-business',
		        'description'   	=> esc_html__( 'Sidebar left business', 'wpdance' ),
		        'before_widget' 	=> '<aside id="%1$s" class="widget %2$s">',
		        'after_widget' 		=> '</aside>',
		        'before_title' 		=> '<h2 class="widget-title">',
		        'after_title' 		=> '</h2>',
		    ));		    
		}
	}
	//Register Sidebar
	add_action('widgets_init', 'tvlgiao_wpdance_register_sidebar');
?>