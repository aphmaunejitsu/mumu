<?php
/**
 * Mumu widgets file
 *
 * @package Mumu Theme
 */

require_once MUMU_APP . '/widgets/init.php';
require_once MUMU_APP . '/widgets/class-recentrypostswidget.php';
require_once MUMU_APP . '/widgets/class-relatepostswidget.php';


add_action(
	'widgets_init',
	function() {
		register_widget( RelatePostsWidget::class );
		register_widget( RecentryPostsWidget::class );
	}
);
