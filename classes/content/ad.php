<?php

class Content_Ad {

	protected $dom;
	protected $should_not_parent_tags = array( 'a', 'div' );
	protected $should_not_next_tags   = array( 'p' );
	public function __construct( $dom ) {
		$this->dom = $dom;
	}

	public function sanitize() {
		try {
			$nodes       = $this->dom->getElementsByTagName( 'p' );
			$node_length = $nodes->length;
			if ( $node_length < 1 ) {
				return $this->dom;
			}

			if ( ! ( $html = get_option( 'sgn_theme_ad_inner_single' ) ) ) {
				return $this->dom;
			}

			if ( ! ( $html = get_option( 'sgn_theme_ad_single' ) ) ) {
				return $this->dom;
			}

			ob_start();
			require get_template_directory() . '/classes/template/googleads.php';
			$html = ob_get_contents();
			ob_end_clean();

			$template = $this->dom->createDocumentFragment();
			$template->appendXML( $html );

			$nodes->item( 0 )->insertBefore( $template );

			return $this->dom;
		} catch ( \Exception $e ) {
			return $this->dom;
		}
	}
}
