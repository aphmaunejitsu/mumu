<?php
/**
 * Init Widgets
 *
 * @package Mumu Theme
 */

if ( ! function_exists( 'remove_recent_comments_style' ) ) {
	/**
	 * コメントスタイルの削除
	 */
	function remove_recent_comments_style() {
		global $wp_widget_factory;
		remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
	}
}
add_action( 'widgets_init', 'remove_recent_comments_style' );

if ( ! function_exists( 'mumu_widgets_init' ) ) {
	/**
	 * ウィジェットの初期化
	 */
	function mumu_widgets_init() {
		$config = array(
			'before_widget' => '<section class="widget %1$s %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>',
		);

		register_sidebar(
			array(
				'name' => 'Main Sidebar',
				'id'   => 'sidebar-primary',
			) + $config
		);

		register_sidebar(
			array(
				'name' => 'On Article',
				'id'   => 'on-article',
			) + $config
		);

		register_sidebar(
			array(
				'name' => 'Under Article',
				'id'   => 'under-article',
			) + $config
		);

		register_sidebar(
			array(
				'name' => 'Single Page Sidebar',
				'id'   => 'sidebar-single-page',
			) + $config
		);

	}
}
add_action( 'widgets_init', 'mumu_widgets_init' );
