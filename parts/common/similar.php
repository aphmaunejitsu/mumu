<?php
$categories = get_the_category();
if ( count($categories) > 1 ) {
	$cat = $categories[0]->term_id . ',' . $categories[1]->term_id;
} elseif (count($categories) == 1) {
	$cat = $categories[0]->term_id;
} else {
	$cat = null;
}
?>

<section class="sgn-post-list mb2">
	<header class="sgn-post-list-title sgn-navi col-12 p1 center block mb1">
		<i class="far fa-thumbs-up"></i> Related Entries
	</header>
	<amp-list
		width="auto"
		height="200"
		layout="fixed-height"
		src="<?php echo get_theme_file_uri(); ?>/api-newlist.php?thumbnail=post-amp-thum&category=<?php echo $cat; ?>&orderby=rand">
		<?php get_template_part('parts/common/list/template'); ?>
		</amp-list>
</section>
<?php get_template_part('parts/ad/similar') ?>
