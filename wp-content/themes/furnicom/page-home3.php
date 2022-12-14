<?php 
/*
Template Name: Page Home 3
*/
?>

<?php get_template_part('header'); ?>
	<div class="container">
		<div class="row">
			 <div id="contents" role="main" class="col-lg-12 col-md-12 col-sm-13">
				<?php if(have_posts()):
					while (have_posts()) : the_post(); ?>
						<div <?php post_class(); ?>>
							<?php if (!is_front_page()) {?>
							<header>
								<h2 class="entry-title"><?php the_title(); ?></h2>
							</header>
							<?php } ?>
							<div class="entry-content">
							  <?php the_content(); ?>
							</div>
						</div>
						<?php
					endwhile;
				else:
					get_template_part('templates/no-results');
				endif;
			?>
			</div>
		</div>
	</div>
</div>	
<?php get_template_part('footer'); ?>

