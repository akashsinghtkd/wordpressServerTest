<?php
		$furnicom_footer_style = furnicom_options()->getCpanelValue('footer_style');
		$furnicom_copyright_text = furnicom_options()->getCpanelValue('footer_copyright');
?>
<footer class="footer theme-clearfix footer-<?php echo esc_attr($furnicom_footer_style); ?>" >
	<div class="container theme-clearfix" >
		<div class="footer-top">
			<div class="row">
				<?php if (is_active_sidebar_Furnicom('footer1')){ ?>
									
						<?php dynamic_sidebar('footer1'); ?>
					
				<?php } ?>
			</div>
		</div>
	</div>
	<?php if (is_active_sidebar_Furnicom('above-footer')){ ?>
		<div class="sidebar-above-footer theme-clearfix">
			   <div class="container theme-clearfix">	   
				<?php dynamic_sidebar('above-footer'); ?>
				</div>
		</div>
	<?php } ?>
	<div class="footer-bottom">
		<div class="container">
			<div class="row">
				<div class="col-bottom">
					<?php if (is_active_sidebar_Furnicom('footer-4')){ ?>
										
							<?php dynamic_sidebar('footer-4'); ?>
						
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
	<div class="copyright theme-clearfix">
		<div class="container clearfix">
				<div class="copyright-text">
					<?php if( $furnicom_copyright_text == '' ) : ?>
						<p>&copy;<?php echo date('Y'); ?><?php esc_html_e(' SW Furnicom ', 'furnicom'); ?><?php esc_html_e('Demo Store. All Rights Reserved. Designed by ','furnicom'); ?><a class="mysite" href="http://wpthemego.com/"><?php esc_html_e('WPThemeGo.com','furnicom');?></a>.</p>
					<?php else : ?>
						<p><?php echo wp_kses( $furnicom_copyright_text, array( 'a' => array( 'href' => array(), 'title' => array(), 'class' => array() ), 'p' => array()  ) ) ; ?></p>
					<?php endif; ?>
				</div>
		</div>
	</div>
</footer>