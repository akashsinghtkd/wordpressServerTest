<?php
class Furnicom_Selectmenu{
	function __construct(){
		add_filter( 'wp_nav_menu_args' , array( $this , 'Furnicom_SelectMenu_AdFilter' ), 100 ); 
		add_filter( 'wp_nav_menu_args' , array( $this , 'Furnicom_SelectMenu_Filter' ), 110 );	
		add_action( 'wp_footer', array( $this  , 'Furnicom_SelectMenu_AdScript' ), 110 );	
	}
	function Furnicom_SelectMenu_AdScript(){
		$furnicom_select_value  = '<script type="text/javascript">';
		$furnicom_select_value .= "jQuery(document).ready( function($){
			$( '.furnicom_selectmenu' ).change(function() {
				var loc = $(this).find( 'option:selected' ).val();
				if( loc != '' && loc != '#' ) window.location = loc;
			});
		});
		</script> ";
		echo $furnicom_select_value;
	}
	function Furnicom_SelectMenu_AdFilter( $args ){
		$args['container'] = false;
		$furnicom_theme_locate = furnicom_options()->getCpanelValue( 'menu_location' );
		if ( ( strcmp( $furnicom_theme_locate, $args['theme_location'] ) == 0 ) ) {	
			if( isset( $args['furnicom_selectmenu'] ) && $args['furnicom_selectmenu'] == true ) {
				return $args;
			}		
			$selectNav = $this->selectNavMenu( $args );			
			$args['container_class'].= ($args['container_class'] == '' ? '' : ' ') . 'furnicomselectmenu-container';	
			$args['menu_class'].= ($args['menu_class'] == '' ? '' : ' ') . 'furnicomselectmenu';			
			$args['items_wrap']	= '<ul id="%1$s" class="%2$s">%3$s</ul>'.$selectNav;
		}
		return $args;
	}
	function selectNavMenu( $args ){
		$args['furnicom_selectmenu'] = true;		
		$select = wp_nav_menu( $args );
		return $select;
	}
	function Furnicom_SelectMenu_Filter( $args ){
		$args['container'] = false;
		$furnicom_theme_locate = furnicom_options()->getCpanelValue( 'menu_location' );
		if ( ( strcmp( $furnicom_theme_locate, $args['theme_location'] ) == 0 ) ) {	
			$args['menu_class'] = 'furnicom_selectmenu';
			$args['walker'] = new Furnicom_Menu_Select();
			$args['items_wrap'] = '<button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#ResMenu">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button><div id="ResMenu" class="collapse menu-responsive-wrapper"><select class="%2$s">%3$s</select></div>';
		}
		return $args;
	}
}
class Furnicom_Menu_Select extends Walker_Nav_Menu{
	
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
	}
	
	function end_lvl(&$output, $depth = 0 , $args = array() ) {
		$indent = str_repeat("\t", $depth);
	}
	function start_el( &$output, $item, $depth = 0, $args = array(), $current_object_id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$class_names = '';
		$dashes = ( $depth ) ? str_repeat( "-", $depth ) : '';
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
		$match = preg_match('/active/', $class_names);		
		$item->url = urldecode( $item->url );
		$attributes = ' value="'   . esc_attr( $item->url ) .'"';
		if( $match ){
			$output = str_replace('selected="selected"', '', $output);
			$attributes.= ' selected="selected"';
		}
		$output .= $indent . '<option ' . $attributes . '>';
		$item_output = $args->before;
		$item_output .= $dashes . $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= $args->after;

		$output.= str_replace( '%', '%%', $item_output );

		$output.= "</option>\n";
	}
	function end_el(&$output, $element, $depth=0, $args=array() ){
		return ;
	}
	public function getElement( $element, $children_elements, $max_depth, $depth = 0, $args ){
	
	}
}
new Furnicom_Selectmenu();