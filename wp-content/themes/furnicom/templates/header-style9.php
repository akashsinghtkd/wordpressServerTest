<?php 
	$furnicom_colorset = furnicom_options()->getCpanelValue('scheme');
	$search = furnicom_options()->getCpanelValue('search');
	$furnicom_page_header = get_post_meta( get_the_ID(), 'page_header_style', true );
	$furnicom_page_header  = ( get_post_meta( get_the_ID(), 'page_header_style', true ) != '' ) ? get_post_meta( get_the_ID(), 'page_header_style', true ) : furnicom_options()->getCpanelValue('header_style');
	$furnicom_header_style = furnicom_options()->getCpanelValue('header_style');
?>
<div class="header-<?php echo $furnicom_header_style; ?>">
	<header id="header"  class="header">
		<div class="header-msg">
			<div class="container">
				<?php if (is_active_sidebar_Furnicom('top-lang')) {?>
					<div id="header-left9" class="header-left9 pull-left">
						<?php dynamic_sidebar('top-lang'); ?>
					</div>
				<?php }?>
				<div id="header-right9" class="header-right9 pull-right">
					<div class="login-top pull-left">
						<?php get_template_part( 'widgets/furnicom_top/login' ); ?>
					</div>
					<div class="account-top pull-left">
						<?php
							$furnicom_menu_class = 'nav nav-pills';
							if ( 'mega' == furnicom_options()->getCpanelValue('menu_type') ){
								$furnicom_menu_class .= ' nav-mega';
							} else $furnicom_menu_class .= ' nav-css';
						?>
						<?php wp_nav_menu(array('theme_location' => 'login_menu', 'menu_class' => $furnicom_menu_class)); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="top-slider">
			<?php if (is_active_sidebar_Furnicom('header-slider')) {?>
				<div id="header-slider" class="header-slider">
					<?php dynamic_sidebar('header-slider'); ?>
				</div>
			<?php }?>
		</div>
		<div class="wrap-top-header">
			<div class="container top">
				<div class="top-header clearfix">
					<div class="furnicom-logo pull-left">
						<a  href="<?php echo esc_url( home_url( '/' ) ); ?>">
							<?php if(furnicom_options()->getCpanelValue('sitelogo')){ ?>
								<img src="<?php echo esc_attr( furnicom_options()->getCpanelValue('sitelogo') ); ?>" alt="<?php bloginfo('name'); ?>"/>
							<?php }else{
								if ($furnicom_colorset){$logo = get_template_directory_uri().'/assets/img/logo-'.$furnicom_colorset.'.png';}
								else $logo = get_template_directory_uri().'/assets/img/logo-default.png';
							?>
								<img src="<?php echo esc_attr( $logo ); ?>" alt="<?php bloginfo('name'); ?>"/>
							<?php } ?>
						</a>
					</div>
					<?php if ( has_nav_menu('primary_menu') ) {?>
						<!-- Primary navbar -->
						<div id="main-menu" class="main-menu">
							<nav id="primary-menu" class="primary-menu pull-left">
								<div class="container">
									<div class="mid-header clearfix">
										<a href="#" class="phone-icon-menu"></a>
										<div class="navbar-inner navbar-inverse">
												<?php
													$furnicom_menu_class = 'nav nav-pills';
													if ( 'mega' == furnicom_options()->getCpanelValue('menu_type') ){
														$furnicom_menu_class .= ' nav-mega';
													} else $furnicom_menu_class .= ' nav-css';
												?>
												<?php wp_nav_menu(array('theme_location' => 'primary_menu', 'menu_class' => $furnicom_menu_class)); ?>
										</div>
									</div>
								</div>
							</nav>
						</div>
						<!-- /Primary navbar -->
					<?php 
						} 
					?>					
					<div id="above-header9" class="above-header9 clearfix">
						<?php if (is_active_sidebar_Furnicom('above-header9')) {?>
							<?php dynamic_sidebar('above-header9'); ?>
						<?php }?>
						<?php if( get_option( 'sw_woocatalog_enable' ) === 'no' || !get_option( 'sw_woocatalog_enable' ) ):?>
							<?php get_template_part( 'woocommerce/minicart-ajax-style2' ); ?>
						<?php endif; ?>
					</div>
					
				</div>
			</div>
		</div>
	</header>
</div>



