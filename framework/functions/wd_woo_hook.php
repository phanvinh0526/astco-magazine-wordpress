<?php
/**
 * @package 
 * @subpackage 
 * @since 
 */
	
/*
/*	Content Single Product
*/
add_filter( 'wp_calculate_image_srcset_meta', '__return_null' );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

add_action( 'woocommerce_single_product_summary', 'tvlgiao_wpdance_template_single_review', 12 );
function tvlgiao_wpdance_template_single_review(){
	global $product;

	if ( get_option( 'woocommerce_enable_review_rating' ) == 'no' )
		return;	
	if( function_exists('wd_get_rating_html') ){
		$rating_html = wd_get_rating_html();
	}else{
		$rating_html = $product->get_rating_html();
	}
	if ( $rating_html ) {
		echo "<div class=\"review_wrapper\">";
		echo '<span class="add_new_review"><a href="#reviews" class="inline show_review_form woocommerce-review-link" title="Review for '. esc_attr($product->get_title()) .' "><i class="fa fa-pencil-square-o"></i>' . esc_html__( 'Add your review', 'wpdance' ) . '</a></span>';
		echo "</div>";
	}else{
		echo '<p><span class="add_new_review"><a href="#reviews" class="inline show_review_form woocommerce-review-link" title="Review for '. esc_attr($product->get_title()) .' "><i class="fa fa-pencil-square-o"></i>' . esc_html__( 'Be the first to review', 'wpdance' ) . '</a></span></p>';
	}		
}

add_action('woocommerce_single_product_summary', 'tvlgiao_wpdance_template_single_availability', 16 );
function tvlgiao_wpdance_template_single_availability(){
	global $product;
	$_product_stock = tvlgiao_wpdance_get_product_availability($product); ?>
	<p class="availability stock <?php echo esc_attr($_product_stock['class']);?>"><?php esc_html_e('Availability','wpdance');?>: <span><?php echo esc_attr($_product_stock['availability']);?></span></p><?php		
}

add_action( 'woocommerce_single_product_summary', 'tvlgiao_wpdance_template_single_sku', 18 );
function tvlgiao_wpdance_template_single_sku(){
	global $product, $post;
	$sku_label = esc_html__("Sku:",'wpdance');
	echo "<p class='wd_product_sku product_meta'>" . $sku_label . " <span class=\"product_sku sku\">" . esc_attr($product->get_sku()) . "</span></p>";
}

function tvlgiao_wpdance_get_product_categories(){
	global $product;
	$categories_label = esc_html__("Categories: ",'wpdance');
	$rs = '';
	$rs .= '<div class="wd_product_categories"><span>'.$categories_label.'</span>';
	$product_categories = wp_get_post_terms(get_the_ID($product),'product_cat');
	$count = count($product_categories);
	if ( $count > 0 ){
		foreach ( $product_categories as $term ) {
		$rs.= '<a href="'.get_term_link($term->slug,$term->taxonomy).'">'.$term->name . "</a>, ";

		}
		$rs = substr($rs,0,-2);
	}
	$rs .= '</div>';
	echo wp_kses_post( $rs );
}

function tvlgiao_wpdance_product_tags_template(){
	global $product, $post;
	$_terms = wp_get_post_terms( $product->id, 'product_tag');
	$tags_label = esc_html__("Tags: ",'wpdance');
	echo '<div class="tagcloud">';
	
	$_include_tags = '';
	if( count($_terms) > 0 ){
		echo '<span class="tag_heading">'.$tags_label.'</span>';
		foreach( $_terms as $index => $_term ){
			$_include_tags .= ( $index == 0 ? "{$_term->term_id}" : ",{$_term->term_id}" ) ;
		}
		wp_tag_cloud( array('taxonomy' => 'product_tag', 'include' => $_include_tags, 'separator'=>'' ) );
	}
	
	echo "</div>\n";			
}

function tvlgiao_wpdance_template_single_social_sharing(){
	?>
		<div class="wd-social-share">
			<span><?php esc_html_e('Share ','wpdance'); ?></span>
			<div class="addthis_sharing_toolbox"></div>
		</div>
	<?php
}

add_action( 'woocommerce_single_product_summary', 'tvlgiao_wpdance_get_product_tags_categories', 40);
function tvlgiao_wpdance_get_product_tags_categories(){
	echo '<div class="wd_product_tags_categoried">';
		tvlgiao_wpdance_template_single_social_sharing();
		tvlgiao_wpdance_product_tags_template();
		tvlgiao_wpdance_get_product_categories();
	echo '</div>';
}



add_action( 'woocommerce_after_single_product_summary', 'tvlgiao_wpdance_upsell_related_display', 15 );
function tvlgiao_wpdance_upsell_related_display(){ ?>
	<div class="wd-ralated-product">
		<h5 class="wd-heading-title"><?php esc_html_e('RELATED ITEMS','wpdance'); ?></h5>
		<div class="wd-ralated-content">
			<?php woocommerce_related_products( array(12), false );	?>			
		</div>
	</div>	
	<?php	
}
add_action( 'after_setup_theme','tvlgiao_wpdance_archive_number_perpage', 200);
function tvlgiao_wpdance_archive_number_perpage(){ 
	$wd_archive_product = get_theme_mod('tvlgiao_wpdance_archive_number_perpage','15');
	add_filter( 'loop_shop_per_page', create_function( '$cols', 'return '.$wd_archive_product.';' ), 20 );
}

