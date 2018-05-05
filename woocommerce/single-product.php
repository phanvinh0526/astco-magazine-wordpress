<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>
<?php
	$post_ID		= tvlgiao_wpdance_get_post_by_global();
	//Product Config
	$_product_config 	= get_post_meta($post_ID, '_tvlgiao_wpdance_custom_product_config', true);
	$_product_config 	= unserialize($_product_config);
	$product_layout 	= $_product_config['layout'];
	//Customize Config
	$layout 		= get_theme_mod('tvlgiao_wpdance_single_product_layout','0-1-0');
	if($product_layout != "0"){
		$layout 	= $product_layout; 
	}
	$sidebar_left 	= get_theme_mod('tvlgiao_wpdance_single_product_sidebar_left','sidebar');
	$sidebar_right 	= get_theme_mod('tvlgiao_wpdance_single_product_sidebar_right','sidebar');

	$full_width_detail 		= get_theme_mod('tvlgiao_wpdance_single_full_width','no');
	$position_additional 	= get_theme_mod('tvlgiao_wpdance_single_additional_image', 'bottom');
	$show_recently_product 	= get_theme_mod('tvlgiao_wpdance_single_recently_product', 'hide');
	$class_full_width		= "";

	if($full_width_detail == 'yes' && $layout != '0-0-0'){ $class_full_width = 'wd-fullwidth-detail-pro';}
	
	$class_recent_pro = "wd_recently_pro";
	if($show_recently_product == "hide"){
		$class_recent_pro = "";
	}

	$class_additional = "wd_additional_bottom";
	if($position_additional == "left"){
		$class_additional = "wd_additional_left";
	}

	if( ($layout == '1-0-0') || ($layout == '0-0-1') ){
		$content_class = "col-sm-18";
	}elseif($layout == '1-0-1'){
		$content_class = "col-sm-12";
	}else{
		if($full_width_detail == 'yes' && $layout == '0-0-0'){
			$content_class = "";
		}else{
			$content_class = "col-sm-24";
		}
		
	}

	tvlgiao_wpdance_set_product_views($post_ID);
?>
<?php tvlgiao_wpdance_init_breadcrumbs() ?>
<div id="main-content" class="main-content <?php echo esc_attr($class_full_width); ?>">
	<?php if($full_width_detail == 'no' || $layout != '0-0-0' ){ ?>
	<div class="container">
		<div class="row">
		<div class="row">
	<?php } ?>
			<!-- Left Content -->
			<?php if( ($layout == '1-0-0') || ($layout == '1-0-1') ) : ?> 
				<div class="col-sm-6 left-sidebar">							
					<?php if (is_active_sidebar($sidebar_left) ) : ?>
						<?php dynamic_sidebar( $sidebar_left ); ?>
					<?php endif; ?>
				</div>
			<?php endif; // Endif Left?>
			<!-- Content Single Post -->
				<div class="<?php echo esc_attr($content_class); ?> content-detail">
					<div class="wd-content-single-product <?php echo esc_attr($class_additional); ?> <?php echo esc_attr($class_recent_pro); ?>">
						<?php
							/**
							 * woocommerce_before_main_content hook.
							 *
							 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
							 * @hooked woocommerce_breadcrumb - 20
							 */
							do_action( 'woocommerce_before_main_content' );
						?>

							<?php while ( have_posts() ) : the_post(); ?>

								<?php wc_get_template_part( 'content', 'single-product' ); ?>

							<?php endwhile; // end of the loop. ?>

						<?php
							/**
							 * woocommerce_after_main_content hook.
							 *
							 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
							 */
							do_action( 'woocommerce_after_main_content' );
						?>

						<?php
							/**
							 * woocommerce_sidebar hook.
							 *
							 * @hooked woocommerce_get_sidebar - 10
							 */
							do_action( 'woocommerce_sidebar' );
						?>
					</div>
				</div>
			<!-- Right Content -->
			<?php if( ($layout == '0-0-1') || ($layout == '1-0-1') ) : ?> 
				<div class="col-sm-6 right-sidebar">
					<?php if (is_active_sidebar($sidebar_right) ) : ?>
							<?php dynamic_sidebar( $sidebar_right ); ?>
					<?php endif; ?>
				</div>
			<?php endif; // Endif Right?>
	<?php if($full_width_detail == 'no' || $layout != '0-0-0'){ ?>	
		</div>
		</div>
	</div>
	<?php } ?>
</div><!-- END CONTAINER  -->

<?php get_footer( 'shop' ); ?>