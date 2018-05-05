<?php
/**
 * Single Product Thumbnails
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-thumbnails.php.
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
 * @version     2.6.3
 */


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce,$smof_data;

$post_id = tvlgiao_wpdance_get_post_by_global();

$attachment_ids = $product->get_gallery_attachment_ids();

$num_post = count($attachment_ids) + 1;
$position_additional = get_theme_mod('tvlgiao_wpdance_single_additional_image', 'bottom');
$per_slide = 1;
if($position_additional == "left"){
	$per_slide = 3;
}
$count 	 = 0;


if ( $attachment_ids ) {
	if( is_array($attachment_ids) && has_post_thumbnail() ) {
		array_unshift($attachment_ids, get_post_thumbnail_id());
	}
	?>
	<?php $_random_id = 'product_thumbnails_wrapper_'.rand(); ?>
	<div class="thumbnails list_carousel loading" id="<?php echo esc_attr($_random_id); ?>">
		<div class="product_thumbnails">
			<?php
				foreach ( $attachment_ids as $attachment_id ) {
					if ($count == 0 || $count % $per_slide == 0 ){ ?>
						<div class="thumbail_per_slide">
					<?php }
					$classes = array(  );

					$image_link = wp_get_attachment_url( $attachment_id );

					if ( ! $image_link )
						continue;	
						
					$image_class = esc_attr( implode( ' ', $classes ) );
						$image_title 		= esc_attr( $product->get_title() );
						$_thumb_size =  apply_filters( 'single_product_large_thumbnail_size', 'shop_catalog' );
						$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_catalog' ),array( 'alt' => $image_title, 'title' => $image_title ) );
						$image_src   = wp_get_attachment_image_src( $attachment_id, $_thumb_size );
						$image_class = $image_class." pop_cloud_zoom cloud-zoom-gallery";
						echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<div><a href="%s" class="%s" title="%s"  rel="useZoom: \'zoom1\', smallImage: \'%s\'">%s</a></div>', $image_link, $image_class, $image_title, $image_src[0], $image ), $attachment_id, $post_id , $image_class );
					$count++; 
					if( $count % $per_slide == 0 || $count == $num_post){ ?>
						</div>
					<?php }
				}

			?>
		</div>
		<?php //if($smof_data['wd_prod_cloudzoom'] == 1) : ?>
		<div class="slider_control">
			<a id="product_thumbnails_prev" class="prev" href="#">&lt;</a>
			<a id="product_thumbnails_next" class="next" href="#">&gt;</a>
		</div>		
		<?php //endif; ?>
	</div>
	
	<?php if( count($attachment_ids) > 0 ) : ?>
		<?php 
			$_found_post = count($attachment_ids);
			$_found_post = $_found_post > 4 ? 4 : $_found_post;
			if($position_additional == "left"){ $_found_post = 1;}
		?>
		<script type="text/javascript">
			jQuery(function() {
				var $_this = jQuery('#<?php echo esc_attr($_random_id); ?>');
				var owl = $_this.find('.product_thumbnails').owlCarousel({
							items : <?php echo esc_attr($_found_post);?>
							,loop : true
							,nav : false
							,dots : false
							,navSpeed : 1000
							,slideBy: 1
							,rtl:jQuery('body').hasClass('rtl')
							,margin: 0
							,navRewind: false
							,autoplay: false
							,autoplayTimeout: 5000
							,autoplayHoverPause: false
							,autoplaySpeed: false
							,mouseDrag: true
							,touchDrag: true
							,responsiveBaseElement: $_this
							,responsiveRefreshRate: 400
							,onInitialized: function(){
								$_this.addClass('loaded').removeClass('loading');
							}
							,responsive:{
								<?php if($position_additional == "left"){ ?>
									items : 1
								<?php }else{ ?>
									0: {
										items : 1	
									},
									80: {
										items : 2	
									},
									160: {
										items : 3
									},
									240: {
										items : 4	
									}	
								<?php } ?>

							}
						});
						$_this.on('click', '.next', function(e){
							e.preventDefault();
							owl.trigger('next.owl.carousel');
						});

						$_this.on('click', '.prev', function(e){
							e.preventDefault();
							owl.trigger('prev.owl.carousel');
						});
			});	
		</script>
	<?php endif;?>	
		
	<?php
}