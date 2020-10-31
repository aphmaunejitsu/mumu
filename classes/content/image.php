<?php

class Content_Image {

	protected $dom;
	protected $should_not_parent_tags = array( 'a', 'div' );
	protected $should_not_next_tags   = array( 'p' );
	public function __construct( $dom ) {
		$this->dom = $dom;
	}
	public function sanitize() {
		$nodes       = $this->dom->getElementsByTagName( 'img' );
		$node_length = $nodes->length;
		if ( $node_length === 0 ) {
			return $this->dom;
		}

		for ( $i = $node_length - 1; $i >= 0; $i-- ) {
			$node = $nodes->item( $i );
			if ( ! $node instanceof DOMElement ) {
				continue;
			}

			if ( ! $node->hasAttribute( 'src' ) || ! trim( $node->getAttribute( 'src' ) ) ) {
				$node->parentNode->removeChild( $node );
				continue;
			}

			$src    = $node->getAttribute( 'src' );
			$width  = $node->getAttribute( 'width' );
			$height = $node->getAttribute( 'height' );

			if ( empty( trim( $width ) ) || empty( trim( $height ) ) ) {
				if ( ( $attachment = $this->get_image_id( $node ) ) ) {
					list($src, $width, $height, $f) = wp_get_attachment_image_src( $attachment, 'large' );
				} else {
					$width  = 480;
					$height = 600;
				}
			}

			$amp_img = $this->dom->createElement( 'amp-img' );
			$amp_img->setAttribute( 'src', $src );
			$amp_img->setAttribute( 'width', $width );
			$amp_img->setAttribute( 'height', $height );
			$amp_img->setAttribute( 'layout', 'responsive' );

			$this->adjust_tag( $amp_img, $node );
		}

		return $this->dom;
	}

	public function adjust_tag( $amp_img, $node ) {
		if ( ! $node instanceof DOMElement ) {
			return;
		}

		if ( $node->parentNode === null ) {
			return;
		}

		$figure = $this->dom->createElement( 'figure' );
		$figure->appendChild( $amp_img );
		if ( strtolower( $node->parentNode->nodeName ) === 'a' ) {
			if ( ( $cap = $this->get_caption( $node->parentNode ) ) ) {
				$figcaption = $this->dom->createElement( 'figcaption', $cap );
				$figure->appendChild( $figcaption );
			}

			if ( $this->adjust_parent_tag_a( $node, $figure ) ) {
				return;
			}
		} elseif ( strtolower( $node->parentNode->nodeName ) === 'figure' ) {
			if ( ( $cap = $this->get_caption( $node ) ) ) {
				$figcaption = $this->dom->createElement( 'figcaption', $cap );
				$figure->appendChild( $figcaption );
			}

			$this->adjust_parent_tag_figure( $node, $figure );
			return;
		} elseif ( strtolower( $node->parentNode->nodeName ) === 'div' ) {
		}

		$div = $this->dom->createElement( 'div' );
		$div->setAttribute( 'class', 'wp-block-image sgn-image-block' );
		$div->appendChild( $figure );

		if ( strtolower( $node->parentNode->nodeName ) === 'div' ) {
			$pNode = $node->parentNode;
			$pNode->setAttribute( 'class', 'wp-block-image sgn-image-block' );
			$pNode->removeAttribute( 'style' );
			$pNode->replaceChild( $figure, $node );
		} else {
			$node->parentNode->replaceChild( $div, $node );
		}
	}

	public function adjust_parent_tag_div( $node, $replace_node ) {
	}

	public function adjust_parent_tag_figure( $node, $replace_node ) {
		if ( strtolower( $node->parentNode->nodeName ) !== 'figure' ) {
			return false;
		}

		$pNode = $node->parentNode;

		$ppNode = $pNode->parentNode;
		if ( strtolower( $ppNode->nodeName ) === 'div' ) {
			$ppNode->setAttribute( 'class', 'wp-block-image sgn-image-block' );
			$ppNode->replaceChild( $replace_node, $pNode );
		} else {
			$div = $this->dom->createElement( 'div' );
			$div->setAttribute( 'class', 'wp-block-image sgn-image-block' );
			$div->appendChild( $replace_node );
			$ppNode->replaceChild( $div, $pNode );
		}

		return true;
	}

	public function adjust_parent_tag_a( $node, $replace_node ) {
		if ( strtolower( $node->parentNode->nodeName ) !== 'a' ) {
			return false;
		}

		// a
		$pNode = $node->parentNode;
		// maybe figure
		$ppNode     = $pNode->parentNode;
		$ppNodeName = strtolower( $ppNode->nodeName );
		if ( $ppNodeName === 'figure' ) {
			// さらに上を確認してみる
			if ( strtolower( $ppNode->parentNode->nodeName ) === 'div' ) {
				$pppNode = $ppNode->parentNode;
				$pppNode->setAttribute( 'class', 'wp-block-image sgn-image-block' );
				$ppNode->parentNode->replaceChild( $replace_node, $ppNode );
			} else {
				$div = $this->dom->createElement( 'div' );
				$div->setAttribute( 'class', 'wp-block-image sgn-image-block' );
				$div->appendChild( $replace_node );
				$ppNode->parentNode->replaceChild( $replace_node, $ppNode );
			}
		} elseif ( $ppNodeName === 'div' ) {
			$ppNode->setAttribute( 'class', 'wp-block-image sgn-image-block' );
			$ppNode->replaceChild( $replace_node, $pNode );
		} else {
			$node->parentNode->replaceChild( $replace_node, $node );
		}

		return true;
	}

	public function get_caption( $node ) {
		if ( ( $nNode = $node->nextSibling ) !== null ) {
			if ( strtolower( $nNode->nodeName ) === 'figcaption' ) {
				return esc_attr( $nNode->nodeValue );
			}
		}

		return null;
	}

	public function get_image_id( $image ) {
		if ( ( $class = $image->getAttribute( 'class' ) ) ) {
			if ( preg_match( '/(.*)wp-image-([0-9]{1,})(.*)$/', $class, $matches ) ) {
				return (int) $matches[2];
			}
		}

		global $wpdb;
		$sql = "SELECT ID FROM {$wpdb->posts} WHERE post_name = %s";
		preg_match( '/([^\/]+?)(-e\d+)?(-\d+x\d+)?(\.\w+)?$/', $image->getAttribute( 'src' ), $matches );
		$post_name = $matches[1];
		return (int) $wpdb->get_var( $wpdb->prepare( $sql, $post_name ) );
	}
}
