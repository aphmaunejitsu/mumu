<?php

if (! function_exists('mumu_google')) {
    function mumu_google($wp_customize)
    {
        $wp_customize->add_panel(
            'mumu[theme_my_google]',
            [
                'title' => 'Google',
                'priority' => 200
            ]
        );
    }
}
add_action('customize_register', 'mumu_google');

if (! function_exists('mumu_google_section')) {
    function mumu_google_section($wp_customize)
    {
        $wp_customize->add_section(
            'mumu[theme_my_google][analytics]',
            array(
                'title'    => 'Analytics',
                'panel'    => 'mumu[theme_my_google]',
                'priority' => 1,
            )
        );

        $wp_customize->add_section(
            'mumu[theme_my_google][adsens]',
            [
                'title'    => 'Adsens',
                'panel'    => 'mumu[theme_my_google]',
                'priority' => 2,
                'description' => __('AMP用の広告を利用してください。AMP以外の広告ではエラーとなります'),
            ]
        );
    }
}
add_action('customize_register', 'mumu_google_section');

if (! function_exists('mumu_google_analytics')) {
    function mumu_google_analytics($wp_customize)
    {

        $wp_customize->add_setting(
            'mumu[theme_my_google][analytics][id]',
            array(
                'default'   => '',
                'type'      => 'option',
                'transport' => 'postMessage',
            )
        );

        $wp_customize->add_control(
            'mumu[theme_my_google][analytics][id]',
            array(
                'settings' => 'mumu[theme_my_google][analytics][id]',
                'label'    => 'Tracking ID',
                'section'  => 'mumu[theme_my_google][analytics]',
                'type'     => 'text',
            )
        );
    }
}
add_action('customize_register', 'mumu_google_analytics');

if (! function_exists('mumu_google_adsens')) {
    function mumu_google_adsens($wp_customize)
    {

        // Adsensを有効
        $wp_customize->add_setting(
            'mumu[theme_my_google][adsens][is_use]',
            [
                'default'   => false,
                'type'      => 'option',
                'transport' => 'postMessage',
            ]
        );

        $wp_customize->add_control(
            'mumu[theme_my_google][adsens][is_use]',
            array(
                'settings' => 'mumu[theme_my_google][adsens][is_use]',
                'label'    => __('Adsensを有効にする'),
                'section'  => 'mumu[theme_my_google][adsens]',
                'type'     => 'checkbox',
            )
        );

        // 自動広告
        $wp_customize->add_setting(
            'mumu[theme_my_google][adsens][auto]',
            [
                'default'   => false,
                'type'      => 'option',
                'transport' => 'postMessage',
            ]
        );

        $wp_customize->add_control(
            'mumu[theme_my_google][adsens][auto]',
            array(
                'settings' => 'mumu[theme_my_google][adsens][auto]',
                'label'    => __('自動広告を使う'),
                'section'  => 'mumu[theme_my_google][adsens]',
                'type'     => 'checkbox',
            )
        );

        $wp_customize->add_setting(
            'mumu[theme_my_google][adsens][id]',
            array(
                'default'   => null,
                'type'      => 'option',
                'transport' => 'postMessage',
            )
        );

        $wp_customize->add_control(
            'mumu[theme_my_google][adsens][id]',
            array(
                'settings' => 'mumu[theme_my_google][adsens][id]',
                'label'    => 'adsens id: ca-pub-',
                'section'  => 'mumu[theme_my_google][adsens]',
                'type'     => 'text',
            )
        );
    }
}
add_action('customize_register', 'mumu_google_adsens');
