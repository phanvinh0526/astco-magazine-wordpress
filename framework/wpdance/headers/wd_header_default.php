<?php
	$default_logo 	= TVLGIAO_WPDANCE_THEME_IMAGES.'/wpdance_logo.png';
	$logo_url	  	= get_theme_mod('tvlgiao_wpdance_header_logo_url', $default_logo); 
	$sticky_menu 	= get_theme_mod('tvlgiao_wpdance_header_sticky_menu'); 
?>
<div class="wd-header-top">
	<div class="container">
		<div class="row">
			<?php if ( is_active_sidebar( 'header_top_content' ) ) : ?>
				<div class="wd-header-info">
					<?php dynamic_sidebar( 'header_top_content' ); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>
<div class="wd-header-bottom">
	<div class="container">
		<div class="row">
			<div class="wd-header-logo col-sm-6">
				<a href="<?php  echo home_url();?>">
					<img src='<?php echo esc_url($logo_url); ?>' alt='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>'>
				</a>
				<?php if ( is_active_sidebar( 'header_info_content' ) ) : ?>
					<div class="wd-info-astco">
						<?php dynamic_sidebar( 'header_info_content' ); ?>
					</div>
				<?php endif; ?>	
			</div>
			<div class="wd-header-banner col-sm-18">
				<?php 
				//Data Adv

				if( !is_archive() ) {
					$args = array(  
						'post_type' 		=> 'advertise',  
						'posts_per_page' 	=> 5,
						'meta_key'			=> '_tvlgiao_wpdance_location_adv',
						'meta_value'		=> '2',
					);
				}else{ 
					$id_category 	= get_queried_object()->term_id;
					$_post_config 	= get_option('_category_image_advertise_'.$id_category);
				    $_default_post_config = array(
						'image_cate_advertise_url' 	=> '',
						'wd_adv_category_id'		=> '-1',
					);
					if( strlen($_post_config) > 0 ){
						$_post_config = unserialize($_post_config);
						if( is_array($_post_config) && count($_post_config) > 0 ){
							$_post_config['image_cate_advertise_url'] 		= ( isset($_post_config['image_cate_advertise_url']) 	&& strlen($_post_config['image_cate_advertise_url']) > 0 ) ? $_post_config['image_cate_advertise_url'] : $_default_post_config['image_cate_advertise_url'];
							$_post_config['wd_adv_category_id'] 			= ( isset($_post_config['wd_adv_category_id']) && strlen($_post_config['wd_adv_category_id']) > 0 ) ? $_post_config['wd_adv_category_id'] : $_default_post_config['wd_adv_category_id'];
						}
					}else{
						$_post_config = $_default_post_config;
					}
					if( $_post_config['wd_adv_category_id'] != -1 ){
						wp_reset_query();
						// New blog
						$args = array(  
							'post_type' 		=> 'advertise',  
							'posts_per_page' 	=> 5
						);
						//Category				
						$args['tax_query'] = array(
								    	array(
										    	'taxonomy' 		=> 'advertise_category',
												'terms' 		=> $_post_config['wd_adv_category_id'],
												'field' 		=> 'term_id',
												'operator' 		=> 'IN'
											)
						   			);
						$args['meta_key']   = '_tvlgiao_wpdance_location_adv';
						$args['meta_value'] = '1';
					}else{
						$args['tax_query'] = array(
					    	array(
							    	'taxonomy' 		=> 'advertise_category',
									'terms' 		=> -1,
									'field' 		=> 'term_id',
									'operator' 		=> 'IN'
								)
			   			);
					}
					}
				$advertise_blogs 		= new WP_Query( $args );
				if( $advertise_blogs->have_posts() ){
					$id_add_sc  = "";
					$ulr_sc  	= "";
					$count		= 0;
					$new_tab 	= "";
					while( $advertise_blogs->have_posts() ) : $advertise_blogs->the_post(); global $post;
						$id_post  = get_the_ID();
						$imag_url = get_post_thumbnail_id( $id_post );
						$_post_config_adv 	= get_post_meta($id_post,'_tvlgiao_wpdance_custom_advertise',true);
						$_post_config_adv = unserialize($_post_config_adv);
						$count++;
						$id_add_sc .= $imag_url.",";
						$ulr_sc  .= 'link_url_'.$count.'="'.$_post_config_adv["advertise_file_url"].'" ';
						$new_tab .= 'new_tab_'.$count.'="'.$_post_config_adv["advertise_new_window"].'" ';	
					endwhile;
					$id_add_sc = rtrim($id_add_sc, ",");
					$string_shortcode = '[tvlgiao_wpdance_slider_banner_image number_image="'.$count.'" bg_image="'.$id_add_sc.'" '.$ulr_sc.$new_tab.']';
					echo do_shortcode($string_shortcode);
				}; // End have post  
					?>
			</div>
		</div>
		<?php if ( is_active_sidebar( 'header_slogan_astco' ) ) : ?>
		<div class="row">		
			<div class="wd-slogan-astco col-sm-24">
				<?php dynamic_sidebar( 'header_slogan_astco' ); ?>
			</div>
		</div>
		<?php endif; ?>	
		<div class="row">
			<div class="wd-header-menu">
				<?php wp_nav_menu( array('theme_location' => 'primary', 'container' => false, 'menu_class' => 'nav navbar-nav responsive-nav main-nav-list')); ?>
			</div>
		</div>
	</div>
</div>