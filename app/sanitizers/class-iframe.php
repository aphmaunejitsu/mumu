<?php
/**
 * This is iFrame Sanitizer
 *
 * @package Mumu Theme
 */

/**
 * IFrame Class
 */
class Iframe extends Sanitizer {

	/**
	 * Excute sanitize for iFrame
	 */
	public function __invoke() {
		$nodes = $this->content->getElementsByTagName( 'iframe' );
		if ( $nodes->count() < 1 ) {
			return $this->content;
		}

		try {
			for ( $i = $nodes->count() - 1; $i >= 0; $i-- ) {
				$node = $nodes->item( $i );
				if ( ! $node->hasAttribute( 'src' ) ) {
					$node->parentNode->removeChild( $node );
					continue;
				}

				$src = $node->getAttribute( 'src' );

				$isGoogleMaps = false;
				if ( preg_match( '/^https:\/\/www\.google\.(com|co\.jp)\/maps/', $src ) ) {
					$isGoogleMaps = true;
				}

				$iframe = $this->content->createElement( 'amp-iframe' );
				$iframe->setAttribute( 'src', $node->getAttribute( 'src' ) );
				$iframe->setAttribute( 'frameborder', 0 );
				$iframe->setAttribute( 'layout', 'responsive' );
				$iframe->setAttribute( 'width', 600 );
				$iframe->setAttribute( 'height', 450 );

				if ( $isGoogleMaps ) {
					$iframe->setAttribute( 'sandbox', 'allow-scripts allow-same-origin allow-popups' );
				}

				$node->parentNode->insertBefore( $iframe, $node );
				$node->parentNode->removeChild( $node );
			}

			return $this->content;
		} catch ( \Exception $e ) {
			_log( $e );
			return $this->content;
		}
	}
}