add_action('after_setup_theme','tvlgiao_wpdance_remove_action', 250);
function tvlgiao_wpdance_remove_action(){
	remove_action('woocommerce_after_shop_loop_item','woocommerce_template_loop_add_to_cart',10);
	add_action('tvlgiao_wpdance_button_shop_loop','woocommerce_template_loop_add_to_cart',10);
	remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_rating',5);	
	remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_price',10);
	add_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_price',5);
	add_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_rating',10);
	remove_action('woocommerce_single_product_summary','woocommerce_template_single_price',10);
	add_action('woocommerce_single_product_summary','woocommerce_template_single_price',14);
}
add_action( 'tvlgiao_wpdance_description_product', 'tvlgiao_wpdance_short_description_product', 15 );
function tvlgiao_wpdance_short_description_product() { ?>
	<div class="wp_description_product">
 		<?php tvlgiao_wpdance_the_excerpt_max_words(40); ?> [...]
 	</div>
	<?php 
}

if( class_exists('YITH_WCWL_UI') && class_exists('YITH_WCWL') ){
	add_action( 'tvlgiao_wpdance_button_shop_loop', 'tvlgiao_wpdance_add_wishlist_button_to_product_list', 20 );
	function tvlgiao_wpdance_add_wishlist_button_to_product_list(){
		echo do_shortcode('[yith_wcwl_add_to_wishlist]');
	}
	// Custom position in Product detail page
	add_action( 'woocommerce_after_add_to_cart_button' , create_function('','echo do_shortcode( "[yith_wcwl_add_to_wishlist]" );'), 50 );
}

if( class_exists( 'YITH_Woocompare_Frontend' ) && class_exists( 'YITH_Woocompare' ) ) {

	global $yith_woocompare;

	$is_ajax = ( defined( 'DOING_AJAX' ) && DOING_AJAX );
	if( $yith_woocompare->is_frontend() || $is_ajax ) {
		if( $is_ajax ){
			$yith_woocompare->obj = new YITH_Woocompare_Frontend();
		}
		add_action( 'tvlgiao_wpdance_button_shop_loop', array( $yith_woocompare->obj, 'add_compare_link' ), 15 );
		add_action( 'woocommerce_after_add_to_cart_button', array( $yith_woocompare->obj, 'add_compare_link' ), 30 );			
	}
	
}

add_action( 'woocommerce_before_shop_loop_item_title', 'tvlgiao_wpdance_flash_featured', 5 );
function tvlgiao_wpdance_flash_featured(){
	global $product;
	if ( $product->is_featured() ) { ?>
		<span class="featured"><?php esc_html_e('Hot','wpdance');?></span>
	<?php } 
}

add_action( 'tvlgiao_wpdance_single_recent_product', 'tvlgiao_wpdance_single_recent_product_function', 5 );
function tvlgiao_wpdance_single_recent_product_function() { 
		// New Product
	$args = array(  
		'post_type' 		=> 'product',  
		'posts_per_page' 	=> 3,
		'orderby' 			=> 'date',
		'order'				=> 'DESC'
	);
	$products = new WP_Query( $args );
	?>
	<div class="wp_single_recent_product">
		<h2 class="wd-title"><?php esc_html_e('Recently Viewed Products','wpdance');?></h2>
		<?php while ( $products->have_posts() ) : $products->the_post(); global $product; ?>
			<a href="<?php the_permalink(); ?>">
			    <?php				    	
			    	if (has_post_thumbnail( $products->post->ID )){
		    			echo get_the_post_thumbnail($products->post->ID,'shop_thumbnail');	 		
			    	} 
			    ?>
			</a>		
		<?php endwhile; ?>
 	</div>
	<?php 
}

add_action('tvlgiao_wpdance_header_init_action','tvlgiao_wpdance_customize_product_config', 500);
function tvlgiao_wpdance_customize_product_config(){
	$catalog_mod    = get_theme_mod('tvlgiao_wpdance_genneral_catalog_mode', "no");
    if($catalog_mod == "yes"){
        remove_action('woocommerce_single_product_summary','woocommerce_template_single_add_to_cart',30);
		remove_action('tvlgiao_wpdance_button_shop_loop','woocommerce_template_loop_add_to_cart',10);
    }
    $show_title    	= get_theme_mod('tvlgiao_wpdance_genneral_show_title', "yes");
    if($show_title == "no"){
    	remove_action('woocommerce_shop_loop_item_title','woocommerce_template_loop_product_title',10);
    }
    $show_rating  	= get_theme_mod('tvlgiao_wpdance_genneral_show_rating', "yes");
    if($show_rating == "no"){
    	remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_rating',10);
    }
    $show_price  	= get_theme_mod('tvlgiao_wpdance_genneral_show_price', "yes");
    if($show_price == "no"){
    	remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_price',5);
    }
    $show_meta  	= get_theme_mod('tvlgiao_wpdance_genneral_show_meta', "yes");
    if($show_meta == "no"){
    	remove_action('woocommerce_before_shop_loop_item_title','tvlgiao_wpdance_flash_featured',5);
    	remove_action('woocommerce_before_shop_loop_item_title','woocommerce_show_product_loop_sale_flash',10);
    }
}
?>