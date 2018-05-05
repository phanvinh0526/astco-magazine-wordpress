<?php
/*
Template Name: Not Breadcrum Template
*/
get_header(); 

	/*CUSTOM DEFAULT*/
	$layout 		= get_theme_mod('tvlgiao_wpdance_default_page_layout','0-1-0');
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
				<div class="wd-content-page row">
					<div id="primary" class="content-area">
						<main id="main" class="site-main">
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