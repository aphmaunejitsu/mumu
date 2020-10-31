<?php
$next = get_adjacent_post( false, '', false );
$prev = get_adjacent_post( false, '', true );

$default_thumbnail[0] = get_stylesheet_directory_uri() . '/amp/assets/img/no-img-180x108.gif';
$default_thumbnail[1] = 90;
$default_thumbnail[2] = 54;

$next_html = null;
$prev_html = null;

if ( $next ) {
	$thum_id = get_post_thumbnail_id( $next->ID );
	if ( $thum_id ) {
		$next_thumb = wp_get_attachment_image_src( $thum_id, 'post-amp-thum' );
	} else {
		$next_thumb = $default_thumbnail;
	}

	$next_html['post']  = $next->guid;
	$next_html['image'] = "<amp-img layout='fixed' src='" . $next_thumb[0] . "' width='" . $next_thumb[1] . "' height='" . $next_thumb[2] . "'>";
	$next_html['title'] = esc_attr( $next->post_title );
}

if ( $prev ) {
	$thum_id = get_post_thumbnail_id( $prev->ID );
	if ( $thum_id ) {
		$prev_thumb = wp_get_attachment_image_src( $thum_id, 'post-amp-thum' );
	} else {
		$prev_thumb = $default_thumbnail;
	}

	$prev_html['post']  = $prev->guid;
	$prev_html['image'] = "<amp-img layout='fixed' src='" . $prev_thumb[0] . "' width='" . $prev_thumb[1] . "' height='" . $prev_thumb[2] . "'>";
	$prev_html['title'] = esc_attr( $prev->post_title );
}
?>

<?php if ( $next_html || $prev_html ) : ?>
	<div class="sgn-nextprev-list mb2">
	<?php if ( $next_html ) : ?>
		<div class='next-post mb1'>
			<div class="next-nav mb1">
				<i class="fas fa-angle-left"></i> 次の記事
			</div>
			<a href="<?php echo get_permalink( $next->ID ); ?>">
				<div class='thumbnail'>
					<?php echo $next_html['image']; ?>
				</div>
				<div class='post-title'>
					<?php echo $next_html['title']; ?>
				</div>
			</a>
		</div>
	<?php endif; ?>
	<?php if ( $prev_html ) : ?>
		<?php if ( ! $next_html) : ?>
		<div class='next-post mb1'></div>
		<?php endif; ?>
		<div class='prev-post'>
			<div class="prev-nav mb1">
				前の記事 <i class="fas fa-angle-right"></i>
			</div>
			<a href="<?php echo get_permalink( $prev->ID ); ?>">
				<div class='thumbnail'>
					<?php echo $prev_html['image']; ?>
				</div>
				<div class='post-title'>
					<?php echo $prev_html['title']; ?>
				</div>
			</a>
		</div>
	<?php endif; ?>
	</div>
<?php endif; ?>
