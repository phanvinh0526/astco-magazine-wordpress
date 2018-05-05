<div class="wd-content_item_quote">		
	<div class="content">
		<div class="content_infor">
			<?php the_excerpt() ?>
		</div>
		<div class="content_author">
			<?php the_author_posts_link(); ?>
		</div>
		<div class="readmore">
			<a class="readmore_link" href="<?php the_permalink(); ?>"><?php esc_html_e('read more','wpdance') ?></a>
		</div>
	</div>
</div>