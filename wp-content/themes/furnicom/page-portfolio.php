<?php 
/*
Template Name: Page Portfolio
*/
?>

<?php get_template_part('header'); ?>
		<div class="container">
			<h2 class="entry-title"><?php echo furnicom_title();?></h2>
		</div>
		<?php

			if (function_exists('furnicom_breadcrumb')){
				furnicom_breadcrumb('<div class="breadcrumbs theme-clearfix"><div class="container">', '</div></div>');
			} 

		?>
	</div>
	<div class="container">
			 <div id="contents" role="main">
				<?php
				get_template_part('templates/content', 'page')
				?>
			</div>
	</div>
</div>
<?php get_template_part('footer'); ?>

