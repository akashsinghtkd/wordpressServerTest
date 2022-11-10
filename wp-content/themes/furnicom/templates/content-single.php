
<?php get_template_part('header'); ?>
<?php $sidebar_template = furnicom_options()->getCpanelValue('sidebar_blog') ;?>

	<!-- Breadcrumb title -->
	<?php furnicom_breadcrumb_title() ?>

	<div class="container">
		<div class="row sidebar-row">
<?php if ( is_active_sidebar_Furnicom('left-blog') && $sidebar_template != 'right_sidebar' && $sidebar_template !='full' ):
	$left_span_class = 'col-lg-'.furnicom_options()->getCpanelValue('sidebar_left_expand');
	$left_span_class .= ' col-md-'.furnicom_options()->getCpanelValue('sidebar_left_expand_md');
	$left_span_class .= ' col-sm-'.furnicom_options()->getCpanelValue('sidebar_left_expand_sm');
?>
<aside id="left" class="sidebar <?php echo esc_attr($left_span_class); ?>">
	<?php dynamic_sidebar('left-blog'); ?>
</aside>

<?php endif; ?>

<div class="single main <?php furnicom_content_blog(); ?>" >
<?php while (have_posts()) : the_post(); ?>
<?php
	$related_post_column = furnicom_options()->getCpanelValue('sidebar_blog');
?>
  <?php setPostViews(get_the_ID()); ?>
  <div <?php post_class(); ?>>
	<?php $pfm = get_post_format();?>
    <header class="header-single"></header>
    <div class="entry-content">
		<?php if( $pfm == '' || $pfm == 'image' ){?>
	  	<?php if( has_post_thumbnail() ){ ?>
	  	<div class="single-thumb">
		<?php the_post_thumbnail('furnicom_detail_thumb'); ?>
	  		</div>
	  	<?php } }?>
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<div class="entry-meta">
			<span class="meta-entry entry-date"><i class="fa fa-clock-o"></i><?php the_modified_date('j M Y')?></span>
			<span class="meta-entry entry-author"><i class="fa fa-user"></i><?php the_author_posts_link(); ?></span>
			<span class="meta-entry entry-view"><i class="fa fa-eye"></i><?php echo esc_html( $post->ID,'count_page_hits', true ) . ((($post->ID.'count_page_hits'. true) == 0 || ($post->ID.'count_page_hits'. true) == 1)? esc_html__(' View ', 'furnicom') : esc_html__(' Views ', 'furnicom')); ?></span>
			<span class="meta-entry entry-comment"><i class="fa fa-comment"></i><?php echo esc_html( $post->comment_count ) . ((($post->comment_count) == 0 || ($post->comment_count) == 1)? esc_html__(' Comment ', 'furnicom') : esc_html__(' Comments ', 'furnicom')); ?></span>
		</div>
	  	<div class="single-content">
		  	<?php the_content(); ?>
	  	</div>
		<!-- Tag -->
	  	<?php if(get_the_tag_list()) { ?>
	  	<div class="entry-tag">
			 <!-- Tag -->
			  <?php if(get_the_tag_list()) { ?>
				  <div class="single-tag">
						<?php echo get_the_tag_list('<span class="title">Tags: </span>',', ','');  ?>
				  </div>
			  <?php } ?>
	  	</div>
	  	<?php } ?>
	  	<!-- link page -->
	  	<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'furnicom' ).'</span>', 'after' => '</div>' , 'link_before' => '<span>', 'link_after'  => '</span>' ) ); ?>
    </div>
	<div id="authorDetails">
		<h3 class="title">About the author </h3>
	  	<div class="authorDetail">
		  	<?php get_the_author_meta() ?>
		  	<div class="avatar">
			  	<?php echo get_avatar( $post->post_author , 100 ); ?>
		  	</div>
			<div class="infomation">
				<h4><a href="<?php the_author_meta('url'); ?>"><?php echo get_the_author()?></a></h4>
				<p> <?php echo the_author_meta('description') ;?></p>
			</div>
	  	</div>
	</div> 
		<!-- Relate Post -->
	  	<?php 
			global $post;
			global $related_term;
			$class_col= "";
			$categories = get_the_category($post->ID);								
			$category_ids = array();
			foreach($categories as $individual_category) {$category_ids[] = $individual_category->term_id;}
			if ($categories) {
				if($related_post_column =='full'){
					$class_col .= 'col-lg-3 col-md-3 col-sm-3 clearfix';
					$related = array(
						'category__in' => $category_ids,
						'post__not_in' => array($post->ID),
						'showposts'=>4,
						'orderby'	=> 'rand',	
						'ignore_sticky_posts'=>1
					   );
				}else{
					$class_col .= 'col-lg-4 col-md-4 col-sm-4 clearfix';
					$related = array(
						'category__in' => $category_ids,
						'post__not_in' => array($post->ID),
						'showposts'=>3,
						'orderby'	=> 'rand',	
						'ignore_sticky_posts'=>1
					   );
				}
		?>
	  	<div class="single-post-relate">
			<h3><?php esc_html_e('Related Posts', 'furnicom'); ?></h3>
			<div class="row">
			<?php
				$related_term = new WP_Query($related);
				while($related_term -> have_posts()):$related_term -> the_post();
			?>
			<div <?php post_class($class_col); ?> >
				<div class="item-relate-img">
					<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('furnicom_related_post'); ?></a>
				</div>
				<div class="item-relate-content">
					<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
					<p>
						<?php
							$text = strip_shortcodes( $post->post_content );
							$text = apply_filters('the_content', $text);
							$text = str_replace(']]>', ']]&gt;', $text);
							$content = wp_trim_words($text, 10,'...');
							echo esc_html($content);
						?>
					</p>
				</div>
			</div>
			<?php
				endwhile;
				wp_reset_postdata();
			?>
			</div>
	  	</div>
	  <?php } ?>
    <?php comments_template('/templates/comments.php'); ?>
  </div>
<?php endwhile; ?>
</div>
<?php if ( is_active_sidebar_Furnicom('right-blog') && $sidebar_template !='left_sidebar' && $sidebar_template !='full' ):
	$right_span_class = 'col-lg-'.furnicom_options()->getCpanelValue('sidebar_right_expand');
	$right_span_class .= ' col-md-'.furnicom_options()->getCpanelValue('sidebar_right_expand_md');
	$right_span_class .= ' col-sm-'.furnicom_options()->getCpanelValue('sidebar_right_expand_sm');
?>
<aside id="right" class="sidebar <?php echo esc_attr($right_span_class); ?>">
	<?php dynamic_sidebar('right-blog'); ?>
</aside>
<?php endif; ?>
</div>	
</div>
</div>
<?php get_template_part('footer'); ?>
