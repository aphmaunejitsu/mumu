<?php

add_theme_support('custom-logo', [
    'height' => 40,
    'width'  => 240,
    'flex-height' => true
]);
add_theme_support('title-tag');

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
