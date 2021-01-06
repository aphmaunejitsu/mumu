<?php

require_once MUMU_APP . '/customizers/sns.php';

if ( ! function_exists( 'mumu_customizer_amp' ) ) {
	function mumu_customizer_amp( $wp_customize ) {
		$wp_customize->add_section(
			'sgn_theme_amp',
			array(
				'title'    => 'AMP',
				'priority' => 211,
			)
		);

		$wp_customize->add_setting(
			'sgn_theme_amp_eyecatch_popup',
			array(
				'default'   => true,
				'type'      => 'option',
				'transport' => 'postMessage',
			)
		);
		$wp_customize->add_control(
			'sgn_theme_amp_eyecatch_popup',
			array(
				'label'    => _( 'アイキャッチ画像をポップアップする' ),
				'section'  => 'sgn_theme_amp',
				'settings' => 'sgn_theme_amp_eyecatch_popup',
				'type'     => 'checkbox',
			)
		);
	}
}
add_action( 'customize_register', 'mumu_customizer_amp' );

// カスタマイザー
if ( ! function_exists( 'mumu_customize_preview_js' ) ) {
	function mumu_customize_preview_js() {
		wp_enqueue_script(
			'mumu_customizer_preview',
			get_template_directory_uri() . '/js/customizer-preview.js',
			array( 'customize-preview' ),
			null,
			true
		);
	}
}
add_action( 'customize_preview_init', 'mumu_customize_preview_js' );

if ( ! function_exists( 'mumu_customize_control_js' ) ) {
	function mumu_customize_control_js() {
		wp_enqueue_script(
			'mumu_customizer_control',
			get_template_directory_uri() . '/js/customizer-control.js',
			array( 'customize-controls', 'jquery' ),
			null,
			true
		);
	}
}
add_action( 'customize_controls_enqueue_scripts', 'mumu_customize_control_js' );
