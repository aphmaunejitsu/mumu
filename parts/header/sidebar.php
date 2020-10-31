<amp-sidebar id="sgn-header-sidebar" class='sgn-sidebar px3 md-hide lg-hide' layout='nodisplay'>
	<div class="flex justify-start items-center sgn-sidebar-header">
		<div role="button" aria-label="close sidebar" on="tap:sgn-header-sidebar.toggle" tabindex="0" class="sgn-navbar-trigger items-start">✕</div>
	</div>
	<?php
	 wp_nav_menu([
		'menu'            => 'global navi',
		'menu_class'      => 'list-reset m0 p0 sgn-label',
		'container'       => 'nav',
		'container_class' => 'sgn-sidebar-menu',
		'theme_location'  => 'sidebar',
	 ]);
		?>
</amp-sidebar>
