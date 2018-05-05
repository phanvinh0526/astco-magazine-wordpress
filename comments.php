<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.  The actual display of comments is
 * handled by a callback to wpdance_comment which is
 * located in the functions.php file.
 *
 * @package Wordpress
 * @since wpdance
 */
?>
<div id="wd-comments">
	<?php if ( have_comments() ) : ?>
		<div class="wd_title_comment">
			<h3 class="heading-title" id="comments-title">
				<span>
				<?php
					esc_html_e('comment','wpdance');
					$comment_number = get_comments_number();
					echo " (".(($comment_number < 10)?'0'.$comment_number:$comment_number).")";
				?>
				</span>
			</h3>
		</div>
		<!-- Are there comments to navigate through ? -->
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( wp_kses(__( '<span class="meta-nav">&larr;</span> Older Comments', 'wpdance' ),array()) ); ?></div>
				<div class="nav-next"><?php next_comments_link( wp_kses(__( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'wpdance' ),array()) ); ?></div>
			</div> <!-- .navigation -->
		<?php endif; // check for comment navigation ?>
		<ol class="wd-commentlist">
			<?php
				/* Loop through and list the comments. Tell wp_list_comments()
				 * to use wpdance_comment() to format the comments.
				 * If you want to overload this in a child theme then you can
				 * define wpdance_comment() and that will be used instead.
				 * See wpdance_comment() in wpdance/functions.php for more.
				 */
				wp_list_comments( array( 'callback' => 'tvlgiao_wpdance_theme_comment' ) );	
			?>
		</ol>
		<!-- Are there comments to navigate through ? -->
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( wp_kses(__( '<span class="meta-nav">&larr;</span> Older Comments', 'wpdance' ),array()) ); ?></div>
				<div class="nav-next"><?php next_comments_link( wp_kses(__( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'wpdance' ),array()) ); ?></div>
			</div> <!-- .navigation -->
		<?php endif; // check for comment navigation ?>
	<?php else: ?>
		<?php if (!comments_open()) : ?>
			<p class="nocomments"><?php esc_html_e( 'Comments are closed.', 'wpdance' ); ?></p>
		<?php endif; // end ! comments_open() ?>
	<?php endif; // end have_comments() ?>
	<?php tvlgiao_wpdance_comment_form(); ?>
</div>