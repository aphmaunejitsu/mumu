<?php if ( is_single() ) : ?>
	<?php if ( $post->post_excerpt ) : ?>
	<meta name="description" content="<?php echo $post->post_excerpt; ?>" />
		<?php
else :
		$summary = wp_strip_all_tags( $post->post_content );
		$summary = str_replace( array( "\r\n", "\r", "\n", "'", '"', ' ', '　' ), '', $summary );
		$summary = mb_strimwidth( $summary, 0, 200, '...' );
	?>
<meta name="description" content="<?php echo $summary; ?>" />
<?php endif ?>
<?php elseif ( is_home() || is_front_page() ) : ?>
<meta name="description" content="<?php bloginfo( 'description' ); ?>" />
<?php elseif ( is_category() ) : ?>
<meta name="description" content="<?php echo category_description(); ?>" />
<?php elseif ( is_tag() ) : ?>
<meta name="description" content="<?php echo tag_description(); ?>" />
<?php else : ?>
<meta name="description" content="<?php the_excerpt(); ?>" />
<?php endif; ?>
