<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Wordpress
 */
?>
<?php get_header(); ?>

<?php //tvlgiao_wpdance_init_breadcrumbs() ?>
<div id="main-content" class="main-content">
	<div class="container">
		<div class="row">
			<div class="main-amazing row">
				<!-- Content Single Post -->
				<div class="col-sm-16">
					<div class="<?php echo esc_attr($content_class); ?>">
						<div class="row">
						<?php if ( have_posts() ) : ?>
							<!-- Start the Loop --> 
							<?php while ( have_posts() ) : the_post(); ?>
								<?php
									get_template_part( 'content', 'magazine');
								?>
							<?php endwhile; ?>
							<!-- End the Loop -->
							<div class="wd-pagination">
								<?php tvlgiao_wpdance_pagination(); ?>
							</div>
						<?php else: ?>
							<?php get_template_part( 'content', 'none' ); ?>
						<?php endif; // End If Have Post ?>
						</div>
					</div>
				</div>

				<!-- Right Content -->
				<div class="col-sm-8">							
					<?php if (is_active_sidebar('banner-vi-left-business') ) : ?>
						<ul class="xoxo">
							<?php dynamic_sidebar('banner-vi-left-business'); ?>
						</ul>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div><!-- END CONTAINER  -->
<?php get_footer(); ?>