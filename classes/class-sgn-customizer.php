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

	public static function my_sns( $wp_customize ) {
		$wp_customize->add_section(
			'sgn_theme_my_sns',
			array(
				'title'    => 'SNS',
				'priority' => 211,
			)
		);

		$wp_customize->add_setting(
			'sgn_theme_my_twitter',
			array(
				'default'   => array(),
				'type'      => 'option',
				'transport' => 'postMessage',
			)
		);

		$wp_customize->add_control(
			'sgn_theme_my_twitter',
			array(
				'settings' => 'sgn_theme_my_twitter',
				'label'    => 'Twitter Profile Url',
				'section'  => 'sgn_theme_my_sns',
				'type'     => 'text',
			)
		);

		$wp_customize->add_setting(
			'sgn_theme_my_fbpage',
			array(
				'default'   => array(),
				'type'      => 'option',
				'transport' => 'postMessage',
			)
		);

		$wp_customize->add_control(
			'sgn_theme_my_fbpage',
			array(
				'settings' => 'sgn_theme_my_fbpage',
				'label'    => 'Facebook Page',
				'section'  => 'sgn_theme_my_sns',
				'type'     => 'text',
			)
		);
	}

	public static function ad( $wp_customize ) {
		$wp_customize->add_section(
			'sgn_theme_ad',
			array(
				'title'       => '広告',
				'priority'    => 210,
				'description' => 'AMP用の広告を利用してください。AMP以外の広告ではエラーとなります',
			)
		);

		$wp_customize->add_setting(
			'sgn_theme_ad_show',
			array(
				'default'   => array(),
				'type'      => 'option',
				'transport' => 'postMessage',
			)
		);

		$wp_customize->add_control(
			'sgn_theme_ad_show',
			array(
				'settings' => 'sgn_theme_ad_show',
				'label'    => '広告表示',
				'section'  => 'sgn_theme_ad',
				'type'     => 'checkbox',
			)
		);

		$wp_customize->add_setting(
			'sgn_theme_ad_adsens',
			array(
				'default'   => array(),
				'type'      => 'option',
				'transport' => 'postMessage',
			)
		);

		$wp_customize->add_control(
			'sgn_theme_ad_adsens',
			array(
				'settings' => 'sgn_theme_ad_adsens',
				'label'    => 'アドセンスid ca-pub-以降',
				'section'  => 'sgn_theme_ad',
				'type'     => 'text',
			)
		);

		$wp_customize->add_setting(
			'sgn_theme_ad_adsens_auto',
			array(
				'default'   => array(),
				'type'      => 'option',
				'transport' => 'postMessage',
			)
		);

		$wp_customize->add_control(
			'sgn_theme_ad_adsens_auto',
			array(
				'settings' => 'sgn_theme_ad_adsens_auto',
				'label'    => '自動広告を使う',
				'section'  => 'sgn_theme_ad',
				'type'     => 'checkbox',
			)
		);

		$wp_customize->add_setting(
			'sgn_theme_ad_inner_single',
			array(
				'default'   => array(),
				'type'      => 'option',
				'transport' => 'postMessage',
			)
		);
		$wp_customize->add_control(
			'sgn_theme_ad_inner_single',
			array(
				'settings' => 'sgn_theme_ad_inner_single',
				'label'    => '記事中に広告を表示する(記事の下の広告を利用します)',
				'section'  => 'sgn_theme_ad',
				'type'     => 'checkbox',
			)
		);

		$wp_customize->add_setting(
			'sgn_theme_ad_single',
			array(
				'default'   => array(),
				'type'      => 'option',
				'transport' => 'postMessage',
			)
		);

		$wp_customize->add_control(
			'sgn_theme_ad_single',
			array(
				'settings' => 'sgn_theme_ad_single',
				'label'    => '記事の下',
				'section'  => 'sgn_theme_ad',
				'type'     => 'textarea',
			)
		);

		$wp_customize->add_setting(
			'sgn_theme_ad_page',
			array(
				'default'   => array(),
				'type'      => 'option',
				'transport' => 'postMessage',
			)
		);

		$wp_customize->add_control(
			'sgn_theme_ad_page',
			array(
				'settings' => 'sgn_theme_ad_page',
				'label'    => '固定ページの下',
				'section'  => 'sgn_theme_ad',
				'type'     => 'textarea',
			)
		);

		$wp_customize->add_setting(
			'sgn_theme_ad_similar',
			array(
				'default'   => array(),
				'type'      => 'option',
				'transport' => 'postMessage',
			)
		);

		$wp_customize->add_setting(
			'sgn_theme_ad_category',
			array(
				'default'   => array(),
				'type'      => 'option',
				'transport' => 'postMessage',
			)
		);

		$wp_customize->add_control(
			'sgn_theme_ad_category',
			array(
				'settings' => 'sgn_theme_ad_category',
				'label'    => 'Categoriesの下',
				'section'  => 'sgn_theme_ad',
				'type'     => 'textarea',
			)
		);

		$wp_customize->add_control(
			'sgn_theme_ad_similar',
			array(
				'settings' => 'sgn_theme_ad_similar',
				'label'    => 'Related Entriesの下',
				'section'  => 'sgn_theme_ad',
				'type'     => 'textarea',
			)
		);

		$wp_customize->add_setting(
			'sgn_theme_ad_new',
			array(
				'default'   => array(),
				'type'      => 'option',
				'transport' => 'postMessage',
			)
		);

		$wp_customize->add_control(
			'sgn_theme_ad_new',
			array(
				'settings' => 'sgn_theme_ad_new',
				'label'    => 'New Entriesの下',
				'section'  => 'sgn_theme_ad',
				'type'     => 'textarea',
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
