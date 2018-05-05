<?php
/*
Template Name: Blog Template
*/
get_header(); 

	$post_ID		= tvlgiao_wpdance_get_post_by_global();
	/*PAGE CONFIG*/
	$_page_config 	= get_post_meta($post_ID, '_tvlgiao_wpdance_custom_page_config', true);
	$_page_config 	= unserialize($_page_config);
	$page_layout 	= $_page_config['layout'];
	$layout 		= get_theme_mod('tvlgiao_wpdance_default_page_layout','0-1-0');
	if($page_layout != "0"){
		$layout 	= $page_layout;
	}
	/*CUSTOM DEFAULT*/
	$sidebar_left 	= get_theme_mod('tvlgiao_wpdance_default_page_sidebar_left','sidebar');
	$sidebar_right 	= get_theme_mod('tvlgiao_wpdance_default_page_sidebar_right','sidebar');
	if( ($layout == '1-0-0') || ($layout == '0-0-1') ){
		$content_class = "col-sm-18";
	}elseif($layout == '1-0-1'){
		$content_class = "col-sm-12";
	}else{
		$content_class = "col-sm-24";
	}

?>
<?php tvlgiao_wpdance_init_breadcrumbs() ?>
<div id="main-content" class="main-content">
	<div class="container">
		<div class="row">


			<div class="row">
				<!-- Left Content -->
				<?php if( ($layout == '1-0-0') || ($layout == '1-0-1') ) : ?> 
					<div class="col-sm-6">							
						<?php if (is_active_sidebar($sidebar_left) ) : ?>
							<?php dynamic_sidebar( $sidebar_left ); ?>
						<?php endif; ?>
					</div>
				<?php endif; // Endif Left?>
				
				<!-- Content Index -->
				<div class="<?php echo esc_attr($content_class); ?>">
					<div class="wd-content-blog">
						<div id="primary" class="content-area container">
							<main id="main" class="site-main row">
								<?php while ( have_posts() ) : the_post(); ?>
									<?php the_content(); ?>	
								<?php endwhile; ?>
							</main><!-- #main -->
						</div><!-- #primary -->
					</div>
				</div>

				<!-- Right Content -->
				<?php if( ($layout == '0-0-1') || ($layout == '1-0-1') ) : ?> 
					<div class="col-sm-6">
						<?php if (is_active_sidebar($sidebar_right) ) : ?>
								<?php dynamic_sidebar( $sidebar_right ); ?>
						<?php endif; ?>
					</div>
				<?php endif; // Endif Right?>	
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>