<?php
/***** Active Plugin ********/
require_once( get_template_directory().'/lib/class-tgm-plugin-activation.php' );

add_action( 'tgmpa_register', 'furnicom_register_required_plugins' );
function furnicom_register_required_plugins() {
    $plugins = array(
        array(
            'name'               => 'Woocommerce', 
            'slug'               => 'woocommerce', 
            'required'           => true, 
            'version'            => '5.6.0'
        ),
        array(
            'name'               => 'SW Testimonial Slider', 
            'slug'               => 'sw-testimonial-slider', 
            'source'             => get_template_directory_uri() . '/lib/plugins/sw-testimonial-slider.zip', 
            'required'           => true, 
			'version'            => '1.1.1'
        ),
        array(
            'name'               => 'Revslider', 
            'slug'               => 'revslider', 
            'source'             => esc_url('https://demo.wpthemego.com/modules/revslider.zip'), 
            'required'           => true, 
			'version'            => '6.5.7'
        ),
        array(
            'name'               => 'SW Portfolio', 
            'slug'               => 'sw_portfolio', 
            'source'             => get_template_directory_uri() . '/lib/plugins/sw_portfolio.zip', 
            'required'           => true, 
			'version'            => '1.1.0'
        ),
        array(
            'name'               => 'SW Woocommerce', 
            'slug'               => 'sw_woocommerce', 
            'source'             => get_template_directory_uri() . '/lib/plugins/sw_woocommerce.zip', 
            'required'           => true,
			'version'            => '1.3.3'
        ),
		 array(
            'name'               => 'Sw Product Bundles', 
            'slug'               => 'sw-product-bundles', 
            'required'           => false,
        ),
        array(
            'name'               => 'Sw Woocatalog', 
            'slug'               => 'sw-woocatalog', 
            'source'             => get_template_directory_uri() . '/lib/plugins/sw-woocatalog.zip', 
            'required'           => true, 
        ),

        array(
            'name'               => 'One Click Demo Import', 
            'slug'               => 'one-click-demo-import', 
            'source'             => get_template_directory_uri() . '/lib/plugins/one-click-demo-import.zip', 
            'required'           => true, 
        ),

        array(
            'name'               => 'SW Our Team', 
            'slug'               => 'sw_ourteam', 
            'source'             => get_template_directory_uri() . '/lib/plugins/sw_ourteam.zip', 
            'required'           => true, 
			'version'            => '1.1.0'
        ),
        array(
            'name'               => 'SW Ajax Woocommerce Search', 
            'slug'               => 'sw_ajax_woocommerce_search', 
            'source'             => get_template_directory_uri() . '/lib/plugins/sw_ajax_woocommerce_search.zip', 
            'required'           => true, 
			'version'            => '1.2.0'
        ),
        array(
            'name'               => 'SW WooSwatches', 
            'slug'               => 'sw_wooswatches', 
            'source'             => get_template_directory_uri() . '/lib/plugins/sw_wooswatches.zip', 
            'required'           => true, 
			'version'            => '1.2.0'
        ),
        array(
            'name'               => 'SW Core', 
            'slug'               => 'sw_core', 
            'source'             => get_template_directory_uri() . '/lib/plugins/sw_core.zip', 
            'required'           => true, 
			'version'            => '1.1.4'
        ),
				
        array(
            'name'               => 'Sw Responsive Post Slider', 
            'slug'               => 'sw-responsive-post-slider', 
            'source'             => get_template_directory_uri() . '/lib/plugins/sw-responsive-post-slider.zip', 
            'required'           => true, 
			'version'            => '1.1.1'
        ),
        array(
            'name'               => 'Visual Composer', 
            'slug'               => 'js_composer', 
            'source'             => esc_url('https://demo.wpthemego.com/modules/js_composerv6.6.zip'),   
            'required'           => true, 
			'version'            => '6.7.0'
        ),      
        array(
            'name'               => 'MailChimp for WordPress Lite',
            'slug'               => 'mailchimp-for-wp',
            'required'           => false,
        ),
        array(
            'name'               => 'Contact Form 7',
            'slug'               => 'contact-form-7',
            'required'           => false,
        ),      
        array(
            'name'               => 'YITH Woocommerce Compare',
            'slug'               => 'yith-woocommerce-compare',
            'required'           => false,
        ),
        array(
            'name'               => 'YITH Woocommerce Wishlist',
            'slug'               => 'yith-woocommerce-wishlist',
            'required'           => false,
        ), 

    );
    $config = array();
		
		if( furnicom_options()->getCpanelValue('developer_mode') ): 
			$plugins[] = array(
				'name'               => esc_html__( 'Less Compile', 'furnicom' ), 
				'slug'               => 'lessphp', 
				'source'             => get_template_directory_uri() . '/lib/plugins/lessphp.zip', 
				'required'           => true, 
				'version'            => '4.0.1'
			);
		endif;		
		
    tgmpa( $plugins, $config );

}
add_action( 'vc_before_init', 'Furnicom_vcSetAsTheme' );
function Furnicom_vcSetAsTheme() {
    vc_set_as_theme();
}