<?php 
if (!isset($instance['category'])){
	$instance['category'] = 0;
}
extract($instance);

$default = array(
	'category' => $category,
	'orderby' => $orderby,
	'order' => $order,
	'include' => $include,
	'exclude' => $exclude,
	'post_status' => 'publish',
	'numberposts' => $numberposts
);

$list = get_posts($default);
if (count($list)>0){
?>
<div class="widget-latest-blog">
	<div class="blog-content">
		<?php foreach ($list as $post){?>
		<div class="blog-item">
			<div class="latest-blog-inner">
				<?php if (get_the_post_thumbnail( $post->ID )) {?>
				<div class="widget-thumb">
					<a href="<?php echo get_permalink($post->ID)?>"><?php echo get_the_post_thumbnail($post->ID, 'furnicomlatest-blog2');?></a>
				</div>
				<?php } ?>
				<div class="widget-content-wrap">
		 			<div class="widget-content">
		 				<div class="item-title">
		 					<h4><a href="<?php echo get_permalink($post->ID)?>"><?php echo $post->post_title;?></a></h4>
		 				</div>
		 				<div class="item-content">
							<p>
								<?php 												
									if ( preg_match('/<!--more(.*?)?-->/', $post->post_content, $matches) ) {
										$content = explode($matches[0], $post->post_content, 2);
										$content = $content[0];
										$content = wp_trim_words($post->post_content, $length, '');
										echo $content;	
									} else {
										the_content('...');
									}		
								?>
							</p>
		 				</div>
		 				<span class="entry-date">
							<?php echo ( get_the_title() ) ? date( 'F, j, Y',strtotime($post->post_date)) : '<a href="'.get_the_permalink().'">'.date( 'F, j, Y',strtotime($post->post_date)).'</a>'; ?>
						</span>
		 			</div>
				</div>
			</div>
		</div>
		<?php }?>
	</div>
</div>
<?php }?>