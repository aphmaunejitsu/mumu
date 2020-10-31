<?php
if ( is_404() ) {
	return;
}
if ( ! get_option( 'sgn_theme_ad_show' ) ) {
    return;
}
if ( ! ($html = get_option( 'sgn_theme_ad_page' ) ) ) {
	return;
}
?>
<section class="sgn-ad mb1 p1">
    <div class="sgn-ad-container flex justify-center flex-wrap">
        <div class="sgn-ad-body">
            <?php echo $html; ?>
        </div>
    </div>
</section>



