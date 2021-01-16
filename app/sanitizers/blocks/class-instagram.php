<?php
/**
 * Instagram Block
 *
 * @package Mumu Theme
 */

/**
 * Instagram Block class
 */
class Instagram extends BlockBase {

	const BLOCK = 'amp-instagram';

	/**
	 * __invoke
	 */
	public function __invoke() {
		_log( 'Start Instagram::__invoke' );

		try {
			for ( $i = $this->nodes->count() - 1; $i >= 0; $i-- ) {
				$node = $this->nodes->item( $i );
				$id   = $this->get_instagram_id( $node );
				if ( null === $id ) {
					_log( 'nullpo' );
					continue;
				}

				$block = $this->content->createElement( self::BLOCK );
				$block->setAttribute( 'data-shortcode', $id );
				$block->setAttribute( 'width', 320 );
				$block->setAttribute( 'height', 320 );
				$block->setAttribute( 'layout', 'responsive' );

				$node->replaceChild( $block, $node->firstChild );
			}

			return $this->content;
		} catch ( \Exception $e ) {
			return $this->content;
		}

		_log( 'End Instagram::__invoke' );
	}

	/**
	 * Get Instagram Id.
	 *
	 * @param DOMNode $node DOMNode.
	 */
	private function get_instagram_id( $node ) {
		_log( 'Start getInstagramId' );
		$src = $node->nodeValue;
		if ( ! preg_match( '/https:\/\/www\.instagram\.com\/p\/([^&]+)/i', $src, $match ) ) {
			_log( 'nullpo instagram' );
			return null;
		}

		$id = str_replace( array( "\r\n", "\r", "\n" ), '', $match[1] );
		_log( 'End getInstagramId' );
		return $id;
	}
}
