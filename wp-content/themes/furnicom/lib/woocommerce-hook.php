<?php
add_theme_support( 'woocommerce' );
add_filter( 'wp_list_categories', 'furnicom_list_categories' );
function furnicom_list_categories( $output ){
	$output = preg_replace('~\((\d+)\)(?=\s*+<)~', '<span class="number-count">$1</span>', $output);
	return $output;
}

/*
** WooCommerce Compare Version
*/
if( !function_exists( 'sw_woocommerce_version_check' ) ) :
	function sw_woocommerce_version_check( $version = '3.0' ) {
		global $woocommerce;
		if( version_compare( $woocommerce->version, $version, ">=" ) ) {
			return true;
		}else{
			return false;
		}
	}
endif;

add_action( 'woocommerce_account_content', 'furnicom_mydashboard_mobile', 9 );
function furnicom_mydashboard_mobile(){
$current_user = get_user_by( 'id', get_current_user_id() );
if( furnicom_mobile_check() ) : ?>
<p class="avatar-user">
<?php
echo get_avatar( $current_user->ID, 155 );
?>
</p>
<?php endif;
}
/*
** Sales label
*/

if( !function_exists( 'sw_label_sales' ) ){
	function sw_label_sales(){
		global $product, $post;
		$product_type = ( sw_woocommerce_version_check( '3.0' ) ) ? $product->get_type() : $product->product_type;
		echo sw_label_new();
		if( $product_type != 'variable' ) {
			$forginal_price 	= get_post_meta( $post->ID, '_regular_price', true );	
			$fsale_price 		= get_post_meta( $post->ID, '_sale_price', true );
			if( $fsale_price > 0 && $product->is_on_sale() ){ 
				$sale_off = 100 - ( ( $fsale_price/$forginal_price ) * 100 ); 
				$html = '<div class="sale-off ' . esc_attr( ( sw_label_new() != '' ) ? 'has-newicon' : '' ) .'">';
				$html .= '-' . round( $sale_off ).'%';
				$html .= '</div>';
				echo apply_filters( 'sw_label_sales', $html );
			} 
		}else{
			echo '<div class="' . esc_attr( ( sw_label_new() != '' ) ? 'has-newicon' : '' ) .'">';
			wc_get_template( 'single-product/sale-flash.php' );
			echo '</div>';
		}
	}	
}

/*minicart via Ajax*/
$furnicom_header  = furnicom_options()->getCpanelValue( 'header_style' );
$filter = sw_woocommerce_version_check( $version = '3.0.3' ) ? 'woocommerce_add_to_cart_fragments' : 'add_to_cart_fragments';
if( $furnicom_header == 'style2' || $furnicom_header == 'style6' || $furnicom_header == 'style7'){
	add_filter( $filter, 'furnicom_add_to_cart_fragment', 100);
	function furnicom_add_to_cart_fragment( $fragments ) {
		ob_start();
		?>
		<?php get_template_part( 'woocommerce/minicart-ajax' ); ?>
		<?php
		$fragments['.furnicom-minicart'] = ob_get_clean();
		return $fragments;
		
	}
}
if( $furnicom_header == 'style4' || $furnicom_header == 'style5' ){
	add_filter( $filter, 'furnicom_add_to_cart_fragment', 100);
	function furnicom_add_to_cart_fragment( $fragments ) {
		ob_start();
		?>
		<?php get_template_part( 'woocommerce/minicart-ajax-style2' ); ?>
		<?php
		$fragments['.furnicom-minicart-style2'] = ob_get_clean();
		return $fragments;
		
	}
}
else{
	add_filter($filter, 'furnicom_add_to_cart_fragment_style1', 101);
	function furnicom_add_to_cart_fragment_style1( $fragments ) {
		ob_start();
		?>
		<?php get_template_part( 'woocommerce/minicart-ajax-style1' ); ?>
		<?php
		$fragments['.furnicom-minicart-style1'] = ob_get_clean();
		return $fragments;
		
	}
}
/*remove woo breadcrumb*/
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );


