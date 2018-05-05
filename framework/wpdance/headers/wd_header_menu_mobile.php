<?php
	$default_logo 	= TVLGIAO_WPDANCE_THEME_IMAGES.'/wpdance_logo.png';
	$logo_url	  	= get_theme_mod('tvlgiao_wpdance_header_logo_url', $default_logo); 
	$sticky_menu 	= get_theme_mod('tvlgiao_wpdance_header_sticky_menu'); 
	$current_user 	= wp_get_current_user();
	$class_login	= "";
	if ( 0 != $current_user->ID ) {
		$class_login = "wp-user-login-mobile";
	} 
?>
<div class="wd-header-top">
	<div class="container">
		<div class="row">
			<?php if ( is_active_sidebar( 'header_info' ) ) : ?>
				<div class="wd-header-info">
					<?php dynamic_sidebar( 'header_info' ); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>		
<div class="wd-header-bottom">
	<div class="container">
		<div class="row">
			<div class="wd-header-logo">
				<a href="<?php  echo home_url();?>">
					<img src='<?php echo esc_url($logo_url); ?>' alt='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>'>
				</a>
				<?php if ( ( 'header_info_content' ) ) : ?>
					<div class="wd-info-astco">
						<?php dynamic_sidebar( 'header_info_content' ); ?>
					</div>
				<?php endif; ?>	
			</div>
			<div class="wd-header-menu">
				<a class="menu-bars"><i class="fa fa-bars"></i></a>
				<div class="pushmenu-left <?php echo esc_attr($class_login);?>">
					<a class="menu-bars"><i class="fa fa-bars"></i></a>
					<?php
						if( has_nav_menu( 'primary_mobile' ) ){ 
							wp_nav_menu( array( 'container_class' => 'mobile-main-menu toggle-menu','theme_location' => 'primary_mobile' ) ); 
						}
						else{
							wp_nav_menu( array( 'container_class' => 'mobile-main-menu toggle-menu','menu_class' => 'nav navbar-nav responsive-nav main-nav-list', 'theme_location' => 'primary' ) ); 
						}
					?>
				</div>
			</div>
			<!-- <?php //if(tvlgiao_wpdance_is_woocommerce()): ?>
				<?php //tvlgiao_wpdance_get_form_user_mobile() ?>
			<?php //endif; ?> -->
			<div class="wd-header-search">
				<a class="wd-click-popup-search"><i class="fa fa-search"></i></a>
				<div class="wd-popup-search hidden">
					<?php get_search_form( $echo = true );?>
					<div class="wd-search-close">X</div>
				</div>
				
			</div>
			<!-- <div class="wd-header-cart">
				<?php if(tvlgiao_wpdance_is_woocommerce()): ?>
					<?php echo tvlgiao_wpdance_tini_cart('')?>
				<?php endif; ?>						
			</div> -->
		</div>
		<?php if ( is_active_sidebar( 'header_slogan_astco' ) ) : ?>
		<div class="row">		
			<div class="wd-slogan-astco col-sm-24">
				<?php dynamic_sidebar( 'header_slogan_astco' ); ?>
			</div>
		</div>
		<?php endif; ?>	
	</div>
</div>