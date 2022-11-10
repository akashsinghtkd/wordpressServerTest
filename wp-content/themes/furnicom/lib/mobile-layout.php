<?php 
/*
** Mobile Layout 
*/
if( !class_exists( 'Mobile_Detect' ) ) {
	require_once( get_template_directory().'/lib/mobile-detect.php' );
}

/*
** Check Header Mobile or Desktop
*/
function furnicom_header_check(){ 
	global $furnicom_detect;
	$mobile_check  = furnicom_options()->getCpanelValue( 'mobile_enable' );
	$mobile_header = ( get_post_meta( get_the_ID(), 'page_mobile_header', true ) != '' ) ? get_post_meta( get_the_ID(), 'page_mobile_header', true ) : furnicom_options()->getCpanelValue( 'mobile_header_style' );
	$page_header   = ( get_post_meta( get_the_ID(), 'page_header_style', true ) != '' ) ? get_post_meta( get_the_ID(), 'page_header_style', true ) : furnicom_options()->getCpanelValue('header_style');
	$furnicom_header_style 	= furnicom_options()->getCpanelValue('header_style');
	/* 
	** Display header or not 
	*/
	if( get_post_meta( get_the_ID(), 'page_header_hide', true ) ) :
		return ;
	endif;
	$mobile_check   = furnicom_options()->getCpanelValue( 'mobile_enable' );
	if( furnicom_mobile_check() ):
		get_template_part( 'mlayouts/header', $mobile_header );
	else: 
		get_template_part( 'templates/header', $furnicom_header_style );
	endif;
}

/*
** Check Footer Mobile or Desktop
*/
function furnicom_footer_check(){
	$mobile_check  = furnicom_options()->getCpanelValue( 'mobile_enable' );
	$mobile_footer = ( get_post_meta( get_the_ID(), 'page_mobile_footer', true ) != '' ) ? get_post_meta( get_the_ID(), 'page_mobile_footer', true ) : furnicom_options()->getCpanelValue( 'mobile_footer_style' );
	$furnicom_header_style 	= furnicom_options()->getCpanelValue('footer_style');
	if( furnicom_mobile_check() && $mobile_footer != '' ):
		get_template_part( 'mlayouts/footer', $mobile_footer );
	else: 
		get_template_part( 'templates/footer', $furnicom_header_style );
	endif;
}

/*
** Check Content Page Mobile or Desktop
*/
function furnicom_pagecontent_check(){
	$mobile_check   = furnicom_options()->getCpanelValue( 'mobile_enable' );
	$mobile_content = furnicom_options()->getCpanelValue( 'mobile_content' );
	if( furnicom_mobile_check() && $mobile_content != '' && is_front_page() ):
		echo get_the_content_by_id( $mobile_content );
	else: 
		the_content();
	endif;
}

/*
** Check Product Listing Mobile or Desktop
*/
function furnicom_product_listing_check(){
	$mobile_check   = furnicom_options()->getCpanelValue( 'mobile_enable' );
	if( furnicom_mobile_check() ) :
		get_template_part('mlayouts/archive','product-mobile');
	else: 
		 wc_get_template( 'archive-product.php' );
	endif;
}

/*
** Check Product Listing Mobile or Desktop
*/
function furnicom_blog_listing_check(){
	$mobile_check   = furnicom_options()->getCpanelValue( 'mobile_enable' );
	if( furnicom_mobile_check()  ) :
		get_template_part('mlayouts/archive', 'mobile');
	else: 
		get_template_part( 'templates/content' );
	endif;		
}

/*
** Check Product Detail Mobile or Desktop
*/
function furnicom_product_detail_check(){
	$mobile_check   = furnicom_options()->getCpanelValue( 'mobile_enable' );
	if( furnicom_mobile_check()  ) :
		get_template_part('mlayouts/single','product');
	else: 
		 wc_get_template( 'single-product.php' );
	endif;
}

/*
** Check Product Detail Mobile or Desktop
*/
function furnicom_content_detail_check(){
	$mobile_check   = furnicom_options()->getCpanelValue( 'mobile_enable' );
	if( furnicom_mobile_check() ) :
		get_template_part('mlayouts/single','mobile');
	else: 
		 get_template_part('templates/content', 'single');
	endif;		
}

/*
** Product Meta
*/

if( !function_exists( 'furnicom_mobile_check' ) ){
	function furnicom_mobile_check(){
		global $furnicom_detect;
		
		$sw_demo   		  = get_option( 'sw_mdemo' );
		$mobile_check   = furnicom_options()->getCpanelValue( 'mobile_enable' );
		
		if( $sw_demo == 1 ) :
			return true;
		endif;
		
		if( !empty( $furnicom_detect ) && $mobile_check && $furnicom_detect->isMobile() && !$furnicom_detect->isTablet() ) :
			return true;
		else: 
			return false;
		endif;
		return false;
	}
}

/*
** Number of post for a WordPress archive page
*/
function furnicom_Per_category_basis($query){
	global $furnicom_detect;
	$mobile_check   = furnicom_options()->getCpanelValue( 'mobile_enable' );
    if ( ( $query->is_category ) ) {
        /* set post per page */
        if ( is_archive() && furnicom_mobile_check() ){
            $query->set('posts_per_page', 3);
        }
    }
    return $query;

}
add_filter('pre_get_posts', 'furnicom_Per_category_basis');


