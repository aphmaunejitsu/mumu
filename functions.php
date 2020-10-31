<?php
require_once dirname(__FILE__) . '/classes/class-mumu-theme.php';
require_once dirname(__FILE__) . '/classes/class-mumu-popular.php';
require_once dirname(__FILE__) . '/classes/class-sgn-content.php';
require_once dirname(__FILE__) . '/classes/class-sgn-fliter.php';
require_once dirname(__FILE__) . '/classes/class-sgn-customizer.php';

// テーマオブジェクトをグローバル変数へ
add_action('after_setup_theme', 'instantiate_theme', 99999);
function instantiate_theme()
{
    $GLOBALS['sgn_theme'] = call_user_func(
        array(
            str_replace(' ', '_', wp_get_theme()),
            'get_object',
        )
    );

    $GLOBALS['mumu_page_view'] = new Mumu_Popular();
}

add_action(
    'after_setup_theme',
    function () {
        // 色々停止
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
        add_action('wp_head', array( 'Sgn_Filter', 'add_canonical' ));
        add_filter('show_admin_bar', '__return_false');
        add_action(
            'wp_enqueue_scripts',
            function () {
                wp_deregister_script('jquery');
                wp_dequeue_style('wp-block-library');
                wp_dequeue_style('wordpress-popular-posts-css');
            }
        );
    },
    0
);

// サムネイルのカスタマイズ
add_action('after_setup_theme', array( 'Sgn_Filter', 'setup_thumbnail' ));
add_filter('posts_search', array( 'Sgn_Filter', 'post_search' ));
add_filter('sgn_additional_js', array( 'Sgn_Filter', 'add_js' ));
add_filter('sgn_google_ads', array( 'Sgn_Filter', 'add_google_ads' ));

add_filter('the_content', array( 'Sgn_Content', 'the_content' ));
add_filter('document_title_parts', array( 'Sgn_Filter', 'title_parts' ));
add_filter('document_title_separator', array( 'Sgn_Filter', 'title_separator' ));

add_action('customize_register', array( 'sgn_theme_customizer', 'contact_us' ));
add_action('customize_register', array( 'sgn_theme_customizer', 'google_analytics' ));
add_action('customize_register', array( 'sgn_theme_customizer', 'ad' ));
add_action('customize_register', array( 'sgn_theme_customizer', 'my_sns' ));
add_action('customize_register', array( 'sgn_theme_customizer', 'amp' ));

add_theme_support('custom-logo');
add_theme_support('title-tag');


add_action('restrict_manage_posts', 'add_author_filter');
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

remove_filter('the_excerpt', 'wpautop');
remove_filter('term_description', 'wpautop');

if (! function_exists('_log')) {
    function _log($message)
    {
        if (WP_DEBUG === true) {
            if (is_array($message) || is_object($message)) {
                error_log(print_r($message, true));
            } else {
                error_log($message);
            }
        }
    }
}
