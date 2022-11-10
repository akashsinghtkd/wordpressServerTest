<?php get_header(); ?>

<!-- Breadcrumb title -->
<?php if ( !furnicom_mobile_check()  ){ furnicom_breadcrumb_title() ;}?>

<div class="container">
	<?php
		$furnicom_post_type = isset( $_GET['search_posttype'] ) ? $_GET['search_posttype'] : '';
		if( ( $furnicom_post_type != '' ) &&  locate_template( 'templates/search-' . $furnicom_post_type . '.php' ) ){
			get_template_part( 'templates/search', $furnicom_post_type );
		}else{ 
			if( have_posts() ){
		?>
			<div class="blog-search-content">
		<?php 
			while (have_posts()) : the_post(); 
			global $post;
			$post_format = get_post_format();
		?>
			<div id="post-<?php the_ID();?>" <?php post_class( 'theme-clearfix' ); ?>>
				<div class="entry clearfix">
					<?php if (get_the_post_thumbnail()){?>
					<div class="entry-thumb pull-left">
						<a class="entry-hover" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">			
							<?php the_post_thumbnail("thumbnail")?>
						</a>
					</div>
					<?php }?>
					<div class="entry-content">
						<div class="title-blog">
							<h3>
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?> </a>
							</h3>
						</div>
						<div class="entry-meta">
							<span class="meta-entry entry-author"><i class="fa fa-user"></i><?php the_author_posts_link(); ?></span>
							<span class="meta-entry entry-view"><i class="fa fa-eye"></i><?php echo esc_html( $post->ID,'count_page_hits', true ) . ((($post->ID.'count_page_hits'. true) == 0 || ($post->ID.'count_page_hits'. true) == 1)? esc_html__(' View ', 'furnicom') : esc_html__(' Views ', 'furnicom')); ?></span>
							<span class="meta-entry entry-comment"><i class="fa fa-comment"></i><?php echo esc_html( $post->comment_count ) . ((($post->comment_count) == 0 || ($post->comment_count) == 1)? esc_html__(' Comment ', 'furnicom') : esc_html__(' Comments ', 'furnicom')); ?></span>
						</div>
						<div class="entry-description">
							<?php the_excerpt(); ?>
						</div>
						<div class="bl_read_more"><a href="<?php the_permalink(); ?>"><?php esc_html_e('see more','furnicom')?><i class="fa fa-angle-right"></i></a></div>
						<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'furnicom' ).'</span>', 'after' => '</div>' , 'link_before' => '<span>', 'link_after'  => '</span>' ) ); ?>
					</div>
				</div>
			</div>			
		<?php endwhile; ?>
		<?php get_template_part('templates/pagination'); ?>
		</div>
	<?php
		}else{
				get_template_part('templates/no-results');
			}
		}
	?>
</div>
<?php get_footer(); ?>