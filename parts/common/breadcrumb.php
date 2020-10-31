<?php
$cats = get_the_category();
error_log(print_r($cats, 1));
if ( is_home() ) {
	return;
}
?>
<section class="sgn-breadcrumb">
<ul class="sgn-breadcrumb-list">
	<li class="sgn-breadcrumb-item">
		<a href="/">
			<i class="fas fa-home"></i> HOME
		</a>
	</li>
<?php if ( $cats !== null ) : ?>
<?php foreach ($cats as $cat) : ?>
	<li class="sgn-breadcrumb-item">
		<a href="<?php get_category_link($cat->term_id); ?>">
			<?php echo $cat->cat_name ?>
		</a>
	</li>
<?php endforeach; ?>
<?php endif; ?>
</ul>
</section>



