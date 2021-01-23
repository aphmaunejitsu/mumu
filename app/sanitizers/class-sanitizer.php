<?php
/**
 * Sanitizer Base
 *
 * @package Mumu Theme
 */

/**
 * Sanitizer Base Class
 */
class Sanitizer {
	/**
	 * XML object.
	 *
	 * @var DOMDocument $content
	 */
	public $content;

	/**
	 * Constructor.
	 *
	 * @param DOMDocument $content dom document.
	 */
	public function __construct( $content ) {
		$this->content = $content;
	}
}
