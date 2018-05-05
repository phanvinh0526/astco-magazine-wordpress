<?php

if (! function_exists( 'tvlgiao_wpdance_tini_account' ) ) {
	function tvlgiao_wpdance_tini_account($class = "", $class_show_title = ""){
		$_actived = apply_filters( 'active_plugins', get_option( 'active_plugins' )  );
		if ( !in_array( "woocommerce/woocommerce.php", $_actived ) ) {
			return '';
		}
		global $woocommerce;
		$myaccount_page_id 		= get_option( 'woocommerce_myaccount_page_id' );
		if ( $myaccount_page_id ) {
		 	$myaccount_page_url = get_permalink( $myaccount_page_id );
		}else{
			$myaccount_page_url = "";
		}		
		ob_start();
		$_user_logged = is_user_logged_in();
		
		?>
			
		<div class="wd_tini_account_wrapper <?php echo esc_attr($class) ?> <?php echo esc_attr($class_show_title) ?>">
			<div class="wd_tini_account_control">
				<a href="<?php echo esc_url($myaccount_page_url);?>" title="<?php esc_html_e('My Account','wpdance');?>">
					<?php if(is_user_logged_in()): ?>	
						<span><?php esc_html_e('My Account','wpdance');?></span>
					<?php else:?>
						<span><?php esc_html_e('Sing Up / Login','wpdance');?></span>
					<?php endif;?>		
				</a>	
			</div>
			<div class="form_drop_down drop_down_container <?php echo esc_url($_user_logged) ? "hidden" : "";?>">
				<?php if( !$_user_logged ): ?>
					<div class="form_wrapper">				
						<div class="form_wrapper_body">
							<h3><?php esc_html_e( 'My Account', 'wpdance' ); ?></h3>
							<form method="post" class="login" id="loginform-custom" >
			
								<?php do_action( 'woocommerce_login_form_start' ); ?>
								
								<p class="login-username">
									<label for="username"><?php esc_html_e( 'User or Email', 'wpdance' ); ?><span class="required">*</span></label>
									<input type="text" size="20" class="input" id="username" name="username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>">
								</p>
								<p class="login-password">
									<label for="password"><?php esc_html_e( 'Password', 'wpdance' ); ?> <span class="required">*</span></label>
									<input type="password" size="20" value="" class="input" id="password" name="password">
								</p>
								
								<div class="clear"></div>
								
								<?php do_action( 'woocommerce_login_form' ); ?>											
								
								<p class="login-submit">
									<?php wp_nonce_field( 'woocommerce-login' ); ?>
									<input type="submit" class="secondary_button" name="login" value="<?php esc_html_e( 'Login', 'wpdance' ); ?>" />
								</p>
								
								<?php do_action( 'woocommerce_login_form_end' ); ?>
								
							</form>
						</div>
						<div class="form_wrapper_footer">
							<span><?php esc_html_e('or New to Goodly? ','wpdance');?></span><span><a class="link_color_hover" href="<?php echo esc_url($myaccount_page_url); ?>"><?php esc_html_e('Register','wpdance'); ?></a></span>
						</div>
					</div>	
				<?php else: ?>	
					<span class="my_account_wrapper"><a href="<?php echo esc_url($url = admin_url( 'profile.php', 'https' )); ?>" title="<?php esc_html_e('My Account','wpdance');?>"><?php esc_html_e('My Account','wpdance');?></a></span>
					<span class="logout_wrapper"><a href="<?php echo esc_url(wp_logout_url( get_permalink())); ?>" title="<?php esc_html_e('Logout','wpdance');?>"><?php esc_html_e('Logout','wpdance');?></a></span>
				<?php endif; ?>
			</div>
		</div>
		<?php 
		$tini_account = ob_get_clean();
		return $tini_account;
	}
}

if ( ! function_exists( 'tvlgiao_wpdance_update_tini_account' ) ) {
	function tvlgiao_wpdance_update_tini_account() {
		die($_tini_account_html = tvlgiao_wpdance_tini_account());
	}
}



function tvlgiao_wpdance_login_fail( $username ) {
	if(isset( $_REQUEST['redirect_to']) && ($_REQUEST['redirect_to'] == admin_url())){
		return;
	}
	if(isset( $_REQUEST['redirect_to']) && strripos($_REQUEST['redirect_to'],'wp-admin') > 0 ){
		return;
	}
	$_actived = apply_filters( 'active_plugins', get_option( 'active_plugins' )  );
	if ( !in_array( "woocommerce/woocommerce.php", $_actived ) ) {
		return 'Woocommerce Plugin do not active';
	}
	global $woocommerce;
	$myaccount_page_id = get_option( 'woocommerce_myaccount_page_id' );
	if ( $myaccount_page_id ) {
		$myaccount_page_url = get_permalink( $myaccount_page_id );
		wp_safe_redirect( $myaccount_page_url );
		exit;
	}		
}
add_action( 'wp_login_failed', 'tvlgiao_wpdance_login_fail' );  // hook failed login
add_action( 'wp_ajax_update_tini_account', 'tvlgiao_wpdance_update_tini_account');
add_action( 'wp_ajax_nopriv_update_tini_account', 'tvlgiao_wpdance_update_tini_account');

?>
