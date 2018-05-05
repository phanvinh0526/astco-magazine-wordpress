<?php
/**
 * Simple product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/simple.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;
$post_id = tvlgiao_wpdance_get_post_by_global();

if ( ! $product->is_purchasable() ) {
	return;
}

?>

<?php
	// Availability
	$availability      = $product->get_availability();
	$availability_html = empty( $availability['availability'] ) ? '' : '<p class="stock ' . esc_attr( $availability['class'] ) . '">' . esc_html( $availability['availability'] ) . '</p>';

	echo apply_filters( 'woocommerce_stock_html', $availability_html, $availability['availability'], $product );
	$catalog_mod 	= get_theme_mod('tvlgiao_wpdance_catalog_mode', "no");
?>

<?php if ( $product->is_in_stock() ) : ?>

	<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

	<form class="variations_form cart" method="post" enctype='multipart/form-data'>
	 	<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
	 	
	 	<div class="variations_button <?php if($catalog_mod == "yes") echo esc_attr("hidden"); ?>">
	 		<div class="label_quantity"><span><?php esc_html_e("QUANTITY: ",'wpdance'); ?></span></div>
		 	<?php
		 		if ( ! $product->is_sold_individually() ) {
		 			woocommerce_quantity_input( array(
		 				'min_value'   => apply_filters( 'woocommerce_quantity_input_min', 1, $product ),
		 				'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->backorders_allowed() ? '' : $product->get_stock_quantity(), $product ),
		 				'input_value' => ( isset( $_POST['quantity'] ) ? wc_stock_amount( $_POST['quantity'] ) : 1 )
		 			) );
		 		}
		 	?>
	 	</div>

	 	<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->id ); ?>" />

		<div class="button_single_product_wpdance">
			<div class="single_variation_wrap add_to_card_button <?php if($catalog_mod == "yes") echo esc_attr("hidden"); ?>">
				<button type="submit" class="single_add_to_cart_button button alt big"><?php echo apply_filters('single_add_to_cart_text', esc_html__( 'Add to cart', 'wpdance' ), $product->product_type); ?></button>
			</div>
			
			<div class="value_submit_wd">	
				<input type="hidden" name="add-to-cart" value="<?php echo wp_kses_post($product->id); ?>" />
				<input type="hidden" name="product_id" value="<?php echo esc_attr( $post_id ); ?>" />
				<input type="hidden" name="variation_id" class="variation_id" value="" />
			</div>
			<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
		</div>
	</form>

	<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

<?php endif; ?>
