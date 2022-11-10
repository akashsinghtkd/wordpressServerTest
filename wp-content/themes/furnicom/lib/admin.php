<?php

/**
 * Add Theme Options page.
 */
function furnicom_theme_admin_page(){
	add_theme_page(
		esc_html__('Theme Options', 'furnicom'),
		esc_html__('Theme Options', 'furnicom'),
		'manage_options',
		'furnicom_theme_options',
		'furnicom_theme_admin_page_content'
	);
}
add_action('admin_menu', 'furnicom_theme_admin_page', 49);

function furnicom_theme_admin_page_content(){ ?>
	<div class="wrap">
		<h2><?php esc_html_e( 'YA Advanced Options Page', 'furnicom' ); ?></h2>
		<?php do_action( 'furnicom_theme_admin_content' ); ?>
	</div>
<?php
}