<?php
/**
 * Twitter block class
 *
 * @package Mumu Theme
 */

/**
 * Twitter Class
 */
class Twitter extends BlockBase {

	const BLOCK = 'amp-twitter';

	/**
	 * __invoke
	 */
	public function __invoke() {
		_log( 'Start ' . __METHOD__ );

		try {
			for ( $i = $this->nodes->count() - 1; $i >= 0; $i-- ) {
				$node = $this->nodes->item( $i );
				$id   = $this->get_twitter_id( $node );
				if ( null === $id ) {
					_log( 'nullpo' );
					continue;
				}

				$twitter = $this->content->createElement( self::BLOCK );
				$twitter->setAttribute( 'data-tweetid', $id );
				$twitter->setAttribute( 'width', 320 );
				$twitter->setAttribute( 'height', 320 );
				$twitter->setAttribute( 'layout', 'responsive' );
				$twitter->setAttribute( 'class', 'm1' );

				$node->replaceChild( $twitter, $node->firstChild );
			}

			_log( 'End ' . __METHOD__ );
			return $this->content;
		} catch ( \Exception $e ) {
			_log( $e );
			return $this->content;
		}

	}

	/**
	 * Get twitter id
	 *
	 * @param DOMNode $node DOMNode.
	 */
	private function get_twitter_id( $node ) {
		_log( 'Start getTheId' );
		$src = $node->nodeValue;
		if ( ! preg_match( '/https:\/\/twitter\.com\/[0-9a-zA-Z]+\/status\/([^&]+)\?.*/i', $src, $match ) ) {
			return null;
		}

		$id = str_replace( array( "\r\n", "\r", "\n" ), '', $match[1] );
		_log( 'End getTwtterId' );
		return $id;
	}
}
