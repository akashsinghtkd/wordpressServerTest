<?php
/**
 * Enqueue scripts and stylesheets
 *
 */

function furnicom_scripts() {	
	$scheme = furnicom_options()->getCpanelValue('scheme');
	$furnicom_direction = furnicom_options()->getCpanelValue('direction');
	if ($scheme){
		$app_css = get_template_directory_uri() . '/css/app-'.$scheme.'.css';
	} else {
		$app_css = get_template_directory_uri() . '/css/app-default.css';
	}

	/* register script */

	wp_register_script('bootstrap_js', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), null, true);
	wp_register_script('gallery_load_js', get_template_directory_uri() . '/js/load-image.min.js', array('bootstrap_js'), null, true);
	wp_register_script('bootstrap_gallery_js', get_template_directory_uri() . '/js/bootstrap-image-gallery.min.js', array('gallery_load_js'), null, true);
	wp_register_script('plugins_js', get_template_directory_uri() . '/js/plugins.js', array('jquery'), null, true);	

	
	wp_dequeue_style('shortcode_css');
	/* enqueue script & style */
	wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), null);
	if( is_rtl() || $furnicom_direction = 'rtl' ){
		wp_enqueue_style('rtl_css', get_template_directory_uri() . '/css/rtl.css', array(), null);
	}
	wp_enqueue_style('slick_slider_css', get_template_directory_uri() . '/css/slick.css', array(), null);
	wp_enqueue_style('lightbox_css', get_template_directory_uri() . '/css/jquery.fancybox.css', array(), null);
	wp_enqueue_style('furnicom_theme_css', $app_css, array(), null);
	wp_enqueue_style('custom_css', get_template_directory_uri() . '/style.css', array(), null);
	wp_enqueue_style('furnicom_theme_responsive_css', get_template_directory_uri() . '/css/app-responsive.css', array(), null);
	wp_enqueue_script('modernizr', get_template_directory_uri() . '/js/modernizr-2.6.2.min.js', false, null, false);
	wp_enqueue_script('lightbox_js', get_template_directory_uri() . '/js/jquery.fancybox.pack.js', array('jquery'), null, true);
	wp_enqueue_script('slick_slider_js',get_template_directory_uri().'/js/slick.min.js',array(),null,true);
	wp_enqueue_script('isotope_script', get_template_directory_uri() . '/js/isotope.js', array(), null, true);
	wp_enqueue_script('quantity_js', get_template_directory_uri() . '/js/wc-quantity-increment.min.js', array('jquery'), null, true);
	wp_enqueue_script('furnicom_theme_js', get_template_directory_uri() . '/js/main.js', array('bootstrap_js', 'plugins_js'), null, true);
	
	/* Load style.css from child theme */
	if (is_child_theme()) {
		wp_enqueue_style('furnicom_theme_child_css', get_stylesheet_uri(), false, null);
	}

	if (is_single() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}		
	
	if( furnicom_options()-> getCpanelValue( 'menu_type' ) == 'mega' ){
		wp_enqueue_script('megamenu_js', get_template_directory_uri() . '/js/megamenu.js', array(), null, true);
	}
	
	/*
	** Dequeue and enqueue css, js mobile
	*/
	if( furnicom_mobile_check() ) :
		if( is_front_page() || is_home() ) :
			wp_dequeue_script( 'prettyPhoto' );
			wp_dequeue_script( 'prettyPhoto-init' );
			wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
		endif;
		wp_dequeue_style( 'jquery-colorbox' );
		wp_dequeue_style( 'colorbox' );
		wp_dequeue_script( 'jquery-colorbox' );
		wp_dequeue_script( 'megamenu_js' );
		wp_dequeue_script( 'moneyjs' );
		wp_dequeue_script( 'preload_script' );
		wp_dequeue_script( 'accountingjs' );
		wp_dequeue_script( 'yith-woocompare-main' );
	endif;
	
	if ( !is_admin() ){
		wp_enqueue_script('modernizr', get_template_directory_uri() . '/js/modernizr-2.6.2.min.js', false, null, false);
		
			$translation_text = array(
			'cart_text' 		 => esc_html__( 'Add To Cart', 'furnicom' ),
			'compare_text' 	 => esc_html__( 'Add To Compare', 'furnicom' ),
			'wishlist_text'  => esc_html__( 'Add To WishList', 'furnicom' ),
			'quickview_text' => esc_html__( 'QuickView', 'furnicom' ),
		);	
		wp_localize_script( 'furnicom_custom_js', 'custom_text', $translation_text );
		wp_enqueue_script( 'furnicom_custom_js', get_template_directory_uri() . '/js/custom_text.js', array(), null, true );
	}
	/*
	** Maintaince Mode
	*/
	if( !is_user_logged_in() && furnicom_options()->getCpanelValue('maintaince_enable') ){ 
		$output = '';
		$countdown = furnicom_options()->getCpanelValue('maintaince_date');
		if( $countdown != '' ):
			$output .= 'jQuery(function($){
			"use strict";
			function furnicom_check_height(){
				var W_height = $( window ).height();
				if( W_height > 767) {
					setTimeout(function(){
						var cm_height = $( window ).height();
						var cm_target = $( "body > .body-wrapper" );
						cm_target.css( "height", cm_height );
					}, 1000);
				}
			}
			$(window).on( "load", function(){
				furnicom_check_height();
			});
				$(document).ready(function(){ 
					var end_date = new Date( "'. esc_js( $countdown ) .'" ).getTime()/1000;
					$("#countdown-container").ClassyCountdown({
						theme: "white", 
						end: end_date, 
						now: $.now()/1000,
						labelsOptions: {
							lang: {
							days: "Days",
							hours: "Hours",
							minutes: "Mins",
							seconds: "Secs"
							},
							style: "font-size: 0.5em;"
						},
					});
				});
			});';
		endif;
		
		wp_enqueue_style('countdown_css', get_template_directory_uri() . '/css/jquery.classycountdown.min.css', array(), null);
		wp_enqueue_style('maintaince_css', get_template_directory_uri() . '/css/style-maintaince.css', array(), null);
		wp_register_script('countdown',get_template_directory_uri(). '/js/maintaince/jquery.classycountdown.min.js', array(), null, true);
		wp_enqueue_script( 'knob', get_template_directory_uri(). '/js/maintaince/jquery.knob.js', array(), null, true);	
		wp_enqueue_script( 'throttle',get_template_directory_uri() . '/js/maintaince/jquery.throttle.js', array(), null, true);	
		wp_enqueue_script( 'countdown' );
		wp_add_inline_script( 'countdown', $output );
	}
	
	/*
	** Dequeue some css and jquery mobile responsive
	*/
	
	global $sw_detect;
	if( !empty( $sw_detect ) && $sw_detect->isMobile() && !$sw_detect->isTablet() ){
		wp_dequeue_style( 'jquery-colorbox' );
		wp_dequeue_style( 'colorbox' );
		wp_dequeue_script( 'jquery-colorbox' );
		wp_dequeue_script( 'megamenu_js' );
		wp_dequeue_script( 'yith-woocompare-main' );
	}
}
add_action('wp_enqueue_scripts', 'furnicom_scripts', 100);
