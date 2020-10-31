<?php get_header(); ?>
<article class="sgn-container mx-auto">
	<div class="sgn-article">
		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				?>
				<?php get_template_part( 'parts/page/header' ); ?>
				<?php get_template_part( 'parts/page/article' ); ?>
				<?php
			endwhile;
			else :
				?>
		投稿が見つかりません
		<?php endif; ?>
	</div>
	<?php get_template_part( 'parts/common/sidebar' ); ?>
</article>
<?php get_footer(); ?>
