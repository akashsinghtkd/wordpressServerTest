<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version   	3.5.1
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
global $post, $woocommerce, $product;
$sidebar_product 		 = furnicom_options()->getCpanelValue( 'sidebar_product_detail' );
$furnicom_featured_video = get_post_meta( $post->ID, 'featured_video_product', true ); 
$post_thumbnail_id	 	 = get_post_thumbnail_id( $post->ID );
$attachments 			 = array();

?>
<div id="product_img_<?php echo esc_attr( $post->ID ); ?>" class="woocommerce-product-gallery woocommerce-product-gallery--with-images images product-images loading" data-vertical="<?php echo ( $sidebar_product == 'full' ) ? 'true' : 'false'; ?>" data-video="<?php echo sprintf( ( $furnicom_featured_video != '' ) ? '%s' : '', esc_url( 'https://www.youtube.com/embed/' . $furnicom_featured_video ) ); ?>">
	<figure class="woocommerce-product-gallery__wrapper">
	<div class="product-images-container clearfix <?php echo ( $sidebar_product == 'full' ) ? 'thumbnail-left' : 'thumbnail-bottom'; ?>">
		<?php 
			if( has_post_thumbnail() ){ 
				$attachments = ( sw_woocommerce_version_check( '3.0' ) ) ? $product->get_gallery_image_ids() : $product->get_gallery_attachment_ids();
				$image_id 	 = get_post_thumbnail_id();
				array_unshift( $attachments, $image_id );
		?>
		<?php 
			if( $sidebar_product == 'full' ){
				do_action('woocommerce_product_thumbnails');
			}
		?>
		<!-- Image Slider -->
		<div class="slider product-responsive">
			<?php  
				foreach ( $attachments as $key => $attachment ) { 
				$full_size_image  = wp_get_attachment_image_src( $attachment, 'full' );
				$thumbnail_post   = get_post( $attachment );

				$attributes = array(
					'class' => 'wp-post-image',
					'title'                   => get_post_field( 'post_title', $post_thumbnail_id ),
					'data-caption'            => get_post_field( 'post_excerpt', $post_thumbnail_id ),
					'data-src'                => $full_size_image[0],
					'data-large_image'        => $full_size_image[0],
					'data-large_image_width'  => $full_size_image[1],
					'data-large_image_height' => $full_size_image[2],
				);
			?>
			<div data-thumb="<?php echo wp_get_attachment_image_url( $attachment, 'shop_thumbnail' ) ?>" class="woocommerce-product-gallery__image">
				<?php if( furnicom_mobile_check() ):
							echo sw_label_sales();
						endif;
					?>
				<a href="<?php echo wp_get_attachment_url( $attachment ) ?>"><?php echo wp_get_attachment_image( $attachment, 'shop_single', false, $attributes ); ?></a>
			</div>
			<?php } ?>
		</div>
		<!-- Thumbnail Slider -->
		<?php 
			if( $sidebar_product != 'full' ){
				do_action('woocommerce_product_thumbnails'); 
			}
		?>
		<?php }else{ ?>
			<div class="single-img-product">
					<?php echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), esc_html__( 'Placeholder', 'furnicom' ) ), $post->ID ); ?>
			</div>
		<?php } ?>
	</div>
	</figure>
</div>