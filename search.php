<?php
/**
 * The template for displaying search results pages
 *
 * @package Wordpress
 * @since wpdance
 */
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
<div id="main-content" class="main-content wd-archive-custom">
	<div class="container">
		<div class="row">
			
			<!-- Content Index -->
			<div class="col-sm-16">
				<div class="row">
					<div class="wd-special-post">
						<?php if ( have_posts() ) : ?>
							<!-- Start the Loop --> 
							<?php while ( have_posts() ) : the_post(); ?>
								<?php
									get_template_part( 'content', get_post_format() );
								?>
							<?php endwhile; ?>
							<!-- End the Loop -->

						<?php else: ?>
							<?php get_template_part( 'content', 'none' ); ?>
						<?php endif; // End If Have Post ?>
					</div>
					<div class="wd-pagination">
						<?php tvlgiao_wpdance_pagination(); ?>
					</div>
				</div>
			</div>
		
			<!-- Right Content -->
			<div class="col-sm-8">							
				<?php if (is_active_sidebar('banner-vi-left-business') ) : ?>
					<ul class="xoxo">
						<?php dynamic_sidebar('banner-vi-left-business'); ?>
					</ul>
				<?php endif; ?>
			</div>	
		</div>
	</div>
</div><!-- END CONTAINER  -->
<?php get_footer(); ?>
