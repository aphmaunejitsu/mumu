<?php

use Masterminds\HTML5;

require_once MUMU_APP . '/sanitizers/Ad.php';
require_once MUMU_DIR . '/classes/content/embed.php';
require_once MUMU_DIR . '/classes/content/iframe.php';
require_once MUMU_DIR . '/classes/content/image.php';
function ampContent( $content ) {
    try {
        if ( ! ( in_the_loop() && is_main_query() ) ) {
            return $content;
        }

        $body = mb_convert_encoding($content, 'HTML-ENTITIES', 'auto');
        //$body = preg_replace('/<!--[\s\S]*?-->/', '', $body);

        $html5 = new HTML5();
        $dom = @$html5->loadHTML($body);

        $result = (new Ad($dom))();
        $html = $dom->saveHTML($result);

        $html = preg_replace( '/<html .*?>/', '', $html );
        $html = preg_replace( '/<\/html>/', '', $html );
        $html = preg_replace( '/<!DOCTYPE html>/', '', $html );
        return $html;
    } catch (\Exception $e) {
        _log($e);
        return $content;
    }
}

add_filter('the_content', 'ampContent', 999999999);

function getSanitizers()
{
    return [
        'Ad',
    ];
}
