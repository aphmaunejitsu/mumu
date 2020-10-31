<?php
class Mumu_Popular {

	private static $page_count      = 'page_count';
	private static $page_count_hour = '_hour_page_count';

	public function __construct() {
		 add_action( 'wp', array( $this, 'reset_post_views_activation' ) );
		add_action( 'reset_post_views', array( $this, 'reset_post_views' ) );
		add_filter( 'cron_schedules', array( $this, 'reset_post_views_interval' ) );

		add_action( 'wp_head', array( $this, 'set_page_views' ) );
	}

	public function set_page_views() {
		if ( ! is_single() or $this->is_bot() ) {
			return;
		}

		$id = get_the_ID();

		if ( ! $id ) {
			return;
		}

		$num       = (int) date_i18n( 'H' );
		$key       = self::$page_count;
		$count_key = self::$page_count_hour;

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

		//error_log(print_r($counts,1));

		update_post_meta( $id, $count_key, $counts );
		update_post_meta( $id, $key, $total_count + 1 );
	}

	public function reset_post_views() {
		$num       = (int) date_i18n( 'H' );
		$key       = self::$page_count;
		$reset_key = self::$page_count_hour;
		$args      = array(
			'posts_per_page' => -1,
			'post_type'      => 'post',
			'post_status'    => 'publish',
			'meta_key'       => $reset_key,
		);

		$reset_posts = get_posts( $args );
		if ( $reset_posts ) {
			foreach ( $reset_posts as $reset_post ) {
				$postID      = $reset_post->ID;
				$count_array = get_post_meta( $postID, $reset_key, true );
				if ( isset( $count_array[ $num ] ) ) { //カウント配列[n]が存在する
					$count_array[ $num ] = 0;
				}
				//アクセス数をリセットする
				update_post_meta( $postID, $reset_key, $count_array );
				update_post_meta( $postID, $key, array_sum( $count_array ) );
			}
		}
	}

	public function reset_post_views_activation() {
		if ( ! wp_next_scheduled( 'reset_post_views' ) ) {
			wp_schedule_event( time(), '1hours', 'reset_post_views' );
		}
	}

	public function reset_post_views_interval( $schedules ) {
		// 1時間ごとを追加
		$schedules['1hours'] = array(
			'interval' => 3600,
			'display'  => _( '1時間に1回' ),
		);
		return $schedules;
	}

	//ボットの判別
	public function is_bot() {
		$bot_list = array(
			'Googlebot',
			'Yahoo! Slurp',
			'Mediapartners-Google',
			'msnbot',
			'bingbot',
			'MJ12bot',
			'Ezooms',
			'pirst; MSIE 8.0;',
			'Google Web Preview',
			'ia_archiver',
			'Sogou web spider',
			'Googlebot-Mobile',
			'AhrefsBot',
			'YandexBot',
			'Purebot',
			'Baiduspider',
			'UnwindFetchor',
			'TweetmemeBot',
			'MetaURI',
			'PaperLiBot',
			'Showyoubot',
			'JS-Kit',
			'PostRank',
			'Crowsnest',
			'PycURL',
			'bitlybot',
			'Hatena',
			'facebookexternalhit',
			'NINJA bot',
			'YahooCacheSystem',
			'NHN Corp.',
			'Steeler',
			'DoCoMo',
		);
		$is_bot   = false;
		foreach ( $bot_list as $bot ) {
			if ( stripos( $_SERVER['HTTP_USER_AGENT'], $bot ) !== false ) {
				$is_bot = true;
				break;
			}
		}
		return $is_bot;
	}
}