/*add second thumbnail loop product*/
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
add_action( 'woocommerce_before_shop_loop_item_title', 'furnicom_woocommerce_template_loop_product_thumbnail', 10 );
	function furnicom_product_thumbnail( $size = 'shop_catalog', $placeholder_width = 0, $placeholder_height = 0  ) {
		
		$quickview = furnicom_options()->getCpanelValue( 'product_quickview' );
		global $post;
		$html = '';
		$id = get_the_ID();
		$gallery = get_post_meta($id, '_product_image_gallery', true);
		$attachment_image = '';
		if(!empty($gallery)) {
			$gallery = explode(',', $gallery);
			$first_image_id = $gallery[0];
			$attachment_image = wp_get_attachment_image($first_image_id , $size, false, array('class' => 'hover-image back'));
		}
		
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' );
		if ( has_post_thumbnail( $post->ID ) ){
			if( $attachment_image ){
				$html .= '<a href="'.get_permalink( $post->ID ).'">';
				$html .= '<div class="product-thumb-hover">';
				$html .= (get_the_post_thumbnail( $post->ID, $size )) ? get_the_post_thumbnail( $post->ID, $size ): '<img src="'.get_template_directory_uri().'/assets/img/placeholder/'.$size.'.png" alt="No thumb">';
				$html .= $attachment_image;
				$html .= '</div>';
				$html .= '</a>';
			}else{
				$html .= '<a href="'.get_permalink( $post->ID ).'">';
				$html .= (get_the_post_thumbnail( $post->ID, $size )) ? get_the_post_thumbnail( $post->ID, $size ): '<img src="'.get_template_directory_uri().'/assets/img/placeholder/'.$size.'.png" alt="No thumb">';
				$html .= '</a>';
			}			
		}else{
			$html .= '<a href="'.get_permalink( $post->ID ).'">';
			$html .= '<img src="'.get_template_directory_uri().'/assets/img/placeholder/'.$size.'.png" alt="No thumb">';
			$html .= '</a>';
		}
		/* Quickview */
		if( $quickview ) : 
			$nonce = wp_create_nonce("furnicom_quickviewproduct_nonce");
			$link = admin_url('admin-ajax.php?ajax=true&amp;action=furnicom_quickviewproduct&amp;post_id='.$post->ID.'&amp;nonce='.$nonce);
			$html .= '<a href="'. esc_url( $link ) .'" data-fancybox-type="ajax" class="fancybox fancybox.ajax sm_quickview_handler  fa fa-search" title="Quick View Product"> </a>';
		endif;
		/* End Quickview */
		
		return $html;
	}
	function furnicom_woocommerce_template_loop_product_thumbnail(){
		echo furnicom_product_thumbnail();
	}

function furnicom_banner_listing(){	
	$banner_enable  = furnicom_options()->getCpanelValue( 'product_banner' ); 
	$banner_listing = furnicom_options()->getCpanelValue( 'product_listing_banner' );
	$link_banner    = furnicom_options()->getCpanelValue( 'link_banner_shop' );
	
	// Check Vendor page of WC MarketPlace
	global $WCMp;
	if ( class_exists( 'WCMp' ) && is_tax($WCMp->taxonomy->taxonomy_name) ) {
		return;
	}
	
	$html = '<div class="widget_sp_image">';
	if( '' === $banner_enable ){
		$html .= ( $link_banner != '' ) ? '<a href="'.esc_url($link_banner).'">': '';
		$html .= ( $banner_listing != '' ) ? '<img src="'. esc_url( $banner_listing ) .'" alt />' : '';
		$html .= ( $link_banner != '' ) ? '</a>': '';
	}else{
		global $wp_query;
		$cat = $wp_query->get_queried_object();
		if( !is_shop() ) {
			$thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
			$image = wp_get_attachment_url( $thumbnail_id );
			if( $image ) {
				$html .= ( $link_banner != '' ) ? '<a href="'.esc_url($link_banner).'">': '';
				$html .= '<img src="'. esc_url( $image ) .'" alt />';
				$html .= ( $link_banner != '' ) ? '</a>': '';
			}else{
				$html .= ( $link_banner != '' ) ? '<a href="'.esc_url($link_banner).'">': '';
				$html .= '<img src="'. esc_url( $banner_listing ) .'" alt />';
				$html .= ( $link_banner != '' ) ? '</a>': '';
			}
		}else{
			$html .= ( $link_banner != '' ) ? '<a href="'.esc_url($link_banner).'">': '';
			$html .= ( $banner_listing != '' ) ? '<img src="'. esc_url( $banner_listing ) .'" alt />' : '';
			$html .= ( $link_banner != '' ) ? '</a>': '';
		}
	}
	$html .= '</div>';
	if( !is_singular( 'product' ) ){
		echo sprintf( '%s', $html );
	}
}
/*filter order*/
function furnicom_addURLParameter($url, $paramName, $paramValue) {
     $url_data = parse_url($url);
     if(!isset($url_data["query"]))
         $url_data["query"]="";

     $params = array();
     parse_str($url_data['query'], $params);
     $params[$paramName] = $paramValue;
     $url_data['query'] = http_build_query($params);
     return furnicom_build_url($url_data);
}


