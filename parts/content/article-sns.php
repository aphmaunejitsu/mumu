<?php
/**
 * Template of SNS part
 *
 * @package Mumu Theme
 */

$mumu         = get_option( 'mumu' );
$is_line      = $mumu['theme_my_sns']['is_line'] ?? false;
$is_facebook  = $mumu['theme_my_sns']['is_facebook'] ?? false;
$fb_id        = $mumu['theme_my_sns']['fbappid'] ?? false;
$is_twitter   = $mumu['theme_my_sns']['is_twitter'] ?? false;
$is_pinterest = $mumu['theme_my_sns']['is_pinterest'] ?? false;
$is_tumblr    = $mumu['theme_my_sns']['is_tumblr'] ?? false;
$is_os        = $mumu['theme_my_sns']['is_os'] ?? false;
if ( $is_line ) : ?>
<amp-social-share type="line"></amp-social-share>
	<?php
endif;
if ( $is_facebook && $fb_id ) :
	?>
<amp-social-share type="facebook" data-param-app_id="<?php echo esc_attr( $fb_id ); ?>"></amp-social-share>
	<?php
endif;
if ( $is_twitter ) :
	?>
<amp-social-share type="twitter"></amp-social-share>
	<?php
endif;
if ( $is_pinterest ) :
	?>
<amp-social-share type="pinterest"></amp-social-share>
	<?php
endif;
if ( $is_tumblr ) :
	?>
<amp-social-share type="tumblr"></amp-social-share>
<?php endif; ?>
