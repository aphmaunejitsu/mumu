<?php
/**
 * Page templete
 *
 * @package Mumu theme
 */

get_header(); ?>
<div id="primary">
	<main id="main">
	<?php
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
			get_template_part( 'parts/content', 'page' );
		endwhile;
	else :
		get_template_part( 'parts/content', 'none' );
	endif;
	?>
	</main><!-- #main -->
</div> <!-- #primary -->
<?php
get_sidebar();
get_footer();
