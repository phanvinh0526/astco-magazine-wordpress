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
<div class="wd-blog-breadcrumb breadcrumb_default">
	<div class="container">
		<div class="row">
			<div class="wrap-info-title">
				<div class="info-title">
					<div class="blog-slug">
						<div id="crumbs">
							<ul>
								<li><a href="<?php echo esc_url( home_url( '/' )); ?>">Trang Chủ</a></li>  
								<li class="current"><a>Doanh nghiệp của "<?php echo $_GET['key_word']; ?>"</a></li>
								<?php if(isset($_GET['page'])) { ?>
								<li class="current"><a>Trang <?php echo $_GET['page']; ?></a></li>
								<?php } ?>
							</ul>
						</div>        								
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
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
					<?php foreach($business as $busines){ ?>
						<div class="wd-content-post wd-content-business">
							<div class="wd-thumbnail-post">
								<div class="post_thumbnail image">
									<a
										<?php
										if($busines->bus_astco_url != ''){
											echo 'href="'.esc_url($busines->bus_astco_url).'"'; 
										} 
										?>
									>
										<?php if( $busines->bus_logo_url != ''){ ?>
											<img src="<?php echo esc_url($busines->bus_logo_url); ?>">
										<?php }else{ ?>
											<img src="<?php echo esc_url(WDT_IMAGE.'/logo_business.png'); ?>">
										<?php } ?>
									</a>
								</div>
							</div>
							<div class="wd-infomation-post">
								<div class="wd-entry-title">
									<h3>
										<a
											<?php
											if($busines->bus_astco_url != ''){
												echo 'href="'.esc_url($busines->bus_astco_url).'"'; 
											} 
											?>
										title="<?php echo esc_attr($busines->name); ?>" rel="bookmark" >
										
										<?php echo esc_attr($busines->name); ?>
									</a></h3>
								</div>
								<div class="excerpt"><?php echo esc_attr($busines->description); ?></div>
								<div class="wd_description">
									<span><?php echo esc_html__('Đia chỉ: ', 'wpdance')."</span>".esc_attr($busines->street); ?><br/>
									<span><?php echo esc_html__('Giờ mở cửa: ', 'wpdance')."</span>".esc_attr($busines->business_hours); ?>
		                        	<ul class="icons-box list-inline">
		                        		<li><span><?php echo esc_html__('Lĩnh Vực: ', 'wpdance')."</span>".wd_partner_get_category_name($busines->id); ?></li>
		                        		<li><span><?php echo esc_html__('Bán Sĩ/Lẻ: ', 'wpdance')."</span>".wd_partner_get_type_business($busines->id); ?></li>
		                        		<li><span><?php echo esc_html__('Phone: ', 'wpdance')."</span>".esc_attr($busines->telephone_1); ?></li>
		                        		<li><span><?php echo esc_html__('Mobile: ', 'wpdance')."</span>".esc_attr($busines->mobile_1); ?></li>
		                        		<li><span><?php echo esc_html__('Website: ', 'wpdance')."</span>".esc_attr($busines->website); ?></li>
		                        		<li><span><?php echo esc_html__('Email: ', 'wpdance')."</span>".esc_attr($busines->email); ?></li>
		                        	</ul>        	
		                        </div>
		                        <?php if($busines->bus_astco_url != ''){ ?>
		                        	<a href="<?php echo esc_url($busines->bus_astco_url); ?>" class="wd-bus-red">Xem chi tiết</a>
		                        <?php } ?>
							</div>

						</div>
					<?php } // End While ?>
				</div>
				<div class="wd-pagination">
					<?php wd_partner_pagination_business(3,10); ?>
				</div>
			</div>

			<div class="moblie">
				<?php echo do_shortcode('[tvlgiao_wpdance_adv_sidebar_mobile id_category="-1" adv_location="1"]'); ?>
			</div>
			<!-- Right Content -->
			<div class="col-sm-8">
				<?php echo do_shortcode('[tvlgiao_wpdance_adv_sidebar_home id_category="-1" adv_location="1" button_text="10"]'); ?>
			</div>
		</div>
		</div>
	</div>
</div><!-- END CONTAINER  -->
<?php get_footer(); ?>