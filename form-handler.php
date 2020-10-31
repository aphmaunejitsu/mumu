<?php
require_once dirname( dirname( dirname( dirname( __FILE__ ) ) ) ) . '/wp-load.php';
$source_origin = $_GET['__amp_source_origin'] ?? null;
$headers       = getallheaders();
$send_mail     = filter_var( get_option( 'sgn_theme_option_contact_us' ), FILTER_VALIDATE_EMAIL );

$allowed_source_origin = home_url();
$origin_h              = str_replace( '.', '-', $allowed_source_origin );
$allow_origins         = array(
	$allowed_source_origin,
	$origin_h . '.cdn.ampproject.org',
	$allowed_source_origin . '.amp.cloudflare.com',
	'https://cdn.ampproject.org',
);

if ( isset( $headers['amp-same-origin'] ) && $headers['amp-same-origin'] === 'true' ) {
	$origin = $source_origin;
} elseif ( isset( $headers['origin'] ) && ( array_search( $headers['origin'], $allow_origins ) !== false ) && ( $source_origin === $allowed_source_origin ) ) {
	$origin = $headers['origin'];
} else {
	header( 'HTTP/1.1 403 Forbidden' );
	echo json_encode( '403 Forbidden' );
	exit();
}

header( 'Content-Type: application/json; charset=utf-8' );
header( 'Access-Control-Allow-Origin: ' . $origin_h );
header( 'Access-Control-Allow-Credentials: true' );
header( 'amp-access-control-allow-source-origin: ' . $origin );
header( 'access-control-allow-methods: POST, GET, OPTIONS' );
header( 'access-control-expose-headers: AMP-Access-Control-Allow-Source-Origin' );

if ( empty( $send_mail ) ) {
		header( 'HTTP/1.1 403 Forbidden' );
		echo json_encode( array( 'output_message' => '403 Forbidden' ) );
		exit();
}

if ( isset( $_POST['my-form'] ) && $_POST['my-form'] ) {
	if ( ! check_admin_referer( 'my-nonce-key', 'my-form' ) ) {
		header( 'HTTP/1.1 403 Forbidden' );
		echo json_encode( array( 'output_message' => '403 Forbidden' ) );
		exit();
	}
}

$your_name    = filter_var( $_POST['your_name'], FILTER_SANITIZE_STRING );
$your_email   = filter_var( $_POST['your_email'], FILTER_SANITIZE_EMAIL );
$your_subject = filter_var( $_POST['your_subject'], FILTER_SANITIZE_STRING );
$your_message = filter_var( $_POST['your_message'], FILTER_SANITIZE_STRING );
if ( ! empty( $your_name ) && ! empty( $your_email ) ) {
		 // Output message
		 $output_message = 'Thanks, ' . $your_name . '. メッセージは送信されました';

		 $blogname = esc_attr( get_bloginfo( 'name' ) );
		 // Email to the website admin
		 $compiled_message  = 'Name: ' . $your_name . "\r\n";
		 $compiled_message .= 'Email: ' . $your_email . "\r\n";
		 $compiled_message .= 'Subject: ' . $your_subject . "\r\n";
		 $compiled_message .= 'Message: ' . "\r\n" . $your_message . "\r\n";
		 $compiled_message .= "\r\n" . 'このメッセージは、「' . $blogname . '」から送信されました';
		 wp_mail( $send_mail, $your_subject, $compiled_message );
} else {
		 // Front-end error message
	$output_message = 'Sorry, メッセージの送信に失敗しました';
}
$output = array( 'output_message' => $output_message );


echo json_encode( $output );
