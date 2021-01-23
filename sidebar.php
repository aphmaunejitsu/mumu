<?php
/**
 * Sidebar Template
 *
 * @package Mumu Theme
 */

if ( is_active_sidebar( 'sidebar-primary' ) && ( ! is_singular() ) ) : ?>
<aside id="secondary">
	<?php dynamic_sidebar( 'sidebar-primary' ); ?>
</aside> <!-- #secondary -->
	<?php
endif;
if ( is_active_sidebar( 'sidebar-single-page' ) && ( is_singular() ) ) :
	?>
<aside id="secondary">
	<?php dynamic_sidebar( 'sidebar-single-page' ); ?>
</aside> <!-- #secondary -->
<?php endif; ?>
