<?php

use Masterminds\HTML5;

require_once dirname(dirname(__FILE__)) . '/classes/content/ad.php';
require_once dirname(dirname(__FILE__)) . '/classes/content/embed.php';
require_once dirname(dirname(__FILE__)) . '/classes/content/iframe.php';
require_once dirname(dirname(__FILE__)) . '/classes/content/image.php';

function amp_content( $content ) {
    if ( ! ( in_the_loop() && is_main_query() ) ) {
        return $content;
    }

	$should_do_sanitize = ['Content_Image', 'Content_Iframe', 'Content_Embed', 'Content_Ad'];
    $content = do_shortcode(get_the_content());;
    $html5   = new HTML5();
    $dom     = $html5->loadHTML( $content );

    foreach ( $should_do_sanitize as $sanitizer ) {
        $class = new $sanitizer( $dom );
        $dom   = $class->sanitize();
    }

    $html = $dom->saveHTML( $dom );//->nodeValue;
    $html = preg_replace( '/<html .*?>/', '', $html );
    $html = preg_replace( '/<\/html>/', '', $html );
    $html = preg_replace( '/<!DOCTYPE html>/', '', $html );
    return $html;
}
add_filter('the_content', 'amp_content', 999999999);
