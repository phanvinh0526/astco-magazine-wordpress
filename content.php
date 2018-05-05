<?php
	$show_title 	= get_theme_mod('tvlgiao_wpdance_genneral_blog_show_title','1');
	$show_thumbnail = get_theme_mod('tvlgiao_wpdance_genneral_blog_show_thumbnail','1');
	$show_date 		= get_theme_mod('tvlgiao_wpdance_genneral_blog_show_date','1');
	$show_author 	= get_theme_mod('tvlgiao_wpdance_genneral_blog_show_author','1');
	$show_category 	= get_theme_mod('tvlgiao_wpdance_genneral_blog_show_category','1');
	$show_readmore 	= get_theme_mod('tvlgiao_wpdance_genneral_blog_show_read_more','1');
	$show_excerpt 	= get_theme_mod('tvlgiao_wpdance_genneral_blog_show_excerpt','1');
	$number_excerpt = get_theme_mod('tvlgiao_wpdance_genneral_blog_number_excerpt','20');
?>

<div class="wd-content-post">
	<?php if( has_post_thumbnail() && $show_thumbnail ){ ?>
		<div class="wd-thumbnail-post">
			<?php if(has_post_thumbnail()){ ?>
				<div class="post_thumbnail image">
					<a class="wd-effect-blog" href="<?php the_permalink(); ?>">
						<?php the_post_thumbnail('medium',array('class' => 'thumbnail-effect-1', 'title'=>get_the_title())); ?>
					</a>
				</div>
			<?php } ?>
		</div>
	<?php } ?>
	<div class="wd-infomation-post">

		<div class="wd-date-category">
			<div class="wd-date-post">
				<span><?php the_time('j F, Y'); ?></span>
			</div>
			<div class="wd-category-post">
				<?php custom_list_categories(); ?>
			</div>
		</div>

		<div class="wd-entry-title">
			<h3><a href="<?php the_permalink(); ?>" title="<?php printf( esc_html__( 'Permalink to %s', 'wpdance' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
				<?php echo esc_attr(get_the_title()); ?>
			</a></h3>
		</div>
		<?php
			$str_excerpt = get_the_excerpt();
			$str_excerpt = wp_strip_all_tags($str_excerpt);
			$str_excerpt = strip_shortcodes($str_excerpt);
			$words = explode(' ', $str_excerpt);
		?>
		<?php if( count($words) > $number_excerpt ) : ?>
			<div class="excerpt"><?php tvlgiao_wpdance_the_excerpt_max_words($number_excerpt); ?><a class="readmore_link" href="<?php the_permalink(); ?>"> ...</a></div>
		<?php else: ?>
			<div class="excerpt"><?php tvlgiao_wpdance_the_excerpt_max_words($number_excerpt); ?></div>
		<?php endif; ?>
	</div>
</div>	