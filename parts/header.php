<?php $url = get_site_icon_url( 32 ); ?>
<header id="sgn-top" class="sgn-headerbar flex justify-start items-center top-0 left-0 right-0 pl2">
	<div role="button" aria-label="open sidebar" on="tap:sgn-header-sidebar.toggle" tabindex="0" class="toggle md-hide lg-hide pr2">☰ </div>
	<a href="<?php echo esc_attr( bloginfo( 'url' ) ); ?>" class="home-link text-decoration-none inline-block mx-auto">
		<div class="site-title-icon mx-auto flex items-center p1 nowrap">
			<?php get_template_part( 'parts/header/logo' ); ?>
			<div class="site-title">
				<?php echo esc_attr( bloginfo( 'name' ) ); ?>
			</div>
		</div>
	</a>
	<?php
	wp_nav_menu(
		array(
			'menu'            => 'global navi',
			'menu_class'      => 'list-reset center m0 p0 flex justify-center nowrap',
			'container'       => 'nav',
			'container_class' => 'submenu xs-hide sm-hide',
			'theme_location'  => 'sgn-headerbar',
		)
	);
	?>
	<div class="search-icon center m0 p0 flex nowrap" role="button" tabindex="1" on="tap:sgn-search-lightbox">
		<div class="mr2"></div>
			<div class="relative">
				<i class="fas fa-search"></i>
			</div>
	</div>
</header>
<?php get_search_form(); ?>
<?php get_template_part( 'parts/header/sidebar' ); ?>
