<?php 
	/* 
	** Content Header
	*/
	$furnicom_colorset = furnicom_options()->getCpanelValue('scheme');
	$furnicom_mobile_logo = furnicom_options()->getCpanelValue( 'mobile_logo' );
?>
<?php if( is_front_page() || get_post_meta( get_the_ID(), 'page_mobile_enable', true ) ):?>
<header id="header" class="header header-mobile-style1">
	<div class="header-wrrapper clearfix">
		<div class="header-top-mobile clearfix">
			<div class="header-menu-categories pull-left">
				<?php if ( has_nav_menu('leftmenu') ) {?>
					<div class="vertical_megamenu">
						<?php wp_nav_menu(array('theme_location' => 'leftmenu', 'menu_class' => 'nav vertical-megamenu')); ?>
					</div>
			<?php } ?>
			</div>
			<div class="ya-logo pull-left">
				<a  href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<?php if( $furnicom_mobile_logo != '' ){ ?>
						<img src="<?php echo esc_url( $furnicom_mobile_logo ); ?>" alt="<?php bloginfo('name'); ?>"/>
					<?php }else{
						$logo = get_template_directory_uri().'/assets/img/logo-default.png'; ?>
							<?php if(furnicom_options()->getCpanelValue('sitelogo')){ ?>
							<img src="<?php echo esc_attr( furnicom_options()->getCpanelValue('sitelogo') ); ?>" alt="<?php bloginfo('name'); ?>"/>
						<?php }else{
							if ($furnicom_colorset){$logo = get_template_directory_uri().'/assets/img/logo-'.$furnicom_colorset.'.png';}
							else $logo = get_template_directory_uri().'/assets/img/logo-default.png';
						?>
							<img src="<?php echo esc_attr( $logo ); ?>" alt="<?php bloginfo('name'); ?>"/>
						<?php } ?>
					<?php } ?>					
				</a>
			</div>
			<div class="header-right pull-right">
				<div class="header-cart">
					<a href="<?php echo get_permalink(get_option('woocommerce_cart_page_id') ); ?>">
						<?php get_template_part( 'woocommerce/minicart-ajax-mobile' ); ?>
					</a>
				</div>
				<div class="header-wishlist">
					<a href="<?php echo get_permalink( get_option('yith_wcwl_wishlist_page_id') ); ?>" title="<?php esc_attr_e('Wishlist','furnicom'); ?>">
						<span class="fa fa-heart-o"></span>
					</a>
				</div>
			</div>
		</div>
		<div class="mobile-search">
			<div class="non-margin">
				<div class="widget-inner">
					<div class="top-form top-search">
						<div class="topsearch-entry">
							<?php get_template_part( 'widgets/furnicom_top/searchcate' ); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="search-sticky">
				<a href="javascript:void(0)" title="Search">
					<span class="icon-menu-top"></span>
				</a>
				<div class="top-form top-search">
					<div class="topsearch-entry">
						<?php get_template_part( 'widgets/furnicom_top/searchcate' ); ?>
					</div>
				</div>		
		</div>
	</div>
</header>
<?php elseif( is_search() ): ?>
<header id="header" class="header header-mobile-style1">
	<div class="header-wrrapper clearfix">
		<div class="header-top-mobile clearfix">
			<div class="header-menu-categories pull-left">
				<?php if ( has_nav_menu('leftmenu') ) {?>
					<div class="vertical_megamenu">
						<?php wp_nav_menu(array('theme_location' => 'leftmenu', 'menu_class' => 'nav vertical-megamenu')); ?>
					</div>
			<?php } ?>
			</div>
			<div class="ya-logo pull-left">
				<a  href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<?php if( $furnicom_mobile_logo != '' ){ ?>
						<img src="<?php echo esc_url( $furnicom_mobile_logo ); ?>" alt="<?php bloginfo('name'); ?>"/>
					<?php }else{
						$logo = get_template_directory_uri().'/assets/img/logo-default.png'; ?>
							<?php if(furnicom_options()->getCpanelValue('sitelogo')){ ?>
							<img src="<?php echo esc_attr( furnicom_options()->getCpanelValue('sitelogo') ); ?>" alt="<?php bloginfo('name'); ?>"/>
						<?php }else{
							if ($furnicom_colorset){$logo = get_template_directory_uri().'/assets/img/logo-'.$furnicom_colorset.'.png';}
							else $logo = get_template_directory_uri().'/assets/img/logo-default.png';
						?>
							<img src="<?php echo esc_attr( $logo ); ?>" alt="<?php bloginfo('name'); ?>"/>
						<?php } ?>
					<?php } ?>					
				</a>
			</div>
			<div class="header-right pull-right">
				<div class="header-cart">
					<a href="<?php echo get_permalink(get_option('woocommerce_cart_page_id') ); ?>">
						<?php get_template_part( 'woocommerce/minicart-ajax-mobile' ); ?>
					</a>
				</div>
				<div class="header-wishlist">
					<a href="<?php echo get_permalink( get_option('yith_wcwl_wishlist_page_id') ); ?>" title="<?php esc_attr_e('Wishlist','furnicom'); ?>">
						<span class="fa fa-heart-o"></span>
					</a>
				</div>
			</div>
		</div>
		<div class="mobile-search">
			<div class="non-margin">
				<div class="widget-inner">
					<div class="top-form top-search">
						<div class="topsearch-entry">
							<?php get_template_part( 'widgets/furnicom_top/searchcate' ); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="search-sticky">
				<a href="javascript:void(0)" title="Search">
					<span class="icon-menu-top"></span>
				</a>
				<div class="top-form top-search">
					<div class="topsearch-entry">
						<?php get_template_part( 'widgets/furnicom_top/searchcate' ); ?>
					</div>
				</div>		
		</div>
	</div>
</header>
<?php else : ?>
<!--  header page -->
<header id="header-page" class="header-page">
	<div class="header-shop clearfix">
		<div class="container">
			<div class="back-history"></div>
			<h1 class="page-title"><?php furnicom_title(); ?></h1>
			<?php if ( has_nav_menu('leftmenu') ) {?>
					<div class="vertical_megamenu vertical_megamenu_shop pull-right">
						<?php wp_nav_menu(array('theme_location' => 'leftmenu', 'menu_class' => 'nav vertical-megamenu')); ?>
					</div>
			<?php } ?>
		</div>
	</div>
</header>
	<!-- End header -->
<?php endif; ?>