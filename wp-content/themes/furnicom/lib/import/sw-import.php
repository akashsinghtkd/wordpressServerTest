<?php 
function sw_import_files() { 
	return array(
		array(
			'import_file_name'          => 'Home Page 1',
			'page_title'				=> 'Home',
			'local_import_file'         => trailingslashit( get_template_directory() ) . 'lib/import/demo-1/data.xml',
			'local_import_widget_file'  => trailingslashit( get_template_directory() ) . 'lib/import/demo-1/widgets.json',
			'local_import_revslider'  	=> array( 
				'slide1' => trailingslashit( get_template_directory() ) . 'lib/import/demo-1/Slider-1.zip' 
			),
			'local_import_options'        => array(
				array(
					'file_path'   => trailingslashit( get_template_directory() ) . 'lib/import/demo-1/theme_options.txt',
					'option_name' => 'furnicom',
				),
			),
			'menu_locate'	=> array(
				'primary_menu' 	=> 'Primary Menu',   
				'leftmenu' 	=> 'Vertical Menu',   
				'login_menu' 	=> 'My Account',   
				'menu_footer' 	=> 'Menu Footer',   
				'menu_mobile1' 	=> 'Menu Mobile 1',   
			),
			'import_preview_image_url'     => get_template_directory_uri() . '/lib/import/demo-1/1.png',
			'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately. This import maybe finish on 10-15 minutes', 'furnicom' ),
			'preview_url'                  => esc_url( 'http://demo.wpthemego.com/themes/sw_furnicom/' ),
		),
	
		array(
			'import_file_name'          => 'Home Page 2',
			'page_title'				=> 'Home 2',
			'local_import_file'         => trailingslashit( get_template_directory() ) . 'lib/import/demo-1/data.xml',
			'local_import_widget_file'  => trailingslashit( get_template_directory() ) . 'lib/import/demo-1/widgets.json',
			'local_import_revslider'  	=> array( 
				'slide1' => trailingslashit( get_template_directory() ) . 'lib/import/demo-2/slider-2.zip' 
			),
			'local_import_options'         => array(
				array(
					'file_path'   => trailingslashit( get_template_directory() ) . 'lib/import/demo-2/theme_options.txt',
					'option_name' => 'furnicom',
				),
			),
			'menu_locate'	=> array(
				'primary_menu' 	=> 'Primary Menu',   
				'leftmenu' 	=> 'Vertical Menu',   
				'login_menu' 	=> 'My Account',   
				'menu_footer' 	=> 'Menu Footer',   
				'menu_mobile1' 	=> 'Menu Mobile 1',   
			),
			'import_preview_image_url'     => get_template_directory_uri() . '/lib/import/demo-2/2.png',
			'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately. This import maybe finish on 10-15 minutes', 'furnicom' ),
			'preview_url'                  => esc_url( 'http://demo.wpthemego.com/themes/sw_furnicom/home-2/?header_style=style2&scheme=blue' ),
		),
		
		array(
			'import_file_name'          => 'Home Page 3',
			'page_title'				=> 'Home 3',
			'local_import_file'         => trailingslashit( get_template_directory() ) . 'lib/import/demo-1/data.xml',
			'local_import_widget_file'  => trailingslashit( get_template_directory() ) . 'lib/import/demo-1/widgets.json',
			'local_import_revslider'  		 => array( 
				'slide1' => trailingslashit( get_template_directory() ) . 'lib/import/demo-3/slider-3.zip' 
			),
			'local_import_options'         => array(
				array(
					'file_path'   => trailingslashit( get_template_directory() ) . 'lib/import/demo-3/theme_options.txt',
					'option_name' => 'furnicom',
				),
			),
			'menu_locate'	=> array(
				'primary_menu' 	=> 'Primary Menu',   
				'leftmenu' 	=> 'Vertical Menu',   
				'login_menu' 	=> 'My Account',   
				'menu_footer' 	=> 'Menu Footer',   
				'menu_mobile1' 	=> 'Menu Mobile 1',   
			),
			'import_preview_image_url'     => get_template_directory_uri() . '/lib/import/demo-3/3.png',
			'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately. This import maybe finish on 10-15 minutes', 'furnicom' ),
			'preview_url'                  => esc_url( 'http://demo.wpthemego.com/themes/sw_furnicom/home-3/?header_style=style3' ),
		),
		
		array(
			'import_file_name'          => 'Home Page 4',				
			'page_title'				=> 'Home 4',
			'local_import_file'         => trailingslashit( get_template_directory() ) . 'lib/import/demo-1/data.xml',
			'local_import_widget_file'  => trailingslashit( get_template_directory() ) . 'lib/import/demo-1/widgets.json',
				'local_import_revslider'  		 => array( 
					'slide1' => trailingslashit( get_template_directory() ) . 'lib/import/demo-4/slider-4.zip' 
				),
				'local_import_options'         => array(
				array(
					'file_path'   => trailingslashit( get_template_directory() ) . 'lib/import/demo-4/theme_options.txt',
					'option_name' => 'furnicom',
				),
			),
			'menu_locate'	=> array(
				'primary_menu' 	=> 'Primary Menu',   
				'leftmenu' 	=> 'Vertical Menu',   
				'login_menu' 	=> 'My Account',   
				'menu_footer' 	=> 'Menu Footer',   
				'menu_mobile1' 	=> 'Menu Mobile 1',   
			),
			'import_preview_image_url'     => get_template_directory_uri() . '/lib/import/demo-4/4.png',
			'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately. This import maybe finish on 10-15 minutes', 'furnicom' ),
			'preview_url'                  => esc_url( 'http://demo.wpthemego.com/themes/sw_furnicom/home-4/?header_style=style4' ),
		),
		
		array(
			'import_file_name'          => 'Home Page 5',
			'page_title'			   	=> 'Home 5',
			'local_import_file'         => trailingslashit( get_template_directory() ) . 'lib/import/demo-1/data.xml',
			'local_import_widget_file'  => trailingslashit( get_template_directory() ) . 'lib/import/demo-1/widgets.json',
			'local_import_revslider'  	=> array( 
				'slide1' => trailingslashit( get_template_directory() ) . 'lib/import/demo-5/slider-5.zip',
			),
			'local_import_options'         => array(
				array(
					'file_path'   => trailingslashit( get_template_directory() ) . 'lib/import/demo-5/theme_options.txt',
					'option_name' => 'furnicom',
				),
			),
			'menu_locate'	=> array(
				'primary_menu' 	=> 'Primary Menu',   
				'leftmenu' 	=> 'Vertical Menu',   
				'login_menu' 	=> 'My Account',   
				'menu_footer' 	=> 'Menu Footer',   
				'menu_mobile1' 	=> 'Menu Mobile 1',   
			),
			'import_preview_image_url'     => get_template_directory_uri() . '/lib/import/demo-5/5.png',
			'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately. This import maybe finish on 10-15 minutes', 'furnicom' ),
			'preview_url'                  => esc_url( 'http://demo.wpthemego.com/themes/sw_furnicom/home-5/?header_style=style5' ),
		),
		
		array(
			'import_file_name'          => 'Home Page 6',
			'page_title'				=> 'Home 6',
			'local_import_file'         => trailingslashit( get_template_directory() ) . 'lib/import/demo-1/data.xml',
			'local_import_widget_file'  => trailingslashit( get_template_directory() ) . 'lib/import/demo-1/widgets.json',
			'local_import_revslider'  	=> array( 
				'slide1' => trailingslashit( get_template_directory() ) . 'lib/import/demo-6/slide-home6.zip',
			),
			'local_import_options'         => array(
				array(
					'file_path'   => trailingslashit( get_template_directory() ) . 'lib/import/demo-6/theme_options.txt',
					'option_name' => 'furnicom',
				),
			),
			'menu_locate'	=> array(
				'primary_menu' 	=> 'Primary Menu',   
				'leftmenu' 	=> 'Vertical Menu',   
				'login_menu' 	=> 'My Account',   
				'menu_footer' 	=> 'Menu Footer',   
				'menu_mobile1' 	=> 'Menu Mobile 1',   
			),
			'import_preview_image_url'     => get_template_directory_uri() . '/lib/import/demo-6/6.png',
			'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately. This import maybe finish on 10-15 minutes', 'furnicom' ),
			'preview_url'                  => esc_url( 'http://demo.wpthemego.com/themes/sw_furnicom/home-6/?header_style=style6&footer_style=style2&scheme=roman' ),
		),
		
		array(
			'import_file_name'          => 'Home Page 7',
			'page_title'				=> 'Home 7',
			'local_import_file'         => trailingslashit( get_template_directory() ) . 'lib/import/demo-1/data.xml',
			'local_import_widget_file'  => trailingslashit( get_template_directory() ) . 'lib/import/demo-1/widgets.json',
			'local_import_revslider'  	=> array( 
				'slide1' => trailingslashit( get_template_directory() ) . 'lib/import/demo-7/slide-home7.zip',
			),
			'local_import_options'         => array(
				array(
					'file_path'   => trailingslashit( get_template_directory() ) . 'lib/import/demo-7/theme_options.txt',
					'option_name' => 'furnicom',
				),
			),
			'menu_locate'	=> array(
				'primary_menu' 	=> 'Primary Menu',   
				'leftmenu' 	=> 'Vertical Menu',   
				'login_menu' 	=> 'My Account',   
				'menu_footer' 	=> 'Menu Footer',   
				'menu_mobile1' 	=> 'Menu Mobile 1',   
			),
			'import_preview_image_url'     => get_template_directory_uri() . '/lib/import/demo-7/7.png',
			'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately. This import maybe finish on 10-15 minutes', 'furnicom' ),
			'preview_url'                  => esc_url( 'http://demo.wpthemego.com/themes/sw_furnicom/home-8/?header_style=style8&footer_style=style1&scheme=darkblue' ),
    ),
		
		array(
			'import_file_name'          => 'Home Page 8',
			'page_title'				=> 'Home 8',
			'local_import_file'         => trailingslashit( get_template_directory() ) . 'lib/import/demo-1/data.xml',
			'local_import_widget_file'  => trailingslashit( get_template_directory() ) . 'lib/import/demo-1/widgets.json',
			'local_import_revslider'  	=> array( 
				'slide1' => trailingslashit( get_template_directory() ) . 'lib/import/demo-8/highlight-carousel8.zip',
			),
			'local_import_options'      => array(
				array(
					'file_path'   => trailingslashit( get_template_directory() ) . 'lib/import/demo-8/theme_options.txt',
					'option_name' => 'furnicom',
				),
			),
			'menu_locate'	=> array(
				'primary_menu' 	=> 'Primary Menu',   
				'leftmenu' 	=> 'Vertical Menu',   
				'login_menu' 	=> 'My Account',   
				'menu_footer' 	=> 'Menu Footer',   
				'menu_mobile1' 	=> 'Menu Mobile 1',   
			),
			'import_preview_image_url'     => get_template_directory_uri() . '/lib/import/demo-8/8.png',
			'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately. This import maybe finish on 10-15 minutes', 'furnicom' ),
			'preview_url'                  => esc_url( 'http://demo.wpthemego.com/themes/sw_furnicom/home-8/?header_style=style8&footer_style=style1&scheme=darkblue' ),
		),
		
		array(
			'import_file_name'          => 'Home Page 9',
			'page_title'				=> 'Home 9',
			'local_import_file'         => trailingslashit( get_template_directory() ) . 'lib/import/demo-1/data.xml',
			'local_import_widget_file'  => trailingslashit( get_template_directory() ) . 'lib/import/demo-1/widgets.json',
			'local_import_revslider'  	=> array( 
				'slide1' => trailingslashit( get_template_directory() ) . 'lib/import/demo-9/slider-9.zip',
			),
			'local_import_options'      => array(
				array(
					'file_path'   => trailingslashit( get_template_directory() ) . 'lib/import/demo-9/theme_options.txt',
					'option_name' => 'furnicom',
				),
			),
			'menu_locate'	=> array(
				'primary_menu' 	=> 'Primary Menu',   
				'leftmenu' 	=> 'Vertical Menu',   
				'login_menu' 	=> 'My Account',   
				'menu_footer' 	=> 'Menu Footer',   
				'menu_mobile1' 	=> 'Menu Mobile 1',   
			),
			'import_preview_image_url'     => get_template_directory_uri() . '/lib/import/demo-9/9.png',
			'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately. This import maybe finish on 10-15 minutes', 'furnicom' ),
			'preview_url'                  => esc_url( 'http://demo.wpthemego.com/themes/sw_furnicom/home-9/?header_style=style9&footer_style=style5&scheme=orange3' ),
		),
		
		array(
			'import_file_name'          => 'Home Page 10',
			'page_title'				=> 'Home 10',
			'local_import_file'         => trailingslashit( get_template_directory() ) . 'lib/import/demo-1/data.xml',
			'local_import_widget_file'  => trailingslashit( get_template_directory() ) . 'lib/import/demo-1/widgets.json',
			'local_import_revslider'  	=> array( 
				'slide1' => trailingslashit( get_template_directory() ) . 'lib/import/demo-10/slider-10.zip',
			),
			'local_import_options'      => array(
				array(
					'file_path'   => trailingslashit( get_template_directory() ) . 'lib/import/demo-10/theme_options.txt',
					'option_name' => 'furnicom',
				),
			),
			'menu_locate'	=> array(
				'primary_menu' 	=> 'Primary Menu',   
				'leftmenu' 	=> 'Vertical Menu',   
				'login_menu' 	=> 'My Account',   
				'menu_footer' 	=> 'Menu Footer',   
				'menu_mobile1' 	=> 'Menu Mobile 1',   
			),
			'import_preview_image_url'     => get_template_directory_uri() . '/lib/import/demo-10/10.png',
			'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately. This import maybe finish on 10-15 minutes', 'furnicom' ),
			'preview_url'                  => esc_url( 'http://demo.wpthemego.com/themes/sw_furnicom/home-10/?header_style=style10&footer_style=style4&scheme=default' ),
		),		
	);
}
add_filter( 'pt-ocdi/import_files', 'sw_import_files' );