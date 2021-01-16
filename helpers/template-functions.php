<?php
/**
 * the template helper file
 *
 * @package Mumu Theme
 */

if ( ! function_exists( 'mumu_edit_link' ) ) {
	/**
	 * Show Edit Link
	 */
	function mumu_edit_link() {
		edit_post_link(
			sprintf(
				wp_kses(
					'%s<span class="screen-reader-text">%s</span>',
					array(
						'span' => array(
							'class' => array(),
						),
						'svg'  => array(),
						'path' => array(),
					)
				),
				'<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="48px" height="48px"><path d="M0 0h24v24H0z" fill="none"/><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/></svg>',
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>',
			0,
			'post-edit-link flex items-center',
		);
	}
}

if ( ! function_exists( 'mumu_next_prev' ) ) {
	/**
	 * Show Next Prev link
	 */
	function mumu_next_prev() {
		$prev = get_previous_post_link( '&laquo; 前の記事' );
		$next = get_next_post_link( '次の記事 &raquo;' );

		$next_prev = <<<EOL
<nav class="next-prev flex justify-between">
    <span class="prev">{$prev}</span>
    <span class="next">{$next}</span>
</nav>
EOL;
		echo $next_prev;
	}
}

if ( ! function_exists( 'mumu_excerpt' ) ) {
	/**
	 * 要約
	 *
	 * @param string $content the content.
	 * @param int    $length length.
	 */
	function mumu_excerpt( $content, $length = 55 ) {
		$content = preg_replace( '/<!--more-->.+/is', '', $content );
		$content = strip_shortcodes( $content );
		$content = strip_tags( $content );
		$content = str_replace( '&nbsp;', '', $content );
		$content = mb_substr( $content, 0, $length );
		return $content . ' ...';
	}
}

if ( ! function_exists( 'mumu_pagination' ) ) {
	/**
	 * Write Pagination
	 */
	function mumu_pagination() {
		global $wp_query;
		$bignum = 999999999;
		if ( $wp_query->max_num_pages <= 1 ) {
			return;
		}

		$pagination = paginate_links(
			array(
				'base'      => str_replace( $bignum, '%#%', esc_url( get_pagenum_link( $bignum ) ) ),
				'format'    => '',
				'current'   => max( 1, get_query_var( 'paged' ) ),
				'total'     => $wp_query->max_num_pages,
				'prev_text' => '<',
				'next_text' => '>',
				'type'      => 'array',
				'end_size'  => 1,
				'mid_size'  => 1,
			)
		);

		$html = null;
		foreach ( $pagination as $page ) {
			$html .= $page;
		}

		if ( $html ) {
			$paginate = <<<EOL
    <nav class="pagination flex justify-center items-center">
    {$html}
    </nav>
EOL;
			echo wp_kses(
				$paginate,
				array(
					'nav'  => array( 'class' => array() ),
					'a'    => array(
						'href'  => array(),
						'class' => array(),
					),
					'span' => array(
						'aria-current' => array(),
						'class'        => array(),
					),
				)
			);
		}
	}
}

if ( ! function_exists( 'mumu_custom_logo' ) ) {
	/**
	 * Write Custom Log
	 *
	 * @param int $id image id.
	 */
	function mumu_custom_logo( $id = null ) {
		if ( has_custom_logo( $id ) ) {
			$custom_logo_id = get_theme_mod( 'custom_logo' );
			$image          = wp_get_attachment_image_src( $custom_logo_id, 'full' );
			$output         = sprintf(
				'<amp-img src="%1$s" width="%2$s" height="%3$s" layout="fixed"></amp_img>',
				$image[0],
				$image[1],
				$image[2]
			);
		} else {
			$output = '<h1 class="site-name">' . get_bloginfo( 'name' ) . '</h1>';
		}

		$logo = '<a href="' . get_home_url() . '" class="home-link text-decoration-none inline-block mx-auto flex items-center">' . $output . '</a>';

		echo wp_kses(
			$logo,
			array(
				'a'       => array(
					'href'  => array(),
					'class' => array(),
				),
				'amp-img' => array(
					'src'    => array(),
					'width'  => array(),
					'height' => array(),
					'layout' => array(),
				),
				'h1'      => array( 'class' => array() ),
			)
		);
	}
}

if ( ! function_exists( 'mumu_feature_image' ) ) {
	/**
	 * Output Feature Image.
	 */
	function mumu_feature_image() {
		$title = esc_attr( get_the_title() );
		$link  = get_the_permalink();

		$category = null;
		if ( has_post_thumbnail( get_the_ID() ) ) {
			$thum_id = get_post_thumbnail_id( get_the_ID() );
			$image   = wp_get_attachment_image_src( $thum_id, 'mumu-thumbnail-s-16x9' );
			$large   = wp_get_attachment_image_src( $thum_id, 'mumu-thumbnail-l-16x9' );
			$medium  = wp_get_attachment_image_src( $thum_id, 'mumu-thumbnail-m-16x9' );

			$image[0]  = esc_attr( $image[0] );
			$large[0]  = esc_attr( $large[0] );
			$medium[0] = esc_attr( $medium[0] );
		} else {
			return null;
		}

		$feature = <<<EOF
<div class='thumbnail mb1 overflow-hidden relative'>
    <amp-img alt="{$title}"
        src='{$image[0]}'
        layout="responsive"
        width='{$image[1]}' height='{$image[2]}'
        srcset='{$image[0]} 480w, {$medium[0]} 752w, {$large[0]} 1280w'
    >
    </amp-img>
</div>
EOF;

		echo wp_kses(
			$feature,
			array(
				'div'     => array( 'class' => array() ),
				'amp-img' => array(
					'alt'    => array(),
					'src'    => array(),
					'layout' => array(),
					'width'  => array(),
					'height' => array(),
					'srcset' => array(),
				),
			)
		);
	}
}

if ( ! function_exists( 'mumu_published_post' ) ) {
	/**
	 * Output published date
	 */
	function mumu_published_post() {
		$published = get_the_date( 'U' );
		$updated   = get_the_modified_date( 'U' );

		if ( get_the_date( 'U' ) > get_the_modified_date( 'U' ) ) {
			$published = get_the_date();
			$updated   = $published;

			$published_t = get_the_date( 'Y-m-d' );
			$updated_t   = $published_t;
		} else {
			$published = get_the_date();
			$updated   = get_the_modified_date();

			$published_t = get_the_date( 'Y-m-d' );
			$updated_t   = get_the_modified_date( 'Y-m-d' );
		}

		$meta = <<<EOF
<span class="published-post flex justify-end">
    <div class="published flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="48px" height="48px"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M20 3h-1V1h-2v2H7V1H5v2H4c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 18H4V10h16v11zm0-13H4V5h16v3z"/></svg>
        <time class="entry-date published flex items-center" datetime="{$published_t}">
            {$published}
        </time>
    </div>
    <div class="updated flex items-center ml1">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="48px" height="48px"><path d="M.01 0h24v24h-24V0z" fill="none"/><path d="M12 4V1L8 5l4 4V6c3.31 0 6 2.69 6 6 0 1.01-.25 1.97-.7 2.8l1.46 1.46C19.54 15.03 20 13.57 20 12c0-4.42-3.58-8-8-8zm0 14c-3.31 0-6-2.69-6-6 0-1.01.25-1.97.7-2.8L5.24 7.74C4.46 8.97 4 10.43 4 12c0 4.42 3.58 8 8 8v3l4-4-4-4v3z"/></svg>
        <time class="updated-post flex items-center" datetime="{$updated_t}">
            {$updated}
        </time>
    </div>
</span>
EOF;
		echo wp_kses_post( $meta );
	}
}
