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

<div class="category-contents <?php furnicom_content_blog(); ?>">
	<!--<div class="category-header">
		<h1 class="entry-title"><?php echo furnicom_title();?></h1>
		<?php 
			if( category_description() ){
				echo '<div class="category-desc">'.category_description().'</div>';
			}
		?>
	</div>-->
	<?php 
		$blog_styles = furnicom_options()->getCpanelValue('blog_layout');	
			get_template_part('templates/content', $blog_styles);
	?>
	<?php get_template_part('templates/pagination'); ?>
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
