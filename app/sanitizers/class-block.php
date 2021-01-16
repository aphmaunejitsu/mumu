<?php
/**
 * Output Block
 *
 * @package Mumu theme
 */

// block snitizers.
require_once MUMU_APP . '/sanitizers/blocks/class-block-base.php';
require_once MUMU_APP . '/sanitizers/blocks/class-youtube.php';
require_once MUMU_APP . '/sanitizers/blocks/class-twitter.php';
require_once MUMU_APP . '/sanitizers/blocks/class-wordpress.php';
require_once MUMU_APP . '/sanitizers/blocks/class-instagram.php';

/**
 * Block class
 */
class Block {

	/**
	 * XML object.
	 *
	 * @var DOMDocument $content
	 */
	public $content;

	/**
	 * Block classes name
	 *
	 * @var array $blocks
	 */
	public $blocks = array(
		'wp-block-embed-youtube'   => 'Youtube',
		'wp-block-embed-wordpress' => 'WordPress',
		'wp-block-embed'           => 'WordPress',
		'wp-block-embed-twitter'   => 'Twitter',
		'wp-block-embed-instagram' => 'Instagram',
	);

	/**
	 * Constructor.
	 *
	 * @param DOMDocument $content dom document.
	 */
	public function __construct( $content ) {
		$this->content = $content;
	}

	/**
	 * Excute sanitize for blocks
	 */
	public function __invoke() {
		try {
			$xpath = new DOMXpath( $this->content );

			foreach ( $this->blocks as $path => $block ) {
				$xp    = '//*[contains(@class, "' . $path . '")]';
				$nodes = $xpath->query( $xp );
				( new $block( $this->content, $nodes ) )();
			}

			return $this->content;
		} catch ( \Exception $e ) {
			_log( $e );
			return $this->content;
		}
	}
}
