<?php
if( !class_exists('tvlgiao_wpdance_widget_special_post') ){
	class tvlgiao_wpdance_widget_special_post extends WP_Widget {

		function __construct() {
			$widget_ops = array( 'classname' => 'widget_recent_post', 'description' => esc_html__( "Recent post, most view",'wpdance' ) );
			parent::__construct('recent_post', esc_html__('WD - Special Post','wpdance'), $widget_ops);
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
			$style_show 		= $instance['style_show'];
			$show_thumbnail 	= ($instance['show_thumbnail'] 	== 'on')?1:0;
			$show_author 		= ($instance['show_author'] 	== 'on')?1:0;
			$show_date 			= ($instance['show_date'] 		== 'on')?1:0;
			$show_detail 		= ($instance['show_detail'] 	== 'on')?1:0;
			$is_slider 			= ($instance['is_slider'] 		== 'on')?1:0;
			$auto_play 			= ($instance['auto_play'] 		== 'on')?1:0;
			$show_nav 			= ($instance['show_nav'] 		== 'on')?1:0;
			$per_slide 			= empty($instance['per_slide'])?1:absint($instance['per_slide']);
			$read_more 			= $instance['read_more'];

			$args = array(
				'post_type'				=> 'post'
				,'ignore_sticky_posts'	=> 1
				,'posts_per_page'		=> $number
				,'post_status'			=> 'publish'
			);
			if($data_post == 'most-view'){
				$args['meta_key'] 		= '_wd_post_views_count';
				$args['orderby'] 		= 'meta_value_num';
				$args['order'] 			= 'DESC';
			}
			wp_reset_query();
			$recent_posts = new WP_Query($args);
			echo wp_kses_post($before_widget);
			if ( $title )
				echo wp_kses_post( $before_title . $title . $after_title);

			if ( $recent_posts->have_posts() ) {
				$num_post =  $recent_posts->post_count;
				if( $num_post < 2 || $num_post <= $per_slide ){
					$is_slider = 0;
				}
				$random_id = 'wd_widget_recent_posts_wrapper_'.mt_rand();
				?>
				<div class="wd_widget_recent_posts_wrapper <?php echo ($show_nav)?'has_navi':''; ?> <?php echo esc_attr( $style_show ); ?>" id="<?php echo esc_attr( $random_id ); ?>">
					<div class="widget_list_post_inner">
				<?php
				$count = 0;	
				while( $recent_posts->have_posts() ) {
					$recent_posts->the_post();
					global $post;
					if ($count == 0 || $count % $per_slide == 0 ){
					?>
						<div class="widget_per_slide">
							<ul>
						<?php } ?>
							<li>
								<?php if( $show_thumbnail ){ ?>
									<div class="wd-thumbnail-post">
										<?php if(has_post_thumbnail()){ ?>
											<div class="post_thumbnail image">
												<a class="wd-effect-blog" href="<?php the_permalink(); ?>">
													<?php the_post_thumbnail('wp_outline_thumbnail_04_image',array('class' => 'thumbnail-effect-1', 'title'=>get_the_title())); ?>
												</a>
											</div>
										<?php } ?>
									</div>
								<?php } ?>
								<div class="wd-infomation-post">
									<!-- Style 1 -->
									<?php if($style_show == 'style-1') : ?>
										<?php if($show_date) : ?>
											<div class="wd-date-post">
												<?php the_time('j F, Y'); ?>
											</div>
										<?php endif;?>
										<div class="wd-entry-title">
											<a href="<?php the_permalink(); ?>" title="<?php printf( esc_html__( 'Permalink to %s', 'wpdance' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
												<?php echo esc_attr(get_the_title()); ?>
											</a>
										</div>
									<?php endif; ?>
									<!-- Style 2 -->
									<?php if($style_show == 'style-2') : ?>
										<div class="wd-entry-title">
											<a href="<?php the_permalink(); ?>" title="<?php printf( esc_html__( 'Permalink to %s', 'wpdance' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
												<?php echo esc_attr(get_the_title()); ?>
											</a>
										</div>
										<?php if($show_date) : ?>
											<div class="wd-date-post">
												<?php the_time('j F, Y'); ?>
											</div>
										<?php endif;?>
									<?php endif; ?>

									<?php if($show_detail) : ?>
										<div class="wd-count-post-detail">
											<span class="post-views"><i class="fa fa-eye"></i> <?php tvlgiao_wpdance_get_post_views(); ?></span>
											<span class="comments-count"><i class="fa fa-comment"></i> <?php $comments_count = wp_count_comments($post->ID); if($comments_count->approved < 10 && $comments_count->approved > 0) echo '0'; echo esc_attr( $comments_count->approved);?></span>
											<span class="post-like"><i class="fa fa-heart"></i> <?php $comments_count = wp_count_comments($post->ID); if($comments_count->approved < 10 && $comments_count->approved > 0) echo '0'; echo esc_attr( $comments_count->approved);?></span>
										</div>
									<?php endif;?>

									<?php if($show_author) : ?>
										<div class="author_post">	
											<i><?php esc_html_e('Post by','wpdance'); ?></i><a href="#"> </a><?php the_author_posts_link(); ?> 
										</div>
									<?php endif; ?>	

								</div>	
							</li>
						<?php $count++; if( $count % $per_slide == 0 || $count == $num_post){ ?>
							</ul>
						</div>
					<?php
					}
				}
				?>
					</div>
					<?php if( $show_nav && $is_slider ){ ?>
						<div class="slider_control">
							<a href="#" class="prev">&lt;</a>
							<a href="#" class="next">&gt;</a>
						</div>
					<?php } ?>
				</div>
				<?php if($read_more != "") : ?>
					<div class="wd-read-more">
						<a href="<?php echo esc_url($read_more); ?>" title="<?php esc_html_e('read more ','wpdance'); ?>">
							<?php esc_html_e('read more ','wpdance'); ?>
						</a>
					</div>
				<?php endif; ?>
				<?php
			}
			$output .= $after_widget;

			echo wp_kses_post( $output );
			if( $is_slider ){
			?>
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
			<?php
			}
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['title'] 			= esc_attr($new_instance['title']);
			$instance['number'] 		= $new_instance['number'];
			$instance['data_post'] 		= $new_instance['data_post'];
			$instance['style_show'] 	= $new_instance['style_show'];
			$instance['show_thumbnail'] = $new_instance['show_thumbnail'];
			$instance['show_author'] 	= $new_instance['show_author'];
			$instance['show_date'] 		= $new_instance['show_date'];
			$instance['show_detail'] 	= $new_instance['show_detail'];
			$instance['is_slider'] 		= $new_instance['is_slider'];
			$instance['show_nav'] 		= $new_instance['show_nav'];
			$instance['auto_play'] 		= $new_instance['auto_play'];
			$instance['per_slide'] 		= $new_instance['per_slide'];
			$instance['read_more'] 		= $new_instance['read_more'];

			return $instance;
		}

		function form( $instance ) {
			$instance_default = array(
									'title' 			=> ''
									,'number' 			=> 10
									,'data_post'		=> 'recent-post'
									,'style_show'		=> 'style-1'
									,'show_thumbnail' 	=> 1
									,'show_author' 		=> 1
									,'show_date'		=> 1
									,'show_detail' 		=> 1
									,'is_slider' 		=> 1
									,'show_nav' 		=> 1
									,'auto_play' 		=> 1
									,'per_slide' 		=> 1
									,'read_more'		=> ''	
									);
			$instance = wp_parse_args( (array) $instance, $instance_default );
			$instance['title'] = esc_attr($instance['title']); 
			$data_show 	= array(
					'recent-post'  	=> esc_html__('Recent Post','wpdance'),
					'most-view' 	=> esc_html__('Most View','wpdance')
			); 
			$style_show = array(
					'style-1'  		=> esc_html__('Style 1','wpdance'),
					'style-2'		=> esc_html__('Style 2','wpdance')
			); ?>
			
			<p><label for="<?php echo esc_attr( $this->get_field_id('title')); ?>"><?php esc_html_e('Title','wpdance'); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title')); ?>" name="<?php echo esc_attr( $this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr( $instance['title']); ?>" /></p>

			<p><label for="<?php echo esc_attr( $this->get_field_id('number')); ?>"><?php esc_html_e('Number of posts to show','wpdance'); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('number')); ?>" name="<?php echo esc_attr( $this->get_field_name('number')); ?>" type="number" min="1" max="999" value="<?php echo esc_attr( $instance['number']); ?>" /></p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id('data_post')); ?>"><?php esc_html_e('Data','wpdance'); ?></label>
				<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('data_post')); ?>" id="<?php echo esc_attr($this->get_field_id('data_post')); ?>">
					<?php foreach( $data_show as $key => $value ){ ?>
					<option value="<?php echo esc_attr($key); ?>" <?php echo ($instance['data_post']==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
					<?php } ?>
				</select>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id('style_show')); ?>"><?php esc_html_e('Show Style','wpdance'); ?></label>
				<select class="widefat" name="<?php echo esc_attr( $this->get_field_name('style_show')); ?>" id="<?php echo esc_attr($this->get_field_id('style_show')); ?>">
					<?php foreach( $style_show as $key => $value ){ ?>
					<option value="<?php echo esc_attr($key); ?>" <?php echo ($instance['style_show']==$key)?'selected':'' ?> ><?php echo esc_attr($value); ?></option>
					<?php } ?>
				</select>
			</p>
			<p>
				<input id="<?php echo esc_attr( $this->get_field_id('show_thumbnail')); ?>" name="<?php echo esc_attr( $this->get_field_name('show_thumbnail')); ?>" type="checkbox" <?php echo ($instance['show_thumbnail'])?'checked':'' ?> />
				<label for="<?php echo esc_attr( $this->get_field_id('show_thumbnail')); ?>"><?php esc_html_e('Show Thumbnail','wpdance'); ?></label>
			</p>
			<p>
				<input id="<?php echo esc_attr( $this->get_field_id('show_author')); ?>" name="<?php echo esc_attr( $this->get_field_name('show_author')); ?>" type="checkbox" <?php echo ($instance['show_author'])?'checked':'' ?> />
				<label for="<?php echo esc_attr( $this->get_field_id('show_author')); ?>"><?php esc_html_e('Show Author','wpdance'); ?></label>
			</p>
			<p>
				<input id="<?php echo esc_attr( $this->get_field_id('show_date')); ?>" name="<?php echo esc_attr( $this->get_field_name('show_date')); ?>" type="checkbox" <?php echo ($instance['show_date'])?'checked':'' ?> />
				<label for="<?php echo esc_attr( $this->get_field_id('show_date')); ?>"><?php esc_html_e('Show Date Post','wpdance'); ?></label>
			</p>
			<p>
				<input id="<?php echo esc_attr( $this->get_field_id('show_detail')); ?>" name="<?php echo esc_attr( $this->get_field_name('show_detail')); ?>" type="checkbox" <?php echo ($instance['show_detail'])?'checked':'' ?> />
				<label for="<?php echo esc_attr( $this->get_field_id('show_detail')); ?>"><?php esc_html_e('Show Post Meta','wpdance'); ?></label>
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
			<p><label for="<?php echo esc_attr( $this->get_field_id('read_more')); ?>"><?php esc_html_e('Link read more','wpdance'); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('read_more')); ?>" name="<?php echo esc_attr( $this->get_field_name('read_more')); ?>" type="text" value="<?php echo esc_attr( $instance['read_more']); ?>" /></p>
		<?php }
	}
}
register_widget( 'tvlgiao_wpdance_widget_special_post');
?>