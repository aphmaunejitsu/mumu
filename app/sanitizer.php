<?php

use Masterminds\HTML5;

require_once MUMU_APP . '/sanitizers/Ad.php';
require_once MUMU_APP . '/sanitizers/Block.php';
require_once MUMU_DIR . '/classes/content/iframe.php';
require_once MUMU_DIR . '/classes/content/image.php';

function ampContent( $content ) {
    try {
        if ( ! ( in_the_loop() && is_main_query() ) ) {
            return $content;
        }

        if (! is_single() ) {
            return $content;
        }

        $body = mb_convert_encoding($content, 'HTML-ENTITIES', 'auto');
        $body = preg_replace('/<!--[\s\S]*?-->/', '', do_shortcode($body));

        $html5 = new HTML5();
        $dom = @$html5->loadHTML($body);

        $sanitizers = getSanitizers();
        foreach ($sanitizers as $sanitizer) {
            $dom = (new $sanitizer($dom))();
        }
        $html = $dom->saveHTML($dom);

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
        'Block',
    ];
}
