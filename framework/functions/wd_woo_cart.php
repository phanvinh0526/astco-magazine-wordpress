<?php
if ( ! function_exists( 'tvlgiao_wpdance_tini_cart' ) ) {
	function tvlgiao_wpdance_tini_cart($class = ""){
		$_actived = apply_filters( 'active_plugins', get_option( 'active_plugins' )  );
		if ( !in_array( "woocommerce/woocommerce.php", $_actived ) ) {
			return;
		}
		global $woocommerce;
		$_cart_empty = sizeof( $woocommerce->cart->get_cart() ) > 0 ? false : true ;
		$_cart_size_id = "cart_size_value_head-".rand();
		
		ob_start();
		?>
		<div class="shopping-cart shopping-cart-wrapper">
			<div class="wd_tini_cart_wrapper <?php echo esc_attr($class) ?>">
				
				<div class="wd_tini_cart_control ">
					<span class="cart_size">
						<a href="<?php echo esc_url(WC()->cart->get_cart_url());?>" title="<?php esc_html_e('View your shopping bag','wpdance');?>">
							<span class="ic-bag"></span>
						
						<!--<span class="cart_division">/</span>-->
						<span class="cart_size_value_head" id="<?php echo esc_attr($_cart_size_id); ?>">
							<span class="cart_item">
								<span class="num_item">
								<?php 
								$number = WC()->cart->cart_contents_count;
								if( $number < 10 && $number != 0 )
									echo '0'.esc_attr($number);
								else
									echo esc_attr($number);
								?>
								</span>
								<span class="text_num_intem"><?php esc_html_e(' Item(s)','wpdance'); ?></span>
							</span>
							<span class="cart_text">
								<span class="text"><?php esc_html_e('Cart','wpdance');?></span>
								<span class="total"><?php echo WC()->cart->get_cart_subtotal(); ?></span>
							</span>
						</span>
						</a>
					</span>
				</div>

				<div class="cart_dropdown drop_down_container">
					<?php if ( !$_cart_empty ) : ?>
					<div class="dropdown_body">
						<h3 class="wd_cart_heading"><?php esc_html_e('Shopping cart','wpdance'); ?></h3>
						<h5 class="wd_cart_item_info"><?php esc_html_e('There are ','wpdance'); echo esc_html($woocommerce->cart->cart_contents_count); esc_html_e(' products in your shopping cart','wpdance'); ?></h5>
						<ul class="cart_list product_list_widget">
								
								<?php
									$_cart_array = $woocommerce->cart->get_cart();
									$_index = 0;
								?>
								
								<?php foreach ( $_cart_array as $cart_item_key => $cart_item ) :
									
									$_product = $cart_item['data'];

									if ( ! apply_filters('woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) || ! $_product->exists() || $cart_item['quantity'] == 0 )
										continue;

									$product_price = get_option( 'woocommerce_tax_display_cart' ) == 'excl' ? $_product->get_price_excluding_tax() : $_product->get_price_including_tax();

									$product_price = apply_filters( 'woocommerce_cart_item_price_html', woocommerce_price( $product_price ), $cart_item, $cart_item_key );
									?>

									<li class="media <?php echo esc_attr($_cart_li_class = ($_index == 0 ? "first" : ($_index == count($_cart_array) - 1 ? "last" : ""))); ?>">
										<a class="pull-left" href="<?php echo esc_url(get_permalink( $cart_item['product_id'] )); ?>">
											<?php echo wp_kses_post( $_product->get_image('wd_cart_dropdown') ); ?>
										</a>
										<div class="cart_item_wrapper">	
											<a class="wd_cart_title" href="<?php echo esc_url(get_permalink( $cart_item['product_id'] )); ?>">
												<?php echo esc_html($_product->get_title()); ?>
											</a>
												<?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity link_color">' . sprintf( '%s &times; %s',$product_price, $cart_item['quantity'] ) . '</span>', $cart_item, $cart_item_key ); ?>
												<?php
													echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove" title="%s">&times;</a>', esc_url( $woocommerce->cart->get_remove_url( $cart_item_key ) ), esc_html__( 'Remove this item', 'wpdance' ) ), $cart_item_key );
											?>
										</div>
									</li>

									<?php $_index++; ?>
									
								<?php endforeach; ?>
						</ul>
					</div>
					<?php else: ?>
					<div class="size_empty">
						<?php esc_html_e('You have no items in your shopping cart.','wpdance');?>
					</div>
					<?php endif; ?>
					<?php if ( !$_cart_empty ) : ?>
						<div class="dropdown_footer">
							<p class="total"><span class="link_color"><?php esc_html_e( 'Cart subtotal', 'wpdance' ); ?>:</span><span class="link_color_hover"><?php echo wp_kses_post( $woocommerce->cart->get_cart_subtotal()); ?></span></p>

							<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>
							
							<p class="buttons">
								<a class="cart" href="<?php echo esc_url($woocommerce->cart->get_cart_url());?>"><?php esc_html_e('View cart','wpdance');?></a>
								<a class="checkout secondary_button" href="<?php echo esc_url($woocommerce->cart->get_checkout_url()); ?>"><?php esc_html_e( 'Checkout', 'wpdance' ); ?></a>
							</p>				
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<?php 
		$tini_cart = ob_get_clean();
		return $tini_cart;
	}
}

if ( ! function_exists( 'tvlgiao_wpdance_update_tini_cart' ) ) {
	function tvlgiao_wpdance_update_tini_cart() {
		die($_tini_cart_html = tvlgiao_wpdance_tini_cart());
	}
}
/* Support WooCommerce Multilingual */
function tvlgiao_wpdance_tiny_cart_add_ajax_action($actions){
	$actions[] = 'update_tini_cart';
	return $actions;
}

add_action('init', 'tvlgiao_wpdance_tiny_cart_add_filter', 1);
function tvlgiao_wpdance_tiny_cart_add_filter(){
	add_filter( 'wcml_multi_currency_is_ajax', 'tvlgiao_wpdance_tiny_cart_add_ajax_action');
}

add_action('wp_ajax_update_tini_cart', 'tvlgiao_wpdance_update_tini_cart');
add_action('wp_ajax_nopriv_update_tini_cart', 'tvlgiao_wpdance_update_tini_cart');

if ( ! function_exists( 'tvlgiao_wpdance_checkout_product_in_woocommerce' ) ) {
	function tvlgiao_wpdance_checkout_product_in_woocommerce(){
		$_actived = apply_filters( 'active_plugins', get_option( 'active_plugins' )  );
		if ( !in_array( "woocommerce/woocommerce.php", $_actived ) ) {
			return;
		}
		global $woocommerce;
		?>
			<a class="checkout secondary_button" href="<?php echo esc_url($woocommerce->cart->get_checkout_url()); ?>"><?php esc_html_e( 'Check out', 'wpdance' ); ?></a>
		<?php
	}
}

?>