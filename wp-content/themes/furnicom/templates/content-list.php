<?php if (!have_posts()) : ?>
<?php get_template_part('templates/no-results'); ?>
<?php endif; ?>
<div class="blog-content-list">
<?php 
	while (have_posts()) : the_post(); 
	$post_format = get_post_format();
?>
	<div id="post-<?php the_ID();?>" <?php post_class( 'theme-clearfix' ); ?>>
		<div class="entry clearfix">
			<?php if (get_the_post_thumbnail()){?>
			<div class="entry-thumb">
				<a class="entry-hover" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">			
					<?php the_post_thumbnail('furnicom_detail_thumb')?>
				</a>
			</div>
			<?php }?>
			<div class="entry-content-list">
				<?php echo ( get_the_title() ) ? '' : '<a href="'. get_the_permalink() .'">' ; ?>
				<div class="entry-date">					
					<span class="day-post"><?php echo date( 'j',strtotime($post->post_date)); ?></span>
					<span class="month-post"><?php echo date( 'M',strtotime($post->post_date)); ?></span>
				</div>
				<?php echo ( get_the_title() ) ? '' : '</a>' ; ?>
				<div class="entry-content">
					<div class="title-blog">
						<h3>
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?> </a>
						</h3>
					</div>
					<div class="entry-meta">
						<span class="meta-entry entry-author"><i class="fa fa-user"></i><?php the_author_posts_link(); ?></span>
						<span class="meta-entry entry-category"><i class="fa fa-folder-open"></i><?php the_category(', '); ?></span>
						<span class="meta-entry entry-comment"><i class="fa fa-comment"></i><?php echo esc_html( $post->comment_count ) . ((($post->comment_count) == 0 || ($post->comment_count) == 1)? esc_html__(' Comment ', 'furnicom') : esc_html__(' Comments ', 'furnicom')); ?></span>
					</div>
					<div class="entry-summary">
						<?php 
													
							if ( preg_match('/<!--more(.*?)?-->/', $post->post_content, $matches) ) {
								$content = explode($matches[0], $post->post_content, 2);
								$content = $content[0];
								$content = wp_trim_words($post->post_content, 30, '...');
								echo $content;	
							} else {
								the_content('...');
							}		
						?>
						<?php the_tags( '<div class="entry-meta-tag"><span>'. esc_html__( 'Tags', 'furnicom' ) .'</span>: ' , ', ', '</div>' ); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'furnicom' ).'</span>', 'after' => '</div>' , 'link_before' => '<span>', 'link_after'  => '</span>' ) ); ?>
					</div>
					<div class="bl_read_more"><a href="<?php the_permalink(); ?>"><?php esc_html_e('Read more','furnicom')?></a></div>
					
				</div>
			</div>
		</div>
	</div>
<?php endwhile; ?>
</div>
<div class="clearfix"></div>