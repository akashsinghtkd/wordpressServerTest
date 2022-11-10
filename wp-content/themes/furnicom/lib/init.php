<?php
/**
 * furnicom initial setup and constants
 */
function furnicom_setup() {
	// Make theme available for translation
	load_theme_textdomain('furnicom', get_template_directory() . '/lang');

	// Register wp_nav_menu() menus (http://codex.wordpress.org/Function_Reference/register_nav_menus)
	register_nav_menus(array(
		'primary_menu' => esc_html__('Primary Menu', 'furnicom'),
		'leftmenu' => esc_html__('Vertical Menu', 'furnicom'),
		'login_menu' => esc_html__('Login Menu', 'furnicom'),
		'menu_footer' => esc_html__('Footer Menu', 'furnicom'),
		'menu_mobile1' => esc_html__('Menu Mobile 1', 'furnicom'),
	));
	
	
	add_theme_support( 'sw_theme' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( "title-tag" );
	add_theme_support( 'woocommerce' );
	
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	if( furnicom_options()->getCpanelValue( 'product_zoom' ) ) :
		add_theme_support( 'wc-product-gallery-zoom' );
	endif;
	
	// Add post thumbnails (http://codex.wordpress.org/Post_Thumbnails)
	add_theme_support('post-thumbnails');
	// Add post formats (http://codex.wordpress.org/Post_Formats)
	add_theme_support('post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'));
	
	new Furnicom_Menu();
}
add_action('after_setup_theme', 'furnicom_setup');

// add image Latest Blog
add_image_size( 'furnicom_lastest_blog', 292,203, true);
// add image blog detail
add_image_size( 'furnicom_toprated', 90,90, true);
// add image latest news
add_image_size( 'furnicom_latest_news', 585,380, true);
add_image_size( 'furnicom_latest_right', 293,190, true);
// add image blog detail
add_image_size( 'furnicom_countdown', 558,395, true);
// add image multi category
add_image_size( 'furnicom_multi_category', 400,400, true);
