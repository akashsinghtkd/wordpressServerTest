<?php if(have_posts()):
		while (have_posts()) : the_post(); ?>
			<div <?php post_class(); ?>>
				<?php if (!is_front_page()) {?>
			    <header>
			    	<h2 class="entry-title"><?php the_title(); ?></h2>
			    </header>
			    <?php } ?>
			    <div class="entry-content">
			      <?php furnicom_pagecontent_check(); ?>
			      <?php wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'furnicom' ), 'after' => '</div>' ) ); ?>
			    </div>
			    <?php comments_template('/templates/comments.php'); ?>
			</div>
			<?php
		endwhile;
	else:
    	get_template_part('templates/no-results');
	endif;
?>