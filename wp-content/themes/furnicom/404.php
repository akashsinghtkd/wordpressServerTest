<?php get_template_part('header'); ?>
<div class="wrap-404">
	<div class="container">
		<div class="row">
            <div class="col-lg-12 col-md-12">
				<div class="col-1-wrapper">
					<div class="std">
						<div class="wrapper_404page clear-fix">
							<div class="error-code">
								<span class="erro-key">
									<img class="img_logo" alt="404" src="<?php echo get_template_directory_uri(); ?>/assets/img/img-404.png">
								</span>
							</div>
							<div class="block-main">
								<div class="block-inner">
									<div class="mess-code"><h3><?php echo esc_html__( "WE CAN'T FIND THE PAGE", "furnicom" ) . '<br/>'. esc_html__( "YOU'RE LOOKING FOR", "furnicom" ) ?></h3></div>
									<div class="second-block">
										<i class="fa fa-home"></i><a href="<?php echo esc_url( home_url('/') ); ?>" class="btn-404 back2home" title="<?php esc_attr_e( "Back to home", 'furnicom' )?>"><?php esc_html_e( "GO TO HOMEPAGE", 'furnicom' )?></a>
									</div>
								</div>
							</div>
							<div class="clear">&nbsp;</div>
							<script>
							function goBack() {
								window.history.back()
							}
							</script>
						</div>
					</div>   
				</div>
			</div>
        </div>
	</div>
</div>
<?php get_template_part('footer'); ?>