<?php get_header(); ?>
<article class="sgn-container mx-auto">
	<div class="sgn-article mb2">
		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				?>
				<?php
				global $sgn_theme;
				//$sgn_theme->set_pagecount();
				?>
				<?php get_template_part( 'parts/single/header' ); ?>
				<?php get_template_part( 'parts/single/article' ); ?>
				<?php get_template_part( 'parts/single/footer' ); ?>
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
