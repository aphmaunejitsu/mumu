<?php

define("MUMU_DIR", dirname(__FILE__));
define("MUMU_APP", MUMU_DIR . '/app');
define("MUMU_VENDOR", MUMU_DIR . '/vendor');
define("MUMU_HELPERS", MUMU_DIR . '/helpers');

// require_once MUMU_VENDOR . '/autoload.php';
// vendor
require_once MUMU_VENDOR . '/masterminds/html5/src/HTML5.php';

require_once MUMU_APP . '/actions.php';
require_once MUMU_APP . '/filters.php';
require_once MUMU_APP . '/supports.php';
require_once MUMU_APP . '/customizers.php';
require_once MUMU_APP . '/sanitizer.php';
require_once MUMU_HELPERS . '/template-functions.php';

require_once MUMU_DIR . '/classes/class-mumu-theme.php';
require_once MUMU_DIR . '/classes/class-mumu-popular.php';


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
