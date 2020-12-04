<?php

// サムネイルのカスタマイズ
function thumbnails()
{
    add_theme_support('post-thumbnails');

    add_image_size('mumu-thumbnail-s-16x9', 480, 270, true);
    add_image_size('mumu-thumbnail-m-16x9', 752, 423, true);
    add_image_size('mumu-thumbnail-l-16x9', 1280, 720, true);
}
add_action('after_setup_theme', 'thumbnails');

// メニューの追加
function register_menu_action()
{
    register_nav_menus([
        'header-navigation' => 'Header Navigation',
        'footer-navigation' => 'Footer Navigation',
    ]);
}
add_action('after_setup_theme',   'register_menu_action');

// AMPに不要なAction削除
function removeAction()
{
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'feed_links_extra', 3);
    remove_action('wp_head', 'wp_shortlink_wp_head');
    remove_action('wp_head', 'rest_output_link_wp_head');
    remove_action('wp_head', 'wp_oembed_add_discovery_links');
    remove_action('wp_head', 'wp_oembed_add_host_js');
    remove_action('wp_head', 'rel_canonical');
    add_filter('show_admin_bar', '__return_false');
}
add_action('after_setup_theme',   'removeAction');

// Widgetsの初期化
function widgets_init()
{
    $config = [
        'before_widget' => '<section class="widget %1$s %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>'
    ];

    register_sidebar([
        'name'          => 'Header Navi menu',
        'id'            => 'sidebar-primary'
    ] + $config);

    register_sidebar([
        'name'          => 'Under Article',
        'id'            => 'under-article',
    ] + $config);

}
add_action('widgets_init', 'widgets_init');

// AMPのCSS出力
function enqueueInlineStyle()
{
    $style = file_get_contents(get_template_directory() . '/assets/css/aphmau.css');
    echo $style;
}
add_action('mumu_amp_custom_css', 'enqueueInlineStyle');

function mumu_after_setup_theme()
{
    add_action('wp_enqueue_scripts', function () {
        wp_deregister_script('jquery');
        wp_dequeue_style('wp-block-library');
        wp_dequeue_style('wordpress-popular-posts-css');
    });
}
add_action('after_setup_theme', 'mumu_after_setup_theme');

function add_canonical()
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
add_action('wp_head', 'add_canonical');

// 管理にユーザを表示
function add_author_filter()
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
add_action('restrict_manage_posts', 'add_author_filter');
