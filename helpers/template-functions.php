<?php
/**
 * The template helper file
 *
 * @package Mumu Theme
 */

if ( ! function_exists( 'mumu_the_category' ) ) {
	/**
	 * 子カテゴリをなるべく取得するthe_category
	 */
	function mumu_the_category() {
		$categories = get_the_category();
		if ( ! isset( $categories[0] ) ) {
			return null;
		}

		$result = $categories[0];

		foreach ( $categories as $category ) {
			if ( 0 != $category->category_parent ) {
				$result = $category;
				break;
			}
		}

		echo wp_kses_post(
			sprintf( '<div class="article-category">%1$s</div>', $result->cat_name )
		);
	}
}

if ( ! function_exists( 'mumu_get_the_category' ) ) {
	/**
	 * 子カテゴリをなるべく取得するget_the_category
	 *
	 * @param mix $post_id post id.
	 */
	function mumu_get_the_category( $post_id = null ) {
		$categories = get_the_category( $post_id );
		if ( ! isset( $categories[0] ) ) {
			return null;
		}

		$result = $categories[0];

		foreach ( $categories as $category ) {
			if ( 0 != $category->category_parent ) {
				$result = $category;
				break;
			}
		}

		return $result;
	}
}

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
				'prev_text' => '&larr;',
				'next_text' => '&rarr;',
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
		$blog = get_bloginfo( 'name' );
		if ( has_custom_logo( $id ) ) {
			$custom_logo_id = get_theme_mod( 'custom_logo' );
			$image          = wp_get_attachment_image_src( $custom_logo_id, 'full' );
			$output         = sprintf(
				'<amp-img src="%1$s" width="32px" height="32px" layout="fixed" class="mr1"></amp-img><h2 class="site-name m0">%2$s</h2>',
				$image[0],
				$blog,
			);
		} else {
			$output = sprintf( '<h2 class="site-name m0">%1$s</h2>', $blog );
		}

		$logo = sprintf(
			'<a href="%1$s" class="home-link text-decoration-none inline-block mx-auto flex items-center">%2$s</a>',
			get_home_url(),
			$output
		);

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
					'class'  => array(),
				),
				'h2'      => array( 'class' => array() ),
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

if ( ! function_exists( 'mumu_get_kses_allow_svg' ) ) {
	/**
	 * Get kess svg
	 */
	function mumu_get_kses_allow_svg() {
		$allow = wp_kses_allowed_html( 'post' );
		$svg   = array(
			'svg'   => array(
				'class'           => true,
				'aria-hidden'     => true,
				'aria-labelledby' => true,
				'role'            => true,
				'xmlns'           => true,
				'width'           => true,
				'height'          => true,
				'viewbox'         => true, // <= Must be lower case!
			),
			'g'     => array( 'fill' => true ),
			'title' => array( 'title' => true ),
			'path'  => array(
				'd'    => true,
				'fill' => true,
			),
		);

		return $allow + $svg;
	}
}

if ( ! function_exists( 'mumu_published_post' ) ) {
	/**
	 * Output published date
	 *
	 * @param int $id post_id.
	 */
	function mumu_published_post( $id = null, $is_show_posted = true, $is_show_updated = true ) {
		$published = get_the_date( 'U', $id );
		$updated   = get_the_modified_date( 'U', $id );

		if ( $published > $updated ) {
			$published = get_the_date( null, $id );
			$updated   = $published;

			$published_t = get_the_date( 'c', $id );
			$updated_t   = $published_t;
		} else {
			$published = get_the_date( null, $id );
			$updated   = get_the_modified_date( null, $id );

			$published_t = get_the_date( 'c', $id );
			$updated_t   = get_the_modified_date( 'c', $id );
		}

		$meta = null;

		if ( $is_show_posted ) {
			$meta = <<<EOF
<span class="published-post flex justify-end">
    <div class="published flex items-center">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="48px" height="48px"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M20 3h-1V1h-2v2H7V1H5v2H4c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 18H4V10h16v11zm0-13H4V5h16v3z"/></svg>
        <time class="entry-date published flex items-center" datetime="{$published_t}">
            {$published}
        </time>
    </div>
EOF;
			if ( ! $is_show_updated ) {
				$meta .= '</span>';
			}
		}
		if ( $is_show_updated ) {
			$updated_html = '';
			if ( ! $is_show_posted ) {
				$updated_html = '<span class="published-post flex justify-end">';
			}
			$updated_html .= <<<EOF
    <div class="updated flex items-center ml1">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="48px" height="48px"><path d="M.01 0h24v24h-24V0z" fill="none"/><path d="M12 4V1L8 5l4 4V6c3.31 0 6 2.69 6 6 0 1.01-.25 1.97-.7 2.8l1.46 1.46C19.54 15.03 20 13.57 20 12c0-4.42-3.58-8-8-8zm0 14c-3.31 0-6-2.69-6-6 0-1.01.25-1.97.7-2.8L5.24 7.74C4.46 8.97 4 10.43 4 12c0 4.42 3.58 8 8 8v3l4-4-4-4v3z"/></svg>
        <time class="updated-post flex items-center" datetime="{$updated_t}">
            {$updated}
        </time>
    </div>
</span>
EOF;
			$meta         .= $updated_html;
		}
		echo wp_kses( $meta, mumu_get_kses_allow_svg() );
	}
}

if ( ! function_exists( 'get_image_sizes' ) ) {
	/**
	 * Get information about available image sizes
	 *
	 * @param string $size size.
	 */
	function get_image_sizes( $size = '' ) {
		$wp_additional_image_sizes = wp_get_additional_image_sizes();

		$sizes                        = array();
		$get_intermediate_image_sizes = get_intermediate_image_sizes();

		// Create the full array with sizes and crop info.
		foreach ( $get_intermediate_image_sizes as $_size ) {
			if ( in_array( $_size, array( 'thumbnail', 'medium', 'large' ) ) ) {
				$sizes[ $_size ]['width']  = get_option( $_size . '_size_w' );
				$sizes[ $_size ]['height'] = get_option( $_size . '_size_h' );
				$sizes[ $_size ]['crop']   = (bool) get_option( $_size . '_crop' );
			} elseif ( isset( $wp_additional_image_sizes[ $_size ] ) ) {
				$sizes[ $_size ] = array(
					'width'  => $wp_additional_image_sizes[ $_size ]['width'],
					'height' => $wp_additional_image_sizes[ $_size ]['height'],
					'crop'   => $wp_additional_image_sizes[ $_size ]['crop'],
				);
			}
		}

		// Get only 1 size if found.
		if ( $size ) {
			if ( isset( $sizes[ $size ] ) ) {
				return $sizes[ $size ];
			} else {
				return false;
			}
		}
		return $sizes;
	}
}
