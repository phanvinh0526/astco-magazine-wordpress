<?php
	$default_logo 	= TVLGIAO_WPDANCE_THEME_IMAGES.'/wpdance_logo.png';
	$logo_url	  	= get_theme_mod('tvlgiao_wpdance_header_logo_url', $default_logo); 
	$copyright = get_theme_mod('tvlgiao_wpdance_footer_copyright_text',esc_html__('Copyright CodeSpot. All rights reserved.','wpdance'));
?>
<div class="wd-footer-top">
	<div class="container">
		<div class="row">
			<div class="row">
			<div class="col-sm-24">
				<?php if ( is_active_sidebar( 'footer_top_content_01' ) ) : ?>
					<div class="wd-footer-top-01">
						<ul class="xoxo">
							<?php dynamic_sidebar( 'footer_top_content_01' ); ?>
						</ul>
					</div>
				<?php endif; ?>

				<?php if ( is_active_sidebar( 'footer_top_content_02' ) ) : ?>
					<div class="wd-footer-top-02">
						<ul class="xoxo">
							<?php dynamic_sidebar( 'footer_top_content_02' ); ?>
						</ul>
					</div>
				<?php endif; ?>

				<div class="wd-footer-menu">
					<?php wp_nav_menu( array('theme_location' => 'footer_menu', 'container' => false, 'menu_class' => 'nav navbar-nav responsive-nav main-nav-list')); ?>	
				</div>
			</div>
			</div>
		</div>
	</div>
</div>
<div class="bottom-footer">
	<?php if ( is_active_sidebar( 'footer_bottom_content' ) ) : ?>
		<div class="wd-footer-top-01">
			<ul class="xoxo">
				<?php dynamic_sidebar( 'footer_bottom_content' ); ?>
			</ul>
		</div>
	<?php else: ?>
		<p>Copyright 2017 by Astco. All rights reserved. Designed & Built by Astco Software Services</p>
	<?php endif; ?>
</div>
