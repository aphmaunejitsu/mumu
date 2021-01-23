<?php
/**
 * Popluar posts file.
 *
 * @package Mumu Theme
 */

const MUMU_PAGE_COUNT      = 'page_count';
const MUMU_PAGE_COUNT_HOUR = '_hour_page_count';

if ( ! function_exists( 'reset_post_views_activation' ) ) {
	/**
	 * ポストのビュー数の有効化
	 */
	function reset_post_views_activation() {
		if ( ! wp_next_scheduled( 'mumu_reset_post_views' ) ) {
			wp_schedule_event( time(), '1hours', 'mumu_reset_post_views' );
		}
	}
}
add_action( 'wp', 'reset_post_views_activation' );

if ( ! function_exists( 'reset_post_views' ) ) {
	/**
	 * ポストのビュー数のリセット
	 */
	function reset_post_views() {
		$num       = (int) date_i18n( 'H' );
		$key       = MUMU_PAGE_COUNT;
		$reset_key = MUMU_PAGE_COUNT_HOUR;
		$args      = array(
			'posts_per_page' => -1,
			'post_type'      => 'post',
			'post_status'    => 'publish',
			'meta_key'       => $reset_key,
		);

		$reset_posts = get_posts( $args );
		if ( $reset_posts ) {
			foreach ( $reset_posts as $reset_post ) {
				$post_id     = $reset_post->ID;
				$count_array = get_post_meta( $post_id, $reset_key, true );
				if ( isset( $count_array[ $num ] ) ) {
					$count_array[ $num ] = 0;
				}

				update_post_meta( $post_id, $reset_key, $count_array );
				update_post_meta( $post_id, $key, array_sum( $count_array ) );
			}
		}
	}
}
add_action( 'reset_post_views', 'reset_post_views' );

if ( ! function_exists( 'reset_post_views_interval' ) ) {
	/**
	 * ポストのビュー数の間隔をリセットする
	 */
	function reset_post_views_interval() {
		// 1時間ごとを追加
		$schedules['1hours'] = array(
			'interval' => 3600,
			'display'  => __( '1時間に1回' ),
		);
		return $schedules;
	}
}
add_filter( 'cron_schedules', 'reset_post_views_interval' );

if ( ! function_exists( 'set_page_views' ) ) {
	/**
	 * ビュー数をセットする
	 */
	function set_page_views() {
		if ( ! is_single() || mumu_is_bot() ) {
			return;
		}

		$id = get_the_ID();

		if ( ! $id ) {
			return;
		}

		$num       = (int) date_i18n( 'H' );
		$key       = MUMU_PAGE_COUNT;
		$count_key = MUMU_PAGE_COUNT_HOUR;

		$counts      = get_post_meta( $id, $count_key, true );
		$total_count = get_post_meta( $id, $key, true );

		if ( is_array( $counts ) ) {
			$counts[ $num ] = isset( $counts[ $num ] ) ? $counts[ $num ] + 1 : 1;
		} else {
			$counts         = array();
			$counts[ $num ] = 1;
		}

		if ( empty( $total_count ) ) {
			$total_count = 0;
		}

		update_post_meta( $id, $count_key, $counts );
		update_post_meta( $id, $key, $total_count + 1 );
	}
}
 add_action( 'wp_head', 'set_page_views' );
