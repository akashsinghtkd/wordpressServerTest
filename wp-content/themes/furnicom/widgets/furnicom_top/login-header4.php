
<?php do_action( 'before' ); ?>
<?php if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) { ?>
<?php global $woocommerce; ?>
<div class="top-login pull-right">
	<?php if ( ! is_user_logged_in() ) {  ?>
	<ul>
		<li>
		    	<?php echo ' <a href="javascript:void(0);" data-toggle="modal" data-target="#login_form_4"><span>'.esc_html__('Login', 'furnicom').'</span></a> '; ?>
 <div class="modal fade" id="login_form_4" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog block-popup-login">
		<a href="javascript:void(0)" title="<?php esc_attr_e( 'Close', 'furnicom' ) ?>" class="close close-login" data-dismiss="modal"><?php esc_html_e( 'Close', 'furnicom' ) ?></a>
		<div class="tt_popup_login"><strong><?php esc_html_e('Sign in Or Register', 'furnicom'); ?></strong></div>
		<?php get_template_part('woocommerce/myaccount/login-form'); ?>
	</div>
</div>
		</li>
	</ul>
	<?php } else{?>
		<div class="div-logined">
			<?php 
				$user_id = get_current_user_id();
				$user_info = get_userdata( $user_id );	
			?>
			<a href="<?php echo wp_logout_url( home_url('/') ); ?>" title="<?php esc_attr_e( 'Logout', 'furnicom' ) ?>" class="logout"><?php esc_html_e('Logout', 'furnicom'); ?></a>
		</div>
	<?php } ?>
</div>
<?php } ?>
