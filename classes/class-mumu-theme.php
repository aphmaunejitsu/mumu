<?php
class Mumu_Theme {

	private static $instance = null;

	private static $page_count      = 'page_count';
	private static $page_count_hour = '_hour_page_count';

	public function get_site_icon() {
		$url = null;
		$id  = get_theme_mod( 'custom_logo' );
		if ( $id ) {
			if ( ( $img = wp_get_attachment_image_src( $id ) ) ) {
				$url = $img[0];
			} else {
				if ( ! ( $url = get_site_icon_url( 150 ) ) ) {
					return;
				}
			}
		} else {
			if ( ! ( $url = get_site_icon_url( 150 ) ) ) {
				return;
			}
		}

		return $url;
	}

	public function pagination() {
		global $wp_query;
		$bignum = 999999999;
		if ( $wp_query->max_num_pages <= 1 ) {
			return;
		}

		$pagination = paginate_links(
			array(
				'base'      => str_replace( $bignum, '%#%', esc_url( get_pagenum_link( $bignum ) ) ),
				'format'    => '',
				'current'   => max( 1, get_query_var( 'paged' ) ),
				'total'     => $wp_query->max_num_pages,
				'prev_text' => '<i class="fas fa-angle-left"></i>',
				'next_text' => '<i class="fas fa-angle-right"></i>',
				'type'      => 'array',
				'end_size'  => 1,
				'mid_size'  => 2,
			)
		);

		$html = null;
		foreach ( $pagination as $page ) {
			$html .= $page;
		}

		if ( $html ) {
			ob_start();
			require dirname( __FILE__ ) . '/template/pagination.php';
			$paginate = ob_get_contents();
			ob_end_clean();

			return $paginate;
		} else {
			return null;
		}
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

	public static function get_object() {
		if ( null === self::$instance ) {
			self::$instance = new static();
		}
		return self::$instance;
	}


}
