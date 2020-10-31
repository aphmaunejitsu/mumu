<?php
$cat = null;
if ( $cats = get_the_category() ) {
	$cat = $cats[0];
}
?>
<header class="sgn-article-header mb1">
	<h1 class="sgn-post-title m0 mb1"><?php echo esc_html( get_the_title() ); ?></h1>
	<?php get_template_part( 'parts/single/feature-image' ); ?>
	<div class="sgn-post-meta flex justify-end flex-wrap">
		<span class="author mb1"><i class="fas fa-user"></i> <?php the_author(); ?> </span>
		<time class="date nowrap ml1 mb1" datetime="<?php echo get_the_date(); ?>">
			<i class="fas fa-calendar-alt fa-fw"></i>
			<?php echo get_the_date(); ?>
		</time>
		<time class="date nowrap ml1 mb1" datetime="<?php echo get_the_modified_date(); ?>">
			<i class="fas fa-sync-alt fa-fw"></i>
			<?php echo get_the_modified_date(); ?>
		</time>
	</div>
	<?php get_template_part( 'parts/single/sns' ); ?>

</header>

