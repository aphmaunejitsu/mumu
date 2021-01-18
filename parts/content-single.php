<?php
/**
 * Displaying single post
 *
 * @package Mumu theme
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'mb2' ); ?>>
	<header class="article-header mb1">
		<?php the_title( '<h1 class="entry-title my1">', '</h1>' ); ?>
		<?php mumu_feature_image(); ?>
		<div class="meta mb1">
		<?php mumu_published_post(); ?>
		</div> <!-- .meta -->
		<div class="sns mb1 flex justify-center">
		<?php get_template_part( 'parts/common/sns' ); ?>
		</div> <!-- .sns -->
	</header>
	<div class="article-content content mb1">
		<?php the_content(); ?>
	</div><!-- .article-content -->
	<footer class="article-footer mt1">
		<?php get_template_part( 'parts/common/footer' ); ?>
	</footer>
</article>
