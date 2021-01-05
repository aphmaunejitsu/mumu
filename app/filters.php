<?php
/**
 * Mumu filters
 *
 * @package Mumu Theme
 */

remove_filter( 'the_excerpt', 'wpautop' );
remove_filter( 'term_description', 'wpautop' );
add_filter( 'wp_lazy_loading_enabled', '__return_false' );

if ( ! function_exists( 'mumu_new_excerpt_more' ) ) {
	/**
	 * 省略文字
	 *
	 * @param string $more 省略文字
	 */
	function mumu_new_excerpt_more( $more ) {
		return '...';
	}
}
add_filter( 'excerpt_more', 'mumu_new_excerpt_more' );

if ( ! function_exists( 'mumu_title_parts' ) ) {
	/**
	 * タイトル出力
	 *
	 * @param $title_parts title parts
	 */
	function mumu_title_parts( $title_parts ) {
		$title_parts['tagline'] = '';
		$title_parts['site']    = '';
		$site_name              = trim( get_bloginfo( 'name' ) );
		if ( is_front_page() ) { // フロントページの場合
			$title_parts['title']   = $site_name;
			$title_parts['site']    = '';
			$title_parts['tagline'] = trim( get_bloginfo( 'description' ) );
		} elseif ( is_singular() ) { // 投稿ページの場合
			$title_parts['title'] = trim( get_the_title() );
			$title_parts['site']  = $site_name;
		} elseif ( is_archive() ) { // アーカイブページの場合
			$title_parts['title'] = '「' . $title_parts['title'] . '」のアーカイブ';
			$title_parts['site']  = $site_name;
		} elseif ( is_search() ) {
			$title_parts['title'] = $title_parts['title'];
		} elseif ( is_404() ) { // 404ページの場合
			$title_parts['title'] = 'お探しのページは見つかりませんでした';
			$title_parts['site']  = $site_name;
		}

		return $title_parts;
	}
}
add_filter( 'document_title_parts', 'mumu_title_parts' );

if ( ! function_exists( 'mumu_title_separator' ) ) {
	function mumu_title_separator() {
		$sep = ' | ';
		return $sep;
	}
}
add_filter( 'document_title_separator', 'mumu_title_separator' );


if ( ! function_exists( 'mumu_post_search' ) ) {
	function mumu_post_search( $search ) {
		if ( is_search() ) {
			$search .= " AND post_type = 'post'";
		}
		return $search;
	}
}
add_filter( 'posts_search', 'mumu_post_search' );

if ( ! function_exists( 'mumu_google_auto_adsens_filter' ) ) {
	function mumu_google_auto_adsens_filter() {
		$ad = null;
		if ( is_404() ) {
			return;
		}

		if ( ! ( $mumu = get_option( 'mumu' ) ) ) {
			return;
		}

		$ads  = $mumu['theme_my_google']['adsens']['is_use'] ?? null;
		$auto = $mumu['theme_my_google']['adsens']['auto'] ?? null;
		$id   = $mumu['theme_my_google']['adsens']['id'] ?? null;

		if ( ! $ads ) {
			return;
		}

		if ( ! $auto ) {
			return;
		}

		if ( $id ) {
			$ad = '<amp-auto-ads type="adsense" data-ad-client="ca-pub-' . $id . '"></amp-auto-ads>"';
		}

		echo $ad;
	}
}
add_filter( 'mumu_google_auto_adsens', 'mumu_google_auto_adsens_filter' );

if ( ! function_exists( 'mumu_google_analytics_filter' ) ) {
	function mumu_google_analytics_filter() {
		if ( ! ( $mumu = get_option( 'mumu' ) ) ) {
			return;
		}
		$analytics = $mumu['theme_my_google']['analytics']['id'] ?? null;

		if ( ! $analytics ) {
			return;
		}

		$html = <<<EOL
<amp-analytics type="googleanalytics" id="analytics-1">
<script type="application/json">
{
  "vars": {
		"account": "{$analytics}"
  },
  "triggers": {
	"trackPageview": {
	  "on": "visible",
	  "request": "pageview"
	}
  }
}
</script>
</amp-analytics>
EOL;
		echo $html;
	}
}
add_filter( 'mumu_google_analytics', 'mumu_google_analytics_filter' );

if ( ! function_exists( 'mumu_add_async_to_script' ) ) {
	/**
	 * Add attribute to js
	 *
	 * @param string $tag Tag name.
	 * @param string $handle Handle name.
	 * @param string $src src.
	 */
	function mumu_add_async_to_script( $tag, $handle, $src ) {
		if ( strstr( $handle, 'amp-' ) ) {
			$tag = '<script async custom-element="' . $handle . '" src="' . esc_url( $src ) . '"></script>';
		} else {
			$tag = '<script async src="' . esc_url( $src ) . '"></script>';
		}
		return $tag;
	}
}
add_filter( 'script_loader_tag', 'mumu_add_async_to_script', 10, 3 );
