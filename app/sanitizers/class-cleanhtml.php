<?php
/**
 * Output clean html
 *
 * @package Mumu theme
 */

/**
 * CleanHtml class
 */
class CleanHtml extends Sanitizer {

	/**
	 * Execute Clean html
	 */
	public function __invoke() {
		$html = preg_replace( '/<!--.*-->/i', '', $this->content );
		$html = preg_replace( '/<html .*?>/', '', $html );
		$html = preg_replace( '/<\/html>/', '', $html );
		$html = preg_replace( '/<!DOCTYPE html>/', '', $html );
		return $html;
	}
}
