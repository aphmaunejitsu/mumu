<?php
/**
 * Archive pages
 *
 * @package Mumu theme
 */

get_header(); ?>
<div id="primary" class="mx-auto">
	<main id="main">
	<header class="page-header flex">
		<?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
	</header><!-- .page-header -->
	<?php
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();

			get_template_part( 'parts/content', get_post_type() );
		endwhile;
	else :
		get_template_part( 'parts/content', 'none' );
	endif;
	?>
	</main><!-- #main -->
	<?php mumu_pagination(); ?>
</div> <!-- #primary -->
<?php
get_sidebar();
get_footer();
