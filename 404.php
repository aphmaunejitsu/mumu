<?php
header( 'HTTP/1.1 404 Not Found' );
global $sgn_theme;
$url = $sgn_theme->get_site_icon();

get_header(); ?>
<article class="sgn-container mx-auto">
<section class="sgn-404 mb1">
	<header class="flex justify-center">
	<h2>ページが見つりませんでした</h2>
	</header>
	<div class="sgn-404-content">
		<a href="<?php echo esc_url( home_url() ); ?>" class="text-decoration-none">
		<div class="site-title-icon flex justify-center items-center">
			<?php get_template_part( 'parts/header/logo' ); ?>
			<div class="site-title">
				<?php echo esc_attr( bloginfo( 'name' ) ); ?>
			</div>
		</div>
		</a>
		<div class="ex center">こちらよりトップページにお戻りください</div>
	</div>
</section>
<?php get_template_part( 'parts/common/sidebar' ); ?>
</article>
<?php get_footer(); ?>
