<header id="mumu-top" class="top-0 left-0 right-0 flex justify-center">
	<div class="container flex justify-start items-center px2">
		<div role="button" aria-label="open sidebar" on="tap:header-side-menu" tabindex="0" class="toggle md-hide lg-hide pr2">☰ </div>
		<?php mumu_custom_logo();
		wp_nav_menu(
			array(
				'menu_class'      => 'list-reset center m0 p0 flex justify-center nowrap',
				'container'       => 'nav',
				'container_class' => 'submenu xs-hide sm-hide text-decoration-none',
				'theme_location'  => 'header-navigation',
				'fallback_cb'     => null,
			)
		);
		?>
		<div class="search-icon center m0 p0 nowrap" role="button" tabindex="1" on="tap:mumu-search-lightbox">
			<div class="flex items-center">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="48px" height="48px"><path d="M0 0h24v24H0z" fill="none"/><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>
			</div>
		</div> <!-- .search-icon -->
	</div> <!-- .container -->
</header>
<amp-sidebar id="header-side-menu" class='header-side-menu px3 lg-hide' layout='nodisplay'>
	<div class="flex justify-start items-center sgn-sidebar-header">
		<div role="button" aria-label="close sidebar" on="tap:header-side-menu.toggle" tabindex="0" class="navbar-trigger items-start">✕</div>
	</div>
	<?php
	wp_nav_menu(
		array(
			'menu_class'      => 'list-reset m0 p0 label',
			'container'       => 'nav',
			'container_class' => 'sidebar-menu',
			'theme_location'  => 'header-navigation',
			'fallback_cb'     => null,
		)
	);
	?>
</amp-sidebar>
<?php get_search_form(); ?>
