<?php
/**
 * 404 page
 *
 * @package mumu theme
 */

header( 'HTTP/1.1 404 Not Found' );
get_header();
?>
<div id="primary" class="mx-auto">
	<main id="main">
	<?php get_template_part( 'parts/content', 'none' ); ?>
	</main><!-- #main -->
</div> <!-- #primary -->
<?php
get_sidebar();
get_footer();
