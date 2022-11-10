<?php $furnicom_box_layout = furnicom_options()->getCpanelValue('layout'); ?>
<?php get_template_part('templates/head'); ?>
<body <?php body_class(); ?>>
<div class="body-wrapper theme-clearfix<?php echo ( $furnicom_box_layout == 'boxed' )? ' box-layout' : '';?> ">
<div class="body-wrapper-inner">
<?php furnicom_header_check(); ?>

<div id="main" class="theme-clearfix" role="document">
<?php
	if (!is_front_page() ) {
		if (function_exists('furnicom_breadcrumb')){
			furnicom_breadcrumb('<div class="breadcrumbs theme-clearfix"><div class="container">', '</div></div>');
		} 
	}
?>