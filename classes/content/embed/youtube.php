<?php

require_once dirname( __FILE__ ) . '/interface.php';

class Content_Embed_Youtube implements Content_Embed_Interface {

	protected $dom;
	protected $node;
	public function __construct( $dom, $node ) {
		$this->dom  = $dom;
		$this->node = $node;
	}

	public function sanitize() {
		if ( ! $this->node instanceof DOMElement ) {
			return $this->node;
		}

		$src      = $this->node->nodeValue;
		$is_short = false;
		if ( ! preg_match( '/https:\/\/www\.youtube\.com/', $src ) ) {
			//https://youtu.be/BTe6Oh-mxDQ
			if ( ! preg_match( '/https:\/\/youtu.be/', $src ) ) {
				return $this->node;
			}
		}

		if ( ! preg_match( '/.*\/embed\/([^&]+)\?.*/', $src, $match ) ) {
			if ( ! preg_match( '/\?v=([^&]+)/', $src, $match ) ) {
				if ( ! preg_match( '/https:\/\/youtu.be\/([^&]+)/', $src, $match ) ) {
					return $this->node;
				}
			}
		}

		$id      = str_replace( array( "\r\n", "\r", "\n" ), '', $match[1] );
		$youtube = $this->dom->createElement( 'amp-youtube' );
		$youtube->setAttribute( 'data-videoid', $id );
		$youtube->setAttribute( 'width', 640 );
		$youtube->setAttribute( 'height', 360 );
		$youtube->setAttribute( 'layout', 'responsive' );

		$div = $this->dom->createElement( 'div' );
		$div->setAttribute( 'class', 'sgn-youtube-block' );

		$figure = $this->dom->createElement( 'figure' );
		$div->appendChild( $figure );
		$figure->appendChild( $youtube );

		$figure = null;
		if ( strtolower( $this->node->parentNode->nodeName ) === 'figure' ) {
			$figureNode = $this->node->parentNode;
			$figureNode->parentNode->replaceChild( $div, $figureNode );
		} else {
			$this->node->parentNode->replaceChild( $div, $this->node );
		}

		return $this->node;
	}
}
