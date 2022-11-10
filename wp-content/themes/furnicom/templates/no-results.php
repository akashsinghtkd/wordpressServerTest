<?php if( furnicom_mobile_check() ) :?>
	<div class="no-result">
		<div class="no-result-image">
			<span class="image">
				<img class="img_logo" alt="404" src="<?php echo get_template_directory_uri(); ?>/assets/img/no-result.png">
			</span>
		</div>
		<h3><?php esc_html_e('no products found','furnicom');?></h3>
		<p><?php esc_html_e('Sorry, but nothing matched your search terms.','furnicom');?><br/><?php  esc_html_e('Please try again with some different keywords.', 'furnicom'); ?></p>
		<button class="back-to"><a href="<?php echo esc_url( home_url('/') ); ?>" title="<?php esc_attr_e( 'back to home', 'furnicom' ) ?>"><?php esc_html_e( "back to home", 'furnicom' )?></a></button>
	</div>
<?php else : ?>
	<div class="alert alert-warning alert-dismissible" role="alert">
			<a class="close" data-dismiss="alert">&times;</a>
			<p><?php esc_html_e('Sorry, no results were found.', 'furnicom'); ?></p>
	</div>
		<div class="no-result">
	</div>
<?php endif; ?>