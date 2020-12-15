<?php

// サムネイルのカスタマイズ
if (! function_exists('mumu_thumbnails')) {
    function mumu_thumbnails()
    {
        add_theme_support('post-thumbnails');

        add_image_size('mumu-thumbnail-xs-16x9', 144,  81, true);
        add_image_size('mumu-thumbnail-s-16x9',  480, 270, true);
        add_image_size('mumu-thumbnail-m-16x9',  752, 423, true);
        add_image_size('mumu-thumbnail-l-16x9', 1280, 720, true);
    }
}
add_action('after_setup_theme', 'mumu_thumbnails');

// メニューの追加
if (! function_exists('mumu_register_menu_action')) {
    function mumu_register_menu_action()
    {
        register_nav_menus([
            'header-navigation' => 'Header Navigation',
            'footer-navigation' => 'Footer Navigation',
        ]);
    }
}
add_action('after_setup_theme',   'mumu_register_menu_action');

// AMPに不要なAction削除
if (! function_exists('mumu_remove_action')) {
    function mumu_remove_action()
    {
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('wp_print_styles', 'print_emoji_styles');
        remove_action('wp_head', 'rsd_link');
        remove_action('wp_head', 'wlwmanifest_link');
        remove_action('wp_head', 'feed_links_extra', 3);
        remove_action('wp_head', 'wp_shortlink_wp_head');
        remove_action('wp_head', 'rest_output_link_wp_head');
        remove_action('wp_head', 'wp_oembed_add_discovery_links');
        remove_action('wp_head', 'wp_oembed_add_host_js');
        remove_action('wp_head', 'rel_canonical');

        add_filter('show_admin_bar', '__return_false');
    }
}
add_action('after_setup_theme',   'mumu_remove_action');

// AMPのCSS出力
if (! function_exists('mumu_enqueue_inline_style')) {
    function mumu_enqueue_inline_style()
    {
        $style = file_get_contents(get_template_directory() . '/assets/css/aphmau.css');
        echo $style;
    }
}
add_action('mumu_amp_custom_css', 'mumu_enqueue_inline_style');

if (! function_exists('mumu_after_setup_theme')) {
    function mumu_after_setup_theme()
    {
        add_action('wp_enqueue_scripts', function () {
            wp_deregister_script('jquery');
            wp_dequeue_style('wp-block-library');
            wp_dequeue_style('wordpress-popular-posts-css');
        });
    }
}
add_action('after_setup_theme', 'mumu_after_setup_theme');

if (! function_exists('mumu_add_canonical')) {
    function mumu_add_canonical()
    {
        $canonical = null;
        if (is_home() || is_front_page()) {
            $canonical = home_url();
        } elseif (is_category()) {
            $canonical = get_category_link(get_query_var('cat'));
        } elseif (is_tag()) {
            $canonical = get_tag_link(get_queried_object()->term_id);
        } elseif (is_search()) {
            $canonical = get_search_link();
        } elseif (is_page() || is_single()) {
            $canonical = get_permalink();
        } else {
            $canonical = home_url();
        }

        echo '<link rel="canonical" href="' . $canonical. '">';
    }
}
add_action('wp_head', 'mumu_add_canonical');

// 管理にユーザを表示
if (! function_exists('mumu_add_author_filter')) {
    function mumu_add_author_filter()
    {
        global $post_type;
        if ($post_type == 'post') {
            wp_dropdown_users(
                array(
                    'show_option_all' => 'すべてのユーザー',
                    'name'            => 'author',
                )
            );
        }
    }
}
add_action('restrict_manage_posts', 'mumu_add_author_filter');
