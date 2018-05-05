<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Wordpress
 * @since wpdance
 */
?>
<?php get_header(); ?>
<?php
	$select_style		= get_theme_mod( 'tvlgiao_wpdance_page_404_select_style' ,'bg_color');
	$class_style_select = 'wd-bg-color-error';
	if($select_style == 'bg_image'){
		$class_style_select = 'wd-bg-image-error';
	}
?>
<div id="main-content" class="main-content wd-404-error wd-bg-color-error">
	<section class="wd-error-404">
		<div class="wd-page-header">
			<h1 class="wd-page-title"><?php esc_html_e( '404', 'wpdance' ); ?></h1>
			<span class="wd-text-title"><?php esc_html_e( 'Sorry! Page Not Found !', 'wpdance' ); ?></span>
		</div><!-- .page-header -->

		<div class="wd-page-content">
			<?php get_search_form(); ?>
		</div><!-- .page-content -->
	</section><!-- .error-404 -->
</div><!-- END CONTAINER  -->
<?php get_footer(); ?>