<?php
class Furnicom_ResmenuSB{
	function __construct(){
		add_filter( 'wp_nav_menu_args' , array( $this , 'Furnicom_MenuRes_AdFilter' ), 100 ); 
		add_filter( 'wp_nav_menu_args' , array( $this , 'Furnicom_MenuRes_Filter' ), 110 );	
		add_action( 'wp_footer', array( $this  , 'Furnicom_MenuRes_AdScript' ), 110 );	
	}
	function Furnicom_MenuRes_AdScript(){
		$html  = '<script type="text/javascript">';
		$html .= '(function($) {
			/* Responsive Menu */
			$(document).ready(function(){
				$("#bt_menusb").on("click", function(){
					$("#ResMenuSB").addClass( "open" );
				});
				$("#ResMenuSB .menu-close").on("click", function(){
					$("#ResMenuSB").removeClass( "open in" ).addClass( "collapse" );
					$("#ResMenuSB").addClass( "collapsed" );
				});				
						
				$( ".show-dropdown" ).each(function(){
					$(this).on("click", function(){
						$(this).toggleClass("show");
						var $parent = $(this).parent().attr("class");
						var $class = $parent.replace( /\s/g, "." );
						var $element = $( "." + $class + " > ul" );
						$element.toggle( 300 );
					});
				});
				var container = $( ".resmenu-container" );
				if( typeof container != "undefined" ){
					$(document).click(function(e) {			
						if ( !container.is(e.target) && container.has(e.target).length === 0 && container.html().length > 0 ){
							container.find( ".navbar-toggle" ).addClass( "collapsed" );
							container.find( ".menu-responsive-wrapper" ).removeClass("in").addClass( "collapse" ).height(0);
						}
					});
				}
			});
		})(jQuery);';
		$html .= '</script>';
		echo $html;
	}
	function Furnicom_MenuRes_AdFilter( $args ){
		$args['container'] = false;
		$furnicom_theme_locates = array();
		$furnicom_menu = furnicom_options()->getCpanelValue( 'menu_location' );
			if( !is_array( $furnicom_menu ) ){
				$furnicom_theme_locates[] = $furnicom_menu;
			}else{
				$furnicom_theme_locates = $furnicom_menu;
			}
			foreach( $furnicom_theme_locates as $key => $furnicom_theme_locate ){
			if ( ( strcmp( $furnicom_theme_locate, $args['theme_location'] ) == 0 ) ) {	
				if( isset( $args['furnicom_resmenu'] ) && $args['furnicom_resmenu'] == true ) {
					return $args;
				}		
				$ResNavMenu = $this->ResNavMenu( $args );
				$args['container'] = '';
				$args['container_class'].= '';	
				$args['menu_class'].= ($args['menu_class'] == '' ? '' : ' ') . 'furnicom-menures';			
				$args['items_wrap']	= '<ul id="%1$s" class="%2$s">%3$s</ul>'.$ResNavMenu;
				}
			}
			
		return $args;
	}
	function ResNavMenu( $args ){
		$args['furnicom_resmenu'] = true;		
		$select = wp_nav_menu( $args );
		return $select;
	}
	function Furnicom_MenuRes_Filter( $args ){
		/* Fix Menu on wp 4.7 */
		if( !isset( $args['furnicom_resmenu'] ) ){
			return $args;
		}
		$args['container'] = false;
		$furnicom_theme_locates = array();
		$furnicom_menu = furnicom_options()->getCpanelValue( 'menu_location' );
		if( !is_array( $furnicom_menu ) ){
			$furnicom_theme_locates[] = $furnicom_menu;
		}else{
			$furnicom_theme_locates = $furnicom_menu;
		}
		foreach( $furnicom_theme_locates as  $furnicom_theme_locate ){
			if ( ( strcmp( $furnicom_theme_locate, $args['theme_location'] ) == 0 ) ) {	
			$args['container'] = 'div';
			$args['container_class'].= 'resmenu-container resmenu-container-sidebar ';
			$args['items_wrap']	= '<button id="bt_menusb" class="navbar-toggle" type="button" data-toggle="collapse" data-target="#ResMenuSB">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<div id="ResMenuSB" class="menu-responsive-wrapper">
				<div class="menu-responsive-inner">
					<h3>'. esc_html__( 'Menu', 'furnicom' ) .'</h3>
					<ul id="%1$s" class="%2$s">%3$s</ul>
					<div class="menu-close"></div>
				</div>
			</div>';	
			$args['menu_class'] = 'furnicom_resmenu';
			$args['walker'] = new Furnicom_ResMenu_Walker();
			}
		}
		return $args;
	}
}
class Furnicom_ResMenu_Walker extends Walker_Nav_Menu {
	function check_current($classes) {
		return preg_match('/(current[-_])|active|dropdown/', $classes);
	}

	function start_lvl(&$output, $depth = 0, $args = array()) {
		$output .= "\n<ul class=\"dropdown-resmenu\">\n";
	}

	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
		$item_html = '';
		parent::start_el($item_html, $item, $depth, $args);
		if( !$item->is_dropdown && ($depth === 0) ){
			$item_html = str_replace('<a', '<a class="item-link"', $item_html);			
			$item_html = str_replace('</a>', '</a>', $item_html);			
		}
		if ( $item->is_dropdown ) {
			$item_html = str_replace('<a', '<a class="item-link dropdown-toggle"', $item_html);
			$item_html = str_replace('</a>', '</a>', $item_html);
			$item_html = str_replace('%', '', $item_html);
			$item_html .= '<span class="show-dropdown"></span>';
		}
		$output .= $item_html;
	}

	function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output) {
		$element->is_dropdown = !empty($children_elements[$element->ID]);
		if ($element->is_dropdown) {			
			$element->classes[] = 'res-dropdown';
		}

		parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
	}
}
new Furnicom_ResmenuSB();