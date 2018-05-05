<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Wordpress
 */
?>
<?php get_header(); ?>

<?php
	$post_ID		= tvlgiao_wpdance_get_post_by_global();
	//Set Post View
	tvlgiao_wpdance_set_post_views($post_ID);
	//Post Config
	$_post_config 	= get_post_meta($post_ID, '_tvlgiao_wpdance_custom_post_config', true);
	$_post_config 	= unserialize($_post_config);
	$post_layout 	= $_post_config['layout'];
	//Customize Config
	$layout 		= get_theme_mod('tvlgiao_wpdance_single_blog_layout','0-1-0');
	if($post_layout != "0"){
		$layout 	= $post_layout;
	}
	$sidebar_left 	= get_theme_mod('tvlgiao_wpdance_single_blog_sidebar_left','sidebar');
	$sidebar_right 	= get_theme_mod('tvlgiao_wpdance_single_blog_sidebar_right','sidebar');
	$row_class 		= '';
	$row_class_1 	= '';
	if( ($layout == '1-0-0') || ($layout == '0-0-1') ){
		$content_class = "col-sm-18";
		$row_class_1 ="row";
	}elseif($layout == '1-0-1'){
		$content_class = "col-sm-12";
		$row_class_1 ="row";
	}else{
		$content_class = "col-sm-24";
		$row_class ="row";
	}
	$number_adv 	= get_theme_mod('tvlgiao_wpdance_adv_number','5');
	if(!isset($_post_config['wd_adv_category_id'])) $_post_config['wd_adv_category_id'] = -1;
?>
<?php tvlgiao_wpdance_init_breadcrumbs() ?>
<div id="main-content" class="main-content">
	<div class="container">
		<div class="row">
			<!-- Content Single Post -->
			<div class="col-sm-16">
				<div class="<?php echo esc_attr($row_class); ?>">
					<div class="wd-post-infomation">
						<div class="wd-title-post">
							<div class="wd-meta-post">
								<div class="wd-date-create-post">
									<?php the_time('d / m / Y'); ?>
								</div>
								<div class="wd-share-post">
									<a href="" class="wd-click-share-social"><i class="fa fa-share-square-o" aria-hidden="true"></i> <?php esc_html_e('Share','wpdance')?></a>
									<div class="wd-content-share">
										<div class="addthis_sharing_toolbox"></div>
									</div>
								</div>
							</div>
							<h2 class="wd-heading-title">
								<?php the_title(); ?>
							</h2>
						</div>
	
					</div>				
					<div class="wd-post-excerpt">
						<?php
							while ( have_posts() ) : the_post(); 
								the_excerpt();
							endwhile;
						?>
						<?php if(isset($_post_config['wd_author_post']) && $_post_config['wd_author_post'] != "") : ?>
							<div class="wd-user-post">
								<?php echo esc_attr($_post_config['wd_author_post']); ?>							
							</div>
						<?php endif; ?> 
					</div>				
					<div class="wd-content-single">
						<div class="wd-content-detail-post">
							<?php while ( have_posts() ) : the_post();  ?>
								<!-- Content Post -->
								<?php get_template_part( 'content', 'single' ); ?>
								<!-- Related Post -->						
							<?php endwhile; // End of the loop. ?>
						</div>
					</div>
					<div class="wd-adv-single-moblie">
						<?php echo do_shortcode('[tvlgiao_wpdance_adv_sidebar_mobile number_adv="'.$number_adv.'" id_category="-1" adv_location="0"]'); ?>
					</div>
					<?php while ( have_posts() ) : the_post();  ?>
						<div class="wd-comment-form">
							<!-- Comment-post -->
							<?php		
								//If comments are open or we have at least one comment, load up the comment template
								if ( comments_open() || '0' != get_comments_number() ) :
									comments_template('');
								endif;
							?>		
						</div>
					<?php endwhile; // End of the loop. ?>
					<div class="wd-related_posts">
						<?php get_template_part( 'templates/wd_related_posts' ); ?>	
					</div>
					<div class="wd-tag-post">
						<i class="fa fa-tags" aria-hidden="true"></i> <span><?php esc_html_e('Tags: ','wpdance'); ?></span>
						<?php the_tags(esc_html__('', 'wpdance'),esc_html__(' ', 'wpdance')); ?>
					</div>
				</div>
			</div>

			<!-- Right Content -->
			<div class="col-sm-8 wd-padding-right-0">
				<?php echo do_shortcode('[tvlgiao_wpdance_adv_sidebar_home number_adv="'.$number_adv.'" id_category="'.$_post_config['wd_adv_category_id'].'" adv_location="0"]'); ?>
			</div>
		</div>
	</div>
</div><!-- END CONTAINER  -->
<?php get_footer(); ?>