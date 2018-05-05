<?php 
if(!class_exists('tvlgiao_wpdance_widget_banner_slider')){
	/**
	 * Ads Widget class
	 *
	 */
	class tvlgiao_wpdance_widget_banner_slider extends WP_Widget {

		function __construct() {
			$widget_ops = array('classname' => 'widget_banner_slider', 'description' => esc_html__('Banner Slider','wpdance'));
			parent::__construct('banner_slider', esc_html__('WD - Banner Slider','wpdance'), $widget_ops);
		}

		function widget( $args, $instance ) {
			extract($args);
			
			$number_image 	= isset($instance['number_image']) ? esc_attr($instance['number_image']) : '5';
			$speed_image 	= isset($instance['speed_image']) ? esc_attr($instance['speed_image']) : '3000';

			$img_url_1 	= isset($instance['img_url_01']) ? esc_url($instance['img_url_01']) : '';
			$click_url_1 	= isset($instance['click_url_01']) ? esc_url($instance['click_url_01']) : '';

			$img_url_2 	= isset($instance['img_url_02']) ? esc_url($instance['img_url_02']) : '';
			$click_url_2 	= isset($instance['click_url_02']) ? esc_url($instance['click_url_02']) : '';

			$img_url_3 	= isset($instance['img_url_03']) ? esc_url($instance['img_url_03']) : '';
			$click_url_3 	= isset($instance['click_url_03']) ? esc_url($instance['click_url_03']) : '';

			$img_url_4 	= isset($instance['img_url_04']) ? esc_url($instance['img_url_04']) : '';
			$click_url_4 	= isset($instance['click_url_04']) ? esc_url($instance['click_url_04']) : '';

			$img_url_5 	= isset($instance['img_url_05']) ? esc_url($instance['img_url_05']) : '';
			$click_url_5 	= isset($instance['click_url_05']) ? esc_url($instance['click_url_05']) : '';		
			$random_id = 'wd_banner_slider'.mt_rand(); ?>

			<div id="<?php echo esc_attr($random_id); ?>" class="wd-banner-slider">
			    <div id="slider" class="nivoSlider">
			    	<?php for($i= 0; $i < $number_image; $i++) { ?>
			    		<?php $img_url 	= 'img_url_'.($i+1); ?>
			    		<?php $link_url = 'click_url_'.($i+1); ?>
			    		
			    		<a href="<?php echo ${$link_url}; ?>">
			    			<img src="<?php echo esc_url(${$img_url});?>" data-thumb="<?php echo esc_url(${$img_url});?>" alt=""/></a>
			    		</a>		
			    	<?php }; ?>
           	 	</div>				
			</div>
			<script type="text/javascript">
			    jQuery(document).ready(function($) {
			    	var $_this = jQuery('#<?php echo esc_attr( $random_id ); ?>');
			        $_this.find('#slider').nivoSlider({
						animSpeed: 500,                   // Slide transition speed 
						pauseTime: <?php echo $speed_image; ?>,
						controlNav: false,                  // How long each slide will show 
						directionNav: false,
					});
			    });
			</script>
			<?php
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['number_image'] 	= esc_attr($new_instance['number_image']);
			$instance['speed_image'] 	= esc_attr($new_instance['speed_image']);

			$instance['img_url_01'] 	= esc_url($new_instance['img_url_01']);
			$instance['click_url_01'] 	= esc_url($new_instance['click_url_01']);

			$instance['img_url_02'] 	= esc_url($new_instance['img_url_02']);
			$instance['click_url_02'] 	= esc_url($new_instance['click_url_02']);

			$instance['img_url_03'] 	= esc_url($new_instance['img_url_03']);
			$instance['click_url_03'] 	= esc_url($new_instance['click_url_03']);

			$instance['img_url_04'] 	= esc_url($new_instance['img_url_04']);
			$instance['click_url_04'] 	= esc_url($new_instance['click_url_04']);

			$instance['img_url_05'] 	= esc_url($new_instance['img_url_05']);
			$instance['click_url_05'] 	= esc_url($new_instance['click_url_05']);

			return $instance;
		}

		function form( $instance ) {

			$number_image 	= isset($instance['number_image']) ? esc_attr($instance['number_image']) : '5';
			$speed_image 	= isset($instance['speed_image']) ? esc_attr($instance['speed_image']) : '3000';

			$img_url_01 	= isset($instance['img_url_01']) ? esc_url($instance['img_url_01']) : '';
			$click_url_01 	= isset($instance['click_url_01']) ? esc_url($instance['click_url_01']) : '';

			$img_url_02 	= isset($instance['img_url_02']) ? esc_url($instance['img_url_02']) : '';
			$click_url_02 	= isset($instance['click_url_02']) ? esc_url($instance['click_url_02']) : '';

			$img_url_03 	= isset($instance['img_url_03']) ? esc_url($instance['img_url_03']) : '';
			$click_url_03 	= isset($instance['click_url_03']) ? esc_url($instance['click_url_03']) : '';

			$img_url_04 	= isset($instance['img_url_04']) ? esc_url($instance['img_url_04']) : '';
			$click_url_04 	= isset($instance['click_url_04']) ? esc_url($instance['click_url_04']) : '';

			$img_url_05 	= isset($instance['img_url_05']) ? esc_url($instance['img_url_05']) : '';
			$click_url_05 	= isset($instance['click_url_05']) ? esc_url($instance['click_url_05']) : '';
			
			?>
			<p><label><?php esc_html_e('Number Image','wpdance'); ?> : </label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('number_image') ); ?>" name="<?php echo esc_attr( $this->get_field_name('number_image') ); ?>" type="text" value="<?php echo esc_attr($number_image); ?>" /></p>

			<p><label><?php esc_html_e('Speed Image: Default 3000ms','wpdance'); ?> : </label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('speed_image') ); ?>" name="<?php echo esc_attr( $this->get_field_name('speed_image') ); ?>" type="text" value="<?php echo esc_attr($speed_image); ?>" /></p>
			<hr/>
			<hr/>
			<!-- 01 -->
			<p><label><?php esc_html_e('Image URL 01','wpdance'); ?> : </label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('img_url_01') ); ?>" name="<?php echo esc_attr( $this->get_field_name('img_url_01') ); ?>" type="text" value="<?php echo esc_attr($img_url_01); ?>" /></p>
			
			<p><label><?php esc_html_e('Click URL 01','wpdance'); ?> : </label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('click_url_01') ); ?>" name="<?php echo esc_attr( $this->get_field_name('click_url_01') ); ?>" type="text" value="<?php echo esc_attr($click_url_01); ?>" /></p>
			<hr/>

			<!-- 02 -->
			<p><label><?php esc_html_e('Image URL 02','wpdance'); ?> : </label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('img_url_02') ); ?>" name="<?php echo esc_attr( $this->get_field_name('img_url_02') ); ?>" type="text" value="<?php echo esc_attr($img_url_02); ?>" /></p>
			
			<p><label><?php esc_html_e('Click URL 02','wpdance'); ?> : </label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('click_url_02') ); ?>" name="<?php echo esc_attr( $this->get_field_name('click_url_02') ); ?>" type="text" value="<?php echo esc_attr($click_url_02); ?>" /></p>
			<hr/>

			<!-- 03-->
			<p><label><?php esc_html_e('Image URL 03','wpdance'); ?> : </label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('img_url_03') ); ?>" name="<?php echo esc_attr( $this->get_field_name('img_url_03') ); ?>" type="text" value="<?php echo esc_attr($img_url_03); ?>" /></p>
			
			<p><label><?php esc_html_e('Click URL 03','wpdance'); ?> : </label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('click_url_03') ); ?>" name="<?php echo esc_attr( $this->get_field_name('click_url_03') ); ?>" type="text" value="<?php echo esc_attr($click_url_03); ?>" /></p>
			<hr/>

			<!-- 04 -->
			<p><label><?php esc_html_e('Image URL 04','wpdance'); ?> : </label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('img_url_04') ); ?>" name="<?php echo esc_attr( $this->get_field_name('img_url_04') ); ?>" type="text" value="<?php echo esc_attr($img_url_04); ?>" /></p>
			
			<p><label><?php esc_html_e('Click URL 04','wpdance'); ?> : </label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('click_url_04') ); ?>" name="<?php echo esc_attr( $this->get_field_name('click_url_04') ); ?>" type="text" value="<?php echo esc_attr($click_url_04); ?>" /></p>
			<hr/>

			<!-- 05 -->
			<p><label><?php esc_html_e('Image URL 05','wpdance'); ?> : </label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('img_url_05') ); ?>" name="<?php echo esc_attr( $this->get_field_name('img_url_05') ); ?>" type="text" value="<?php echo esc_attr($img_url_05); ?>" /></p>
			
			<p><label><?php esc_html_e('Click URL 05','wpdance'); ?> : </label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('click_url_05') ); ?>" name="<?php echo esc_attr( $this->get_field_name('click_url_05') ); ?>" type="text" value="<?php echo esc_attr($click_url_05); ?>" /></p>

			<?php
		}
	}
}
register_widget( 'tvlgiao_wpdance_widget_banner_slider');
?>