<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one
 * of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query,
 * e.g., it puts together the home page when no home.php file exists.
 *
 * @package Wordpress
 * @since wpdance
 */
?>
<?php get_header(); ?>
<?php
	$_post_config 	= get_option('_category_image_advertise_'.get_queried_object()->term_id);
    $_default_post_config = array(
		'image_cate_advertise_url' 	=> '',
		'wd_adv_category_id'		=> '-1',
	);
	if( strlen($_post_config) > 0 ){
		$_post_config = unserialize($_post_config);
		if( is_array($_post_config) && count($_post_config) > 0 ){
			$_post_config['image_cate_advertise_url'] 		= ( isset($_post_config['image_cate_advertise_url']) 	&& strlen($_post_config['image_cate_advertise_url']) > 0 ) ? $_post_config['image_cate_advertise_url'] : $_default_post_config['image_cate_advertise_url'];
			$_post_config['wd_adv_category_id'] 			= ( isset($_post_config['wd_adv_category_id']) && strlen($_post_config['wd_adv_category_id']) > 0 ) ? $_post_config['wd_adv_category_id'] : $_default_post_config['wd_adv_category_id'];
		}
	}else{
		$_post_config = $_default_post_config;
	}
	$number_adv 	= get_theme_mod('tvlgiao_wpdance_adv_number','5');
	if(!isset($_post_config['wd_adv_category_id'])) $_post_config['wd_adv_category_id'] = -1;
?>
<?php tvlgiao_wpdance_init_breadcrumbs() ?>
<div class="wd-top-banner-archive-single container">
	<div class="row">
		<div class="row">
			<!-- Right Content -->
			<div class="col-sm-24">							
				<?php if($_post_config['image_cate_advertise_url'] != "") : ?>
					<?php echo do_shortcode('[tvlgiao_wpdance_banner_image open_new_tab="1" bg_image="'.$_post_config['image_cate_advertise_url'].'"]'); ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>
<div id="main-content" class="main-content wd-archive-custom">
	<div class="container">
		<div class="row">
		<div class="row">
			<!-- Content Single Post -->
			<div class="col-sm-16">
				<div class="wd-special-post wd-special-post">
					<?php $count_post = $GLOBALS['wp_query']->post_count; ?>
					<?php if ( have_posts() ) : ?>
						<!-- Start the Loop -->
						<?php if($count_post > 3){ ?> 
								<?php $count = 1; ?>
							<?php while ( have_posts() ) : the_post(); ?>
								<?php get_template_part( 'content', get_post_format() ); ?>
								<?php 
									if($count == 5): 
								 		echo do_shortcode('[tvlgiao_wpdance_adv_sidebar_mobile number_adv="'.$number_adv.'" id_category="'.$_post_config['wd_adv_category_id'].'" adv_location="0"]');
								 	endif; 
								 ?>
								<?php $count++; ?>
							<?php endwhile; ?>
						<?php }else{ ?>
							<?php while ( have_posts() ) : the_post(); ?>
								<?php get_template_part( 'content', get_post_format() ); ?>
							<?php endwhile; ?>
							<?php echo do_shortcode('[tvlgiao_wpdance_adv_sidebar_mobile number_adv="'.$number_adv.'" id_category="'.$_post_config['wd_adv_category_id'].'" adv_location="0"]'); ?>
						<?php } ?>
						<!-- End the Loop -->

					<?php else: ?>
						<?php get_template_part( 'content', 'none' ); ?>
					<?php endif; // End If Have Post ?>
				</div>
				<div class="wd-pagination">
					<?php tvlgiao_wpdance_pagination(); ?>
				</div>
			</div>

			<!-- Right Content -->
			<div class="col-sm-8">
				<?php echo do_shortcode('[tvlgiao_wpdance_adv_sidebar_home number_adv="'.$number_adv.'" id_category="'.$_post_config['wd_adv_category_id'].'" adv_location="0"]'); ?>
			</div>
		</div>
		</div>
	</div>
</div><!-- END CONTAINER  -->
<?php get_footer(); ?>