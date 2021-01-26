<?php
/**
 * Displaying post
 *
 * @package Mumu theme
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'mb2 list-item' ); ?>>
	<div class="article-image">
		<a href="<?php the_permalink(); ?>" class="p0 text-decoration-none" ><?php mumu_feature_image(); ?></a>
	</div>
	<div class="container">
		<header class="article-header mb1">
			<?php
			mumu_the_category();
			?>
			<a href="<?php the_permalink(); ?>" class="post-link">
			<?php
			if ( is_singular() ) :
					the_title( '<h1 class="entry-title my1">', '</h1>' );
				else :
					the_title( '<h3 class="entry-title my1">', '</h3>' );
				endif;
				?>
			</a>
			<div class="meta">
			<?php mumu_published_post(); ?>
			</div> <!-- .meta -->
		</header>
		<div class="article-content content mb1">
			<?php the_excerpt(); ?>
			<div class="read-more">
				<a href="<?php the_permalink(); ?>" class="button">Read More</a>
			</div><!-- .read-more -->
		</div><!-- .article-content -->
		<footer class="article-footer mt1">
			<?php get_template_part( 'parts/content/article', 'footer' ); ?>
		</footer>
	</div> <!-- .container -->
</article>
