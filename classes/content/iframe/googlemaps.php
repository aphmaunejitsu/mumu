<?php
class Content_Iframe_GoogleMaps {
	protected $dom;
	protected $node;
	public function __construct($dom, $node) {
		$this->dom  = $dom;
		$this->node = $node;
	}

	public function sanitize()
	{
		if ( ! $this->node instanceof DOMElement ) {
			return $this->node;
		}

		// 再度チェック
		if ( ! preg_match('/^https:\/\/www\.google\.(com|co\.jp)\/maps/', $this->node->getAttribute('src')) ) {
			return $this->node;
		}

		$figure = $this->dom->createElement( 'figure' );
		$div = $this->dom->createElement( 'div' );
		$div->setAttribute( 'class', 'sgn-googlemaps-block' );
		$div->appendChild( $figure );

		$maps = $this->dom->createElement('amp-iframe');
		$maps->setAttribute( 'src', $this->node->getAttribute('src') );
		$maps->setAttribute( 'frameborder', 0 );
		$maps->setAttribute( 'sandbox', 'allow-scripts allow-same-origin allow-popups' );
		$maps->setAttribute( 'layout', 'responsive' );
		$maps->setAttribute( 'width', 600 );
		$maps->setAttribute( 'height', 450 );

		$figure->appendChild( $maps );

		if ( ($this->node->parentNode->nodeName) === 'figure' ) {
			$pNode = $this->node->parentNode;
			$pNode->parentNode->replaceChild($div, $pNode);
		} else {
			$this->node->parentNode->replaceChild($div, $this->node);
		}


		return $this->node;
	}
}
