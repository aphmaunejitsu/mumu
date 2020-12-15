<?php

if (! function_exists('mumu_google_analytics')) {
    function mumu_google_analytics($wp_customize)
    {
        $wp_customize->add_section(
            'mumu[theme_my_analytics]',
            array(
                'title'    => 'Google Analytics',
                'priority' => 201,
            )
        );

        $wp_customize->add_setting(
            'mumu[theme_my_analytics][id]',
            array(
                'default'   => '',
                'type'      => 'option',
                'transport' => 'postMessage',
            )
        );

        $wp_customize->add_control(
            'mumu[theme_my_analytics][id]',
            array(
                'settings' => 'mumu[theme_my_analytics][id]',
                'label'    => 'Tracking ID',
                'section'  => 'mumu[theme_my_analytics]',
                'type'     => 'text',
            )
        );
    }
}
add_action('customize_register', 'mumu_google_analytics');

if (! function_exists('mumu_advertising')) {
    function mumu_advertising($wp_customize)
    {
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
                'default'   => '',
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
                'default'   => null,
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
                'default'   => false,
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
                'default'   => false,
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
                'default'   => null,
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
                'default'   => null,
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
                'default'   => null,
                'type'      => 'option',
                'transport' => 'postMessage',
            )
        );

        $wp_customize->add_setting(
            'sgn_theme_ad_category',
            array(
                'default'   => '',
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
                'default'   => '',
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
}
add_action('customize_register', 'mumu_advertising');

if (! function_exists('mumu_customier_sns')) {
    function mumu_customier_sns($wp_customize)
    {
        $wp_customize->add_section(
            'mumu[theme_my_sns]',
            array(
                'title'    => 'SNS',
                'priority' => 211,
            )
        );

        $wp_customize->add_setting(
            'mumu[theme_my_sns][is_twitter]',
            array(
                'default'   => 0,
                'type'      => 'option',
                'transport' => 'postMessage',
            )
        );

        $wp_customize->add_control(
            'mumu[theme_my_sns][is_twitter]',
            array(
                'settings' => 'mumu[theme_my_sns][is_twitter]',
                'label'    => 'Shared Twitter',
                'section'  => 'mumu[theme_my_sns]',
                'type'     => 'checkbox',
            )
        );

        $wp_customize->add_setting(
            'mumu[theme_my_sns][is_facebook]',
            array(
                'default'   => 0,
                'type'      => 'option',
                'transport' => 'postMessage',
            )
        );

        $wp_customize->add_control(
            'mumu[theme_my_sns][is_facebook]',
            array(
                'settings' => 'mumu[theme_my_sns][is_facebook]',
                'label'    => 'Shared Facebook',
                'description' => 'Facebok APP IDを取得して入力してください',
                'section'  => 'mumu[theme_my_sns]',
                'type'     => 'checkbox',
            )
        );
        $wp_customize->add_setting(
            'mumu[theme_my_sns][fbappid]',
            [
                'default'   => '',
                'type'      => 'option',
                'transport' => 'postMessage',
            ]
        );

        $wp_customize->add_control(
            'mumu[theme_my_sns][fbappid]',
            [
                'settings' => 'mumu[theme_my_sns][fbappid]',
                'label'    => 'Facebook APP ID',
                'section'  => 'mumu[theme_my_sns]',
                'type'     => 'text',
            ]
        );

        // line
        $wp_customize->add_setting(
            'mumu[theme_my_sns][is_line]',
            array(
                'default'   => 0,
                'type'      => 'option',
                'transport' => 'postMessage',
            )
        );

        $wp_customize->add_control(
            'mumu[theme_my_sns][is_line]',
            array(
                'settings' => 'mumu[theme_my_sns][is_line]',
                'label'    => 'Shared LINE',
                'section'  => 'mumu[theme_my_sns]',
                'type'     => 'checkbox',
            )
        );

        // pinterest
        $wp_customize->add_setting(
            'mumu[theme_my_sns][is_pinterest]',
            array(
                'default'   => 0,
                'type'      => 'option',
                'transport' => 'postMessage',
            )
        );

        $wp_customize->add_control(
            'mumu[theme_my_sns]is_pinterest',
            array(
                'settings' => 'mumu[theme_my_sns][is_pinterest]',
                'label'    => 'Shared Pinterest',
                'section'  => 'mumu[theme_my_sns]',
                'type'     => 'checkbox',
            )
        );

        // Tumblr
        $wp_customize->add_setting(
            'mumu[theme_my_sns][is_tumblr]',
            array(
                'default'   => 0,
                'type'      => 'option',
                'transport' => 'postMessage',
            )
        );

        $wp_customize->add_control(
            'mumu[theme_my_sns][is_tumblr]',
            array(
                'settings' => 'mumu[theme_my_sns][is_tumblr]',
                'label'    => 'Shared Tumblr',
                'section'  => 'mumu[theme_my_sns]',
                'type'     => 'checkbox',
            )
        );

        $wp_customize->add_setting(
            'mumu[theme_my_sns][twitter]',
            array(
                'default'   => '',
                'type'      => 'option',
                'transport' => 'refresh',
            )
        );

        $wp_customize->add_control(
            'mumu[theme_my_sns][twitter]',
            array(
                'settings' => 'mumu[theme_my_sns][twitter]',
                'label'    => 'Twitter Profile Url',
                'section'  => 'mumu[theme_my_sns]',
                'type'     => 'text',
            )
        );

        $wp_customize->add_setting(
            'mumu[theme_my_sns][fbpage]',
            array(
                'default'   => '',
                'type'      => 'option',
                'transport' => 'refresh',
            )
        );

        $wp_customize->add_control(
            'mumu[theme_my_sns][fbpage]',
            array(
                'settings' => 'mumu[theme_my_sns][fbpage]',
                'label'    => 'Facebook Page',
                'section'  => 'mumu[theme_my_sns]',
                'type'     => 'text',
            )
        );
    }
}
add_action('customize_register', 'mumu_customier_sns');

if (! function_exists('mumu_customizer_amp')) {
    function mumu_customizer_amp($wp_customize)
    {
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
                'default'   => null,
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
                    'witdh'       => 600,
                    'height'      => 60,
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
                'label'    => _('アイキャッチ画像をポップアップする'),
                'section'  => 'sgn_theme_amp',
                'settings' => 'sgn_theme_amp_eyecatch_popup',
                'type'     => 'checkbox',
            )
        );
    }
}
add_action('customize_register', 'mumu_customizer_amp');

// カスタマイザー
if (! function_exists('mumu_customize_preview_js')) {
    function mumu_customize_preview_js()
    {
        wp_enqueue_script(
            'mumu_customizer_preview',
            get_template_directory_uri() . '/js/customizer-preview.js',
            ['customize-preview'],
            null,
            true
        );
    }
}
add_action('customize_preview_init', 'mumu_customize_preview_js');

if (! function_exists('mumu_customize_control_js')) {
    function mumu_customize_control_js()
    {
        wp_enqueue_script(
            'mumu_customizer_control',
            get_template_directory_uri() . '/js/customizer-control.js',
            ['customize-controls', 'jquery'],
            null,
            true
        );
    }
}
add_action('customize_controls_enqueue_scripts', 'mumu_customize_control_js');
