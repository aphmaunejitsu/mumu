<?php
$args   = array(
	'type'         => 'post',
	'child_of'     => 0,
	'parent'       => 0,
	'orderby'      => 'name',
	'order'        => 'ASC',
	'hide_empty'   => 1,
	'hierarchical' => 1,
	'taxonomy'     => 'category',
	'pad_counts'   => false,
);
$p_cats = get_categories( $args );

?>

<section class="sgn-list-category mb2">
	<header class="category-header sgn-navi col-12 p1 block">
		<i class="fas fa-tags"></i> Categories
	</header>
	<amp-accordion animate>
		<?php if ( $p_cats ) : ?>
			<?php foreach ( $p_cats as $p_cat ) : ?>
			<section expanded>
				<header class="p1">
					<?php echo $p_cat->name; ?>
				</header>
				<ul class="pl2 my1">
                <?php if ($p_cat->count > 0) : ?>
				<li class="my1">
					<a href="<?php echo get_category_link( $p_cat->term_id ); ?>" title="<?php echo esc_attr( $p_cat->name ); ?>" class="text-decoration-none">
						<span><?php echo esc_attr( $p_cat->name ) . ' (' . $p_cat->count . ')'; ?></span>
					</a>
				</li>
                <?php endif; ?>
				<?php
					$args['parent'] = $p_cat->term_id;
					$c_cats         = get_categories( $args );
				if ( $c_cats ) :
					?>
					<?php foreach ( $c_cats as $c_cat ) : ?>
					<li class="my1">
						<a href="<?php echo get_category_link( $c_cat->term_id ); ?>" title="<?php echo esc_attr( $c_cat->name ); ?>" class="text-decoration-none">
							<span><?php echo esc_attr( $c_cat->name ); ?> (<?php echo $c_cat->count; ?>)</span>
						</a>
					</li>
					<?php endforeach; ?>
				<?php endif; //child ?>
				</ul>
			</section>
		<?php endforeach; ?>
		<?php else : ?>
			<p>no category</p>
		<?php endif; ?>
	</amp-accordion>
	<?php get_template_part( 'parts/ad/category' ); ?>
</section>
