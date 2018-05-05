<?php
/**
*
* @package Wordpress
*
**/
$id_post 		= tvlgiao_wpdance_get_post_by_global();
$_post_config 	= get_post_meta($id_post, '_tvlgiao_wpdance_custom_post_config', true);
$_post_config	= unserialize($_post_config);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'wpdance' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );
		?>
	</div><!-- .entry-content -->
</article><!-- End Article -->