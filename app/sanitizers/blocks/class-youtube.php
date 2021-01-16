<?php
/**
 * Youtube block class
 *
 * @package Mumu Theme
 */

/**
 * Youtube Class
 */
class Youtube extends BlockBase {

	const YOUTUBE = 'amp-youtube';

	/**
	 * __invoke
	 */
	public function __invoke() {
		_log( 'Start Youtube::__invoke' );

		try {
			for ( $i = $this->nodes->count() - 1; $i >= 0; $i-- ) {
				$node = $this->nodes->item( $i );
				$id   = $this->get_youtube_id( $node );
				if ( null === $id ) {
					_log( 'nullpo' );
					continue;
				}

				$youtube = $this->content->createElement( self::YOUTUBE );
				$youtube->setAttribute( 'data-videoid', $id );
				$youtube->setAttribute( 'width', 640 );
				$youtube->setAttribute( 'height', 360 );
				$youtube->setAttribute( 'layout', 'responsive' );

				$node->replaceChild( $youtube, $node->firstChild );
			}

			return $this->content;
		} catch ( \Exception $e ) {
			return $this->content;
		}

		_log( 'End Youtube::__invoke' );
	}

	/**
	 * Get Youtube Id
	 *
	 * @param DOMNode $node DOMNode.
	 */
	private function get_youtube_id( $node ) {
		_log( 'Start getYoutubeId' );
		$src = $node->nodeValue; // $this->content->saveHTML($node);
		if ( ! preg_match( '/https:\/\/www\.youtube\.com/', $src ) ) {
			if ( ! preg_match( '/https:\/\/youtu.be/', $src ) ) {
				return null;
			}
		}

		if ( ! preg_match( '/.*\/embed\/([^&]+)\?.*/', $src, $match ) ) {
			if ( ! preg_match( '/\?v=([^&]+)/', $src, $match ) ) {
				if ( ! preg_match( '/https:\/\/youtu.be\/([^&]+)/', $src, $match ) ) {
					return null;
				}
			}
		}

		$id = str_replace( array( "\r\n", "\r", "\n" ), '', $match[1] );
		_log( 'End getYoutubeId' );
		return $id;
	}
}
