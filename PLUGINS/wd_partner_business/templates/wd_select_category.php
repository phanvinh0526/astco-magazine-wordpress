<?php
/*
	Template Name: Advance Search Business
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
								<li class="current"><a>Tìm Doanh Nghiệp</a></li>
							</ul>
						</div>        								
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="main-content" class="main-content wd-archive-custom wd-advanced-search-return">
	<div class="container">
		<div class="row">
		<div class="row">
			<!-- Content Single Post -->
			<div class="col-sm-16">
				<h2> Xin vui lòng cho biết ngành kinh danh của doanh nghiệp</h2>
				<div class="wd-select-cat">
                    <?php foreach($categores as $category){ ?>
                    	<div class="wd-item-cate">
                    		<?php if($category->cat_icon == "") { ?>
                    			<img width="50px" height="50px" src="<?php echo esc_url(WDT_IMAGE.'/'.$category->cat_id.'.png'); ?>">
                    		<?php }else{ ?>
                    			<img width="50px" height="50px" src="<?php echo esc_url($category->cat_icon); ?>">
                    		<?php } ?>
                    		<a href="<?php echo esc_url( home_url( '/' ).'?search=advanced-search&cateid='.$category->cat_id ); ?>"><?php echo $category->cat_name; ?></a>
                    	</div>
					<?php }; ?>
				    
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