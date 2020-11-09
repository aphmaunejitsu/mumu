<?php

use Masterminds\HTML5;

require_once dirname( __FILE__ ) . '/content/image.php';
require_once dirname( __FILE__ ) . '/content/embed.php';
require_once dirname( __FILE__ ) . '/content/iframe.php';
require_once dirname( __FILE__ ) . '/content/ad.php';

class Sgn_Content {
	private static $root_content;
	private static $should_do_sanitize = array( 'Content_Image', 'Content_Iframe', 'Content_Embed', 'Content_Ad' );

	public static function the_content( $content ) {
		if ( ! ( in_the_loop() && is_main_query() ) ) {
			return $content;
		}

		$content = preg_replace( '/<!--[\s\S]*?-->/', '', do_shortcode( get_the_content() ) );
		$html5   = new HTML5();
		$dom     = $html5->loadHTML( $content );

		foreach ( self::$should_do_sanitize as $sanitizer ) {
			$class = new $sanitizer( $dom );
			$dom   = $class->sanitize();
		}

		$html = $dom->saveHTML( $dom );//->nodeValue;
		$html = preg_replace( '/<html .*?>/', '', $html );
		$html = preg_replace( '/<\/html>/', '', $html );
		$html = preg_replace( '/<!DOCTYPE html>/', '', $html );
		return $html;
	}
}