function furnicom_build_url($url_data) {
 $url="";
 if(isset($url_data['host']))
 {
	 $url .= $url_data['scheme'] . '://';
	 if (isset($url_data['user'])) {
		 $url .= $url_data['user'];
			 if (isset($url_data['pass'])) {
				 $url .= ':' . $url_data['pass'];
			 }
		 $url .= '@';
	 }
	 $url .= $url_data['host'];
	 if (isset($url_data['port'])) {
		 $url .= ':' . $url_data['port'];
	 }
 }
 if (isset($url_data['path'])) {
	$url .= $url_data['path'];
 }
 if (isset($url_data['query'])) {
	 $url .= '?' . $url_data['query'];
 }
 if (isset($url_data['fragment'])) {
	 $url .= '#' . $url_data['fragment'];
 }
 return $url;
}
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
remove_filter( 'woocommerce_product_loop_start', 'woocommerce_maybe_show_product_subcategories' );
add_action( 'woocommerce_before_main_content', 'furnicom_banner_listing', 10 );
add_filter( 'furnicom_custom_category', 'woocommerce_maybe_show_product_subcategories' );
add_action( 'woocommerce_before_shop_loop_item_title', 'sw_label_sales', 10 );
add_action( 'woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 1 );
add_action( 'woocommerce_before_shop_loop', 'furnicom_viewmode_wrapper_start', 5 );
add_action( 'woocommerce_before_shop_loop', 'furnicom_viewmode_wrapper_end', 50 );
add_action( 'woocommerce_before_shop_loop', 'furnicom_woocommerce_catalog_ordering', 10 );
add_action( 'woocommerce_before_shop_loop','furnicom_woommerce_view_mode_wrap',15 );
add_action( 'woocommerce_after_shop_loop', 'furnicom_viewmode_wrapper_start', 5 );
add_action( 'woocommerce_after_shop_loop', 'furnicom_viewmode_wrapper_end', 50 );
add_action( 'woocommerce_after_shop_loop', 'furnicom_woommerce_view_mode_wrap', 6 );
add_action( 'woocommerce_after_shop_loop', 'furnicom_woocommerce_catalog_ordering', 7 );
remove_action( 'woocommerce_before_shop_loop', 'wc_print_notices', 10 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_pagination', 35 );
add_action( 'woocommerce_before_shop_loop_mobile', 'furnicom_viewmode_wrapper_start_mobile', 5 );
add_action( 'woocommerce_before_shop_loop_mobile', 'furnicom_viewmode_wrapper_end_mobile', 50 );
add_action( 'woocommerce_before_shop_loop_mobile', 'furnicom_woocommerce_catalog_ordering_mobile', 30 );
add_action( 'woocommerce_before_shop_loop_mobile','furnicom_woommerce_view_mode_wrap_mobile',15 );
add_action('woocommerce_message','wc_print_notices', 10);

function furnicom_viewmode_wrapper_start_mobile(){
	echo '<div class="products-nav clearfix">';
}
function furnicom_viewmode_wrapper_end_mobile(){
	echo '</div>';
}
function furnicom_woommerce_view_mode_wrap_mobile () {
	$html='<div class="view-mode-wrap">
				<p class="view-mode">
						<a href="javascript:void(0)" class="grid-view active" title="'. esc_html__('Grid view', 'furnicom').'"><span>'. esc_html__('Grid view', 'furnicom').'</span></a>
						<a href="javascript:void(0)" class="list-view" title="'. esc_html__('List view', 'furnicom') .'"><span>'.esc_html__('List view', 'furnicom').'</span></a>
				</p>	
			</div>';
	echo $html;
}

function furnicom_woocommerce_catalog_ordering_mobile() { 
	$html = '';
	$html .= '<div class="catalog-ordering">';
	$html .= woocommerce_catalog_ordering();	
	$html .= '</div>';
	$html .= '<div class="filter-product">'. esc_html__('Filter','furnicom') .'</div>';
	echo $html;
}

function furnicom_viewmode_wrapper_start(){
	echo '<div class="products-nav">';
}
function furnicom_viewmode_wrapper_end(){
	echo '</div>';
}
function furnicom_woommerce_view_mode_wrap () {
	$html='<div class="view-mode-wrap">
				<p class="view-mode">
						<a href="javascript:void(0)" class="grid-view active" title="'. esc_html__('Grid view', 'furnicom').'"><span>'. esc_html__('Grid view', 'furnicom').'</span></a>
						<a href="javascript:void(0)" class="list-view" title="'. esc_html__('List view', 'furnicom') .'"><span>'.esc_html__('List view', 'furnicom').'</span></a>
				</p>	
			</div>';
	echo $html;
}

function furnicom_woocommerce_catalog_ordering() {
	global $data;
	parse_str($_SERVER['QUERY_STRING'], $params);

	$query_string = '?'.$_SERVER['QUERY_STRING'];
	$option_number 	=  furnicom_options()->getCpanelValue( 'product_number' );
	// replace it with theme option
	if( $option_number ) {
		$per_page = $option_number;
	} else {
		$per_page = 12;
	}

	$pc  = !empty($params['product_count']) ? $params['product_count'] : $per_page;

	$html = '';
	$html .= '<div class="catalog-ordering clearfix">';

	$html .= '<div class="orderby-order-container">';
	$html .= woocommerce_catalog_ordering();
	$html .= '<span class="show-product"> ' . esc_html__( 'Show', 'furnicom' ) .' </span>';
	$html .= '<ul class="sort-count order-dropdown">';
	$html .= '<li>';
	$html .= '<span class="current-li"><a>'.esc_html__('12', 'furnicom').'</a></span>';
	$html .= '<ul>';
	$html .= '<li class="'.(($pc == $per_page) ? 'current': '').'"><a href="'.furnicom_addURLParameter($query_string, 'product_count', $per_page).'">'.$per_page.'</a></li>';
	$html .= '<li class="'.(($pc == $per_page*2) ? 'current': '').'"><a href="'.furnicom_addURLParameter($query_string, 'product_count', $per_page*2).'">'.($per_page*2).'</a></li>';
	$html .= '<li class="'.(($pc == $per_page*3) ? 'current': '').'"><a href="'.furnicom_addURLParameter($query_string, 'product_count', $per_page*3).'">'.($per_page*3).'</a></li>';
	$html .= '</ul>';
	$html .= '</li>';
	$html .= '</ul>';
	$html .= '</div>';
	$html .= '</div>';
	
	echo $html;
}

add_filter('loop_shop_per_page', 'furnicom_loop_shop_per_page');
function furnicom_loop_shop_per_page()
{
	global $data;

	parse_str($_SERVER['QUERY_STRING'], $params);

	$option_number 	=  furnicom_options()->getCpanelValue( 'product_number' );
	// replace it with theme option
	if( $option_number ) {
		$per_page = $option_number;
	} else {
		$per_page = 12;
	}

	$pc = !empty($params['product_count']) ? $params['product_count'] : $per_page;

	return $pc;
}
/*********QUICK VIEW PRODUCT**********/

add_action("wp_ajax_furnicom_quickviewproduct", "furnicom_quickviewproduct");
add_action("wp_ajax_nopriv_furnicom_quickviewproduct", "furnicom_quickviewproduct");
function furnicom_quickviewproduct(){
	
	$productid = (isset($_REQUEST["post_id"]) && $_REQUEST["post_id"]>0) ? $_REQUEST["post_id"] : 0;
	
	$query_args = array(
		'post_type'	=> 'product',
		'p'			=> $productid
	);
	$outputraw = $output = '';
	$r = new WP_Query($query_args);
	if($r->have_posts()){ 

		while ($r->have_posts()){ $r->the_post(); setup_postdata($r->post);
			global $product;
			ob_start();
			wc_get_template_part( 'content', 'quickview-product' );
			$outputraw = ob_get_contents();
			ob_end_clean();
		}
	}
	$output = preg_replace(array('/\s{2,}/', '/[\t\n]/'), ' ', $outputraw);
	echo $output;exit();
}
/* Product loop content */
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );

add_action( 'woocommerce_shop_loop_item_title', 'furnicom_loop_product_title', 10 );
add_action( 'woocommerce_after_shop_loop_item_title', 'furnicom_product_description', 20 );
add_action( 'woocommerce_after_shop_loop_item', 'furnicom_product_addcart_start', 1 );
add_action( 'woocommerce_after_shop_loop_item', 'furnicom_product_addcart_first', 9 );
add_action( 'woocommerce_after_shop_loop_item', 'furnicom_product_addcart_mid', 20 );
add_action( 'woocommerce_after_shop_loop_item', 'furnicom_product_addcart_end', 99 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 15 );
if( furnicom_options()->getCpanelValue( 'product_listing_countdown' ) ){
	add_action( 'woocommerce_before_shop_loop_item_title', 'furnicom_product_deal', 20 );
}


function furnicom_loop_product_title(){
	?>
		<h4><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title() ?></a></h4>
	<?php
}
function furnicom_product_description(){
	global $post;
	if ( ! $post->post_excerpt ) return;
	
	echo '<div class="item-description">'.wp_trim_words( $post->post_excerpt, 20 ).'</div>';
}
function furnicom_product_addcart_start(){
	echo '<div class="item-bottom">';
}
function furnicom_product_addcart_end(){
	echo '</div>';
}
function furnicom_product_addcart_first(){
	global $post;
	$post_id = $post->ID;
	$html = '';
	if( class_exists( 'YITH_WOOCOMPARE' ) && !furnicom_mobile_check() ){
		$html .= '<div class="compare-button product"><a href="#" class="compare button" data-product_id="'. $post_id .'" rel="nofollow">'. esc_html__( 'Compare', 'furnicom' ) .'</a></div>';
	}
	echo $html;
}
function furnicom_product_addcart_mid(){
	global $product;
	$html ='';
	/* compare & wishlist */
	if( class_exists( 'YITH_WCWL' ) ){update_option( 'yith_wcwl_after_add_to_wishlist_behaviour', 'add' );
		$html .= do_shortcode( "[yith_wcwl_add_to_wishlist]" );
	}
	echo $html;
}

/*
** Filter product category class
*/
add_filter( 'product_cat_class', 'furnicom_product_category_class', 2 );
function furnicom_product_category_class( $classes, $category = null ){
	global $woocommerce_loop;
	
	$col_lg = ( furnicom_options()->getCpanelValue( 'product_colcat_large' ) )  ? furnicom_options()->getCpanelValue( 'product_colcat_large' ) : 1;
	$col_md = ( furnicom_options()->getCpanelValue( 'product_colcat_medium' ) ) ? furnicom_options()->getCpanelValue( 'product_colcat_medium' ) : 1;
	$col_sm = ( furnicom_options()->getCpanelValue( 'product_colcat_sm' ) )	   ? furnicom_options()->getCpanelValue( 'product_colcat_sm' ) : 1;
	
	
	$column1 = str_replace( '.', '' , floatval( 12 / $col_lg ) );
	$column2 = str_replace( '.', '' , floatval( 12 / $col_md ) );
	$column3 = str_replace( '.', '' , floatval( 12 / $col_sm ) );

	$classes[] = ' col-lg-'.$column1.' col-md-'.$column2.' col-sm-'.$column3.' col-xs-6';
	
	return $classes;
}

/*
** attribute for product listing
*/
function furnicom_product_attribute(){
	global $woocommerce_loop;
	
	$col_lg = furnicom_options()->getCpanelValue( 'product_col_large' );
	$col_md = furnicom_options()->getCpanelValue( 'product_col_medium' );
	$col_sm = furnicom_options()->getCpanelValue( 'product_col_sm' );
	$class_col= "item ";
	
	if( isset( get_queried_object()->term_id ) ) :
		$term_col_lg  = get_term_meta( get_queried_object()->term_id, 'term_col_lg', true );
		$term_col_md  = get_term_meta( get_queried_object()->term_id, 'term_col_md', true );
		$term_col_sm  = get_term_meta( get_queried_object()->term_id, 'term_col_sm', true );

		$col_lg = ( intval( $term_col_lg ) > 0 ) ? $term_col_lg : furnicom_options()->getCpanelValue( 'product_col_large' );
		$col_md = ( intval( $term_col_md ) > 0 ) ? $term_col_md : furnicom_options()->getCpanelValue( 'product_col_medium' );
		$col_sm = ( intval( $term_col_sm ) > 0 ) ? $term_col_sm : furnicom_options()->getCpanelValue( 'product_col_sm' );
	endif;
	
	$col_large 	= ( $col_lg ) ? $col_lg : 4;
	$col_medium = ( $col_md ) ? $col_md : 4;
	$col_small	= ( $col_sm ) ? $col_sm : 4;
	
	$column1 = str_replace( '.', '' , floatval( 12 / $col_large ) );
	$column2 = str_replace( '.', '' , floatval( 12 / $col_medium ) );
	$column3 = str_replace( '.', '' , floatval( 12 / $col_small ) );

	$class_col .= ' col-lg-'.$column1.' col-md-'.$column2.' col-sm-'.$column3.' col-xs-6';
	
	return esc_attr( $class_col );
}

/* ==========================================================================================
	** Single Product
   ========================================================================================== */
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 15 );
add_action( 'woocommerce_single_product_summary', 'furnicom_product_excerpt', 20 );
add_action( 'woocommerce_single_product_summary', 'furnicom_woocommerce_sharing', 35 );
if( furnicom_options()->getCpanelValue( 'product_single_countdown' ) ){
	add_action( 'woocommerce_single_product_summary', 'furnicom_product_deal',10 );
}

