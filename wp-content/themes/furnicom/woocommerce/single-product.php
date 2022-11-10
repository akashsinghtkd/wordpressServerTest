<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
$sidebar = furnicom_options() -> getCpanelValue('sidebar_product_detail');
?>

<?php get_template_part('header'); ?>

<!-- Breadcrumb title -->
<?php furnicom_breadcrumb_title() ?>

<div class="container">
<div class="row sidebar-row">
<?php if ( is_active_sidebar_Furnicom('left-product') && $sidebar == 'left' ):
	$left_span_class = 'col-lg-'.furnicom_options()->getCpanelValue('sidebar_left_expand');
	$left_span_class .= ' col-md-'.furnicom_options()->getCpanelValue('sidebar_left_expand_md');
	$left_span_class .= ' col-sm-'.furnicom_options()->getCpanelValue('sidebar_left_expand_sm');
?>
<aside id="left" class="sidebar <?php echo esc_attr($left_span_class); ?>">
	<?php dynamic_sidebar('left-product'); ?>
</aside>

<?php endif; ?>
<div id="contents-detail" <?php furnicom_content_product(); ?> role="main">
	<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action('woocommerce_before_main_content');
	?>
	<div class="single-product clearfix">
	
		<?php while ( have_posts() ) : the_post(); ?>

			<?php wc_get_template_part( 'content', 'single-product' ); ?>

		<?php endwhile; // end of the loop. ?>
	
	</div>
	
	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action('woocommerce_after_main_content');
	?>
<!--- contents-detail --->
<?php if ( is_active_sidebar_Furnicom('right-product') && $sidebar == 'right' ):
	$right_span_class = 'col-lg-'.furnicom_options()->getCpanelValue('sidebar_right_expand');
	$right_span_class .= ' col-md-'.furnicom_options()->getCpanelValue('sidebar_right_expand_md');
	$right_span_class .= ' col-sm-'.furnicom_options()->getCpanelValue('sidebar_right_expand_sm');
?>
<aside id="right" class="sidebar <?php echo esc_attr($right_span_class); ?>">
	<?php dynamic_sidebar('right-product'); ?>
</aside>

<?php endif; ?>
</div>
</div>
</div>
<?php get_template_part('footer'); ?>
