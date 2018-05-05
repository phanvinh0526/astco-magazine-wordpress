<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Wordpress
 */
?>
<?php get_header(); ?>
<?php
	//Information Company
	$_post_config 	= get_post_meta($post->ID,'_tvlgiao_wpdance_custom_partner_business',true);
	$_post_config 	= unserialize($_post_config);
	//Map
	$_data_map_google = get_post_meta($post->ID,'_tvlgiao_wpdance_custom_partner_map_google',true);
	if( strpos($_data_map_google, "iframe") == false  ){
		$_data_map_google = "";
	}
    // Image Company
    $image_gallery 	= get_post_meta($post->ID, '_easy_image_gallery', true );
    $attachments 	= array_filter( explode( ',', $image_gallery ) );
    $is_slider		= 1;
    $random_id 		= 'wd_special_post'.mt_rand();
    if(count($attachments) < 2){ $is_slider = 0;}
?>  
<?php //tvlgiao_wpdance_init_breadcrumbs() ?>
<div id="main-content" class="main-content">
	<div class="container">
		<div class="row">
			<div class="row">
			<!-- Content Single Post -->
			<div class="col-sm-16 wpb_wrapper">
				<?php
					global $wpdb;
					$sql = "SELECT id, name FROM astco_business";
					$myrows = $wpdb->get_results($sql);
					print_r($myrows);
				?>
				<div class="wd-parner-infomation">
					<div class="wd-meta-partner">
						<div class="wd-date-create-parner">
							<?php the_time('d / m / Y'); ?>
						</div>
						<div class="wd-user-parner">
							<?php if(isset($_post_config['wd_author_post']) && $_post_config['wd_author_post'] != "") : ?>
								<?php echo esc_attr($_post_config['wd_author_post']); ?>
							<?php else: ?>
								<?php
									while ( have_posts() ) : the_post(); 
										the_author();
									endwhile;
								?> 
							<?php endif; ?>
						</div>
						<div class="wd-share-post">
							<a href="" class="wd-click-share-social"><?php esc_html_e('Share','wpdance')?></a>
							<div class="wd-content-share">
								<div class="addthis_sharing_toolbox"></div>
							</div>
						</div>
					</div>
					<div class="wd-title-parner">
						<h2 class="wd-heading-title">
							<a href="<?php the_permalink();?>" class="wd-title-post"><?php the_title(); ?></a>
						</h2>
					</div>
					<?php if ( $attachments ): ?>
						<div id="<?php echo esc_attr( $random_id ); ?>" class="wd_special_post_wrapper wd-partner-imagecompany">
					        <?php foreach ( $attachments as $attachment_id ) {  ?>
								<div class="wd-content-post-home">
									<div class="wd-thumbnail-post">
										<div class="post_thumbnail image">
											<?php echo wp_get_attachment_image( $attachment_id, 'image_size_large' ); ?>
										</div>
									</div>					
								</div>
					        <?php } ?>
						</div>
					<?php endif; ?>
					<div class="wd-partner-social">
						<ul>
							<li class="icon-facebook">
								<a href="<?php echo esc_url($_post_config["company_facebook"]); ?>" target="_blank" title="<?php esc_html_e('Facebook', 'wpdance'); ?>" >
									<i class="fa fa-facebook"></i>
								</a>
								<span><?php esc_html_e('Facebook','wpdance'); ?></span>
							</li>				
							<li class="icon-twitter">
								<a href="<?php echo esc_url($_post_config["company_twitter"]); ?>" target="_blank" title="<?php esc_html_e('Follow us', 'wpdance'); ?>" >
									<i class="fa fa-twitter"></i>
								</a>
								<span><?php esc_html_e('Twitter','wpdance'); ?></span>
							</li>
							<li class="icon-google">
								<a href="<?php echo esc_url($_post_config["company_google"]); ?>" target="_blank" title="<?php esc_html_e('Get updates', 'wpdance'); ?>" >
									<i class="fa fa-google-plus"></i>
								</a>
								<span><?php esc_html_e('Google','wpdance'); ?></span>
							</li>
						</ul>
					</div>		
				</div>
				<div class="wd-partner-content">
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<?php while ( have_posts() ) : the_post();  ?>
							<?php the_content(); ?>
						<?php endwhile; ?>
					</article><!-- End Article -->
				</div>
				<div class="wd-partner-contact">
					<div class="wd-map-google">
						<?php echo $_data_map_google; ?>
					</div>
					<div class="wd-info-contact">
						<p>
							<i class="fa fa-map-marker" aria-hidden="true"></i>
							<span><?php echo esc_attr($_post_config["business_address"]); ?></span>
						</p>
						<p>
							<i class="fa fa-fax" aria-hidden="true"></i>
							<span><?php echo esc_attr($_post_config["business_phone"]); ?></span>
						</p>
						<p>
							<i class="fa fa-clock-o" aria-hidden="true"></i>
							<span><?php echo esc_attr($_post_config["business_time"]); ?></span>
						</p>
					</div>
				</div>
				<div class="wd-partner-count">
					<p class="wd-like">
						<i class="fa fa-thumbs-o-up"></i>
						<span><?php esc_html_e('Like','wpdance'); ?></span>
						<span class="wd-number-like" >00</span>
					</p>
					<p class="wd-useful">
						<i class="fa fa-lightbulb-o"></i>
						<span><?php esc_html_e('Useful','wpdance'); ?></span>
						<span class="wd-number-useful">00</span>
					</p>
					<p class="wd-comment">
						<i class="fa fa-comment"></i>
						<span><?php esc_html_e('Comment','wpdance'); ?></span>
						<span class="wd-number-comment" >00</span>
					</p>
					<p class="wd-report">
						<i class="fa fa-exclamation-triangle"></i>
						<span><?php esc_html_e('Bad Report','wpdance'); ?></span>
						<span class="wd-number-report" >00</span>
					</p>
					<p class="wd-views">
						<i class="fa fa-eye"></i>
						<span><?php esc_html_e('Views','wpdance'); ?></span>
						<span class="wd-number-view" >00</span>
					</p>
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
	<?php if( $is_slider ) : ?> 
		<script type="text/javascript">
			jQuery(document).ready(function($) {
		 
				var time = 7; // time in seconds
		 
				var $progressBar,
				    $bar, 
				    $elem, 
				    isPause, 
				    tick,
				    percentTime;
				var $_this = jQuery('#<?php echo esc_attr( $random_id ); ?>');
				// Init the carousel
				$_this.owlCarousel({
					smartSpeed : 500,				
					loop: true,
					nav: true,
					items: 1,
					onInitialized: progressBar,
					onTranslated: moved,
					onDrag: pauseOnDragging
				});

				// Init progressBar where elem is $("#owl-demo")
				function progressBar(){    
				    // build progress bar elements
				    buildProgressBar();
				    // start counting
				    start();
				}

				// create div#progressBar and div#bar then prepend to $("#owl-demo")
				function buildProgressBar(){
				    $progressBar = $("<div>",{
				        id:"progressBar"
				    });
				    
				    $bar = $("<div>",{
				        id:"bar"
				    });
				    
				    $progressBar.append($bar).prependTo($("#<?php echo esc_attr( $random_id ); ?>"));
				}

				function start() {
				    // reset timer
				    percentTime = 0;
				    isPause = false;
				    // run interval every 0.01 second
				    tick = setInterval(interval, 10);
				};

				function interval() {
				    if(isPause === false){
				        percentTime += 1 / time;
				        
				        $bar.css({
				            width: percentTime+"%"
				        });
				        
				        // if percentTime is equal or greater than 100
				        if(percentTime >= 100){
				            // slide to next item 
				            $("#<?php echo esc_attr( $random_id ); ?>").trigger("next.owl.carousel");
				            percentTime = 0; // give the carousel at least the animation time ;)
				        }
				    }
				}

				// pause while dragging 
				function pauseOnDragging(){
				    isPause = true;
				}

				// moved callback
				function moved(){
					// clear interval
					clearTimeout(tick);
					// start again
					start();
				}
			});
		</script>
		<style>
			.owl-carousel .item {
				height: 200px;
				background: #4DC7A0;
				padding: 1rem;
			}

			#bar {
				width: 0%;
				max-width: 100%;
				height: 1px;
				background: #980b0e;
			}

			#progressBar {
				width: 100%;
				background: #EDEDED;
			}
		</style>	
	<?php endif; ?>
</div><!-- END CONTAINER  -->
<?php get_footer(); ?>