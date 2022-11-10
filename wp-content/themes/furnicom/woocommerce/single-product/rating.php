<?php
/*
 * Single Product Rating
 *
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     3.6.0
*/
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


global $product;

if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' ) {
	return;
}

if ( ! wc_review_ratings_enabled() ) {
	return;
}
	$rating_count = $product->get_rating_count();
	$review_count = $product->get_review_count();
	$average      = $product->get_average_rating();
	if(  $rating_count > 0 ) :
?>

<div class="reviews-content" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
	<div class="star">
		<?php echo '<span style="width:'. ( $average*16 ) .'px"></span>'; ?>
		<div class="rating-hidden">
			<strong itemprop="ratingValue" class="rating"><?php echo esc_html( $average ); ?></strong> <?php printf( __( 'out of %s5%s', 'furnicom' ), '<span itemprop="bestRating">', '</span>' ); ?>
			<?php printf( _n( 'based on %s customer rating', 'based on %s customer ratings', $rating_count, 'furnicom' ), '<span itemprop="ratingCount" class="rating">' . $rating_count . '</span>' ); ?>
		</div>
	</div>
		<a href="#reviews" class="woocommerce-review-link" rel="nofollow"><?php printf( _n( '%s Review', '%s Review(s)', $rating_count, 'furnicom' ), '<span itemprop="ratingCount" class="count">' . $rating_count . '</span>' ); ?></a>
	<?php $stock = ( $product->is_in_stock() )? 'in-stock' : 'out-stock' ; ?>
	<div class="product-stock <?php echo esc_attr( $stock ); ?>">
		<span><?php echo ( $product->is_in_stock() )? esc_html__( 'in stock', 'furnicom' ) : esc_html__( 'Out stock', 'furnicom' ); ?></span>
	</div>
</div>

<?php else : ?>

<div class="reviews-content">
	<div class="star"><?php echo ( $average > 0 ) ?'<span style="width:'. ( $average*16 ).'px"></span>' : ''; ?></div>
		<a href="#reviews" class="woocommerce-review-link" rel="nofollow"><?php printf( _n( '%s Review', '%s Review(s)', $rating_count, 'furnicom' ), '<span class="count">' . $rating_count . '</span>' ); ?></a>
	<?php $stock = ( $product->is_in_stock() )? 'in-stock' : 'out-stock' ; ?>
	<div class="product-stock <?php echo esc_attr( $stock ); ?>">
		<span><?php echo ( $product->is_in_stock() )? esc_html__( 'in stock', 'furnicom' ) : esc_html__( 'Out stock', 'furnicom' ); ?></span>
	</div>
</div>

<?php endif; ?>
<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>
<div class="product_meta">
	<span class="sku_wrapper"><?php esc_html_e( 'SKU:', 'furnicom' ); ?> <span class="sku" itemprop="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'furnicom' ); ?></span></span>
</div>
<?php endif; ?>