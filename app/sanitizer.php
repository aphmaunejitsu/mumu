<?php
/**
 * Sanitize the content
 *
 * @package Mumu theme
 */

use Masterminds\HTML5;

require_once MUMU_APP . '/sanitizers/class-sanitizer.php';
require_once MUMU_APP . '/sanitizers/class-block.php';
require_once MUMU_APP . '/sanitizers/class-cleanhtml.php';
require_once MUMU_APP . '/sanitizers/class-iframe.php';
require_once MUMU_APP . '/sanitizers/class-image.php';

if ( ! function_exists( 'mumu_amp_content' ) ) {
	/**
	 * Output the content
	 *
	 * @param string $content the content.
	 */
	function mumu_amp_content( $content ) {
		try {
			if ( ! ( in_the_loop() && is_main_query() ) ) {
				return $content;
			}

			if ( ! is_single() ) {
				return $content;
			}

			$content = preg_replace( '/<!--[\s\S]*?-->/', '', do_shortcode( get_the_content() ) );

			$html5 = new HTML5();
			$dom   = @$html5->loadHTML( $content );

			$sanitizers = array( 'Block', 'Iframe', 'Image' );
			foreach ( $sanitizers as $sanitizer ) {
				$dom = ( new $sanitizer( $dom ) )();
			}

			$html = $dom->saveHTML( $dom );

			$html = ( new CleanHtml( $html ) )();

			return $html;
		} catch ( \Exception $e ) {
			_log( $e );
			return $content;
		}
	}
}
add_filter( 'the_content', 'mumu_amp_content' );

