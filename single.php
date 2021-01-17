<?php
/**
 * Single templete
 *
 * @package Mumu theme
 */

get_header(); ?>
<div id="primary" class="mx-auto">
	<main id="main">
	<?php
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
			get_template_part( 'parts/content', 'single' );
		endwhile;
	else :
		get_template_part( 'parts/content', 'none' );
	endif;
	?>
	</main><!-- #main -->
	<?php get_template_part( 'parts/common/page', 'nextprev' ); ?>
</div> <!-- #primary -->
<?php
get_sidebar();
get_footer();
