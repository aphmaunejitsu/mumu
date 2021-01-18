<?php
/**
 * Next Prev template parts
 *
 * @package Mumu Theme
 */

?>
<nav class="next-prev flex justify-between">
<?php
if ( get_previous_post() ) :
	;
	?>
	<span class="prev">
	<?php previous_post_link( '%link', '&laquo; 前の記事', true ); ?>
	</span>
	<?php
endif;
if ( get_next_post() ) :
	?>
	<span class="next">
	<?php next_post_link( '%link', '次の記事 &raquo;', true ); ?>
	</span>
<?php endif; ?>
</nav>
