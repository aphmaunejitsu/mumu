<section class="sgn-post-list mb2">
	<header class="sgn-post-list-title sgn-navi col-12 p1 center block mb1">
		<i class="far fa-newspaper"></i> Popular Entries
	</header>
	<amp-list
		width="auto"
		height="200"
		layout="fixed-height"
		src="<?php echo get_theme_file_uri(); ?>/api-newlist.php?meta=page_count&thumbnail=post-amp-thum&orderby=meta_value_num">
	<?php get_template_part('parts/common/list/template'); ?>
	</amp-list>
</section>
<?php get_template_part('parts/ad/new'); ?>
