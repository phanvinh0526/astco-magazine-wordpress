<?php
if( !class_exists('tvlgiao_wpdance_widget_business_partner') ){
	class tvlgiao_wpdance_widget_business_partner extends WP_Widget {

		function __construct() {
			$widget_ops = array( 'classname' => 'widget_recent_onsale', 'description' => esc_html__( "Business Partner",'wpdance' ) );
			parent::__construct('business-partner', esc_html__('WD - Business Partner','wpdance'), $widget_ops);
		}
	
		function widget( $args, $instance ) {
			global $posts, $post;

			if ( ! isset( $args['widget_id'] ) )
				$args['widget_id'] = $this->id;

			extract($args);
			$output = '';
			$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? esc_html__( '','wpdance' ) : $instance['title'], $instance, $this->id_base );

			if ( empty( $instance['number'] )  || ! $number = absint( $instance['number'] ) )
				$number = 5;
			if ( empty( $instance['columns'] ) || ! $columns = absint( $instance['columns'] ) )
				$columns = 4;

			$show_title 		= ($instance['show_title'] == 'on')?1:0;
			$is_slider 			= ($instance['is_slider'] == 'on')?1:0;
			$auto_play 			= ($instance['auto_play'] == 'on')?1:0;
			$show_nav 			= ($instance['show_nav'] == 'on')?1:0;
			// New Product
			$args = array(  
					'post_type' 		=> 'partner_business',
					'post_status' 		=> 'publish', 
					'posts_per_page' 	=> $number,
			);

			$business_partner 	= new WP_Query( $args );  $count = 0;
			$num_post 			= $business_partner->post_count;
			$random_id 			= 'widget_onsale_product'.mt_rand();

			?>
			<div class="wd-widget-business-partner" id="<?php echo esc_attr( $random_id ); ?>" >
				<?php 			
					if ( $title != '' )
						echo wp_kses_post($before_title . $title . $after_title); 
				?>
				<div class="per-slider-partner">
					<?php while ($business_partner->have_posts()) : $business_partner->the_post(); global $post; ?>
						<div class="wd-content-partner">
							<div class="wd-logo-partner">
								<a class="wd-effect-blog" href="<?php the_permalink(); ?>">
									<img src="<?php the_post_thumbnail_url(); ?>" alt="" class="sc-image">
								</a>
							</div>
							<?php if( $show_title ){ ?>
								<div class="wd-title-partner">
									<h2><?php echo esc_html(get_the_title($post->ID)); ?></h2>
								</div>
							<?php } // Endif ?>
						</div>						
					<?php endwhile; ?>
				</div>

			</div>
			<?php if( $is_slider ) : ?> 
				<script type="text/javascript">
				jQuery(document).ready(function(){
						"use strict";	
						var $_this = jQuery('#<?php echo esc_attr( $random_id ); ?>');
						var _auto_play = <?php echo esc_attr( $auto_play ); ?> == 1;
						var _show_nav = <?php echo esc_attr( $show_nav ); ?> == 1;
						var owl = $_this.find('.per-slider-partner').owlCarousel({
									loop : true
									,items : 5
									,nav : _show_nav
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
									,responsive:{
										0:{
											items : 1
										},
										300:{
											items : 2
										},
										579:{
											items : <?php if($columns == 5){echo $columns - 2;}elseif($columns == 4){echo $columns;}elseif($columns==3){echo $columns - 1;}else{echo $columns;}  ?>
										},
										767:{
											items : <?php echo $columns ?>
										},
										1100:{
											items : <?php echo $columns ?>
										}
									}
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
			$instance['columns'] 			= esc_attr($new_instance['columns']);
			$instance['number'] 			= $new_instance['number'];
			$instance['show_title'] 		= $new_instance['show_title'];
			$instance['show_nav'] 			= $new_instance['show_nav'];
			$instance['auto_play'] 			= $new_instance['auto_play'];

			return $instance;
		}

		function form( $instance ) {
			$instance_default = array(
									'title' 				=> ''
									,'number' 				=> 10
									,'show_title' 			=> 1
									,'is_slider' 			=> 1
									,'show_nav' 			=> 1
									,'auto_play' 			=> 1
								);

			$instance = wp_parse_args( (array) $instance, $instance_default );
			$instance['title'] 		= esc_attr($instance['title']);
			$instance['columns'] = esc_attr($instance['columns']); ?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id('title')); ?>"><?php esc_html_e('Title','wpdance'); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title')); ?>" name="<?php echo esc_attr( $this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr( $instance['title']); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id('number')); ?>"><?php esc_html_e('Number of product to show','wpdance'); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('number')); ?>" name="<?php echo esc_attr( $this->get_field_name('number')); ?>" type="number" min="1" max="999" value="<?php echo esc_attr( $instance['number']); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id('columns')); ?>"><?php esc_html_e('Columns','wpdance'); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('columns')); ?>" name="<?php echo esc_attr( $this->get_field_name('columns')); ?>" type="number" min="1" max="999" value="<?php echo esc_attr( $instance['columns']); ?>" />
			</p>
			<hr/>
			<p>
				<input id="<?php echo esc_attr( $this->get_field_id('show_title')); ?>" name="<?php echo esc_attr( $this->get_field_name('show_title')); ?>" type="checkbox" <?php echo ($instance['show_title'])?'checked':'' ?> />
				<label for="<?php echo esc_attr( $this->get_field_id('show_title')); ?>"><?php esc_html_e('Show Title','wpdance'); ?></label>
			</p>
			<hr />
			<p>
				<input id="<?php echo esc_attr( $this->get_field_id('show_nav')); ?>" name="<?php echo esc_attr( $this->get_field_name('show_nav')); ?>" type="checkbox" <?php echo ($instance['show_nav'])?'checked':'' ?> />
				<label for="<?php echo esc_attr( $this->get_field_id('show_nav')); ?>"><?php esc_html_e('Slider - Show navigation button','wpdance'); ?></label>
			</p>
			<p>
				<input id="<?php echo esc_attr( $this->get_field_id('auto_play')); ?>" name="<?php echo esc_attr( $this->get_field_name('auto_play')); ?>" type="checkbox" <?php echo ($instance['auto_play'])?'checked':'' ?> />
				<label for="<?php echo esc_attr( $this->get_field_id('auto_play')); ?>"><?php esc_html_e('Slider - Auto play','wpdance'); ?></label>
			</p>
		<?php
		}
	}
}
register_widget( 'tvlgiao_wpdance_widget_business_partner');
?>