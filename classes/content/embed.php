<?php
require_once dirname( __FILE__ ) . '/embed/youtube.php';
require_once dirname( __FILE__ ) . '/embed/url.php';
require_once dirname( __FILE__ ) . '/embed/twitter.php';
class Content_Embed {

	protected $dom;
	public function __construct( $dom ) {
		$this->dom = $dom;
	}

	public function sanitize() {
		// embed
		$nodes       = $this->dom->getElementsByTagName( 'figure' );
		$node_length = $nodes->length;

		if ( $node_length === 0 ) {
			return $this->dom;
		}

		for ( $i = $node_length - 1; $i >= 0; $i-- ) {
			$node = $nodes->item( $i );
			if ( ! $node instanceof DOMElement ) {
				continue;
			}

			if ( ! ( $class = $node->getAttribute( 'class' ) ) ) {
				continue;
			}

			$classes = explode( ' ', $class );

			$class_name = null;
			// Youtube
			if ( in_array( 'wp-block-embed-youtube', $classes, true ) ) {
				$class_name = 'Content_Embed_Youtube';
			}

			if ( in_array( 'wp-block-embed-twitter', $classes, true ) ) {
				$class_name = 'Content_Embed_Twitter';
			}

			if ( in_array( 'wp-block-embed-wordpress', $classes, true ) ) {
				$class_name = 'Content_Embed_Url';
			}

			if ( $class_name ) {
				$embed = new $class_name( $this->dom, $node );
				$embed->sanitize();
			}
		}

		return $this->dom;
	}


}

