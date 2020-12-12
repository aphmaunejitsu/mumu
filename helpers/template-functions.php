<?php

if (! function_exists('getAssetsDir')) {
    function getAssetsDir()
    {
        return esc_attr(get_template_directory_uri() . 'assests/');
    }
}

if (! function_exists('mumu_edit_link')) {
    function mumu_edit_link() {
		edit_post_link(
			sprintf(
				wp_kses(
					'Edit <span class="screen-reader-text">%s</span>',
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
    }
}

if (! function_exists('mumu_excerpt')) {
    function mumu_excerpt($content, $length = 55)
    {
        $content =  preg_replace('/<!--more-->.+/is', '', $content); //moreタグ以降削除
        $content =  strip_shortcodes($content);
        $content =  strip_tags($content);
        $content =  str_replace("&nbsp;", '', $content);
        $content =  mb_substr($content, 0, $length);
        return $content . ' ...';
    }
}

if (! function_exists('pagination')) {
    function pagination()
    {
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
			ob_start();
			require dirname( __FILE__ ) . '/views/pagination.php';
			$paginate = ob_get_contents();
			ob_end_clean();

			echo $paginate;
		}
    }
}

if (! function_exists('nextPrev')) {
    function nextPrev()
    {
        $next = get_next_post();
        $prev = get_previous_post();
        $nextThumb = null;

        $getTemplatePart = 'get_template_part';

        $noImage = '<svg version="1.1" id="mumu-no-image" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"	 y="0px" viewBox="0 0 841.9 595.3" style="enable-background:new 0 0 841.9 595.3;" xml:space="preserve"><style type="text/css">	.st0{fill:#9FA0A0;}	.st1{fill:#C9CACA;}</style><g>	<path class="st0" d="M374.5,301.2L366,288v13.2h-4.2v-21.5h3.7l8.5,13.2v-13.2h4.2v21.5H374.5z"/>	<path class="st0" d="M397.8,299c-1.5,1.5-3.4,2.4-5.8,2.4c-2.4,0-4.3-0.8-5.8-2.4c-2.2-2.2-2.1-4.9-2.1-8.6s-0.1-6.4,2.1-8.6		c1.5-1.5,3.4-2.4,5.8-2.4c2.4,0,4.3,0.8,5.8,2.4c2.2,2.2,2.1,4.9,2.1,8.6S400,296.8,397.8,299z M394.7,284.4		c-0.6-0.7-1.5-1.1-2.7-1.1s-2.1,0.5-2.7,1.1c-0.8,0.9-1,1.9-1,6s0.2,5.1,1,6c0.6,0.7,1.6,1.1,2.7,1.1s2.1-0.5,2.7-1.1		c0.8-0.9,1.1-1.9,1.1-6S395.5,285.3,394.7,284.4z"/>	<path class="st0" d="M414.3,301.2v-21.5h4.2v21.5H414.3z"/>	<path class="st0" d="M440.3,301.2v-12.5l-4.1,8.2h-2.8l-4.1-8.2v12.5H425v-21.5h4.1l5.6,11.6l5.6-11.6h4.1v21.5H440.3z"/>	<path class="st0" d="M463.2,301.2l-1.3-3.8h-7.6l-1.3,3.8h-4.4l7.8-21.5h3.3l7.8,21.5H463.2z M458.2,286l-2.7,7.8h5.3L458.2,286z"		/>	<path class="st0" d="M485,298.9c-1.7,1.8-3.8,2.4-6.1,2.4c-2.4,0-4.3-0.8-5.8-2.4c-2.2-2.2-2.1-4.9-2.1-8.6s-0.1-6.4,2.1-8.6		c1.5-1.5,3.4-2.4,5.8-2.4c5,0,7.5,3.3,8.1,6.9h-4.2c-0.5-2-1.7-3.1-3.9-3.1c-1.1,0-2.1,0.5-2.7,1.1c-0.8,0.9-1,1.9-1,6		s0.2,5.2,1,6.1c0.6,0.7,1.5,1.1,2.7,1.1c1.3,0,2.3-0.5,3-1.2c0.7-0.8,1-1.8,1-2.9v-0.8h-4v-3.5h8.1v3.1		C487.1,295.5,486.5,297.3,485,298.9z"/>	<path class="st0" d="M492.8,301.2v-21.5H507v3.7h-10v5h8.5v3.7H497v5.2h10v3.7H492.8z"/></g><g>	<circle class="st1" cx="435.9" cy="224.6" r="13.4"/>	<path class="st1" d="M481.4,198.3v52.7c0,3.7-3,6.7-6.7,6.7h-77.6c-3.7,0-6.7-3-6.7-6.7v-52.7c0-3.7,3-6.7,6.7-6.7h15.1		c1.2-2.5,3.8-7.7,5.5-10c2.2-3.1,5.2-2.8,5.2-2.8h12.9h0.2h12.9c0,0,3.1-0.2,5.2,2.8c1.6,2.3,4.3,7.6,5.5,10h15.1		C478.4,191.5,481.4,194.6,481.4,198.3z M435.9,203.1c-11.9,0-21.5,9.6-21.5,21.5c0,11.9,9.6,21.5,21.5,21.5		c11.9,0,21.5-9.6,21.5-21.5C457.5,212.7,447.8,203.1,435.9,203.1z"/></g></svg>';
        $src = '<amp-img src="%s" width="80" height="80" layout="fixed" data-amp-auto-lightbox-disable></amp-img>';

        $htmlNext = null;
        if ($next) {
            $thum_id = get_post_thumbnail_id( $next->ID );
            $url = get_permalink($next->ID);

            if ( $thum_id ) {
                $thumb = wp_get_attachment_image_src( $thum_id, 'thumbnail' );
                $thumb = sprintf($src, $thumb[0]);
            } else {
                $thumb = $noImage;
            }
            $htmlNext =<<< NEXT
<div class="next flex items-center">
    <div class="content">
        <a href="{$url}" class="flex items-center text-decoration-none">
        <span>{$next->post_title} :次の記事</span>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="48px" height="48px"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z"/></svg>
        </a>
    </div>
    <div class="thumbnail ml1"><a herf="{$url}">{$thumb}</a></div>
</div>
NEXT;
        }

        $prevThumb = null;
        $htmlPrev = null;
        if ($prev) {
            $thum_id = get_post_thumbnail_id( $prev->ID );
            $url = get_permalink($prev->ID);

            if ( $thum_id ) {
                $thumb = wp_get_attachment_image_src( $thum_id, 'thumbnail' );
                $thumb = sprintf($src, $thumb[0]);
            } else {
                $thumb = $noImage;
            }
            $htmlPrev =<<<PREV
<div class="prev flex items-center">
    <div class="thumbnail mr1"><a herf="{$url}">{$thumb}</a></div>
    <div class="content">
        <a href="{$url}" class="flex items-center text-decoration-none">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="48px" height="48px"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M15.41 16.59L10.83 12l4.58-4.59L14 6l-6 6 6 6 1.41-1.41z"/></svg>
        <span>前の記事: {$prev->post_title}</span>
        </a>
    </div>
</div>
PREV;
        }

        $html = <<<EOF
<div class="container flex items-center">
    {$htmlPrev}
    {$htmlNext}
</div>
EOF;
        echo $html;
    }
}

if (! function_exists('customLogo')) {
    function customLogo($id = null)
    {
        if (has_custom_logo($id)) {
            $custom_logo_id = get_theme_mod('custom_logo');
            $image = wp_get_attachment_image_src($custom_logo_id, 'full');
            $output = sprintf(
                '<amp-img src="%1$s" width="%2$s" height="%3$s" layout="fixed"></amp_img>',
                $image[0],
                $image[1],
                $image[2]
            );
        } else {
            $output = '<h1 class="site-name">' . get_bloginfo('name') . '</h1>';
        }

        $logo = '<a href="' . get_home_url() . '" class="home-link text-decoration-none inline-block mx-auto flex items-center">' . $output . '</a>';

        echo $logo;
    }
}

if (! function_exists('featureImage')) {
    function featureImage()
    {
        $image[0] = esc_attr(get_template_directory_uri() . '/assets/images/no-image-752x423.jpg');
        $image[1] = 752;
        $image[2] = 423;

        $large[0]  = $image[0];
        $medium[0] = $image[0];
        $title = esc_attr(get_the_title());
        $link = get_the_permalink();

        $category = null;
        if ( has_post_thumbnail( get_the_ID() ) ) {
            $thum_id = get_post_thumbnail_id( get_the_ID() );
            $image   = wp_get_attachment_image_src( $thum_id, 'mumu-thumbnail-s-16x9' );
            $large   = wp_get_attachment_image_src( $thum_id, 'mumu-thumbnail-l-16x9' );
            $medium  = wp_get_attachment_image_src( $thum_id, 'mumu-thumbnail-m-16x9' );

            $image[0] = esc_attr($image[0]);
            $large[0] = esc_attr($large[0]);
            $medium[0] = esc_attr($medium[0]);
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

        echo $feature;
    }
}

if (! function_exists('publishedPost')) {
    function publishedPost() {
        $published = get_the_date('U');
        $updated   = get_the_modified_date('U');

        if (get_the_date('U') > get_the_modified_date('U')) {
            $published = get_the_date();
            $updated   = $published;

            $published_t = get_the_date('Y-m-d');
            $updated_t   = $published_t;
        } else {
            $published = get_the_date();
            $updated   = get_the_modified_date();

            $published_t = get_the_date('Y-m-d');
            $updated_t   = get_the_modified_date('Y-m-d');
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
        echo $meta;
    }
}
