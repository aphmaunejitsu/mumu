<?php
/**
 * Mumu Supports defines
 *
 * @package Mumu Theme
 */

add_theme_support(
	'custom-logo',
	array(
		'height'      => 32,
		'width'       => 32,
		'flex-height' => true,
	)
);
add_theme_support( 'title-tag' );

if ( ! function_exists( '_log' ) ) {
	/**
	 * ログ出力
	 *
	 * @param string $message output message.
	 */
	function _log( $message ) {
		if ( WP_DEBUG === true ) {
			if ( is_array( $message ) || is_object( $message ) ) {
				error_log( print_r( $message, true ) );
			} else {
				error_log( $message );
			}
		}
	}
}
