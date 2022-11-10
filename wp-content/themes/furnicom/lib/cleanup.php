<?php
/**
 * Clean up wp_head()
 *
 * Remove unnecessary <link>'s
 * Remove inline CSS used by Recent Comments widget
 * Remove inline CSS used by posts with galleries
 * Remove self-closing tag and change ''s to "'s on rel_canonical()
 */
 
/* 
** Function title tag 
*/
if ( ! function_exists( '_wp_render_title_tag' ) ) {
	function furnicom_render_title() {
?>
	<title><?php wp_title( '|', true, 'right' ); ?></title>
<?php
	}
	add_action( 'wp_head', 'furnicom_render_title' );
}

/**
 * Add and remove body_class() classes
 */
function furnicom_body_class($classes) {
	$page_metabox_hometemp = get_post_meta( get_the_ID(), 'page_home_template', true );
	$furnicom_direction  = furnicom_options()->getCpanelValue('direction');
	$furnicom_box_layout 	= furnicom_options()->getCpanelValue('layout');
	$sw_demo   		  = get_option( 'sw_mdemo' );
	if( $furnicom_direction == 'rtl' ){
		$classes[] = 'rtl';
	}
	if( furnicom_mobile_check()  ){
		$classes[] = 'mobile-layout';
	}
	if( $furnicom_box_layout == 'boxed' ){
		$classes[] = 'box-layout';
	}
	
	if( $sw_demo == 1 ){
		$classes[] = 'mobile-demo';
	}
	
	if( $page_metabox_hometemp != '' ){
		$classes[] = 'page-template-' . $page_metabox_hometemp;
	}
	// Add post/page slug
	if (is_single() || is_page() && !is_front_page()) {
		$classes[] = basename(get_permalink());
	}
	
	// Remove unnecessary classes
	$home_id_class = 'page-id-' . get_option('page_on_front');
	$remove_classes = array(
			'page-template-default',
			$home_id_class
	);
	$classes = array_diff($classes, $remove_classes);
	return $classes;
}
add_filter('body_class', 'furnicom_body_class');

/**
 * Wrap embedded media as suggested by Readability
 *
 * @link https://gist.github.com/965956
 * @link http://www.readability.com/publishers/guidelines#publisher
 */
function furnicom_embed_wrap($cache, $url, $attr = '', $post_ID = '') {
	$cache = preg_replace('/width="(.*?)?"/', 'width="100%"', $cache);
	return '<div class="entry-content-asset">' . $cache . '</div>';
}
add_filter('embed_oembed_html', 'furnicom_embed_wrap', 10, 4);
add_filter('embed_googlevideo', 'furnicom_embed_wrap', 10, 2);

/**
 * Add class="thumbnail" to attachment items
 */
function furnicom_attachment_link_class($html) {
	$postid = get_the_ID();
	$html = str_replace('<a', '<a class="thumbnail"', $html);
	return $html;
}
add_filter('wp_get_attachment_link', 'furnicom_attachment_link_class', 10, 1);

/**
 * Add Bootstrap thumbnail styling to images with captions
 * Use <figure> and <figcaption>
 *
 * @link http://justintadlock.com/archives/2011/07/01/captions-in-wordpress
 */
function furnicom_caption($output, $attr, $content) {
	if (is_feed()) {
		return $output;
	}

	$defaults = array(
			'id'      => '',
			'align'   => 'alignnone',
			'width'   => '',
			'caption' => ''
	);

	$attr = shortcode_atts($defaults, $attr);

	// If the width is less than 1 or there is no caption, return the content wrapped between the [caption] tags
	if ($attr['width'] < 1 || empty($attr['caption'])) {
		return $content;
	}

	// Set up the attributes for the caption <figure>
	$attributes  = (!empty($attr['id']) ? ' id="' . esc_attr($attr['id']) . '"' : '' );
	$attributes .= ' class="thumbnail wp-caption ' . esc_attr($attr['align']) . '"';
	$attributes .= ' style="width: ' . esc_attr($attr['width']) . 'px"';

	$output  = '<figure' . $attributes .'>';
	$output .= do_shortcode($content);
	$output .= '<figcaption class="caption wp-caption-text">' . $attr['caption'] . '</figcaption>';
	$output .= '</figure>';

	return $output;
}
add_filter('img_caption_shortcode', 'furnicom_caption', 10, 3);

/**
 * Clean up the_excerpt()
 */
function furnicom_excerpt_length($length) {
	return $length;
}

function furnicom_excerpt_more($more) {
	//return;
	return ' &hellip; <a href="' . get_permalink() . '">' . esc_html__('Readmore', 'furnicom') . '</a>';
}
add_filter('excerpt_length', 'furnicom_excerpt_length');
add_filter('excerpt_more',   'furnicom_excerpt_more');

/**
 * Remove unnecessary self-closing tags
 */
function furnicom_remove_self_closing_tags($input) {
  return str_replace(' />', '>', $input);
}
add_filter('get_avatar',          'furnicom_remove_self_closing_tags'); // <img />
add_filter('comment_id_fields',   'furnicom_remove_self_closing_tags'); // <input />
add_filter('post_thumbnail_html', 'furnicom_remove_self_closing_tags'); // <img />

