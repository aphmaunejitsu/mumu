<?php
/**
 * Search form template file
 *
 * @package Mumu theme
 */

?>
<amp-lightbox id="mumu-search-lightbox" layout="nodisplay">
	<div class="mumu-search-lightbox p1 flex ml-auto mx-auto top-0 right-0 left-0 bottom-0 absolute items-center">
		<form class="search-form" method="GET" action="<?php esc_attr( bloginfo( 'url' ) ); ?>" target="_top">
			<input type="search" placeholder="<?php echo esc_html__( '記事を検索する' ); ?>" name="s">
		</form>
		<div class="close absolute m2" on="tap:mumu-search-lightbox.close" role="button" tabindex="3">× </div>
	</div>
</amp-lightbox>