if( !function_exists( 'furnicom_single_addcart_wrapper_start' ) ) :
	add_action( 'woocommerce_single_product_summary', 'furnicom_single_addcart_wrapper_start', 25 );
	add_action( 'woocommerce_after_add_to_cart_button', 'furnicom_single_addcart', 10 );
	add_action( 'woocommerce_single_product_summary', 'furnicom_single_addcart_wrapper_end', 32 );
	function furnicom_single_addcart_wrapper_start(){
		echo '<div class="product-summary-bottom clearfix">';
	}
	function furnicom_single_addcart_wrapper_end(){
		echo "</div>";
	}
	function furnicom_single_addcart(){
		/* compare & wishlist */
		global $post;
		$product_id = $post->ID;
		if( !furnicom_mobile_check() ) {
			$html = '<div class="single-product-addcart clearfix">';
			if( class_exists( 'YITH_WOOCOMPARE' ) ){
				$html .= '<div class="compare-button"><a href="javascript:void(0)" class="compare button" data-product_id="'. esc_attr( $product_id ) .'" rel="nofollow">'. esc_html__( 'Compare', 'furnicom' ) .'</a></div>';
			}
			if( class_exists( 'YITH_WCWL' ) ){update_option( 'yith_wcwl_after_add_to_wishlist_behaviour', 'add' );
				$html .= do_shortcode( "[yith_wcwl_add_to_wishlist]" );
			}
			$html .= '</div>';
			echo $html;
		}
	}
