<?php
$cat = null;
if ( $cats = get_the_category() ) {
	$cat = $cats[0];
}
?>
<header class="sgn-article-header mb1">
	<h2 class="sgn-post-title m0 mb1"><?php echo esc_html( get_the_title() ); ?></h2>
	<?php get_template_part( 'parts/single/feature-image' ); ?>
	<div class="sgn-post-meta flex justify-end flex-wrap">
        <div class="author mb1">
            <?php get_template_part('parts/svg/user'); ?>
            <span><?php the_author(); ?></span>
        </div>
		<time class="date nowrap ml1 mb1" datetime="<?php echo get_the_date(); ?>">
            <?php get_template_part('parts/svg/calender'); ?>
			<?php echo get_the_date(); ?>
		</time>
		<time class="date nowrap ml1 mb1" datetime="<?php echo get_the_modified_date(); ?>">
            <?php get_template_part('parts/svg/refresh'); ?>
			<?php echo get_the_modified_date(); ?>
		</time>
	</div>
	<?php get_template_part( 'parts/single/sns' ); ?>

</header>

