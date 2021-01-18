<?php
/**
 * Customizer defines
 *
 * @package Mumu Theme
 */

require_once MUMU_APP . '/customizers/sns.php';

if ( ! function_exists( 'mumu_customize_preview_js' ) ) {
	/**
	 * カスタマイザーのプレビュー
	 */
	function mumu_customize_preview_js() {
		// phpcs:disable WordPress.WP.EnqueuedResourceParameters.MissingVersion, WordPress.WP.EnqueuedResourceParameters.NotInFooter
		wp_enqueue_script(
			'mumu_customizer_preview',
			get_template_directory_uri() . '/js/customizer-preview.js',
			array( 'jquery', 'customize-preview' ),
			null,
			true
		);
		// phpcs:enable
	}
}
add_action( 'customize_preview_init', 'mumu_customize_preview_js' );

if ( ! function_exists( 'mumu_customize_control_js' ) ) {
	/**
	 * カスタマイザーのコントロール
	 */
	function mumu_customize_control_js() {
		// phpcs:disable WordPress.WP.EnqueuedResourceParameters.MissingVersion, WordPress.WP.EnqueuedResourceParameters.NotInFooter
		wp_enqueue_script(
			'mumu_customizer_control',
			get_template_directory_uri() . '/js/customizer-control.js',
			array( 'customize-controls', 'jquery' ),
			null,
			true
		);
		// phpcs:enable
	}
}
add_action( 'customize_controls_enqueue_scripts', 'mumu_customize_control_js' );
