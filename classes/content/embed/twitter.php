<?php

require_once dirname( __FILE__ ) . '/interface.php';

class Content_Embed_Twitter implements Content_Embed_Interface {

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

		$src = $this->node->nodeValue;
		if ( ! preg_match( '/https:\/\/twitter\.com/', $src ) ) {
			return $this->node;
		}

		if ( ! preg_match( '#(?:https?://)?(?:mobile.)?(?:www.)?(?:twitter.com/)?(?:\#!/)?(?:\w+)/status(?:es)?/(\d+)#i', $src, $match ) ) {
				return $this->node;
		}

		$id      = $match[1];
		$youtube = $this->dom->createElement( 'amp-twitter' );
		$youtube->setAttribute( 'data-tweetid', $id );
		$youtube->setAttribute( 'width', 640 );
		$youtube->setAttribute( 'height', 360 );
		$youtube->setAttribute( 'layout', 'responsive' );

		$div = $this->dom->createElement( 'div' );
		$div->setAttribute( 'class', 'sgn-twitter-block' );

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
