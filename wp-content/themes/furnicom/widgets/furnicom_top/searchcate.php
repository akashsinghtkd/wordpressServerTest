<div class="top-form top-search pull-left">
	<div class="topsearch-entry">
	<?php if ( class_exists( 'WooCommerce' ) ) { ?>
		<form method="get" id="searchform_special" action="<?php echo esc_url( home_url( '/'  ) ); ?>" class="form-search searchform">
			<div>	
				<?php
				$args = array(
				'type' => 'post',
				'parent' => 0,
				'orderby' => 'id',
				'order' => 'ASC',
				'hide_empty' => false,
				'hierarchical' => 1,
				'exclude' => '',
				'include' => '',
				'number' => '',
				'taxonomy' => 'product_cat',
				'pad_counts' => false,

				);
				$product_categories = get_categories($args);
				?>
				<input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" class="search-query" placeholder="<?php esc_html_e( 'Enter your keyword...', 'furnicom' ); ?>" />
				<button type="submit" title="<?php esc_attr_e( 'Search', 'furnicom' ) ?>" class="button-search-pro form-button"><?php esc_attr_e( 'Search', 'furnicom' ) ?></button>
				<input type="hidden" name="search_posttype" value="product" />
			</div>
		</form>
		<?php }else{ ?>
			<?php get_template_part('templates/searchform'); ?>
		<?php } ?>
	</div>
</div>
