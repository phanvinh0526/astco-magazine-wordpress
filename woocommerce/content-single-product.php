<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php
	/**
	 * woocommerce_before_single_product hook.
	 *
	 * @hooked wc_print_notices - 10
	 */
	do_action( 'woocommerce_before_single_product' );

	if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	}
	$post_ID		= tvlgiao_wpdance_get_post_by_global();
	$full_width_detail 		= get_theme_mod('tvlgiao_wpdance_single_full_width','no');
	$show_recently_product 	= get_theme_mod('tvlgiao_wpdance_single_recently_product', 'hide');
	$_product_config 		= get_post_meta($post_ID, '_tvlgiao_wpdance_custom_product_config' , true);
	$_product_config 		= unserialize($_product_config);
	$product_layout 		= $_product_config['layout'];
	//Customize Config
	$layout 		= get_theme_mod('tvlgiao_wpdance_single_product_layout','0-1-0');
	if($product_layout != "0"){
		$layout 	= $product_layout; 
	}
?>

<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if($full_width_detail == 'yes' && $layout == '0-0-0'){ ?>
		<div class="wd-full-width-single-product">
	<?php } ?>
	<?php
		/**
		 * woocommerce_before_single_product_summary hook.
		 *
		 * @hooked woocommerce_show_product_sale_flash - 10
		 * @hooked woocommerce_show_product_images - 20
		 */
		do_action( 'woocommerce_before_single_product_summary' );
	?>

	<div class="summary entry-summary">
		<div class="wd-description-single-pro">
		<?php
			/**
			 * woocommerce_single_product_summary hook.
			 *
			 * @hooked woocommerce_template_single_title - 5
			 * @hooked woocommerce_template_single_rating - 10
			 * @hooked tvlgiao_wpdance_template_single_review - 12
			 * @hooked woocommerce_template_single_price - 14
			 * @hooked tvlgiao_wpdance_template_single_availability 16
			 * @hooked tvlgiao_wpdance_template_single_sku - 18
			 * @hooked woocommerce_template_single_excerpt - 20
			 * @hooked woocommerce_template_single_add_to_cart - 30
			 * @hooked woocommerce_template_single_meta - 40
			 * @hooked woocommerce_template_single_sharing - 50
			 */
			do_action( 'woocommerce_single_product_summary' );
		?>
		</div>
		<?php
			/**
			 *@hooked tvlgiao_wpdance_single_recent_product - 5
			*/

			if($show_recently_product == 'show'){
				do_action( 'tvlgiao_wpdance_single_recent_product' ); 
			}
		?>
	</div><!-- .summary -->

	<?php if($full_width_detail == 'yes' && $layout == '0-0-0'){ ?>
		</div>
	<div class="container">
		<div class="row">
	<?php } ?>
		<?php
			/**
			 * woocommerce_after_single_product_summary hook.
			 *
			 * @hooked woocommerce_output_product_data_tabs - 10
			 * @hooked woocommerce_upsell_display - 15
			 * @hooked woocommerce_output_related_products - 20
			 */
			do_action( 'woocommerce_after_single_product_summary' );
		?>
	<?php if($full_width_detail == 'yes' && $layout == '0-0-0'){ ?>	
		</div>
	</div>
	<?php } ?>
	<meta itemprop="url" content="<?php the_permalink(); ?>" />

</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>