endif;

function furnicom_woocommerce_sharing(){
	$html  = '';
	if( furnicom_mobile_check() ) :
		$html .= furnicom_get_social();
	else :
		$html .= '<div class="single-product-sharing">';
		$html .= get_social();
		$html .= '</div>';
	endif;
	
	echo $html;
}
function furnicom_product_excerpt(){
	global $post;
	
	if ( ! $post->post_excerpt ) {
		return;
	}
	$html = '';
	$html .= '<div class="product-description" itemprop="description">';
	$html .= '<h2 class="quick-overview">'. esc_html__( 'Quick Overview', 'furnicom' ) .'</h2>';
	$html .= apply_filters( 'woocommerce_short_description', $post->post_excerpt );
	$html .= '</div>';
	echo $html;
}

/*
** Add page deal to listing
*/
function furnicom_product_deal(){
	if( ( is_shop() || is_tax( 'product_cat' ) || is_tax( 'product_tag' ) || is_post_type_archive( 'product' ) ) || is_singular( 'product' ) ) {
		global $product;
		$start_time 	= get_post_meta( $product->get_id(), '_sale_price_dates_from', true );
		$countdown_time = get_post_meta( $product->get_id(), '_sale_price_dates_to', true );	
		
		if( !empty ($countdown_time ) && $countdown_time > $start_time ) :
?>
		<div class="sw-product-countdown" data-date="<?php echo esc_attr( $countdown_time ); ?>" data-starttime="<?php echo esc_attr( $start_time ); ?>" data-cdtime="<?php echo esc_attr( $countdown_time ); ?>" data-id="<?php echo esc_attr( 'product_' . $product->get_id() ); ?>"></div>
<?php 
		endif;
	}
}

