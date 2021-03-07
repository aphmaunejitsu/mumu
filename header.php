<?php
/**
 * Header templete
 *
 * @package Mumu theme
 */

?>
<!doctype html>
<html
<?php
if ( ! is_page() ) :
	?>
	amp <?php endif; ?>>
	<?php get_template_part( 'parts/head' ); ?>
<body <?php body_class( 'flex flex-column' ); ?>>
<?php wp_body_open(); ?>
<header id="mumu-top" class="top-0 left-0 right-0 flex justify-center">
	<div class="container flex justify-start items-center px2">
		<div role="button" aria-label="open sidebar" on="tap:header-side-menu" tabindex="0" class="toggle md-hide lg-hide pr2">☰ </div>
		<?php
		mumu_custom_logo();
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
				<?php get_template_part( 'parts/icons/svg', 'search' ); ?>
			</div>
		</div> <!-- .search-icon -->
	</div> <!-- .container -->
</header>
<amp-sidebar id="header-side-menu" class='header-side-menu p2 lg-hide' layout='nodisplay'>
	<div class="flex justify-end items-center">
		<div role="button" aria-label="close sidebar" on="tap:header-side-menu.toggle" tabindex="0" class="navbar-trigger">✕</div>
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
	<?php get_template_part( 'parts/common/sns', 'page' ); ?>
</amp-sidebar>
<?php get_search_form(); ?>
<div id="content" class="site-content flex mx-auto p1">
