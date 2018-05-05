<?php
	if(!function_exists ('tvlgiao_wpdance_comment_form')){
		function tvlgiao_wpdance_comment_form( $args = array(), $post_id = null ) {
			global $user_identity, $id;

			if ( null === $post_id )
				$post_id = $id;
			else
				$id = $post_id;

			$commenter = wp_get_current_commenter();
			$req = get_option( 'require_name_email' );
			$aria_req = ( $req ? " aria-required='true'" : '' );
			$defaut = array(
				'comment_author'		=>	esc_html__('Tên*','wpdance'),
				'comment_author_email'	=>	esc_html__('Email*','wpdance'),
				'comment_author_url'	=>	esc_html__('Website','wpdance')	
			);
			extract($defaut,EXTR_OVERWRITE);
			extract(array_filter(array(
				'comment_author'		=>	esc_attr($commenter['comment_author']),
				'comment_author_email'	=>	esc_attr($commenter['comment_author_email']),
				'comment_author_url'	=>	esc_attr($commenter['comment_author_url'])
			)),EXTR_OVERWRITE);
			
			$fields =  array(
				'author' => '<div class="col"><span class="label">'.esc_html__('Họ tên','wpdance').'</span><p class="comment-form-author">' . '<input id="author" class="input-text" name="author" type="text" placeholder="' .$comment_author. '" data-default="'.$defaut['comment_author'].'" size="30"' . $aria_req . ' />' .'</p></div>',
				'email'  => '<div class="col"><span class="label">'.esc_html__('Địa chỉ Email','wpdance').'</span><p class="comment-form-email"><input id="email" class="input-text" name="email" type="text" placeholder="' . $comment_author_email . '" size="30"' . $aria_req . ' data-default="'.$defaut['comment_author_email'].'"/>'.'</p></div>',
				'url'    => '<div class="col"><span class="label">'.esc_html__('Website','wpdance').'</span><p class="comment-form-url"><input id="url" class="input-text" name="url" type="text" placeholder="' . $comment_author_url . '" size="30" data-default="'.$defaut['comment_author_url'].'"/>' .'</p></div>',
			);
			
			if( !is_user_logged_in() ){
				$fields['author'] = '<div class="comment-author-wrapper">'.$fields['author'];
				$fields['url'] = $fields['url'].'</div>';
			}

			$required_text = sprintf( ' ' . wp_kses(__('Các trường hợp bắt buôc được đánh dấu %s','wpdance'), array()), '<span class="required">*</span>' );
			$defaults = array(
				'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
				'comment_field'        => '<span class="label">'.esc_html__('Nội dung bình luận', 'wpdance').'</span><p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="4" aria-required="true"></textarea></p>',
				'must_log_in'          => '<p class="must-log-in">' .  sprintf(__( 'Bạn phải <a href="%s">đăng nhập</a> để bình luận.','wpdance' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
				'logged_in_as'         => '<p class="logged-in-as">' . sprintf(__( '<a href="%1$s" title="Log out of this account">Đăng xuất?</a>','wpdance'), wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
				'comment_notes_before' => '',
				'comment_notes_after'  => '',
				'id_form'              => 'commentform',
				'id_submit'            => 'submit',
				'title_reply'          => esc_html__( 'Bình luận đầu tiên','wpdance' ),
				'title_reply_to'       => esc_html__( 'Trả lời bình luận %s','wpdance'),
				'cancel_reply_link'    => esc_html__( 'Hủy bình luận','wpdance' ),
				'label_submit'         => esc_html__( 'Bình luận','wpdance' ),
				//'label_infomation'	   => esc_html__('Please note comments must be approved before they are published','wpdance')
			);
			
			if( !is_user_logged_in() ){
				$defaults['comment_field'] = '<div class="comment-message-wrapper">'.$defaults['comment_field'].'</div>';
			}

			$args = wp_parse_args( $args, apply_filters( 'comment_form_defaults', $defaults ) );

			?>
				<?php if ( comments_open() ) : ?>
					<?php do_action( 'comment_form_before' ); ?>
					<div id="respond">
						<div class="wd_title_respond"><h3 id="reply-title" class="heading-title"><span><?php comment_form_title( $args['title_reply'], $args['title_reply_to'] ); ?> <small><?php cancel_comment_reply_link( $args['cancel_reply_link'] ); ?></small></span></h3></div>
						
						<!--<p class="info"><?php //echo esc_attr( $args['label_infomation'] ); ?></p>-->
						
						<?php  ?>
						<?php if ( get_option( 'comment_registration' ) && !is_user_logged_in() ) : ?>
							<?php echo esc_attr($args['must_log_in']); ?>
							<?php do_action( 'comment_form_must_log_in_after' ); ?>
						<?php else : ?>
							<form action="<?php echo site_url( '/wp-comments-post.php' ); ?>" method="post" id="<?php echo esc_attr( $args['id_form'] ); ?>">
								<?php do_action( 'comment_form_top' ); ?>
								<?php if ( is_user_logged_in() ) : ?>
									<?php echo apply_filters( 'comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity ); ?>
									<?php do_action( 'comment_form_logged_in_after', $commenter, $user_identity ); ?>
								<?php else : ?>
									<?php echo esc_attr($args['comment_notes_before']); ?>
									<?php
									do_action( 'comment_form_before_fields' );
									foreach ( (array) $args['fields'] as $name => $field ) {
										echo apply_filters( "comment_form_field_{$name}", $field ) . "\n";
									}
									
									?>
								<?php endif; ?>
								<?php echo apply_filters( 'comment_form_field_comment', $args['comment_field'] ); ?>
								<?php echo esc_attr($args['comment_notes_after']); ?>
								<?php if ( !is_user_logged_in() ) do_action( 'comment_form_after_fields' );?>
								<p class="form-submit">
									<button class="button" type="submit" id="<?php echo esc_attr( $args['id_submit'] ); ?>"><span><span><?php echo esc_attr( $args['label_submit'] ); ?></span></span></button>

									<?php comment_id_fields( $post_id ); ?>
								</p>
								<?php do_action( 'comment_form', $post_id ); ?>
							</form>
						<?php endif; ?>
					</div><!-- #respond -->
					<?php do_action( 'comment_form_after' ); ?>
					<script type="text/javascript">
					//<![CDATA[
						jQuery('#commentform').find('input').focus(function() {
							if(jQuery(this).val() == jQuery(this).attr('data-default'))
								jQuery(this).val('');
						}).blur(function() {
							if(jQuery(this).val() == '')
								jQuery(this).val(jQuery(this).attr('data-default'));
						});
						jQuery('#commentform').submit(function() {
							jQuery(this).find('input').each(function(input){
								if(jQuery(this).val() == jQuery(this).attr('data-default'))
									jQuery(this).val('');
							});	
							return true;
						});
					//]]>	
					</script>
				<?php else : ?>
					<?php do_action( 'comment_form_comments_closed' ); ?>
				<?php endif; ?>
			<?php
		} // End Function
	} // End If
?>