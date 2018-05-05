<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other 'pages' on your WordPress site will use a different template.
 *
 * @package Wordpress
 * @since wpdance
 *
 **/
?>
<?php get_header(); ?>
<?php
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
<?php tvlgiao_wpdance_init_breadcrumbs() ?>
<div id="main-content" class="main-content">
	<div class="container">
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
				<div class="wd-content-page">
					<?php if ( have_posts() ) : ?>
						<!-- Start the Loop --> 
						<?php while ( have_posts() ) : the_post(); ?>
							<?php get_template_part( 'content', 'page' ); ?>
							<?php
								// If comments are open or we have at least one comment, load up the comment template
								if ( comments_open() || '0' != get_comments_number() ) :
									comments_template();
								endif;
							?>
						<?php endwhile; ?>
						<!-- End the Loop -->
						<div class="wd-pagination">
							<?php tvlgiao_wpdance_pagination(); ?>
						</div>
					<?php else: ?>
						<?php get_template_part( 'content', 'none' ); ?>
					<?php endif; // End If Have Post ?>
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
<?php get_footer(); ?>