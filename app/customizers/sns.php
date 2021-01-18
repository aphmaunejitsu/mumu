<?php
/**
 * SNS Customizer file
 *
 * @package Mumu Theme
 */

if ( ! function_exists( 'mumu_sns_panel' ) ) {
	/**
	 * SNS PANEL
	 *
	 * @param WP_Customize_Manager $wp_customize wp customize manager.
	 */
	function mumu_sns_panel( $wp_customize ) {
		$wp_customize->add_panel(
			'mumu[theme_my_sns]',
			array(
				'title'    => 'SNS',
				'priority' => 211,
			)
		);
	}
}
add_action( 'customize_register', 'mumu_sns_panel' );

if ( ! function_exists( 'mumu_sns_section' ) ) {
	/**
	 * SNS Section
	 *
	 * @param WP_Customize_Manager $wp_customize wp customize manager.
	 */
	function mumu_sns_section( $wp_customize ) {
		$wp_customize->add_section(
			'mumu[theme_my_sns][shared]',
			array(
				'title'       => __( '利用SNS' ),
				'description' => __( '共有で利用するSNSを選択してください' ),
				'panel'       => 'mumu[theme_my_sns]',
				'priority'    => 1,
			)
		);

		$wp_customize->add_section(
			'mumu[theme_my_sns][site]',
			array(
				'title'       => __( 'サイト' ),
				'description' => __( 'Twitterアカウント, Facebook Pageを入力してください' ),
				'panel'       => 'mumu[theme_my_sns]',
				'priority'    => 2,
			)
		);
	}
}
add_action( 'customize_register', 'mumu_sns_section' );

if ( ! function_exists( 'mumu_sns_shared' ) ) {
	/**
	 * SNS Shared
	 *
	 * @param WP_Customize_Manager $wp_customize wp customize manager.
	 */
	function mumu_sns_shared( $wp_customize ) {
		$wp_customize->add_setting(
			'mumu[theme_my_sns][shared][is_twitter]',
			array(
				'default'   => 0,
				'priority'  => 1,
				'type'      => 'option',
				'transport' => 'postMessage',
			)
		);

		$wp_customize->add_control(
			'mumu[theme_my_sns][shared][is_twitter]',
			array(
				'settings' => 'mumu[theme_my_sns][shared][is_twitter]',
				'label'    => __( 'Twitter' ),
				'section'  => 'mumu[theme_my_sns][shared]',
				'type'     => 'checkbox',
			)
		);

		$wp_customize->add_setting(
			'mumu[theme_my_sns][shared][is_facebook]',
			array(
				'default'   => 0,
				'priority'  => 2,
				'type'      => 'option',
				'transport' => 'postMessage',
			)
		);

		$wp_customize->add_control(
			'mumu[theme_my_sns][shared][is_facebook]',
			array(
				'settings' => 'mumu[theme_my_sns][shared][is_facebook]',
				'label'    => __( 'facebook' ),
				'section'  => 'mumu[theme_my_sns][shared]',
				'type'     => 'checkbox',
			)
		);

		$wp_customize->add_setting(
			'mumu[theme_my_sns][shared][fbappid]',
			array(
				'default'   => '',
				'type'      => 'option',
				'priority'  => 3,
				'transport' => 'postMessage',
			)
		);

		$wp_customize->add_control(
			'mumu[theme_my_sns][shared][fbappid]',
			array(
				'settings'    => 'mumu[theme_my_sns][shared][fbappid]',
				'label'       => 'Facebook APP ID',
				'description' => 'Facebook共有を利用するときは、Facebook APP IDを取得して入力してください',
				'section'     => 'mumu[theme_my_sns][shared]',
				'type'        => 'text',
			)
		);

		// line
		$wp_customize->add_setting(
			'mumu[theme_my_sns][shared][is_line]',
			array(
				'default'   => 0,
				'priority'  => 4,
				'type'      => 'option',
				'transport' => 'postMessage',
			)
		);

		$wp_customize->add_control(
			'mumu[theme_my_sns][shared][is_line]',
			array(
				'settings' => 'mumu[theme_my_sns][shared][is_line]',
				'label'    => 'Shared LINE',
				'section'  => 'mumu[theme_my_sns][shared]',
				'type'     => 'checkbox',
			)
		);

		// pinterest.
		$wp_customize->add_setting(
			'mumu[theme_my_sns][shared][is_pinterest]',
			array(
				'default'   => 0,
				'priority'  => 5,
				'type'      => 'option',
				'transport' => 'postMessage',
			)
		);

		$wp_customize->add_control(
			'mumu[theme_my_sns][shared][is_pinterest]',
			array(
				'settings' => 'mumu[theme_my_sns][shared][is_pinterest]',
				'label'    => 'Shared Pinterest',
				'section'  => 'mumu[theme_my_sns][shared]',
				'type'     => 'checkbox',
			)
		);

		// Tumblr.
		$wp_customize->add_setting(
			'mumu[theme_my_sns][shared][is_tumblr]',
			array(
				'default'   => 0,
				'type'      => 'option',
				'transport' => 'postMessage',
			)
		);

		$wp_customize->add_control(
			'mumu[theme_my_sns][shared][is_tumblr]',
			array(
				'settings' => 'mumu[theme_my_sns][shared][is_tumblr]',
				'label'    => 'Shared Tumblr',
				'section'  => 'mumu[theme_my_sns][shared]',
				'type'     => 'checkbox',
			)
		);
	}
}
add_action( 'customize_register', 'mumu_sns_shared' );

if ( ! function_exists( 'mumu_sns_site' ) ) {
	/**
	 * SNS Site
	 *
	 * @param WP_Customize_Manager $wp_customize wp customize manager.
	 */
	function mumu_sns_site( $wp_customize ) {
		$wp_customize->add_setting(
			'mumu[theme_my_sns][site][twitter]',
			array(
				'default'   => '',
				'type'      => 'option',
				'transport' => 'refresh',
			)
		);

		$wp_customize->add_control(
			'mumu[theme_my_sns][site][twitter]',
			array(
				'settings' => 'mumu[theme_my_sns][site][twitter]',
				'label'    => 'Twitter Profile Url',
				'section'  => 'mumu[theme_my_sns][site]',
				'type'     => 'text',
			)
		);

		$wp_customize->add_setting(
			'mumu[theme_my_sns][site][fbpage]',
			array(
				'default'   => '',
				'type'      => 'option',
				'transport' => 'refresh',
			)
		);

		$wp_customize->add_control(
			'mumu[theme_my_sns][site][fbpage]',
			array(
				'settings' => 'mumu[theme_my_sns][site][fbpage]',
				'label'    => 'Facebook Page',
				'section'  => 'mumu[theme_my_sns][site]',
				'type'     => 'text',
			)
		);
	}
}
add_action( 'customize_register', 'mumu_sns_site' );
