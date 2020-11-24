<?php
/**
 *
Template Name: API SGN Newlist
 *
 */
require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/wp/wp-load.php';

$source_origin         = $_GET['__amp_source_origin'] ?? null;
$origin                = null;
$allowed_source_origin = home_url();
$origin_h              = str_replace( '.', '-', $allowed_source_origin );
$origin_h              = str_replace( 'hcm-nights', 'hcm--nights', $origin_h );

$allow_origins = array(
	$allowed_source_origin,
	$origin_h . '.cdn.ampproject.org',
	$allowed_source_origin . '.amp.cloudflare.com',
	'https://cdn.ampproject.org',
);

$headers = getallheaders();
if ( isset( $headers['amp-same-origin'] ) && $headers['amp-same-origin'] === 'true' ) {
	$origin = $source_origin;
} elseif ( isset( $headers['origin'] ) && ( array_search( $headers['origin'], $allow_origins ) !== false ) && ( $source_origin === $allowed_source_origin ) ) {
	$origin = $headers['origin'];
} else {
	if ( WP_DEBUG ) {
	} else {
		header( 'HTTP/1.1 403 Forbidden' );
		exit();
	}
}



$origin_h = $origin_h . '.cdn.ampproject.org';
$origin   = esc_attr( $_GET['__amp_source_origin'] );


$posts     = isset( $_GET['items'] ) ? esc_attr( $_GET['items'] ) : 5;
$thumbnail = isset( $_GET['thumbnail'] ) ? esc_attr( $_GET['thumbnail'] ) : 'sgn-list-thum';
$order_by  = isset( $_GET['orderby'] ) ? esc_attr( $_GET['orderby'] ) : 'post_date';
$category  = isset( $_GET['category'] ) ? esc_attr( $_GET['category'] ) : null;
$meta      = isset( $_GET['meta'] ) ? esc_attr( $_GET['meta'] ) : null;

$args = array(
	'posts_per_page' => $posts,
	'meta_key'       => $meta,
	'orderby'        => $order_by,
	'category'       => $category,
	'order'          => 'DESC',
);

$ps = get_posts( $args );

$json['items'] = array();

if ( $ps ) {
	foreach ( $ps as $p ) {
		$image = null;
		if ( $thumbnail === 'post-eye-thum' || $thumbnail === 'sgn-eyecatch-16-9' || $thumbnail === 'sgn-list-thum' ) {
			$image['src']    = get_template_directory_uri() . '/assets/images/no-image-752x423.jpg';
			$image['width']  = 752;
			$image['height'] = 423;
		} elseif ( $thumbnail === 'post-amp-thum' ) {
			$image['src']    = get_template_directory_uri() . '/assets/images/no-image-90x54.jpg';
			$image['width']  = 90;
			$image['height'] = 54;
		} elseif ( $thumbnail === 'thumbnail' ) {
			$image['src']    = get_template_directory_uri() . '/assets/images/no-image-150x150.jpg';
			$image['width']  = 150;
			$image['height'] = 150;
		}

		$category = null;
		if ( ( $terms = get_the_category( $p->ID ) ) ) {
			$category = $terms[0];
		}

		if ( has_post_thumbnail( $p->ID ) ) {
			$thum_id = get_post_thumbnail_id( $p->ID );
			$img     = wp_get_attachment_image_src( $thum_id, $thumbnail );

			$image['src']    = $img[0];
			$image['width']  = $img[1];
			$image['height'] = $img[2];
		}

		$date  = get_the_date( null, $p->ID );
		$mdate = get_the_modified_date( null, $p->ID );
		if ( $date > $mdate ) {
			$mdate = $date;
		}

		$json['items'][] = array(
			'title'    => $p->post_title,
			'url'      => get_permalink( $p->ID ),
			'image'    => $image,
			'date'     => $date,
			'mdate'    => $mdate,
			'human'    => human_time_diff( get_the_time( 'U', $p->ID ), current_time( 'timestamp' ) ) . '前',
			'content'  => mb_substr( trim( str_replace( array( "\r\n", "\r", "\n" ), '', strip_tags( esc_attr( $p->post_content ) ) ) ), 0, 400 ),
			'category' => $category->cat_name,
		);
	}
}

$http_origin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : '*';
header( 'Content-Type: application/json; charset=utf-8' );
header( 'Access-Control-Allow-Origin: ' . $http_origin);
header( 'Access-Control-Allow-Credentials: true' );
header( 'amp-access-control-allow-source-origin: ' . $origin );
header( 'access-control-allow-methods: POST, GET, OPTIONS' );
header( 'access-control-expose-headers: AMP-Access-Control-Allow-Source-Origin' );
echo wp_json_encode( $json );
