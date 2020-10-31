<?php

require_once dirname( __FILE__ ) . '/interface.php';

class Content_Embed_Url implements Content_Embed_Interface {

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
		$src = str_replace( array( "\r\n", "\r", "\n" ), '', $src );

		if ( ! ( $postid = url_to_postid( $src ) ) ) {
			return $this->node;
		}

		if ( ! ( $post = get_post( $postid ) ) ) {
			return $this->node;
		}

		$embed = $this->dom->createElement( 'blockquote' );
		$embed->setAttribute( 'cite', $src );
		$p = $this->dom->createElement( 'span' );
		$p->appendChild(
			$this->dom->createTextNode(
				mb_substr(
					trim(
						str_replace(
							array( "\r\n", "\r", "\n" ),
							'',
							strip_tags( $post->post_content )
						)
					),
					0,
					150
				) . '...'
			)
		);
		$embed->appendChild( $p );

		$a = $this->dom->createElement( 'a' );
		$a->setAttribute( 'href', $src );
		$a->appendChild(
			$this->dom->createTextNode(
				$post->post_title
			)
		);
		$embed->appendChild( $a );

		// $embed = $this->dom->createElement( 'div' );
		// $embed->setAttribute( 'class', 'sgn-embed-block' );
		// $figure     = $this->dom->createElement( 'figure' );

		// $figCaption = $this->dom->createElement( 'figcaption' );
		// $title      = $this->dom->createTextNode( esc_html( $post->post_title ) );

		// $figCaption->appendChild( $title );

		// $figure->appendChild( $figCaption );
		// $embed->appendChild( $figure );

		$this->node->parentNode->replaceChild( $embed, $this->node );

		return $this->node;
	}
}
