<?php 	global $woocommerce;	$number    		= isset( $instance['numberposts'] ) ? intval($instance['numberposts']) : 5;	$query_args = array(    		'posts_per_page' => $number,    		'post_status' 	 => 'publish',    		'post_type' 	 => 'product',    		'meta_key' 		 => 'total_sales',    		'orderby' 		 => 'meta_value_num',    		'no_found_rows'  => 1,    	);    	$query_args['meta_query'] = $woocommerce->query->get_meta_query();    	if ( isset( $instance['hide_free'] ) && 1 == $instance['hide_free'] ) {    		$query_args['meta_query'][] = array(			    'key'     => '_price',			    'value'   => 0,			    'compare' => '>',			    'type'    => 'DECIMAL',			);    	}		$r = new WP_Query($query_args);		if ( $r->have_posts() ) {?><div id="<?php echo esc_attr( $widget_id ); ?>" class="sw-best-seller-product">	<ul class="list-unstyled">	<?php		while ( $r -> have_posts() ) : $r -> the_post();		global $product, $post;		$rating_count = $product->get_rating_count();		$review_count = $product->get_review_count();		$average      = $product->get_average_rating();	?>		<li class="clearfix">			<div class="item-img">				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>">					<?php if( has_post_thumbnail() ){  						echo (get_the_post_thumbnail( $r->post->ID, 'shop_thumbnail' )) ? get_the_post_thumbnail( $r->post->ID, 'shop_thumbnail' ):'<img src="'.get_template_directory_uri().'/assets/img/placeholder/shop_thumbnail.png" alt="No thumb"/>' ;					}else{ 						echo '<img src="'.get_template_directory_uri().'/assets/img/placeholder/shop_thumbnail.png" alt="No thumb"/>' ;					} ?>				</a>			</div>			<div class="item-content">				<h4><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php the_title(); ?></a></h4>				<div class="star"><?php echo ( $average > 0 ) ?'<span style="width:'. ( $average*16 ).'px"></span>' : ''; ?></div>				<p><?php echo $product->get_price_html(); ?></p>			</div>		</li>	<?php 		endwhile;		wp_reset_postdata();	?>	</ul></div><?php } ?>