/**
 * Don't return the default description in the RSS feed if it hasn't been changed
 */
function furnicom_remove_default_description($bloginfo) {
	$default_tagline = 'Just another WordPress site';
	return ($bloginfo === $default_tagline) ? '' : $bloginfo;
}
add_filter('get_bloginfo_rss', 'furnicom_remove_default_description');

/**
 * Allow more tags in TinyMCE including <iframe> and <script>
 */
function furnicom_change_mce_options($options) {
	$ext = 'pre[id|name|class|style],iframe[align|longdesc|name|width|height|frameborder|scrolling|marginheight|marginwidth|src],script[charset|defer|language|src|type]';

	if (isset($initArray['extended_valid_elements'])) {
		$options['extended_valid_elements'] .= ',' . $ext;
	} else {
		$options['extended_valid_elements'] = $ext;
	}

	return $options;
}
add_filter('tiny_mce_before_init', 'furnicom_change_mce_options');

/**
 * Add additional classes onto widgets
 *
 * @link http://wordpress.org/support/topic/how-to-first-and-last-css-classes-for-sidebar-widgets
 */
function furnicom_widget_first_last_classes($params) {
	global $my_widget_num;

	$this_id = $params[0]['id'];
	$arr_registered_widgets = wp_get_sidebars_widgets();

	if (!$my_widget_num) {
		$my_widget_num = array();
	}

	if (!isset($arr_registered_widgets[$this_id]) || !is_array($arr_registered_widgets[$this_id])) {
		return $params;
	}

	if (isset($my_widget_num[$this_id])) {
		$my_widget_num[$this_id] ++;
	} else {
		$my_widget_num[$this_id] = 1;
	}

	$class = 'class="widget-' . esc_attr( $my_widget_num[$this_id] ) . ' ';

	if ($my_widget_num[$this_id] == 1) {
		$class .= 'widget-first ';
	} elseif ($my_widget_num[$this_id] == count($arr_registered_widgets[$this_id])) {
		$class .= 'widget-last ';
	}

	$params[0]['before_widget'] = preg_replace('/class=\"/', "$class", $params[0]['before_widget'], 1);

	return $params;
}
add_filter('dynamic_sidebar_params', 'furnicom_widget_first_last_classes');

/**
 * Redirects search results from /?s=query to /search/query/, converts %20 to +
 *
 * @link http://txfx.net/wordpress-plugins/nice-search/
 */
function furnicom_nice_search_redirect() {
	global $furnicom_rewrite;
	if (!isset($furnicom_rewrite) || !is_object($furnicom_rewrite) || !$furnicom_rewrite->using_permalinks()) {
		return;
	}

	$search_base = $furnicom_rewrite->search_base;
	if (is_search() && !is_admin() && strpos($_SERVER['REQUEST_URI'], "/{$search_base}/") === false) {
		wp_redirect(home_url("/{$search_base}/" . urlencode(get_query_var('s'))));
		exit();
	}
}
if (current_theme_supports('nice-search')) {
	add_action('template_redirect', 'furnicom_nice_search_redirect');
}

/**
 * Fix for empty search queries redirecting to home page
 *
 * @link http://wordpress.org/support/topic/blank-search-sends-you-to-the-homepage#post-1772565
 * @link http://core.trac.wordpress.org/ticket/11330
 */
function furnicom_request_filter($query_vars) {
  if (isset($_GET['s']) && empty($_GET['s'])) {
    $query_vars['s'] = ' ';
  }

  return $query_vars;
}
add_filter('request', 'furnicom_request_filter');

/**
 * Tell WordPress to use searchform.php from the templates/ directory
 */
function furnicom_get_search_form($argument) {
	if ($argument === '') {
		locate_template('/templates/searchform.php', true, false);
	}
}
add_filter('get_search_form', 'furnicom_get_search_form');

function furnicom_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'furnicom' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'furnicom_wp_title', 10, 2 );


/**
 * Widget text do_shortcode();
 */
add_filter('widget_text', 'do_shortcode');


add_filter('wp_link_pages_args','add_next_and_number');

