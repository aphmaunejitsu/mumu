<?php
/**
 * Actions defines
 *
 * @package Mumu Theme
 */

if ( ! function_exists( 'mumu_thumbnails' ) ) {
	/**
	 * サムネイルサイズ
	 */
	function mumu_thumbnails() {
		add_theme_support( 'post-thumbnails' );

		add_image_size( 'mumu-thumbnail-xs-16x9', 144, 81, true );
		add_image_size( 'mumu-thumbnail-s-16x9', 480, 270, true );
		add_image_size( 'mumu-thumbnail-m-16x9', 752, 423, true );
		add_image_size( 'mumu-thumbnail-l-16x9', 1280, 720, true );
	}
}
add_action( 'after_setup_theme', 'mumu_thumbnails' );

if ( ! function_exists( 'mumu_register_menu_action' ) ) {
	/**
	 * ヘッダー, フッターメニュー
	 */
	function mumu_register_menu_action() {
		register_nav_menus(
			array(
				'header-navigation' => 'Header Navigation',
				'footer-navigation' => 'Footer Navigation',
			)
		);
	}
}
add_action( 'after_setup_theme', 'mumu_register_menu_action' );

if ( ! function_exists( 'mumu_remove_action' ) ) {
	/**
	 * 不要な処理を削除
	 */
	function mumu_remove_action() {
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_action( 'wp_head', 'rsd_link' );
		remove_action( 'wp_head', 'wlwmanifest_link' );
		remove_action( 'wp_head', 'feed_links_extra', 3 );
		remove_action( 'wp_head', 'wp_shortlink_wp_head' );
		remove_action( 'wp_head', 'rest_output_link_wp_head' );
		remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
		remove_action( 'wp_head', 'wp_oembed_add_host_js' );
		remove_action( 'wp_head', 'rel_canonical' );

		add_filter( 'show_admin_bar', '__return_false' );
	}
}
add_action( 'after_setup_theme', 'mumu_remove_action', 0 );

if ( ! function_exists( 'mumu_enqueue_inline_style' ) ) {
	/**
	 * AMP用cssの出力
	 */
	function mumu_enqueue_inline_style() {
		$style = file_get_contents( get_template_directory() . '/assets/css/aphmau.css' );
		echo wp_kses( $style, array() );
	}
}
add_action( 'mumu_amp_custom_css', 'mumu_enqueue_inline_style' );

if ( ! function_exists( 'mumu_after_setup_theme' ) ) {
	/**
	 * AMPに不要なCSSを出力しない
	 */
	function mumu_after_setup_theme() {
		add_action(
			'wp_enqueue_scripts',
			function () {
				wp_deregister_script( 'jquery' );
				wp_dequeue_style( 'wp-block-library' );
			}
		);
	}
}
add_action( 'after_setup_theme', 'mumu_after_setup_theme' );

if ( ! function_exists( 'mumu_enqueue_scripts' ) ) {
	/**
	 * AMP用Javascriptのリンク
	 */
	function mumu_enqueue_scripts() {
		// phpcs:disable WordPress.WP.EnqueuedResourceParameters.MissingVersion, WordPress.WP.EnqueuedResourceParameters.NotInFooter
		wp_enqueue_script( 'AMP', 'https://cdn.ampproject.org/v0.js', array(), null );
		wp_enqueue_script( 'amp-sidebar', 'https://cdn.ampproject.org/v0/amp-sidebar-0.1.js', array(), null );
		wp_enqueue_script( 'amp-form', 'https://cdn.ampproject.org/v0/amp-form-0.1.js', array(), null );
		wp_enqueue_script( 'amp-lightbox', 'https://cdn.ampproject.org/v0/amp-lightbox-0.1.js', array(), null );
		wp_enqueue_script( 'amp-iframe', 'https://cdn.ampproject.org/v0/amp-iframe-0.1.js', array(), null );
		wp_enqueue_script( 'amp-youtube', 'https://cdn.ampproject.org/v0/amp-youtube-0.1.js', array(), null );
		wp_enqueue_script( 'amp-social-share', 'https://cdn.ampproject.org/v0/amp-social-share-0.1.js', array(), null );
		wp_enqueue_script( 'amp-twitter', 'https://cdn.ampproject.org/v0/amp-twitter-0.1.js', array(), null );
		wp_enqueue_script( 'amp-instagram', 'https://cdn.ampproject.org/v0/amp-instagram-0.1.js', array(), null );
		// phpcs:enable
	}
}
add_action( 'wp_enqueue_scripts', 'mumu_enqueue_scripts' );

if ( ! function_exists( 'mumu_add_canonical' ) ) {
	/**
	 * カノニカルの出力
	 */
	function mumu_add_canonical() {
		$canonical = null;
		if ( is_home() || is_front_page() ) {
			$canonical = home_url();
		} elseif ( is_category() ) {
			$canonical = get_category_link( get_query_var( 'cat' ) );
		} elseif ( is_tag() ) {
			$canonical = get_tag_link( get_queried_object()->term_id );
		} elseif ( is_search() ) {
			$canonical = get_search_link();
		} elseif ( is_page() || is_single() ) {
			$canonical = get_permalink();
		} else {
			$canonical = home_url();
		}

		echo '<link rel="canonical" href="' . esc_attr( $canonical ) . '">';
	}
}
add_action( 'wp_head', 'mumu_add_canonical' );

if ( ! function_exists( 'mumu_add_author_action' ) ) {
	/**
	 * 投稿一覧にユーザ絞り込み表示
	 */
	function mumu_add_author_action() {
		global $post_type;
		if ( 'post' === $post_type ) {
			wp_dropdown_users(
				array(
					'show_option_all' => 'すべてのユーザー',
					'name'            => 'author',
				)
			);
		}
	}
}
add_action( 'restrict_manage_posts', 'mumu_add_author_action' );

if ( ! function_exists( 'mumu_deactive_theme' ) ) {
	/**
	 * Clean up database when deactive theme
	 */
	function mumu_deactive_theme() {
		delete_post_meta_by_key( 'page_count' );
		delete_post_meta_by_key( '_hour_page_count' );
		delete_option( 'mumu' );
	}
}
add_action( 'switch_theme', 'mumu_deactive_theme' );
