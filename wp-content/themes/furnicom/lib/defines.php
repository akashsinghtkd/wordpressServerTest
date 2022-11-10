<?php
$lib_dir = trailingslashit( str_replace( '\\', '/', dirname(__FILE__) ) );
$lib_abs = trailingslashit( str_replace( '\\', '/', ABSPATH ) );

if( !defined('Furnicom_DIR') ){
	define( 'Furnicom_DIR', $lib_dir );
}

if( !defined('Furnicom_URL') ){
	define( 'Furnicom_URL', site_url( str_replace( $lib_abs, '', $lib_dir ) ) );
}

if ( !defined( 'ICL_LANGUAGE_CODE' ) && !defined('FURNICOM') ){
	define( 'FURNICOM', 'furnicom' );
}else{
	define( 'FURNICOM', 'furnicom'.ICL_LANGUAGE_CODE );
}

if( !defined('Furnicom_OPTIONS_URL') ){
	define( 'Furnicom_OPTIONS_URL', trailingslashit( get_template_directory_uri() ) . 'lib/options/' ); 
}

defined('FURNICOM') or die;

if (!isset($content_width)) { $content_width = 940; }

define("PRODUCT_TYPE","product");
define("PRODUCT_DETAIL_TYPE","product_detail");

require_once( get_template_directory().'/lib/options.php' );
function Furnicom_Options_Setup(){
	global $furnicom_options, $options, $options_args;

	$options = array();

	$options[] = array(
			'title' => esc_html__('General', 'furnicom'),
			'desc' => wp_kses(__('<p class="description">The theme allows to build your own styles right out of the backend without any coding knowledge. Start your own color scheme by selecting one of 8 predefined schemes. Upload new logo and favicon or get their URL.</p>', 'furnicom'),'p'),
			//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
			//You dont have to though, leave it blank for default.
			'icon' => Furnicom_URL.'/options/img/glyphicons/glyphicons_019_cogwheel.png',
			//Lets leave this as a blank section, no options just some intro text set above.
			'fields' => array(					

					array(
							'id' => 'bg_img',
							'type' => 'upload',
							'title' => esc_html__('Background Image', 'furnicom'),
							'sub_desc' => '',
							'std' => ''
							),
					
					array(
							'id' => 'bg_repeat',
							'type' => 'checkbox',
							'title' => esc_html__('Background Repeat', 'furnicom'),
							'sub_desc' => '',
							'desc' => '',
							'std' => '1'// 1 = on | 0 = off
							),

					array(
							'id' => 'favicon',
							'type' => 'upload',
							'title' => esc_html__('Favicon Icon', 'furnicom'),
							'sub_desc' => esc_html__( 'Use the Upload button to upload the new favicon and get URL of the favicon', 'furnicom' ),
							'std' => get_template_directory_uri().'/assets/img/favicon.ico'
						),		
					
					array(
							'id' => 'sitelogo',
							'type' => 'upload',
							'title' => esc_html__('Logo Image', 'furnicom'),
							'sub_desc' => esc_html__( 'Use the Upload button to upload the new logo and get URL of the logo', 'furnicom' ),
							'std' => get_template_directory_uri().'/assets/img/logo-default.png'
						),
						
						array(
							'id' => 'bg_breadcrumb',
							'type' => 'upload',
							'title' => esc_html__('Breadcrumb Background', 'furnicom'),
							'sub_desc' => esc_html__( 'Use upload button to upload custom background for breadcrumb.', 'furnicom' ),
							'std' => ''
						),
				)
		);
		
	$options[] = array(
			'title' => esc_html__('Schemes', 'furnicom'),
			'desc' => wp_kses( __('<p class="description">Custom color scheme for theme. Unlimited color that you can choose.</p>', 'furnicom'), array( 'p' => array( 'class' => array() ) ) ),
			//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
			//You dont have to though, leave it furnicom for default.
			'icon' => Furnicom_URL.'/options/img/glyphicons/glyphicons_163_iphone.png',
			//Lets leave this as a furnicom section, no options just some intro text set above.
			'fields' => array(		
				array(
					'id' => 'scheme',
					'type' => 'radio_img',
					'title' => esc_html__('Color Scheme', 'furnicom'),
					'sub_desc' => esc_html__( 'Select one of 8 predefined schemes', 'furnicom' ),
					'desc' => '',
					'options' => array(
									'default' => array('title' => 'Default', 'img' => get_template_directory_uri().'/assets/img/default.png'),
									'orange' => array('title' => 'Orange', 'img' => get_template_directory_uri().'/assets/img/orange.png'),
									'blue' => array('title' => 'Blue', 'img' => get_template_directory_uri().'/assets/img/blue.png'),
									'darkblue' => array('title' => 'Dark Blue', 'img' => get_template_directory_uri().'/assets/img/darkblue.png'),
									'red' => array('title' => 'Red', 'img' => get_template_directory_uri().'/assets/img/red.png'),
									'cyan' => array('title' => 'Cyan', 'img' => get_template_directory_uri().'/assets/img/cyan.png'),
									'roman' => array('title' => 'Roman', 'img' => get_template_directory_uri().'/assets/img/roman.png'),
									'orange2' => array('title' => 'Orange2', 'img' => get_template_directory_uri().'/assets/img/orange2.png'),
									'orange3' => array('title' => 'Orange3', 'img' => get_template_directory_uri().'/assets/img/orange3.png'),
										),//Must provide key => value(array:title|img) pairs for radio options
					'std' => 'default'
				),
					
				array(
					'id' => 'custom_color',
					'title' => esc_html__( 'Enable Custom Color', 'furnicom' ),
					'type' => 'checkbox',
					'sub_desc' => esc_html__( 'Check this field to enable custom color and when you update your theme, custom color will not lose.', 'furnicom' ),
					'desc' => '',
					'std' => '0'
				),
				
				array(
					'id' => 'developer_mode',
					'title' => esc_html__( 'Developer Mode', 'furnicom' ),
					'type' => 'checkbox',
					'sub_desc' => esc_html__( 'Turn on/off compile less to css and custom color', 'furnicom' ),
					'desc' => '',
					'std' => '0'
				),
				
				array(
					'id' => 'scheme_color',
					'type' => 'color',
					'title' => esc_html__('Color', 'furnicom'),
					'sub_desc' => esc_html__('Select main custom color.', 'furnicom'),
					'std' => ''
				),						
			)
	);

	$options[] = array(
			'title' => esc_html__('Layout', 'furnicom'),
			'desc' => wp_kses(__('<p class="description">Furnicom Framework comes with a layout setting that allows you to build any number of stunning layouts and apply theme to your entries.</p>', 'furnicom'),'p'),
			//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
			//You dont have to though, leave it blank for default.
			'icon' => Furnicom_URL.'/options/img/glyphicons/glyphicons_319_sort.png',
			//Lets leave this as a blank section, no options just some intro text set above.
			'fields' => array(
					array(
							'id' => 'layout',
							'type' => 'select',
							'title' => esc_html__('Box Layout', 'furnicom'),
							'sub_desc' => esc_html__( 'Select Layout Box or Wide', 'furnicom' ),
							'options' => array(
									'full' => 'Wide',
									'boxed' => 'Boxed'
									),
							'std' => 'full'
						),
					
					array(
							'id' => 'bg_box_img',
							'type' => 'upload',
							'title' => esc_html__('Background Box Image', 'furnicom'),
							'sub_desc' => '',
							'std' => ''
						),
					array(
							'id' => 'sidebar_left_expand',
							'type' => 'select',
							'title' => esc_html__('Left Sidebar Expand', 'furnicom'),
							'options' => array(
									'2' => '2/12',
									'3' => '3/12',
									'4' => '4/12',
									'5' => '5/12', 
									'6' => '6/12',
									'7' => '7/12',
									'8' => '8/12',
									'9' => '9/12',
									'10' => '10/12',
									'11' => '11/12',
									'12' => '12/12'
								),
							'std' => '3',
							'sub_desc' => esc_html__( 'Select width of left sidebar.', 'furnicom' ),
						),
					
					array(
							'id' => 'sidebar_right_expand',
							'type' => 'select',
							'title' => esc_html__('Right Sidebar Expand', 'furnicom'),
							'options' => array(
									'2' => '2/12',
									'3' => '3/12',
									'4' => '4/12',
									'5' => '5/12',
									'6' => '6/12',
									'7' => '7/12',
									'8' => '8/12',
									'9' => '9/12',
									'10' => '10/12',
									'11' => '11/12',
									'12' => '12/12'
								),
							'std' => '3',
							'sub_desc' => esc_html__( 'Select width of right sidebar medium desktop.', 'furnicom' ),
						),
						array(
							'id' => 'sidebar_left_expand_md',
							'type' => 'select',
							'title' => esc_html__('Left Sidebar Medium Desktop Expand', 'furnicom'),
							'options' => array(
									'2' => '2/12',
									'3' => '3/12',
									'4' => '4/12',
									'5' => '5/12',
									'6' => '6/12',
									'7' => '7/12',
									'8' => '8/12',
									'9' => '9/12',
									'10' => '10/12',
									'11' => '11/12',
									'12' => '12/12'
								),
							'std' => '4',
							'sub_desc' => esc_html__( 'Select width of left sidebar medium desktop.', 'furnicom' ),
						),
					array(
							'id' => 'sidebar_right_expand_md',
							'type' => 'select',
							'title' => esc_html__('Right Sidebar Medium Desktop Expand', 'furnicom'),
							'options' => array(
									'2' => '2/12',
									'3' => '3/12',
									'4' => '4/12',
									'5' => '5/12',
									'6' => '6/12',
									'7' => '7/12',
									'8' => '8/12',
									'9' => '9/12',
									'10' => '10/12',
									'11' => '11/12',
									'12' => '12/12'
								),
							'std' => '4',
							'sub_desc' => esc_html__( 'Select width of right sidebar.', 'furnicom' ),
						),
						array(
							'id' => 'sidebar_left_expand_sm',
							'type' => 'select',
							'title' => esc_html__('Left Sidebar Tablet Expand', 'furnicom'),
							'options' => array(
									'2' => '2/12',
									'3' => '3/12',
									'4' => '4/12',
									'5' => '5/12',
									'6' => '6/12',
									'7' => '7/12',
									'8' => '8/12',
									'9' => '9/12',
									'10' => '10/12',
									'11' => '11/12',
									'12' => '12/12'
								),
							'std' => '4',
							'sub_desc' => esc_html__( 'Select width of left sidebar tablet.', 'furnicom' ),
						),
					array(
							'id' => 'sidebar_right_expand_sm',
							'type' => 'select',
							'title' => esc_html__('Right Sidebar Tablet Expand', 'furnicom'),
							'options' => array(
									'2' => '2/12',
									'3' => '3/12',
									'4' => '4/12',
									'5' => '5/12',
									'6' => '6/12',
									'7' => '7/12',
									'8' => '8/12',
									'9' => '9/12',
									'10' => '10/12',
									'11' => '11/12',
									'12' => '12/12'
								),
							'std' => '4',
							'sub_desc' => esc_html__( 'Select width of right sidebar tablet.', 'furnicom' ),
						),				
				)
		);
	
	$options[] = array(
				'title' => esc_html__('Mobile Layout', 'furnicom'),
				'desc' => wp_kses( __('<p class="description">Furnicom Framework comes with a mobile setting home page layout.</p>', 'furnicom'), array( 'p' => array( 'class' => array() ) ) ),
				//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
				//You dont have to though, leave it shoppystore for default.
				'icon' => Furnicom_URL.'/options/img/glyphicons/glyphicons_163_iphone.png',
				//Lets leave this as a shoppystore section, no options just some intro text set above.
				'fields' => array(				
					array(
						'id' => 'mobile_enable',
						'type' => 'checkbox',
						'title' => esc_html__('Enable Mobile Layout', 'furnicom'),
						'sub_desc' => '',
						'desc' => '',
						'std' => '1'// 1 = on | 0 = off
					),
					array(
					'id' => 'mobile_logo',
					'type' => 'upload',
					'title' => esc_html__('Logo Mobile Image', 'furnicom'),
					'sub_desc' => esc_html__( 'Use the Upload button to upload the new mobile logo', 'furnicom' ),
					'std' => get_template_directory_uri().'/assets/img/logo-default.png'
					),
					array(
						'id' => 'mobile_content',
						'type' => 'pages_select',
						'title' => esc_html__('Mobile Layout Content', 'furnicom'),
						'sub_desc' => esc_html__('Select content index for this mobile layout', 'furnicom'),
						'std' => ''
					),
					array(
						'id' => 'mobile_header_style',
						'type' => 'select',
						'title' => esc_html__('Header Mobile Style', 'furnicom'),
						'sub_desc' => esc_html__('Select header mobile style', 'furnicom'),
						'options' => array(
								'mstyle1'  => esc_html__( 'Style 1', 'furnicom' ),
								'mstyle2'  => esc_html__( 'Style 2', 'furnicom' ),
						),
						'std' => 'style1'
					),
					array(
						'id' => 'mobile_footer_style',
						'type' => 'select',
						'title' => esc_html__('Footer Mobile Style', 'furnicom'),
						'sub_desc' => esc_html__('Select footer mobile style', 'furnicom'),
						'options' => array(
								'mstyle1'  => esc_html__( 'Style 1', 'furnicom' ),
								'mstyle2'  => esc_html__( 'Style 2', 'furnicom' ),
						),
						'std' => 'style1'
					)				
				)
		);
		
	$options[] = array(
		'title' => esc_html__('Header & Footer', 'furnicom'),
			'desc' => wp_kses(__('<p class="description">Furnicom Framework comes with a header setting that allows you to build style header and footer.</p>', 'furnicom'),'p'),
			//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
			//You dont have to though, leave it blank for default.
			'icon' => Furnicom_URL.'/options/img/glyphicons/glyphicons_336_read_it_later.png',
			//Lets leave this as a blank section, no options just some intro text set above.
			'fields' => array(
				 array(
							'id' => 'header_style',
							'type' => 'select',
							'title' => esc_html__('Header Style', 'furnicom'),
							'sub_desc' => 'Select Header style',
							'options' => array(
									'style1'  => 'Style 1',
									'style2'  => 'Style 2',
									'style3'  => 'Style 3',
									'style4'  => 'Style 4',
									'style5'  => 'Style 5',
									'style6'  => 'Style 6',
									'style7'  => 'Style 7',
									'style8'  => 'Style 8',
									'style9'  => 'Style 9',
									'style10'  => 'Style 10',
									),
							'std' => 'style1'
						),
				array(
							'id' => 'footer_style',
							'type' => 'select',
							'title' => __('Footer Style', 'furnicom'),
							'sub_desc' => __( 'Select Footer style', 'furnicom' ),
							'options' => array(
							'style1' => 'Style 1',
							'style2'  => 'Style 2',
							'style3'  => 'Style 3',
							'style4'  => 'Style 4',	
							),
							'std' => 'style1'
				),
				
				array(
					'id' => 'footer_copyright',
					'type' => 'editor',
					'sub_desc' => '',
					'title' => esc_html__( 'Copyright text', 'furnicom' )
				),	
			)
	);
	$options[] = array(
			'title' => esc_html__('Navbar Options', 'furnicom'),
			'desc' => wp_kses(__('<p class="description">If you got a big site with a lot of sub menus we recommend using a mega menu. Just select the dropbox to display a menu as mega menu or dropdown menu.</p>', 'furnicom'),'p'),
			//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
			//You dont have to though, leave it blank for default.
			'icon' => Furnicom_URL.'/options/img/glyphicons/glyphicons_157_show_lines.png',
			//Lets leave this as a blank section, no options just some intro text set above.
			'fields' => array(
				array(
						'id' => 'menu_type',
						'type' => 'select',
						'title' => esc_html__('Menu Type', 'furnicom'),
						'options' => array( 'dropdown' => 'Dropdown Menu', 'mega' => 'Mega Menu' ),
						'std' => 'mega'
					),
				array(
						'id' => 'menu_location',
						'type' => 'menu_location_multi_select',
						'title' => esc_html__('Theme Location', 'furnicom'),
						'sub_desc' => esc_html__( 'Select theme location to active mega menu.', 'furnicom' ),
						'std' => 'primary_menu'
					),
				array(
						'id' => 'sticky_menu',
						'type' => 'checkbox',
						'title' => esc_html__('Active sticky menu', 'furnicom'),
						'sub_desc' => '',
						'desc' => '',
						'std' => '0'// 1 = on | 0 = off
					),
			)
		);
	$options[] = array(
		'title' => esc_html__('Blog Options', 'furnicom'),
		'desc' => wp_kses(__('<p class="description">Select layout in blog listing page.</p>', 'furnicom'),'p'),
		//all the esc_html__ are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'icon' => Furnicom_URL.'/options/img/glyphicons/glyphicons_319_sort.png',
		//Lets leave this as a blank section, no options just some intro text set above.
		'fields' => array(
				array(
						'id' => 'sidebar_blog',
						'type' => 'select',
						'title' => esc_html__('Sidebar Blog Layout', 'furnicom'),
						'options' => array(
								'full' => 'Full Layout',		
								'left_sidebar'	=> 'Left Sidebar',
								'right_sidebar' =>'Right Sidebar',
								 'lr_sidebar'   =>'Left Right Sidebar'						
						),
						'std' => 'left_sidebar',
						'sub_desc' => esc_html__( 'Select style sidebar blog', 'furnicom' ),
					),
					array(
						'id' => 'blog_layout',
						'type' => 'select',
						'title' => esc_html__('Layout blog', 'furnicom'),
						'options' => array(
								'list'	=> 'List Layout',
								'grid' => 'Grid Layout'								
						),
						'std' => 'list',
						'sub_desc' => esc_html__( 'Select style layout blog', 'furnicom' ),
					),
					array(
						'id' => 'blog_column',
						'type' => 'select',
						'title' => esc_html__('Blog column', 'furnicom'),
						'options' => array(								
								'2' => '2 columns',
								'3' => '3 columns',
								'4' => '4 columns'								
							),
						'std' => '2',
						'sub_desc' => esc_html__( 'Select style number column blog', 'furnicom' ),
					),
			)
	);	
	$options[] = array(
		'title' => esc_html__('Product Options', 'furnicom'),
		'desc' => wp_kses(__('<p class="description">Select layout in product listing page.</p>', 'furnicom' ),'p'),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'icon' => Furnicom_URL.'/options/img/glyphicons/glyphicons_319_sort.png',
		//Lets leave this as a blank section, no options just some intro text set above.
		'fields' => array(
			array(
				'id' => 'info_typo1',
				'type' => 'info',
				'title' => esc_html( 'Product Categories Config', 'furnicom' ),
				'desc' => '',
				'class' => 'furnicom-opt-info'
				),
			
			array(
				'id' => 'product_colcat_large',
				'type' => 'select',
				'title' => esc_html__('Product Category Listing column Desktop', 'furnicom'),
				'options' => array(
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',							
					),
				'std' => '4',
				'sub_desc' => esc_html__( 'Select number of column on Desktop Screen', 'furnicom' ),
				),

			array(
				'id' => 'product_colcat_medium',
				'type' => 'select',
				'title' => esc_html__('Product Listing Category column Medium Desktop', 'furnicom'),
				'options' => array(
					'2' => '2',
					'3' => '3',
					'4' => '4',	
					'5' => '5',
					'6' => '6',
					),
				'std' => '3',
				'sub_desc' => esc_html__( 'Select number of column on Medium Desktop Screen', 'furnicom' ),
				),

			array(
				'id' => 'product_colcat_sm',
				'type' => 'select',
				'title' => esc_html__('Product Listing Category column Tablet', 'furnicom'),
				'options' => array(
					'2' => '2',
					'3' => '3',
					'4' => '4',	
					'5' => '5',
					'6' => '6'
					),
				'std' => '2',
				'sub_desc' => esc_html__( 'Select number of column on Tablet Screen', 'furnicom' ),
				),
			
			array(
				'id' => 'info_typo1',
				'type' => 'info',
				'title' => esc_html( 'Product General Config', 'furnicom' ),
				'desc' => '',
				'class' => 'furnicom-opt-info'
				),
				
			array(
				'id' => 'product_banner',
				'title' => esc_html__( 'Select Banner', 'furnicom' ),
				'type' => 'select',
				'sub_desc' => '',
				'options' => array(
					'' 			=> esc_html__( 'Use Background Breadcrumb', 'furnicom' ),
					'listing' 	=> esc_html__( 'Use Category Product Image', 'furnicom' ),
					),
				'std' => '',
				),

			array(
				'id' => 'product_listing_banner',
				'type' => 'upload',
				'title' => esc_html__('Shop Breadcrumb Background', 'furnicom'),
				'sub_desc' => esc_html__( 'Use the Upload button to upload background breadcrumb for shop page', 'furnicom' ),
				'std' => ''
				),
			array(
				'id' => 'link_banner_shop',
				'type' => 'text',
				'title' => esc_html__('Link Of Banner Product', 'furnicom'),
				'sub_desc' => esc_html__( 'Use the link for the banner product listing', 'furnicom' ),
				'std' => '',
				),
			array(
				'id' => 'product_col_large',
				'type' => 'select',
				'title' => esc_html__('Product Listing column Desktop', 'furnicom'),
				'options' => array(
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',							
					),
				'std' => '3',
				'sub_desc' => esc_html__( 'Select number of column on Desktop Screen', 'furnicom' ),
				),

			array(
				'id' => 'product_col_medium',
				'type' => 'select',
				'title' => esc_html__('Product Listing column Medium Desktop', 'furnicom'),
				'options' => array(
					'2' => '2',
					'3' => '3',
					'4' => '4',	
					'5' => '5',
					'6' => '6',
					),
				'std' => '2',
				'sub_desc' => esc_html__( 'Select number of column on Medium Desktop Screen', 'furnicom' ),
				),

			array(
				'id' => 'product_col_sm',
				'type' => 'select',
				'title' => esc_html__('Product Listing column Tablet', 'furnicom'),
				'options' => array(
					'2' => '2',
					'3' => '3',
					'4' => '4',	
					'5' => '5',
					'6' => '6'
					),
				'std' => '2',
				'sub_desc' => esc_html__( 'Select number of column on Tablet Screen', 'furnicom' ),
				),

			array(
				'id' => 'sidebar_product',
				'type' => 'select',
				'title' => esc_html__('Sidebar Product Layout', 'furnicom'),
				'options' => array(
					'left'	=> esc_html__( 'Left Sidebar', 'furnicom' ),
					'full' 	=> esc_html__( 'Full Layout', 'furnicom' ),		
					'right' => esc_html__( 'Right Sidebar', 'furnicom' )
					),
				'std' => 'left',
				'sub_desc' => esc_html__( 'Select style sidebar product', 'furnicom' ),
				),

			array(
				'id' => 'product_quickview',
				'title' => esc_html__( 'Quickview', 'furnicom' ),
				'type' => 'checkbox',
				'sub_desc' => '',
				'desc' => esc_html__( 'Turn On/Off Product Quickview', 'furnicom' ),
				'std' => '1'
				),
			
			array(
				'id' => 'product_listing_countdown',
				'title' => esc_html__( 'Enable Countdown', 'furnicom' ),
				'type' => 'checkbox',
				'sub_desc' => '',
				'desc' => esc_html__( 'Turn On/Off Product Countdown on product listing', 'furnicom' ),
				'std' => '1'
				),
			
			
			array(
				'id' => 'product_number',
				'type' => 'text',
				'title' => esc_html__('Product Listing Number', 'furnicom'),
				'sub_desc' => esc_html__( 'Show number of product in listing product page.', 'furnicom' ),
				'std' => 12
				),
			
			array(
				'id' => 'newproduct_time',
				'title' => esc_html__( 'New Product', 'furnicom' ),
				'type' => 'number',
				'sub_desc' => '',
				'desc' => esc_html__( 'Set day for the new product label from the date publish product.', 'furnicom' ),
				'std' => '1'
				),
			
			array(
				'id' => 'info_typo1',
				'type' => 'info',
				'title' => esc_html( 'Product Single Config', 'furnicom' ),
				'desc' => '',
				'class' => 'furnicom-opt-info'
				),
			
			array(
				'id' => 'sidebar_product_detail',
				'type' => 'select',
				'title' => esc_html__('Sidebar Product Single Layout', 'furnicom'),
				'options' => array(
					'left'	=> esc_html__( 'Left Sidebar', 'furnicom' ),
					'full' 	=> esc_html__( 'Full Layout', 'furnicom' ),		
					'right' => esc_html__( 'Right Sidebar', 'furnicom' )
					),
				'std' => 'left',
				'sub_desc' => esc_html__( 'Select style sidebar product single', 'furnicom' ),
				),			
			
			array(
				'id' => 'product_zoom',
				'title' => esc_html__( 'Product Zoom', 'furnicom' ),
				'type' => 'checkbox',
				'sub_desc' => '',
				'desc' => esc_html__( 'Turn On/Off image zoom when hover on single product', 'furnicom' ),
				'std' => '1'
				),		

			array(
				'id' => 'product_single_countdown',
				'title' => esc_html__( 'Enable Countdown Single', 'furnicom' ),
				'type' => 'checkbox',
				'sub_desc' => '',
				'desc' => esc_html__( 'Turn On/Off Product Countdown on product single', 'furnicom' ),
				'std' => '1'
			),
			
		)
);		
	$options[] = array(
		'title' => esc_html__('Portfolio Options', 'furnicom'),
		'desc' => wp_kses(__('<p class="description">Select layout in Portfolio listing page.</p>', 'furnicom'),'p'),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'icon' => Furnicom_URL.'/options/img/glyphicons/glyphicons_319_sort.png',
		//Lets leave this as a blank section, no options just some intro text set above.
		'fields' => array(
				array(
					'id' => 'p_col_large',
					'type' => 'select',
					'title' => esc_html__('Portfolio column Desktop', 'furnicom'),
					'options' => array(
							'1' => '1',
							'2' => '2',
							'3' => '3',
							'4' => '4',							
							'6' => '6'							
						),
					'std' => '4',
					'sub_desc' => esc_html__( 'Select number of column on Desktop Screen', 'furnicom' ),
				),
				array(
					'id' => 'p_col_medium',
					'type' => 'select',
					'title' => esc_html__('Portfolio column Medium Desktop', 'furnicom'),
					'options' => array(
							'1' => '1',
							'2' => '2',
							'3' => '3',
							'4' => '4',							
							'6' => '6'							
						),
					'std' => '3',
					'sub_desc' => esc_html__( 'Select number of column on Medium Desktop Screen', 'furnicom' ),
				),
				array(
					'id' => 'p_col_sm',
					'type' => 'select',
					'title' => esc_html__('Portfolio column Tablet', 'furnicom'),
					'options' => array(
							'1' => '1',
							'2' => '2',
							'3' => '3',
							'4' => '4',							
							'6' => '6'							
						),
					'std' => '3',
					'sub_desc' => esc_html__( 'Select number of column on Tablet Screen', 'furnicom' )
				),
				array(
					'id' => 'p_col_xs',
					'type' => 'select',
					'title' => esc_html__('Portfolio column Smartphone', 'furnicom'),
					'options' => array(
							'1' => '1',
							'2' => '2',
							'3' => '3',
							'4' => '4',							
							'6' => '6'								
						),
					'std' => '2',
					'sub_desc' => esc_html__( 'Select number of column on Smartphone Screen', 'furnicom' ),
				)
			)
	);	
	$options[] = array(
			'title' => esc_html__('Typography', 'furnicom'),
			'desc' => wp_kses(__('<p class="description">Change the font style of your blog, custom with Google Font.</p>', 'furnicom'),'p'),
			//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
			//You dont have to though, leave it blank for default.
			'icon' => Furnicom_URL.'/options/img/glyphicons/glyphicons_151_edit.png',
			//Lets leave this as a blank section, no options just some intro text set above.
			'fields' => array(
				array(
					'id' => 'info_typo1',
					'type' => 'info',
					'title' => esc_html( 'Global Typography', 'furnicom' ),
					'desc' => '',
					'class' => 'furnicom-opt-info'
				),

				array(
					'id' => 'google_webfonts',
					'type' => 'google_webfonts',
					'title' => esc_html__('Use Google Webfont', 'furnicom'),
					'sub_desc' => esc_html__( 'Insert font style that you actually need on your webpage.', 'furnicom' ), 
					'std' => ''
				),

				array(
					'id' => 'webfonts_weight',
					'type' => 'multi_select',
					'sub_desc' => esc_html__( 'For weight, see Google Fonts to custom for each font style.', 'furnicom' ),
					'title' => esc_html__('Webfont Weight', 'furnicom'),
					'options' => array(
						'100' => '100',
						'200' => '200',
						'300' => '300',
						'400' => '400',
						'500' => '500',
						'600' => '600',
						'700' => '700',
						'800' => '800',
						'900' => '900'
					),
					'std' => ''
				),

				array(
					'id' => 'info_typo2',
					'type' => 'info',
					'title' => esc_html( 'Header Tag Typography', 'furnicom' ),
					'desc' => '',
					'class' => 'furnicom-opt-info'
				),

				array(
					'id' => 'header_tag_font',
					'type' => 'google_webfonts',
					'title' => esc_html__('Header Tag Font', 'furnicom'),
					'sub_desc' => esc_html__( 'Select custom font for header tag ( h1...h6 )', 'furnicom' ), 
					'std' => ''
				),

				array(
					'id' => 'info_typo2',
					'type' => 'info',
					'title' => esc_html( 'Main Menu Typography', 'furnicom' ),
					'desc' => '',
					'class' => 'furnicom-opt-info'
				),

				array(
					'id' => 'menu_font',
					'type' => 'google_webfonts',
					'title' => esc_html__('Main Menu Font', 'furnicom'),
					'sub_desc' => esc_html__( 'Select custom font for main menu', 'furnicom' ), 
					'std' => ''
				),
				
				array(
					'id' => 'info_typo2',
					'type' => 'info',
					'title' => esc_html( 'Custom Typography', 'furnicom' ),
					'desc' => '',
					'class' => 'furnicom-opt-info'
				),

				array(
					'id' => 'custom_font',
					'type' => 'google_webfonts',
					'title' => esc_html__('Custom Font', 'furnicom'),
					'sub_desc' => esc_html__( 'Select custom font for custom class', 'furnicom' ), 
					'std' => ''
				),
				
				array(
					'id' => 'custom_font_class',
					'title' => esc_html__( 'Custom Font Class', 'furnicom' ),
					'type' => 'text',
					'sub_desc' => esc_html__( 'Put custom class to this field. Each class separated by commas.', 'furnicom' ),
					'desc' => '',
					'std' => '',
				),
			)
		);

	$options[] = array(
			'title' => esc_html__('Social share', 'furnicom'),
			'desc' => wp_kses(__('<p class="description">Social sharing is ready to use and built in. You can share your pages with just a click and your post can go to their wall and you can gain vistitors from Social Networks. Check Social Networks that you want to use.</p>', 'furnicom'),'p'),
			//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
			//You dont have to though, leave it blank for default.
			'icon' => Furnicom_URL.'/options/img/glyphicons/glyphicons_222_share.png',
			//Lets leave this as a blank section, no options just some intro text set above.
			'fields' => array(
					array(
							'id' => 'social-share',
							'title' => esc_html__( 'Social share', 'furnicom' ),
							'type' => 'checkbox',
							'sub_desc' => '',
							'desc' => '',
							'std' => '0'
						),
					array(
							'id' => 'social-share-fb',
							'title' => esc_html__( 'Facebook', 'furnicom' ),
							'type' => 'checkbox',
							'sub_desc' => '',
							'desc' => '',
							'std' => '1',
						),
					array(
							'id' => 'social-share-tw',
							'title' => esc_html__( 'Twitter', 'furnicom' ),
							'type' => 'checkbox',
							'sub_desc' => '',
							'desc' => '',
							'std' => '1',
						),
					array(
							'id' => 'social-share-in',
							'title' => esc_html__( 'Linked_in', 'furnicom' ),
							'type' => 'checkbox',
							'sub_desc' => '',
							'desc' => '',
							'std' => '1',
						),
					array(
							'id' => 'social-share-go',
							'title' => esc_html__( 'Google+', 'furnicom' ),
							'type' => 'checkbox',
							'sub_desc' => '',
							'desc' => '',
							'std' => '1',
						),
				)
		);
		
	$options[] = array(
		'title' => esc_html__('Maintaincece Mode', 'furnicom'),
		'desc' => wp_kses( __('<p class="description">Enable and config for Maintaincece mode.</p>', 'furnicom'), array( 'p' => array( 'class' => array() ) ) ),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it furnicom for default.
		'icon' => Furnicom_URL.'/options/img/glyphicons/glyphicons_083_random.png',
		//Lets leave this as a furnicom section, no options just some intro text set above.
		'fields' => array(
				array(
					'id' => 'maintaince_enable',
					'title' => esc_html__( 'Enable Maintaincece Mode', 'furnicom' ),
					'type' => 'checkbox',
					'sub_desc' => esc_html__( 'Turn on/off Maintaince mode on this website', 'furnicom' ),
					'desc' => '',
					'std' => '0'
				),
				
				array(
					'id' => 'maintaince_background',
					'title' => esc_html__( 'Maintaince Background', 'furnicom' ),
					'type' => 'upload',
					'sub_desc' => esc_html__( 'Choose maintance background image', 'furnicom' ),
					'desc' => '',
					'std' => get_template_directory_uri().'/assets/img/maintaince/bg-main.jpg'
				),
				
				array(
					'id' => 'maintaince_content',
					'title' => esc_html__( 'Maintaince Content', 'furnicom' ),
					'type' => 'editor',
					'sub_desc' => esc_html__( 'Change text of maintaince mode', 'furnicom' ),
					'desc' => '',
					'std' => ''
				),
				
				array(
					'id' => 'maintaince_date',
					'title' => esc_html__( 'Maintaince Date', 'furnicom' ),
					'type' => 'date',
					'sub_desc' => esc_html__( 'Put date to this field to show countdown date on maintaince mode.', 'furnicom' ),
					'desc' => '',
					'placeholder' => 'mm/dd/yy',
					'std' => ''
				),
				
				array(
					'id' => 'maintaince_form',
					'title' => esc_html__( 'Maintaince Form', 'furnicom' ),
					'type' => 'text',
					'sub_desc' => esc_html__( 'Put shortcode form to this field and it will be shown on maintaince mode frontend.', 'furnicom' ),
					'desc' => '',
					'std' => ''
				),
				
			)
	);

	$options[] = array(
			'title' => esc_html__('Advanced', 'furnicom'),
			'desc' => wp_kses(__('<p class="description">Custom advanced with Cpanel, Widget advanced, Developer mode </p>', 'furnicom'),'p'),
			//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
			//You dont have to though, leave it blank for default.
			'icon' => Furnicom_URL.'/options/img/glyphicons/glyphicons_083_random.png',
			//Lets leave this as a blank section, no options just some intro text set above.
			'fields' => array(
					array(
							'id' => 'show_cpanel',
							'title' => esc_html__( 'Show cPanel', 'furnicom' ),
							'type' => 'checkbox',
							'sub_desc' => esc_html__( 'Turn on/off Cpanel', 'furnicom' ),
							'desc' => '',
							'std' => ''
						),
					array(
							'id' => 'widget-advanced',
							'title' => esc_html__('Widget Advanced', 'furnicom'),
							'type' => 'checkbox',
							'sub_desc' => esc_html__( 'Turn on/off Widget Advanced', 'furnicom' ),
							'desc' => '',
							'std' => '1'
						),				
					array(
							'id' => 'back_active',
							'type' => 'checkbox',
							'title' => esc_html__('Back to top', 'furnicom'),
							'sub_desc' => '',
							'desc' => '',
							'std' => '1'// 1 = on | 0 = off
							),								
					array(
							'id' => 'direction',
							'type' => 'select',
							'title' => esc_html__('Direction', 'furnicom'),
							'options' => array( 'ltr' => 'Left to Right', 'rtl' => 'Right to Left' ),
							'std' => 'ltr'
						),
					
					array(
						'id' => 'advanced_css',
						'type' => 'textarea',
						'sub_desc' => esc_html__( 'Insert your own CSS into this block. This overrides all default styles located throughout the theme', 'furnicom' ),
						'title' => esc_html__( 'Custom CSS', 'furnicom' )
					),
					
					array(
						'id' => 'advanced_js',
						'type' => 'textarea',
						'placeholder' => esc_html__( 'Example: $("p").hide()', 'furnicom' ),
						'sub_desc' => esc_html__( 'Insert your own JS into this block. This customizes js throughout the theme', 'furnicom' ),
						'title' => esc_html__( 'Custom JS', 'furnicom' )
					)
				)
		);

	$options_args = array();

	//Setup custom links in the footer for share icons
	$options_args['share_icons']['facebook'] = array(
			'link' => 'http://www.facebook.com/wpthemego',
			'title' => 'Facebook',
			'img' => Furnicom_URL.'/options/img/glyphicons/glyphicons_320_facebook.png'
	);
	$options_args['share_icons']['twitter'] = array(
			'link' => 'https://twitter.com/wpthemego',
			'title' => 'Folow me on Twitter',
			'img' => Furnicom_URL.'/options/img/glyphicons/glyphicons_322_twitter.png'
	);
	$options_args['share_icons']['linked_in'] = array(
			'link' => 'http://wpthemego.com/#',
			'title' => 'Find me on LinkedIn',
			'img' => Furnicom_URL.'/options/img/glyphicons/glyphicons_337_linked_in.png'
	);

	//Choose a custom option name for your theme options, the default is the theme name in lowercase with spaces replaced by underscores
	$options_args['opt_name'] = FURNICOM;

	$options_args['google_api_key'] = '';//must be defined for use with google webfonts field type

	//Custom menu icon
	//$options_args['menu_icon'] = '';

	//Custom menu title for options page - default is "Options"
	$options_args['menu_title'] = esc_html__('Theme Options', 'furnicom');

	//Custom Page Title for options page - default is "Options"
	$options_args['page_title'] = esc_html__('YA Options :: ', 'furnicom') . wp_get_theme()->get('Name');

	//Custom page slug for options page (wp-admin/themes.php?page=***) - default is "furnicom_theme_options"
	$options_args['page_slug'] = 'furnicom_theme_options';

	//Custom page capability - default is set to "manage_options"
	//$options_args['page_cap'] = 'manage_options';

	//page type - "menu" (adds a top menu section) or "submenu" (adds a submenu) - default is set to "menu"
	$options_args['page_type'] = 'submenu';

	//parent menu - default is set to "themes.php" (Appearance)
	//the list of available parent menus is available here: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
	//$options_args['page_parent'] = 'themes.php';

	//custom page location - default 100 - must be unique or will override other items
	$options_args['page_position'] = 27;
	$furnicom_options = new Furnicom_Options($options, $options_args);
}
add_action( 'admin_init', 'Furnicom_Options_Setup', 0 );
Furnicom_Options_Setup();

