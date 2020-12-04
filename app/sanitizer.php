<?php

use Masterminds\HTML5;

require_once MUMU_APP . '/sanitizers/Ad.php';
require_once MUMU_DIR . '/classes/content/embed.php';
require_once MUMU_DIR . '/classes/content/iframe.php';
require_once MUMU_DIR . '/classes/content/image.php';

function amp_content( $content ) {
    if ( ! ( in_the_loop() && is_main_query() ) ) {
        return $content;
    }

    $html = mb_convert_encoding($content, 'HTML-ENTITIES', 'auto');

    $html5 = new HTML5();
    $dom = @$html5->loadHTML($content);


    $dom = (new Ad($dom))();
    return $dom->saveHTML($dom);

    $html = preg_replace( '/<html .*?>/', '', $html );
    $html = preg_replace( '/<\/html>/', '', $html );
    $html = preg_replace( '/<!DOCTYPE html>/', '', $html );
    return $html;
}

add_filter('the_content', 'amp_content', 999999999);
