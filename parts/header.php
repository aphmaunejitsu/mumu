<header id="mumu-top" class="top-0 left-0 right-0 flex justify-center">
    <div class="container flex justify-start items-center px2">
        <div role="button" aria-label="open sidebar" on="tap:header-side-menu" tabindex="0" class="toggle md-hide lg-hide pr2">☰ </div>
        <?php customLogo();
        wp_nav_menu([
                'menu_class'      => 'list-reset center m0 p0 flex justify-center nowrap',
                'container'       => 'nav',
                'container_class' => 'submenu xs-hide sm-hide text-decoration-none',
                'theme_location'  => 'header-navigation',
                'fallback_cb'     => null
        ]);
        ?>
        <div class="search-icon center m0 p0 nowrap" role="button" tabindex="1" on="tap:sgn-search-lightbox">
            <div class="flex items-center">
                <?php get_template_part('parts/icons/svg', 'search'); ?>
            </div>
        </div> <!-- .search-icon -->
    </div> <!-- .container -->
</header>
<amp-sidebar id="header-side-menu" class='header-side-menu px3 lg-hide' layout='nodisplay'>
	<div class="flex justify-start items-center sgn-sidebar-header">
		<div role="button" aria-label="close sidebar" on="tap:header-side-menu.toggle" tabindex="0" class="navbar-trigger items-start">✕</div>
	</div>
	<?php
	 wp_nav_menu([
		'menu_class'      => 'list-reset m0 p0 label',
		'container'       => 'nav',
		'container_class' => 'sidebar-menu',
		'theme_location'  => 'header-navigation',
        'fallback_cb'     => null
	 ]);
		?>
</amp-sidebar>
<?php get_search_form(); ?>