function furnicom_widget_setup_args(){
	$furnicom_widget_areas = array(
		
		array(
				'name' => esc_html__('Sidebar Left Blog', 'furnicom'),
				'id'   => 'left-blog',
				'before_widget' => '<div id="%1$s" id="%1$s" class="widget %1$s %2$s"><div class="widget-inner">',
				'after_widget' => '</div></div>',
				'before_title' => '<div class="block-title-widget"><h2><span>',
				'after_title' => '</span></h2></div>'
		),
		array(
				'name' => esc_html__('Sidebar Right Blog', 'furnicom'),
				'id'   => 'right-blog',
				'before_widget' => '<div id="%1$s" id="%1$s" class="widget %1$s %2$s"><div class="widget-inner">',
				'after_widget' => '</div></div>',
				'before_title' => '<div class="block-title-widget"><h2><span>',
				'after_title' => '</span></h2></div>'
		),
		array(
				'name' => esc_html__('Top Header Right', 'furnicom'),
				'id'   => 'top-header-right',
				'before_widget' => '<div id="%1$s" id="%1$s" class="widget %1$s %2$s"><div class="widget-inner">',
				'after_widget'  => '</div></div>',
				'before_title'  => '<h3>',
				'after_title'   => '</h3>'
		),
		array(
				'name' => esc_html__('Top Header Right Home6', 'furnicom'),
				'id'   => 'top-header-right6',
				'before_widget' => '<div id="%1$s" id="%1$s" class="widget %1$s %2$s"><div class="widget-inner">',
				'after_widget'  => '</div></div>',
				'before_title'  => '<h3>',
				'after_title'   => '</h3>'
		),
		array(
				'name' => esc_html__('Top Header Left', 'furnicom'),
				'id'   => 'top-header-left',
				'before_widget' => '<div id="%1$s" id="%1$s" class="widget %1$s %2$s"><div class="widget-inner">',
				'after_widget'  => '</div></div>',
				'before_title'  => '<h3>',
				'after_title'   => '</h3>'
		),
		array(
				'name' => esc_html__('Top Header 1', 'furnicom'),
				'id'   => 'top',
				'before_widget' => '<div id="%1$s" id="%1$s" class="widget %1$s %2$s"><div class="widget-inner">',
				'after_widget'  => '</div></div>',
				'before_title'  => '<h3>',
				'after_title'   => '</h3>'
		),

		array(
				'name' => esc_html__('Top Lang', 'furnicom'),
				'id'   => 'top-lang',
				'before_widget' => '<div id="%1$s" id="%1$s" class="widget %1$s %2$s"><div class="widget-inner">',
				'after_widget'  => '</div></div>',
				'before_title'  => '<h3>',
				'after_title'   => '</h3>'
		),

		array(
				'name' => esc_html__('Header Right', 'furnicom'),
				'id'   => 'header-right',
				'before_widget' => '<div id="%1$s" id="%1$s" class="widget %1$s %2$s"><div class="widget-inner">',
				'after_widget'  => '</div></div>',
				'before_title'  => '<h3>',
				'after_title'   => '</h3>'
		),

		array(
				'name' => esc_html__('Header Right5', 'furnicom'),
				'id'   => 'header-right5',
				'before_widget' => '<div id="%1$s" id="%1$s" class="widget %1$s %2$s"><div class="widget-inner">',
				'after_widget'  => '</div></div>',
				'before_title'  => '<h3>',
				'after_title'   => '</h3>'
		),

		array(
				'name' => esc_html__('Header Right8', 'furnicom'),
				'id'   => 'header-right8',
				'before_widget' => '<div id="%1$s" id="%1$s" class="widget %1$s %2$s"><div class="widget-inner">',
				'after_widget'  => '</div></div>',
				'before_title'  => '<h3>',
				'after_title'   => '</h3>'
		),

		array(
				'name' => esc_html__('Header Left', 'furnicom'),
				'id'   => 'header-left',
				'before_widget' => '<div id="%1$s" id="%1$s" class="widget %1$s %2$s"><div class="widget-inner">',
				'after_widget'  => '</div></div>',
				'before_title'  => '<h3>',
				'after_title'   => '</h3>'
		),
		
		array(
				'name' => esc_html__('Header Slider', 'furnicom'),
				'id'   => 'header-slider',
				'before_widget' => '<div id="%1$s" id="%1$s" class="widget %1$s %2$s"><div class="widget-inner">',
				'after_widget'  => '</div></div>',
				'before_title'  => '<h3>',
				'after_title'   => '</h3>'
		),
		
		array(
				'name' => esc_html__('Above Header', 'furnicom'),
				'id'   => 'above-header',
				'before_widget' => '<div id="%1$s" id="%1$s" class="widget %1$s %2$s"><div class="widget-inner">',
				'after_widget'  => '</div></div>',
				'before_title'  => '<h3>',
				'after_title'   => '</h3>'
		),

		array(
				'name' => esc_html__('Above Header 9', 'furnicom'),
				'id'   => 'above-header9',
				'before_widget' => '<div id="%1$s" id="%1$s" class="widget %1$s %2$s"><div class="widget-inner">',
				'after_widget'  => '</div></div>',
				'before_title'  => '<h3>',
				'after_title'   => '</h3>'
		),
		
		array(
				'name' => esc_html__('Login Top', 'furnicom'),
				'id'   => 'login-top',
				'before_widget' => '<div id="%1$s" id="%1$s" class="widget %1$s %2$s"><div class="widget-inner">',
				'after_widget'  => '</div></div>',
				'before_title'  => '<h3>',
				'after_title'   => '</h3>'
		),

		array(
				'name' => esc_html__('Wrap Top', 'furnicom'),
				'id'   => 'wrap-top',
				'before_widget' => '<div id="%1$s" id="%1$s" class="widget %1$s %2$s"><div class="widget-inner">',
				'after_widget'  => '</div></div>',
				'before_title'  => '<h3>',
				'after_title'   => '</h3>'
		),
		
		array(
				'name' => esc_html__('Menu Right', 'furnicom'),
				'id'   => 'menu-right',
				'before_widget' => '<div id="%1$s" id="%1$s" class="widget %1$s %2$s"><div class="widget-inner">',
				'after_widget'  => '</div></div>',
				'before_title'  => '<h3>',
				'after_title'   => '</h3>'
		),

		array(
				'name' => esc_html__('Sidebar Bottom Detail Product', 'furnicom'),
				'id'   => 'bottom-detail-product',
				'before_widget' => '<div id="%1$s" id="%1$s" class="widget %1$s %2$s" data-scroll-reveal="enter bottom move 20px wait 0.2s"><div class="widget-inner">',
				'after_widget'  => '</div></div>',
				'before_title'  => '<h3>',
				'after_title'   => '</h3>'
		),
		
		array(
				'name' => esc_html__('Sidebar Left Product', 'furnicom'),
				'id'   => 'left-product',
				'before_widget' => '<div id="%1$s" id="%1$s" class="widget %1$s %2$s"><div class="widget-inner">',
				'after_widget' => '</div></div>',
				'before_title' => '<div class="block-title-widget"><h2><span>',
				'after_title' => '</span></h2></div>'
		),

		array(
				'name' => esc_html__('Sidebar Right Product', 'furnicom'),
				'id'   => 'right-product',
				'before_widget' => '<div id="%1$s" id="%1$s" class="widget %1$s %2$s"><div class="widget-inner">',
				'after_widget' => '</div></div>',
				'before_title' => '<div class="block-title-widget"><h2><span>',
				'after_title' => '</span></h2></div>'
		),
		array(
				'name' => esc_html__('Bottom Detail Product Mobile', 'furnicom'),
				'id'   => 'bottom-detail-product-mobile',
				'before_widget' => '<div id="%1$s" class="widget %1$s %2$s" data-scroll-reveal="enter bottom move 20px wait 0.2s"><div class="widget-inner">',
				'after_widget'  => '</div></div>',
				'before_title'  => '<h3>',
				'after_title'   => '</h3>'
		),
		array(
				'name' => esc_html__('Filter Mobile', 'furnicom'),
				'id'   => 'filter-mobile',
				'before_widget' => '<div id="%1$s" class="widget %1$s %2$s" data-scroll-reveal="enter bottom move 20px wait 0.2s"><div class="widget-inner">',
				'after_widget'  => '</div></div>',
				'before_title'  => '<h3>',
				'after_title'   => '</h3>'
		),
		
		array(
				'name' => esc_html__('Above Footer', 'furnicom'),
				'id'   => 'above-footer',
				'before_widget' => '<div id="%1$s" id="%1$s" class="widget %2$s"><div class="widget-inner">',
				'after_widget'  => '</div></div>',
				'before_title'  => '<h3>',
				'after_title'   => '</h3>'
		),
		array(
				'name' => esc_html__('Menu Footer', 'furnicom'),
				'id'   => 'menu-footer',
				'before_widget' => '<div id="%1$s" id="%1$s" class="widget %2$s"><div class="widget-inner">',
				'after_widget'  => '</div></div>',
				'before_title'  => '<h3>',
				'after_title'   => '</h3>'
		),
		array(
				'name' => esc_html__('Footer', 'furnicom'),
				'id'   => 'footer',
				'before_widget' => '<div id="%1$s" id="%1$s" class="widget %2$s"><div class="widget-inner">',
				'after_widget'  => '</div></div>',
				'before_title'  => '<h3>',
				'after_title'   => '</h3>'
		),

		array(
				'name' => esc_html__('Footer 2', 'furnicom'),
				'id'   => 'footer-2',
				'before_widget' => '<div id="%1$s" id="%1$s" class="widget %2$s"><div class="widget-inner">',
				'after_widget'  => '</div></div>',
				'before_title'  => '<h3>',
				'after_title'   => '</h3>'
		),
		
		array(
				'name' => esc_html__('Footer Top Style2', 'furnicom'),
				'id'   => 'footer1',
				'before_widget' => '<div id="%1$s" id="%1$s" class="widget %2$s"><div class="widget-inner">',
				'after_widget'  => '</div></div>',
				'before_title'  => '<h3>',
				'after_title'   => '</h3>'
		),

		array(
				'name' => esc_html__('Footer Bottom Style2', 'furnicom'),
				'id'   => 'footer-3',
				'before_widget' => '<div id="%1$s" id="%1$s" class="widget %2$s"><div class="widget-inner">',
				'after_widget'  => '</div></div>',
				'before_title'  => '<h3>',
				'after_title'   => '</h3>'
		),
		array(
				'name' => esc_html__('Footer Bottom Style3', 'furnicom'),
				'id'   => 'footer-4',
				'before_widget' => '<div id="%1$s" id="%1$s" class="widget %2$s"><div class="widget-inner">',
				'after_widget'  => '</div></div>',
				'before_title'  => '<h3>',
				'after_title'   => '</h3>'
		),
		array(
				'name' => esc_html__('Sidebar Copyright', 'furnicom'),
				'id'   => 'copyright',
				'before_widget' => '<div id="%1$s" id="%1$s" class="widget %2$s"><div class="widget-inner">',
				'after_widget'  => '</div></div>',
				'before_title'  => '<h3>',
				'after_title'   => '</h3>'
		),
	);
	return $furnicom_widget_areas;
}
