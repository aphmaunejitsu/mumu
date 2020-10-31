<?php
if ( is_single() ) :
	$next = get_adjacent_post( false, '', false );
	$prev = get_adjacent_post( false, '', true );

	if ($next) : ?>
<link rel='next' attr='<?php echo esc_attr($next->post_title) ?>' href='<?php echo get_permalink($next->ID) ?>'>
	<?php endif;
	if ($prev) : ?>
<link rel='prev' attr='<?php echo esc_attr($prev->post_title) ?>' href='<?php echo get_permalink($prev->ID)?>'>
	<?php endif; ?>
<? endif; ?>

