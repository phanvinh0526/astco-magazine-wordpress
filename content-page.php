<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Wordpress
 * @since wpdance
**/
?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content bg">
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

</div><!-- #post-## -->