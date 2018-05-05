<?php
/**
 * EW Social Widget
 */
if(!class_exists('tvlgiao_wpdance_widget_ew_social')){
	class tvlgiao_wpdance_widget_ew_social extends WP_Widget {

		function __construct(){
			$widgetOps = array('classname' => 'widget_social', 'description' => esc_html__('Display Social Profiles','wpdance'));
			$controlOps = array('width' => 400, 'height' => 350);
			parent::__construct('ew_social', esc_html__('WD - Social Profiles','wpdance'), $widgetOps, $controlOps);
		}

		function widget( $args, $instance ) {
			extract($args);
				$title 			= apply_filters('widget_title', empty($instance['title']) ? esc_html__('','wpdance') : $instance['title']);
				$rss_id 		= empty($instance['rss_id']) ? esc_html__('','wpdance') : $instance['rss_id'] ;
				$twitter_id 	= empty($instance['twitter_id']) ? esc_html__('','wpdance') : $instance['twitter_id'] ;
				$facebook_id 	= empty($instance['facebook_id']) ? esc_html__('','wpdance') : $instance['facebook_id'] ;
				$pin_id 		= empty($instance['pin_id']) ? esc_html__('','wpdance') : $instance['pin_id'] ;
				$google_id 		= empty($instance['google_id']) ? esc_html__('','wpdance') : $instance['google_id'] ;
				$youtube_id 	= empty($instance['youtube_id']) ? esc_html__('','wpdance') : $instance['youtube_id'] ;	
				$instagram_id 	= empty($instance['instagram_id']) ? esc_html__('','wpdance') : $instance['instagram_id'] ;	

				$show_facebook 	= apply_filters('show_facebook', empty($instance['show_facebook']) ? esc_html__('','wpdance') : $instance['show_facebook']);
				$show_twitter 	= apply_filters('show_twitter', empty($instance['show_twitter']) ? esc_html__('','wpdance') : $instance['show_twitter']);
				$show_google 	= apply_filters('show_google', empty($instance['show_google']) ? esc_html__('','wpdance') : $instance['show_google']);
				$show_instagram = apply_filters('show_instagram', empty($instance['show_instagram']) ? esc_html__('','wpdance') : $instance['show_instagram']);
				$show_pin 		= apply_filters('show_pin', empty($instance['show_pin']) ? esc_html__('','wpdance') : $instance['show_pin']);		
				$show_rss 		= apply_filters('show_rss', empty($instance['show_rss']) ? esc_html__('','wpdance') : $instance['show_rss']);
				$show_youtube 	= apply_filters('show_youtube', empty($instance['show_youtube']) ? esc_html__('','wpdance') : $instance['show_youtube']);		
					
			?>
			<?php echo wp_kses_post($before_widget);?>
			<div class="social-icons">
				<?php 
					if($title != ""){
						echo wp_kses_post($before_title . $title . $after_title);
					}
				?>
				<ul class="social-share">
					<?php if($show_facebook==1){?>
						<li class="icon-facebook">
							<a href="http://www.facebook.com/<?php echo esc_attr($facebook_id); ?>" target="_blank" title="<?php esc_html_e('Become our fan', 'wpdance'); ?>" >
								<i class="fa fa-facebook"></i>
							</a>
						</li>				
					<?php } ?>

					<?php if($show_twitter==1){?>
						<li class="icon-twitter">
							<a href="http://twitter.com/<?php echo esc_attr($twitter_id); ?>" target="_blank" title="<?php esc_html_e('Follow us', 'wpdance'); ?>" >
								<i class="fa fa-twitter"></i>
							</a>
						</li>
					<?php } ?>

					<?php if($show_google==1){?>
						<li class="icon-google"><a href="https://plus.google.com/u/0/<?php echo esc_attr($google_id); ?>" target="_blank" title="<?php esc_html_e('Get updates', 'wpdance'); ?>" >
								<i class="fa fa-google-plus"></i>
						</a></li>
					<?php } ?>

					<?php if($show_instagram==1){?>
						<li class="icon-instagram"><a href="http://www.instagram.com/<?php echo esc_attr($instagram_id); ?>" target="_blank" title="<?php esc_html_e('See Us', 'wpdance'); ?>" >
								<i class="fa fa-instagram"></i>
						</a></li>	
					<?php } ?>

					<?php if($show_pin==1){?>
						<li class="icon-pin"><a href="http://www.pinterest.com/<?php echo esc_attr($pin_id); ?>" target="_blank" title="<?php esc_html_e('See Us', 'wpdance'); ?>" >
								<i class="fa fa-pinterest"></i>
						</a></li>
					<?php } ?>

					<?php if($show_rss==1){?>
						<li class="icon-rss"><a href="https://www.rss.com/<?php echo esc_attr($rss_id); ?>" target="_blank" title="<?php esc_html_e('Get updates', 'wpdance'); ?>" >
								<i class="fa fa-rss"></i>
						</a></li>		
					<?php } ?>
		
					<?php if($show_youtube==1){?>
						<li class="icon-youtube"><a href="http://youtube.com/<?php echo esc_attr($youtube_id); ?>" target="_blank" title="<?php esc_html_e('Get updates', 'wpdance'); ?>" >
								<i class="fa fa-youtube"></i>
						</a></li>		
					<?php } ?>

				</ul>
			</div>

			<?php
			echo wp_kses_post($after_widget);
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['rss_id'] 		= $new_instance['rss_id'];
			$instance['twitter_id'] 	= $new_instance['twitter_id'];
			$instance['facebook_id'] 	= $new_instance['facebook_id'];
			$instance['pin_id'] 		= $new_instance['pin_id'];	
			$instance['google_id'] 		= $new_instance['google_id'];			
			$instance['title'] 			= $new_instance['title'];
			$instance['show_rss'] 		= $new_instance['show_rss'];
			$instance['show_twitter']	= $new_instance['show_twitter'];
			$instance['show_facebook'] 	= $new_instance['show_facebook'];
			$instance['show_google'] 	= $new_instance['show_google'];
			$instance['show_pin'] 		= $new_instance['show_pin'];
			$instance['youtube_id'] 	= $new_instance['youtube_id'];
			$instance['show_youtube'] 	= $new_instance['show_youtube'];
			$instance['instagram_id'] 	= $new_instance['instagram_id'];
			$instance['show_instagram'] = $new_instance['show_instagram'];
			return $instance;
		}

		function form( $instance ) { 
			$instance = wp_parse_args( (array) $instance, array( 'title' => '','rss_id' => '#', 'twitter_id' => '#',
																 'facebook_id' => '#', 'pin_id' => '#', 'google_id' => '#',
																 'show_rss' => '0', 'show_twitter' => '0', 'show_facebook' => '0',
																 'show_google' => '0', 'show_pin' => '0', 
																 'show_youtube' => '0', 'youtube_id' => '#',
																 'instagram_id' => "#", 'show_instagram' => '0'  ));
			$rss_id 			= esc_attr($instance['rss_id']);
			$twitter_id 		= esc_attr(format_to_edit($instance['twitter_id']));
			$facebook_id 		= esc_attr(format_to_edit($instance['facebook_id']));
			$pin_id 			= esc_attr(format_to_edit($instance['pin_id']));
			$google_id 			= esc_attr(format_to_edit($instance['google_id']));	
			$show_rss 			= esc_attr($instance['show_rss']);
			$show_twitter 		= esc_attr($instance['show_twitter']);
			$show_facebook 		= esc_attr($instance['show_facebook']);
			$show_google 		= esc_attr($instance['show_google']);
			$show_pin 			= esc_attr($instance['show_pin']);
			$show_youtube 		= esc_attr($instance['show_youtube']);
			$youtube_id 		= esc_attr($instance['youtube_id']);			
			$instagram_id 		= esc_attr($instance['instagram_id']);
			$show_instagram 	= esc_attr($instance['show_instagram']);
				
		?>

			<p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Enter your title','wpdance'); ?> : </label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" /></p>

			<hr/>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id('show_rss') ); ?>"><?php esc_html_e('Show Rss','wpdance'); ?> </label>
				<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('show_rss') ); ?>" id="<?php echo esc_attr( $this->get_field_id('show_rss') ); ?>">
					<option value="0" <?php echo ($instance['show_rss']=="0")?'selected':''; ?>><?php esc_html_e('Hide','wpdance'); ?></option>
					<option value="1" <?php echo ($instance['show_rss']=="1")?'selected':''; ?>><?php esc_html_e('Show','wpdance'); ?></option>
				</select>
			</p>
			<p><label for="<?php echo esc_attr($this->get_field_id('rss_id')); ?>"><?php esc_html_e('Enter your Rss','wpdance'); ?> : </label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('rss_id')); ?>" name="<?php echo esc_attr($this->get_field_name('rss_id')); ?>" type="text" value="<?php echo esc_attr($rss_id); ?>" /></p>
			
			<hr/>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id('show_twitter') ); ?>"><?php esc_html_e('Show Twitter','wpdance'); ?> </label>
				<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('show_twitter') ); ?>" id="<?php echo esc_attr( $this->get_field_id('show_twitter') ); ?>">
					<option value="0" <?php echo ($instance['show_twitter']=="0")?'selected':''; ?> ><?php esc_html_e('Hide','wpdance'); ?></option>
					<option value="1" <?php echo ($instance['show_twitter']=="1")?'selected':''; ?> ><?php esc_html_e('Show','wpdance'); ?></option>
				</select>
			</p>
			<p><label for="<?php echo esc_attr($this->get_field_id('twitter_id')); ?>"><?php esc_html_e('Enter your Twitter ID','wpdance'); ?> : </label>
			<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id('twitter_id')); ?>" name="<?php echo esc_attr($this->get_field_name('twitter_id')); ?>" value="<?php echo esc_attr($twitter_id); ?>" /></p>
			
			
			<hr/>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id('show_facebook') ); ?>"><?php esc_html_e('Show Facebook','wpdance'); ?> </label>
				<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('show_facebook') ); ?>" id="<?php echo esc_attr( $this->get_field_id('show_facebook') ); ?>">
					<option value="0" <?php echo ($instance['show_facebook']=="0")?'selected':''; ?> ><?php esc_html_e('Hide','wpdance'); ?></option>
					<option value="1" <?php echo ($instance['show_facebook']=="1")?'selected':''; ?> ><?php esc_html_e('Show','wpdance'); ?></option>
				</select>
			</p>
			<p><label for="<?php echo esc_attr($this->get_field_id('facebook_id')); ?>"><?php esc_html_e('Enter your Facebook ID','wpdance'); ?> : </label>
			<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id('image')); ?>" name="<?php echo esc_attr($this->get_field_name('facebook_id')); ?>" value="<?php echo esc_attr($facebook_id); ?>" /></p>
			

			<hr/>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id('show_pin') ); ?>"><?php esc_html_e('Show Pinterest','wpdance'); ?> </label>
				<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('show_pin') ); ?>" id="<?php echo esc_attr( $this->get_field_id('show_pin') ); ?>">
					<option value="0" <?php echo ($instance['show_pin']=="0")?'selected':''; ?> ><?php esc_html_e('Hide','wpdance'); ?></option>
					<option value="1" <?php echo ($instance['show_pin']=="1")?'selected':''; ?> ><?php esc_html_e('Show','wpdance'); ?></option>
				</select>
			</p>
			<p><label for="<?php echo esc_attr($this->get_field_id('pin_id')); ?>"><?php esc_html_e('Enter your Pinterest ID','wpdance'); ?> : </label>
			<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id('image')); ?>" name="<?php echo esc_attr($this->get_field_name('pin_id')); ?>" value="<?php echo esc_attr($pin_id); ?>" /></p>		
			
			<hr/>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id('show_google') ); ?>"><?php esc_html_e('Show Google','wpdance'); ?> </label>
				<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('show_google') ); ?>" id="<?php echo esc_attr( $this->get_field_id('show_google') ); ?>">
					<option value="0" <?php echo ($instance['show_google']=="0")?'selected':''; ?> ><?php esc_html_e('Hide','wpdance'); ?></option>
					<option value="1" <?php echo ($instance['show_google']=="1")?'selected':''; ?> ><?php esc_html_e('Show','wpdance'); ?></option>
				</select>
			</p>
			<p><label for="<?php echo esc_attr($this->get_field_id('google_id')); ?>"><?php esc_html_e('Enter your Google+ ID','wpdance'); ?> : </label>
			<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id('image')); ?>" name="<?php echo esc_attr($this->get_field_name('google_id')); ?>" value="<?php echo esc_attr($google_id); ?>" /></p>					
			

			<hr/>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id('show_youtube') ); ?>"><?php esc_html_e('Show youtube','wpdance'); ?> </label>
				<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('show_youtube') ); ?>" id="<?php echo esc_attr( $this->get_field_id('show_youtube') ); ?>">
					<option value="0" <?php echo ($instance['show_youtube']=="0")?'selected':''; ?> ><?php esc_html_e('Hide','wpdance'); ?></option>
					<option value="1" <?php echo ($instance['show_youtube']=="1")?'selected':''; ?> ><?php esc_html_e('Show','wpdance'); ?></option>
				</select>
			</p>
			<p><label for="<?php echo esc_attr($this->get_field_id('youtube_id')); ?>"><?php esc_html_e('Youtube ID','wpdance'); ?> : </label>
			<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id('image')); ?>" name="<?php echo esc_attr($this->get_field_name('youtube_id')); ?>" value="<?php echo esc_attr($youtube_id); ?>" /></p>					


			<hr/>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id('show_instagram') ); ?>"><?php esc_html_e('Show Instagram','wpdance'); ?> </label>
				<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('show_instagram') ); ?>" id="<?php echo esc_attr( $this->get_field_id('show_instagram') ); ?>">
					<option value="0" <?php echo ($instance['show_instagram']=="0")?'selected':''; ?> ><?php esc_html_e('Hide','wpdance'); ?></option>
					<option value="1" <?php echo ($instance['show_instagram']=="1")?'selected':''; ?> ><?php esc_html_e('Show','wpdance'); ?></option>
				</select>
			</p>
			<p><label for="<?php echo esc_attr($this->get_field_id('instagram_id')); ?>"><?php esc_html_e('Instagram ID','wpdance'); ?> : </label>
			<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id('image')); ?>" name="<?php echo esc_attr($this->get_field_name('instagram_id')); ?>" value="<?php echo esc_attr($instagram_id); ?>" /></p>
		<?php }
	}
}
register_widget( 'tvlgiao_wpdance_widget_ew_social');
?>