<?php
/**
 * Block Base class
 *
 * @package Mumu Theme
 */

/**
 * Base Class
 */
class BlockBase {
	/**
	 * DOM Object
	 *
	 * @var DOMDocument $content
	 */
	public $content;

	/**
	 * DOMNode object
	 *
	 * @var DOMNode $nodes
	 */
	public $nodes;

	/**
	 * __constructor
	 *
	 * @param DOMDocument $content DOMDocument.
	 * @param DOMNode     $nodes   DOMNode.
	 */
	public function __construct( $content, $nodes ) {
		$this->content = $content;
		$this->nodes   = $nodes;
	}
}
