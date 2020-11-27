<section class="sgn-list-section relative">
<?php if ( is_search() ) :
	$search_query = esc_attr( get_search_query() );
	?>
	<section class="sgn-category-title center">
        <h2>
            <svg width="16" height="16" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="search" class="svg-inline--fa fa-search fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"></path></svg>
            <?php echo $search_query; ?>
        </h2>
	</section>
<?php elseif ( is_archive() ) : ?>
	<section class="sgn-category-title center">
        <h2>
            <?php get_template_part('part/svg/tag'); ?>
            <?php esc_html( single_cat_title() ); ?>
        </h2>
	</section>
<?php endif; ?>
<div class="sgn-list">
<?php
if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		$image['src']    = get_template_directory_uri() . '/assets/images/no-image-752x423.jpg';
		$image['width']  = 752;
		$image['height'] = 423;

		$category = null;
		if ( ( $terms = get_the_category( get_the_ID() ) ) ) {
			$category = $terms[0];
		}

		if ( has_post_thumbnail( get_the_ID() ) ) {
			$thum_id = get_post_thumbnail_id( get_the_ID() );
			$img     = wp_get_attachment_image_src( $thum_id, 'sgn-list-thum' );

			$image['src']    = $img[0];
			$image['width']  = $img[1];
			$image['height'] = $img[2];
		}

		$title = esc_html( get_the_title() );
		$date  = get_the_date( null, get_the_ID() );
		$mdate = get_the_modified_date( null, get_the_ID() );
		if ( $date > $mdate ) {
			$mdate = $date;
		}
		$content  = mb_strimwidth( trim( str_replace( array( "\r\n", "\r", "\n" ), '', strip_tags( get_the_content() ) ) ), 0, 300, '...' );
		$category = $category->cat_name;
		?>
		<div class="entry content-stretch flex-column flex mb1">
		<a href="<?php echo get_the_permalink(); ?>" class="mb1 text-decoration-none" >
					<div class='card overflow-hidden relative'>
						<div class='thumbnail mb1 overflow-hidden'>
							<amp-img alt="<?php echo esc_attr( $title ); ?>"
								src='<?php echo esc_attr( $image['src'] ); ?>'
								layout="responsive"
								width='<?php echo $image['width']; ?>'
								height='<?php echo $image['height']; ?>' >
							</amp-img>
						</div>
                        <div class="post-category nowrap absolute display-inline">
                            <?php get_template_part('parts/svg/tag'); ?>
                            <span><?php echo esc_attr( $category ); ?></span>
                        </div>
						<h3 class="post-title mb1 px1"><?php echo $title; ?></h3>
						<div class="post-time px1">
                            <time datetime="<?php echo $date; ?>" class="mr1">
                                <?php get_template_part('parts/svg/calender'); ?>
                                <span><?php echo $date; ?></span>
                            </time>
                            <time datetime="<?php echo $mdate; ?>">
                                <?php get_template_part('parts/svg/refresh'); ?>
                                <?php echo $mdate; ?></time>
						</div>
						<div class="post-content px1"><?php echo $content; ?></div>
					</div>
				</a>
		</div>
		<?php
		endwhile;
	?>
</div>
	<?php
		global $sgn_theme;
		echo $sgn_theme->pagination();
	else :
		?>
		<div class="sgn-list-notfound">対象の記事がありません。</div>
		<?php
	endif;
	?>
</section>
