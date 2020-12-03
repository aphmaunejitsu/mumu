<?php

require_once dirname(__FILE__) . '/app/actions.php';
require_once dirname(__FILE__) . '/app/filters.php';
require_once dirname(__FILE__) . '/app/supports.php';
require_once dirname(__FILE__) . '/app/customizers.php';
require_once dirname(__FILE__) . '/helpers/template-functions.php';

require_once dirname(__FILE__) . '/classes/class-mumu-theme.php';
require_once dirname(__FILE__) . '/classes/class-mumu-popular.php';


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
