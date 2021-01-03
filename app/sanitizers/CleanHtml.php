<?php

class CleanHtml {

	public $content;

	public function __construct( $content ) {
		$this->content = $content;
	}

	public function __invoke() {
		$html = preg_replace( '/<!--.*-->/i', '', $this->content );
		$html = preg_replace( '/<html .*?>/', '', $html );
		$html = preg_replace( '/<\/html>/', '', $html );
		$html = preg_replace( '/<!DOCTYPE html>/', '', $html );
		return $html;
	}
}
