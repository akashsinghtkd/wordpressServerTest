<?php
/**
 * Single Product Meta
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product;
?>
<div class="product_meta">

	<?php do_action( 'woocommerce_product_meta_start' ); ?>
	<div class="code-sku">
		<?php echo '<span itemprop="productID" class="sku">PRODUCT CODE : SKU- ' .'<a>'. $product->sku .'</a>'. '</span>'; ?>
	</div>
	<?php
		$size = sizeof( get_the_terms( $post->ID, 'product_tag' ) );
		echo $product->get_tags( ', ', '<span class="tagged_as">' . _n( 'Tag:', 'Tags:', $size, 'furnicom' ) . ' ', '.</span>' );
	?>

	<?php do_action( 'woocommerce_product_meta_end' ); ?>

</div>