<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
$classes[] = 'product';
$style_hover_product = get_theme_mod('tvlgiao_wpdance_genneral_product_hover_button', 'wd-hover-style-1');
?>
<li <?php post_class($classes); ?>>
	<div class="wd-content-product <?php echo esc_attr($style_hover_product); ?>">
		<?php
			/**
			 * woocommerce_before_shop_loop_item hook.
			 *
			 * @hooked woocommerce_template_loop_product_link_open - 10
			 */
			do_action( 'woocommerce_before_shop_loop_item' );
		?>
		<div class="wd-thumbnail-product">
			<?php
				/**
				 * woocommerce_before_shop_loop_item_title hook.
				 *
				 * @hooked tvlgiao_wpdance_flash_featured 5
				 * @hooked woocommerce_show_product_loop_sale_flash - 10
				 * @hooked woocommerce_template_loop_product_thumbnail - 10
				 */
				do_action( 'woocommerce_before_shop_loop_item_title' );
			?>
			<?php if( $style_hover_product == 'wd-hover-style-2' || $style_hover_product == 'wd-hover-style-3') : ?>
				<div class="wd-button-shop wd-hide-style-list">
				<?php
					/**
					 * woocommerce_button_shop
					 *
					 * @hooked add_quickshop_button - 5
					 * @hooked woocommerce_template_loop_add_to_cart 10
					 * @hooked YITH_Woocompare_Frontend 15
					 * @hooked tvlgiao_wpdance_add_wishlist_button_to_product_list 20
					 */
					do_action( 'tvlgiao_wpdance_button_shop_loop' );			
				?>
				</div>
			<?php endif; ?>			
		</div>
		<?php
			/**
			 * woocommerce_after_shop_loop_item hook.
			 *
			 * @hooked woocommerce_template_loop_product_link_close - 5
			 */
			do_action( 'woocommerce_after_shop_loop_item' );
		?>
		<div class="wd-content-detail">
			<?php
				/**
				 * woocommerce_before_shop_loop_item hook.
				 *
				 * @hooked woocommerce_template_loop_product_link_open - 10
				 */
				do_action( 'woocommerce_before_shop_loop_item' );
			?>
			<?php
				/**
				 * woocommerce_shop_loop_item_title hook.
				 *
				 * @hooked woocommerce_template_loop_product_title - 10
				 */
				do_action( 'woocommerce_shop_loop_item_title' );

				/**
				 * woocommerce_after_shop_loop_item_title hook.
				 *
				 * @hooked woocommerce_template_loop_price - 5
				 * @hooked woocommerce_template_loop_rating - 10
				 */
				do_action( 'woocommerce_after_shop_loop_item_title' );
			?>
			<?php
				/**
				 * woocommerce_after_shop_loop_item hook.
				 *
				 * @hooked woocommerce_template_loop_product_link_close - 5
				 */
				do_action( 'woocommerce_after_shop_loop_item' );
			?>
			<?php
				/**
				 *
				 * @hooked tvlgiao_wpdance_short_description_product 5
				 */
				do_action( 'tvlgiao_wpdance_description_product' );			
			?>
			<div class="wd-button-shop wd-show-style-list">
			<?php
				/**
				 * woocommerce_button_shop
				 *
				 * @hooked add_quickshop_button - 5
				 * @hooked woocommerce_template_loop_add_to_cart 10
				 * @hooked tvlgiao_wpdance_add_wishlist_button_to_product_list 15
				 */
				do_action( 'tvlgiao_wpdance_button_shop_loop' );			
			?>
			</div>	
		</div>
	</div>
</li>
