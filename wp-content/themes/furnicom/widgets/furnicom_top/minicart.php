<?php 
	do_action( 'before' ); 
?>
<?php if( get_option( 'sw_woocatalog_enable' ) === 'no' || !get_option( 'sw_woocatalog_enable' ) ):?>
	<?php if ( (in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) ) { ?>
		<?php
			$furnicom_header  = furnicom_options()->getCpanelValue( 'header_style' );
			if( $furnicom_header == 'style2' ){
				get_template_part( 'woocommerce/minicart-ajax' ); 
			}else{
				get_template_part( 'woocommerce/minicart-ajax-style1' );
			}
			
		?>
	<?php } ?>
<?php endif; ?>