function add_next_and_number($args){
    if($args['next_or_number'] == 'next_and_number'){
        global $page, $numpages, $multipage, $more, $pagenow;
        $args['next_or_number'] = 'number';
        $prev = '';
        $next = '';
        if ( $multipage ) {
            if ( $more ) {
                $i = $page - 1;
                if ( $i && $more ) {
					$prev .='<p>';
                    $prev .= _wp_link_page($i);
                    $prev .= $args['link_before'].$args['previouspagelink'] . $args['link_after'] . '</a></p>';
                }
                $i = $page + 1;
                if ( $i <= $numpages && $more ) {
					$next .='<p>';
                    $next .= _wp_link_page($i);
                    $next .= $args['link_before']. $args['nextpagelink'] . $args['link_after'] . '</a></p>';
                }
            }
        }
        $args['before'] = $args['before'].$prev;
        $args['after'] = $next.$args['after'];    
    }
    return $args;
}
/* Menu Sticky */
add_action( 'wp_footer', 'furnicom_sticky_menu', 100 );
function furnicom_sticky_menu(){
	$sticky_menu 		= furnicom_options()->getCpanelValue( 'sticky_menu' );
	$furnicom_header_style 	= furnicom_options()->getCpanelValue('header_style');
	$output = '';
	if( !furnicom_mobile_check() ) { 
		if( $sticky_menu && ($furnicom_header_style = 'style2' || $furnicom_header_style == 'style1')){
			$output .= '<script type="text/javascript">';
			$output .= '(function($) {';
			$output .= 'var sticky_navigation_offset_top = $("#primary-menu").offset().top;';
			$output .= 'var sticky_navigation = function(){';
			$output .= 'var scroll_top = $(window).scrollTop();';
			$output .= 'if (scroll_top > sticky_navigation_offset_top) {';
			$output .= '$("#primary-menu").addClass("sticky-menu");';
			$output .= '$(".header").addClass("header-sticky-menu");';
			$output .= '$("#primary-menu").css({ "top":0, "left":0, "right" : 0, "z-index": 9999 });';
			$output .= '} else {';
			$output .= '$("#primary-menu").removeClass("sticky-menu");';
			$output .= '$(".header").removeClass("header-sticky-menu");';
			$output .= '}';
			$output .= '};';
			$output .= 'sticky_navigation();';
			$output .= '$(window).scroll(function() {';
			$output .= 'sticky_navigation();';
			$output .= '});';
			$output .= '}(jQuery));';
			$output .= '</script>';
		}
	}else{
		$output .= '<script type="text/javascript">';
			$output .= '(function($) {';
			$output .= 'var sticky_navigation_offset = $(".mobile-search").offset();';
			$output .= 'if( typeof sticky_navigation_offset != "undefined" ) {';
			$output .= 'var sticky_navigation_offset_top = sticky_navigation_offset.top;';
			$output .= 'var sticky_navigation = function(){';
			$output .= 'var scroll_top = $(window).scrollTop();';
			$output .= 'if (scroll_top > sticky_navigation_offset_top) {';
			$output .= '$(".header-mobile-style1").addClass("sticky-menu");';
			$output .= '$(".header-mobile-style1").css({ "top":0, "left":0, "right" : 0 });';
			$output .= '} else {';
			$output .= '$(".header-mobile-style1").removeClass("sticky-menu");';
			$output .= '}';
			$output .= '};';
			$output .= 'sticky_navigation();';
			$output .= '$(window).scroll(function() {';
			$output .= 'sticky_navigation();';
			$output .= '}); }';
			$output .= 'var sticky_navigation_offset = $(".header-mobile-style2 .header-top-mobile").offset();';
			$output .= 'if( typeof sticky_navigation_offset != "undefined" ) {';
			$output .= 'var sticky_navigation_offset_top = sticky_navigation_offset.top;';
			$output .= 'var sticky_navigation = function(){';
			$output .= 'var scroll_top = $(window).scrollTop();';
			$output .= 'if (scroll_top > sticky_navigation_offset_top) {';
			$output .= '$(".header-mobile-style2").addClass("sticky-menu");';
			$output .= '$(".header-mobile-style2").css({ "top":0, "left":0, "right" : 0 });';
			$output .= '} else {';
			$output .= '$(".header-mobile-style2").removeClass("sticky-menu");';
			$output .= '}';
			$output .= '};';
			$output .= 'sticky_navigation();';
			$output .= '$(window).scroll(function() {';
			$output .= 'sticky_navigation();';
			$output .= '}); }';
			$output .= '}(jQuery));';
			$output .= '</script>';
	}
	echo $output;
}
/* Popup Newsletter */
add_action( 'wp_footer', 'furnicom_popup', 101 );
function furnicom_popup(){
	$furnicom_popup	 		= furnicom_options()->getCpanelValue( 'popup_active' );
	$furnicom_popup_content 	= furnicom_options()->getCpanelValue('popup_shortcode');
	if( $furnicom_popup ){
		echo stripslashes( do_shortcode( $furnicom_popup_content ) );
?>
		<script>
			(function($) {
				$(document).ready(function() {
					var check_cookie = $.cookie('subscribe_popup');
					if(check_cookie == null || check_cookie == 'shown') {
						 popupNewsletter();
					 }
					$('#subscribe_popup input#popup_check').on('click', function(){
						if($(this).parent().find('input:checked').length){        
							var check_cookie = $.cookie('subscribe_popup');
						   if(check_cookie == null || check_cookie == 'shown') {
								$.cookie('subscribe_popup','dontshowitagain');            
							}
							else
							{
								$.cookie('subscribe_popup','shown');
								popupNewsletter();
								alert('hhah');
							}
						} else {
							$.cookie('subscribe_popup','shown');
						}
					}); 
				});

				function popupNewsletter() {
					jQuery.fancybox({
						href: '#subscribe_popup',
						autoResize: true
					});
					jQuery('#subscribe_popup').trigger('click');
					jQuery('#subscribe_popup').parents('.fancybox-overlay').addClass('popup-fancy');
				};
			}(jQuery));
		</script>
<?php
	}
}