/* Add Product Tag To Tabs */
add_filter( 'woocommerce_product_tabs', 'furnicom_tab_tag' );
function furnicom_tab_tag($tabs){
	global $post, $product;
	$tag_count = get_the_terms( $post->ID, 'product_tag' );
	if ( is_array( $tag_count ) && count( $tag_count ) ) {
		$tabs['product_tag'] = array(
			'title'    => esc_html__( 'Tags', 'furnicom' ),
			'priority' => 11,
			'callback' => 'furnicom_single_product_tab_tag'
		);
	}
	return $tabs;
}
function furnicom_single_product_tab_tag(){
	global $post, $product;
	echo wc_get_product_tag_list( $product->get_id(), ', ', '<span class="tagged_as">' . _n( 'Tag:', 'Tags:', count( $product->get_tag_ids() ), 'furnicom' ) . ' ', '</span>' ); 
}
function furnicom_cpwl_init(){
	if( class_exists( 'YITH_WOOCOMPARE' ) ){
		update_option( 'yith_woocompare_compare_button_in_product_page', 'no' );
		update_option( 'yith_woocompare_compare_button_in_products_list', 'no' );
	}
	if( class_exists( 'YITH_WCWL' ) ){
		update_option( 'yith_wcwl_after_add_to_wishlist_behaviour', 'add' );
		update_option( 'yith_wcwl_button_position', 'shortcode' );
		
	}
}
add_action('admin_init','furnicom_cpwl_init');
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

