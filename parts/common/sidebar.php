	<section class="sgn-sidebar">
	<?php get_template_part('parts/common/categories'); ?>
	<?php get_template_part('parts/common/popular'); ?>
<?php if ( is_singular() ) : ?>
	<?php get_template_part('parts/common/similar'); ?>
	<?php get_template_part('parts/common/new-list-small'); ?>
<?php endif; ?>
	</section>
