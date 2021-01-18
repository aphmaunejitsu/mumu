<?php
/**
 * Mumu functions
 *
 * @package mumu theme
 */

define( 'MUMU_DIR', dirname( __FILE__ ) );
define( 'MUMU_APP', MUMU_DIR . '/app' );
define( 'MUMU_VENDOR', MUMU_DIR . '/vendor' );
define( 'MUMU_HELPERS', MUMU_DIR . '/helpers' );

require_once MUMU_VENDOR . '/autoload.php';

require_once MUMU_APP . '/actions.php';
require_once MUMU_APP . '/filters.php';
require_once MUMU_APP . '/customizers.php';
require_once MUMU_APP . '/supports.php';
require_once MUMU_APP . '/sanitizer.php';
require_once MUMU_APP . '/widgets.php';
require_once MUMU_HELPERS . '/template-functions.php';
