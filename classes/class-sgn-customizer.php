<?php
class sgn_theme_customizer {

	public static function amp( $wp_customize ) {
		$wp_customize->add_section(
			'sgn_theme_amp',
			array(
				'title'    => 'AMP',
				'priority' => 211,
			)
		);

		$wp_customize->add_setting(
			'sgn_theme_amp_logo',
			array(
				'default'   => array(),
				'type'      => 'option',
				'transport' => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'sgn_thme_amp_logo',
				array(
					'label'       => 'Logo',
					'section'     => 'sgn_theme_amp',
					'settings'    => 'sgn_theme_amp_logo',
					'description' => 'JSON LD用のロゴ 600 x 60のサイズの画像をアップロードしてください',
				)
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



	public static function custom_logo( $wp_customize ) {
		$wp_customize->get_setting( 'custom-logo' )->transport = 'postMessage';

	}

	public static function google_analytics( $wp_customize ) {
		$wp_customize->add_section(
			'sgn_theme_analytics',
			array(
				'title'    => 'Google Analytics',
				'priority' => 201,
			)
		);

		$wp_customize->add_setting(
			'sgn_theme_analytics_id',
			array(
				'default'   => array(),
				'type'      => 'option',
				'transport' => 'postMessage',
			)
		);

		$wp_customize->add_control(
			'sgn_theme_analytics_id',
			array(
				'settings' => 'sgn_theme_analytics_id',
				'label'    => 'Tracking ID',
				'section'  => 'sgn_theme_analytics',
				'type'     => 'text',
			)
		);
	}

	public static function contact_us( $wp_customize ) {
		$wp_customize->add_section(
			'sgn_theme_option',
			array(
				'title'    => 'お問い合わせ',
				'priority' => 200,
			)
		);

		$wp_customize->add_setting(
			'sgn_theme_option_contact_us',
			array(
				'default'   => array(),
				'type'      => 'option',
				'transport' => 'postMessage',
			)
		);

		$wp_customize->add_control(
			'sgn_theme_option_contact_us',
			array(
				'settings' => 'sgn_theme_option_contact_us',
				'label'    => 'お問合せ受信メールアドレス',
				'section'  => 'sgn_theme_option',
				'type'     => 'text',
			)
		);
	}
}
