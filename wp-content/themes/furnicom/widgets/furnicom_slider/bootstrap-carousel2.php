<?php 
if (!isset($instance['category'])){
	$instance['category'] = 0;
}

$instance['interval'] = isset( $instance['interval'] ) ? intval( $instance['interval'] ) : 5000;

extract($instance);

$default = array(
	'category' => $category,
	'orderby' => $orderby,
	'order' => $order,
	'post_status' => 'publish',
	'numberposts' => $numberposts
);

$list = get_posts($default);
$list1 = preg_split( '/[\s,]+/', $include, -1, PREG_SPLIT_NO_EMPTY );
if ( count( $list )>0 || count( $list1 ) > 0 ){
?>
	<script type="text/javascript">
		yaCarousel = {} ;
		yaCarousel['<?php echo esc_attr( $this->id ); ?>'] = {
			interval : <?php echo esc_attr( $interval ); ?>,
		};
	</script>
<div class="widget-slider">
	<div class="yaslider carousel slide style2" id="<?php echo $esc_attr( this->id ); ?>" data-interval="<?php echo esc_attr( $interval ); ?>">
		<!-- If select post ID -->
		<?php if( count( $list1 ) > 0  ) {?>        
		<div class="carousel-inner">
			<?php foreach ( $list1 as $i => $post ){?>
			<div class="item <?php if ( $i==0 )echo "active";?>">
				<a href="<?php echo get_permalink( $post->ID ); ?>"><?php echo get_the_post_thumbnail( $post->ID ); ?></a>
				<div class="slider-caption">
					<h3><?php echo esc_html( $post -> post_title ); ?></h3>
					<div class="caption-desc">
						<?php 
						if ( preg_match('/<!--more(.*?)?-->/', $post->post_content, $matches) ) {
							$content = explode($matches[0], $post->post_content, 2);
							$content = $content[0];
						} else {
							$content = self::furnicom_trim_words($post->post_content, $length, ' ');
						}
						echo esc_html( $content );
						?>
					</div>
				</div>
			</div>
			<?php }?>
		</div>
		<!-- End select Post ID -->
		
		<!-- select Category -->
		<?php } else{ ?>
			<div class="carousel-inner">
				<?php foreach ( $list as $i => $post ){?>
				<div class="item <?php if ( $i==0 )echo "active";?>">
					<a href="<?php echo get_permalink( $post->ID ); ?>"><?php echo get_the_post_thumbnail( $post->ID ); ?></a>
					<div class="slider-caption">
						<span><?php echo esc_html( $post -> post_title ); ?></span>
						<div class="caption-desc">
							<?php 			
								$content = self::furnicom_trim_words($post->post_content, $length, ' ');
								echo esc_html( $content );
							?>
						</div>
					</div>
				</div>
				<?php }?>
			</div>
		<?php } ?>
			<div class="carousel-nav">
				<a href="#<?php echo esc_attr( $this->id ); ?>" data-slide="prev" class="carousel-control left"><i class="icon-angle-left"></i></a>
				<a href="#<?php echo esc_attr( $this->id ); ?>" data-slide="next" class="carousel-control right"><i class="icon-angle-right"></i></a>
			</div>
	</div>
</div>
	<?php 
	add_action('wp_footer', array($this, 'add_script_slideshow'), 50 );
}?>