/*
**Hook into review for rick snippet
*/
add_action( 'woocommerce_review_before_comment_meta', 'furnicom_title_ricksnippet', 10 ) ;
function furnicom_title_ricksnippet(){
	global $post;
	echo '<span class="hidden" itemprop="itemReviewed" itemscope itemtype="http://schema.org/Thing">
    <span itemprop="name">'. $post->post_title .'</span>
  </span>';
}

/*
** Add Label New and SoldOut
*/
if( !function_exists( 'sw_label_new' ) ){
	function sw_label_new(){
		global $product;
		$html = '';
		$newtime = ( get_post_meta( $product->get_id(), 'newproduct', true ) != '' && get_post_meta( $product->get_id(), 'newproduct', true ) ) ? get_post_meta( $product->get_id(), 'newproduct', true ) : furnicom_options()->getCpanelValue( 'newproduct_time' );
		$product_date = get_the_date( 'Y-m-d', $product->get_id() );
		$newdate = strtotime( $product_date ) + intval( $newtime ) * 24 * 3600;
		if( ! $product->is_in_stock() ) :
			$html .= '<span class="sw-outstock">'. esc_html__( 'Out Of Stock', 'furnicom' ) .'</span>';		
		else:
			if( $newtime != '' && $newdate > time() ) :
				$html .= '<span class="sw-newlabel">'. esc_html__( 'New', 'furnicom' ) .'</span>';			
			endif;
		endif;
		return apply_filters( 'sw_label_new', $html );
	}
}

/*
** Check for mobile layout
*/
if( furnicom_mobile_check() ){
	remove_action( 'woocommerce_single_product_summary', 'furnicom_woocommerce_sharing', 35 );
	remove_action( 'woocommerce_before_shop_loop_item_title', 'furnicom_product_deal', 20 );
	add_action( 'woocommerce_single_product_summary', 'furnicom_mobile_woocommerce_sharing', 5 );
}

function furnicom_mobile_woocommerce_sharing(){
	echo '<div class="item-meta-mobile">';
		furnicom_get_social();
		if( class_exists( 'YITH_WCWL' ) ) :
			echo do_shortcode( "[yith_wcwl_add_to_wishlist]" );
		endif;
	echo '</div>';
}