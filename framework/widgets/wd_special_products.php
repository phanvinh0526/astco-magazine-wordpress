<?php
if( !class_exists('tvlgiao_wpdance_widget_special_products') ){
	class tvlgiao_wpdance_widget_special_products extends WP_Widget {

		function __construct() {
			$widget_ops = array( 'classname' => 'widget_recent_onsale', 'description' => esc_html__( "Special product",'wpdance' ) );
			parent::__construct('special-products', esc_html__('WD - Special Products','wpdance'), $widget_ops);
		}
	
		function widget( $args, $instance ) {
			global $posts, $post;

			if ( ! isset( $args['widget_id'] ) )
				$args['widget_id'] = $this->id;

			extract($args);
			$output = '';
			$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? esc_html__( '','wpdance' ) : $instance['title'], $instance, $this->id_base );

			if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
				$number = 5;
			$data_post 			= $instance['data_post'];
			$post_type 			= $instance['post_type'];
			$show_thumbnail 	= ($instance['show_thumbnail'] == 'on')?1:0;
			$show_info_product 	= ($instance['show_info_product'] == 'on')?1:0;
			$show_rating 		= ($instance['show_rating'] == 'on')?1:0;
			$is_slider 			= ($instance['is_slider'] == 'on')?1:0;
			$auto_play 			= ($instance['auto_play'] == 'on')?1:0;
			$show_nav 			= ($instance['show_nav'] == 'on')?1:0;
			$per_slide 			= empty($instance['per_slide'])?2:absint($instance['per_slide']);
			$style_onsale 		= $instance['style_onsale'];

			// New Product
			$args = array(  
				'post_type' 		=> 'product',  
				'posts_per_page' 	=> $number,
				'orderby' 			=> 'date',
				'order'				=> 'DESC'
			);

			//Most View Products
			if($data_post == 'most-view-product'){
				$args['meta_key'] 	= '_wd_product_views_count';
				$args['orderby'] 	= 'meta_value_num';
				$args['order'] 		= 'DESC';
			}

			//On Sale Product
			if($data_post == 'on-sale-product'){
				$args['meta_query'] = array(
						                    'relation' => 'OR',
						                    array( // Simple products type
						                        'key'           => '_sale_price',
						                        'value'         => 0,
						                        'compare'       => '>',
						                        'type'          => 'numeric'
						                    ),
						                    array( // Variable products type
						                        'key'           => '_min_variation_sale_price',
						                        'value'         => 0,
						                        'compare'       => '>',
						                        'type'          => 'numeric'
						                    )
		           					);
			}
			//Featured Product
			if($data_post == 'featured-product'){
				$args['meta_key'] 	= '_featured';
				$args['meta_value'] = 'yes';
			}


			?>

			<?php $products = new WP_Query( $args );  $count = 0; ?>
			<?php $num_post = $products->post_count;?>
			<?php $random_id = 'widget_onsale_product'.mt_rand();?>
			
			<div class="woocommerce wd_widget_recent_onsaleproduct_wrapper widget <?php echo esc_attr($style_onsale); ?> <?php if($style_onsale=='style_02') echo 'label_best_sale'; ?>" id="<?php echo esc_attr( $random_id ); ?>" >
				<?php 			
					if ( $title != '' )
						echo wp_kses_post($before_title . $title . $after_title); 
				?>
				<div class="widget_list_post_inner">
					<?php while ( $products->have_posts() ) : $products->the_post(); global $product; ?>
						<?php if ($count == 0 || $count % $per_slide == 0 ){ ?>
							<div class="widget_per_slide">
						<?php } ?>
								<div class="product_detail_wd">
									<div class="product_thumbnail_wd">
										<?php if($show_info_product) : ?>
											<?php echo woocommerce_show_product_sale_flash(); ?>
											<?php
												if ( $product->is_featured() ) {
													echo '<span class="featured">Featured</span>';
												} 
											?>
										<?php endif; ?>
										<a href="<?php the_permalink(); ?>">
										    <?php				    	
										    	if (has_post_thumbnail( $products->post->ID )){
										    		if($style_onsale =='style_02'){
										    			echo get_the_post_thumbnail($products->post->ID,'shop_single');	
										    		}else{
										    			echo get_the_post_thumbnail($products->post->ID,'shop_thumbnail');	
										    		}
										    		
										    	} 
										    ?>
										</a>
									</div>
									<div class="product_info_wd">
										<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
										    <h3><?php the_title(); ?></h3>
										</a>
										
										<span class="price"><?php echo wp_kses_post($product->get_price_html()); ?></span>

										<?php if($show_rating) : ?>
											<?php echo woocommerce_template_single_rating(); ?>
										<?php endif; ?>
									</div>
								</div>
						<?php $count++; if( $count % $per_slide == 0 || $count == $num_post){ ?>
							</div>
						<?php } ?>
					<?php endwhile; ?>
				</div>
				<?php if( $show_nav && $is_slider ){ ?>
					<div class="slider_control">
						<a href="#" class="prev">&lt;</a>
						<a href="#" class="next">&gt;</a>
					</div>
				<?php } ?>
			</div>
	
			<?php if( $is_slider ) : ?> 
				<script type="text/javascript">
				jQuery(document).ready(function(){
						"use strict";	
						var $_this = jQuery('#<?php echo esc_attr( $random_id ); ?>');
						var _auto_play = <?php echo esc_attr( $auto_play ); ?> == 1;
						var owl = $_this.find('.widget_list_post_inner').owlCarousel({
									loop : true
									,items : 1
									,nav : false
									,dots : false
									,navSpeed : 1000
									,slideBy: 1
									,rtl:jQuery('body').hasClass('rtl')
									,navRewind: false
									,autoplay: _auto_play
									,autoplayTimeout: 5000
									,autoplayHoverPause: true
									,autoplaySpeed: false
									,mouseDrag: true
									,touchDrag: true
									,responsiveBaseElement: $_this
									,responsiveRefreshRate: 1000
									,onInitialized: function(){
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
			<?php endif; ?>
		<?php
		}

		function update( $new_instance, $old_instance ) {
			$instance 						= $old_instance;
			$instance['title'] 				= esc_attr($new_instance['title']);
			$instance['data_post'] 			= $new_instance['data_post'];
			$instance['number'] 			= $new_instance['number'];
			$instance['show_thumbnail'] 	= $new_instance['show_thumbnail'];
			$instance['show_info_product'] 	= $new_instance['show_info_product'];
			$instance['show_rating'] 		= $new_instance['show_rating'];
			$instance['is_slider'] 			= $new_instance['is_slider'];
			$instance['show_nav'] 			= $new_instance['show_nav'];
			$instance['auto_play'] 			= $new_instance['auto_play'];
			$instance['per_slide'] 			= $new_instance['per_slide'];
			$instance['style_onsale'] 		= $new_instance['style_onsale'];

			return $instance;
		}

		function form( $instance ) {
			$instance_default = array(
									'title' 				=> ''
									,'data_post'			=> 'recent-post'
									,'number' 				=> 10
									,'show_thumbnail' 		=> 1
									,'show_info_product' 	=> 1
									,'show_rating' 			=> 1
									,'is_slider' 			=> 1
									,'show_nav' 			=> 1
									,'auto_play' 			=> 1
									,'per_slide' 			=> 2
									,'style_onsale' 		=> 'style_01'
									);
			$args = array('public' => true,'show_ui' => true);
			$instance = wp_parse_args( (array) $instance, $instance_default );
			$instance['title'] = esc_attr($instance['title']);
			$data_show 	= array(
					'recent-product'  		=> esc_html__('Recent Post','wpdance'),
					'on-sale-product'  		=> esc_html__('On Sale Product','wpdance'),
					'most-view-product' 	=> esc_html__('Most View','wpdance'),
					'featured-product'		=> esc_html__('Featured Product','wpdance')
			); 
			$style_show = array(
								'style_01' 	=> esc_html__('Style 1','wpdance')
								,'style_02' => esc_html__('Style 2','wpdance')
							);
			?>
			<p><label for="<?php echo esc_attr( $this->get_field_id('title')); ?>"><?php esc_html_e('Title','wpdance'); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title')); ?>" name="<?php echo esc_attr( $this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr( $instance['title']); ?>" /></p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id('data_post')); ?>"><?php esc_html_e('Data','wpdance'); ?></label>
				<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('data_post')); ?>" id="<?php echo esc_attr($this->get_field_id('data_post')); ?>">
					<?php foreach( $data_show as $key => $value ){ ?>
					<option value="<?php echo esc_attr($key); ?>" <?php echo ($instance['data_post']==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
					<?php } ?>
				</select>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id('style_onsale')); ?>"><?php esc_html_e('Show Category Type:','wpdance'); ?></label>
				<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('style_onsale')); ?>" id="<?php echo esc_attr($this->get_field_id('style_onsale')); ?>">
					<?php foreach( $style_show as $key => $value ){ ?>
					<option value="<?php echo esc_attr($key); ?>" <?php echo ($instance['style_onsale']==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
					<?php } ?>
				</select>
			</p>
			<p><label for="<?php echo esc_attr( $this->get_field_id('number')); ?>"><?php esc_html_e('Number of product to show','wpdance'); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('number')); ?>" name="<?php echo esc_attr( $this->get_field_name('number')); ?>" type="number" min="1" max="999" value="<?php echo esc_attr( $instance['number']); ?>" /></p>
			<hr />
			<p>
				<input id="<?php echo esc_attr( $this->get_field_id('show_thumbnail')); ?>" name="<?php echo esc_attr( $this->get_field_name('show_thumbnail')); ?>" type="checkbox" <?php echo ($instance['show_thumbnail'])?'checked':'' ?> />
				<label for="<?php echo esc_attr( $this->get_field_id('show_thumbnail')); ?>"><?php esc_html_e('Show Image','wpdance'); ?></label>
			</p>
			<p>
				<input id="<?php echo esc_attr( $this->get_field_id('show_info_product')); ?>" name="<?php echo esc_attr( $this->get_field_name('show_info_product')); ?>" type="checkbox" <?php echo ($instance['show_info_product'])?'checked':'' ?> />
				<label for="<?php echo esc_attr( $this->get_field_id('show_info_product')); ?>"><?php esc_html_e('Show Product Info','wpdance'); ?></label>
			</p>
			<p>
				<input id="<?php echo esc_attr( $this->get_field_id('show_rating')); ?>" name="<?php echo esc_attr( $this->get_field_name('show_rating')); ?>" type="checkbox" <?php echo ($instance['show_rating'])?'checked':'' ?> />
				<label for="<?php echo esc_attr( $this->get_field_id('show_rating')); ?>"><?php esc_html_e('Show Rating','wpdance'); ?></label>
			</p>
			<hr />
			<p>
				<input id="<?php echo esc_attr( $this->get_field_id('is_slider')); ?>" name="<?php echo esc_attr( $this->get_field_name('is_slider')); ?>" type="checkbox" <?php echo ($instance['is_slider'])?'checked':'' ?> />
				<label for="<?php echo esc_attr( $this->get_field_id('is_slider')); ?>"><?php esc_html_e('Slider mode','wpdance'); ?></label>
			</p>
			<p>
				<input id="<?php echo esc_attr( $this->get_field_id('show_nav')); ?>" name="<?php echo esc_attr( $this->get_field_name('show_nav')); ?>" type="checkbox" <?php echo ($instance['show_nav'])?'checked':'' ?> />
				<label for="<?php echo esc_attr( $this->get_field_id('show_nav')); ?>"><?php esc_html_e('Slider - Show navigation button','wpdance'); ?></label>
			</p>
			<p>
				<input id="<?php echo esc_attr( $this->get_field_id('auto_play')); ?>" name="<?php echo esc_attr( $this->get_field_name('auto_play')); ?>" type="checkbox" <?php echo ($instance['auto_play'])?'checked':'' ?> />
				<label for="<?php echo esc_attr( $this->get_field_id('auto_play')); ?>"><?php esc_html_e('Slider - Auto play','wpdance'); ?></label>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id('per_slide')); ?>"><?php esc_html_e('Slider - Number of posts per slide','wpdance'); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('per_slide')); ?>" name="<?php echo esc_attr( $this->get_field_name('per_slide')); ?>" type="number" min="1" max="100" value="<?php echo esc_attr( $instance['per_slide']); ?>" />
			</p>
		<?php
		}
	}
}
register_widget( 'tvlgiao_wpdance_widget_special_products');
?>