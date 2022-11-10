<?php 
if ( !class_exists('Woocommerce') ) { 
	return false;
}
global $woocommerce; ?>
<div class="top-form top-form-minicart furnicom-minicart">
	<div class="top-minicart-icon">
		<p class="icon-cart"><?php esc_html_e('icon cart', 'furnicom'); ?></p>
		<div class="cart-right">
			<span class="text-cart"><?php esc_html_e('My Cart', 'furnicom'); ?></span>
			<a class="cart-contents" href="<?php echo wc_get_cart_url(); ?>" title="<?php esc_html_e('View your shopping cart', 'furnicom'); ?>"><?php echo '<span class="minicart-number">'.$woocommerce->cart->cart_contents_count.' </span>';( $woocommerce->cart->cart_contents_count > 1 )? esc_html_e('items', 'furnicom') : esc_html_e('item', 'furnicom');?></a>
		</div>
	</div>
	<div class="wrapp-minicart">
		<div class="minicart-padding">
			<div class="minicart-title">
				<span><?php echo esc_html_e('Your Product', 'furnicom');?></span>
				<span class="price-title"><?php echo esc_html_e('Price', 'furnicom');?></span>
			</div>
			<ul class="minicart-content">
				<?php foreach($woocommerce->cart->cart_contents as $cart_item_key => $cart_item): 
						 $_product  = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
						$product_name = ( sw_woocommerce_version_check( '3.0' ) ) ? $_product->get_name() : $_product->get_title();	
				?>
				<li>
					<div class="minicart-img">
						<a href="<?php echo get_permalink($cart_item['product_id']); ?>" class="product-image">
							<?php echo $_product->get_image(array(70,60)) ; ?>
						</a>
						<div class="product-action">
							<?php echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf( '<a href="%s" class="btn-remove" title="%s"><span></span></a>', esc_url( wc_get_cart_remove_url( $cart_item_key ) ), esc_html__( 'Remove this item', 'furnicom' ) ), $cart_item_key ); ?>
						</div>
					</div>
					<?php 	global $product, $post, $wpdb, $average;
						$count = $wpdb->get_var($wpdb->prepare("
							SELECT COUNT(meta_value) FROM $wpdb->commentmeta
							LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
							WHERE meta_key = 'rating'
							AND comment_post_ID = %d
							AND comment_approved = '1'
							AND meta_value > 0
						",$cart_item['product_id']));

						$rating = $wpdb->get_var($wpdb->prepare("
							SELECT SUM(meta_value) FROM $wpdb->commentmeta
							LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
							WHERE meta_key = 'rating'
							AND comment_post_ID = %d
							AND comment_approved = '1'
						",$cart_item['product_id']));?>			 
					<div class="detail-item">
						<div class="product-details">
							<div class="product-information"> 
								<div class="product-name">
									<a href="<?php echo get_permalink($cart_item['product_id']); ?>"><?php echo esc_html( $product_name ); ?></a>	  		
								</div>
								<div class="qty">
								<span class="qty-label"><?php echo esc_html_e('Quantity: ', 'furnicom');?></span>
									<?php echo '<span class="qty-number">'.esc_html( $cart_item['quantity'] ).'</span>'; ?>
								</div>
							</div>
							<div class="product-price">
								 <span class="price"><?php echo $woocommerce->cart->get_product_subtotal($cart_item['data'], 1); ?></span>		        		        		    		
							</div>
						</div>	
					</div>			
				</li>
			<?php
			endforeach;
			?>
			</ul>
			<div class="cart-checkout">
			    <div class="price-total">
				   <span class="label-price-total"><?php esc_html_e('Total:', 'furnicom'); ?></span>
				   <span class="price-total-w"><span class="price"><?php echo $woocommerce->cart->get_cart_total(); ?></span></span>
				   
				</div>
				<div class="cart-links">
					<div class="cart-link"><a href="<?php echo get_permalink(get_option('woocommerce_cart_page_id')); ?>" title="<?php esc_attr_e( 'Cart', 'furnicom' ) ?>"><?php esc_html_e('Go To Cart', 'furnicom'); ?></a></div>
					<div class="checkout-link"><a href="<?php echo get_permalink(get_option('woocommerce_checkout_page_id')); ?>" title="<?php esc_attr_e( 'Check Out', 'furnicom' ) ?>"><?php esc_html_e('Check Out', 'furnicom'); ?></a></div>
				</div>
			</div>
		</div>
	</div>
</div>