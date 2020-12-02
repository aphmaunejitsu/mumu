<amp-lightbox id="sgn-search-lightbox" layout="nodisplay">
    <div class="sgn-search-lightbox p1 flex ml-auto mx-auto top-0 right-0 left-0 bottom-0 absolute items-center">
        <form class="search-form" method="GET" action="<?php esc_attr( bloginfo( 'url' ) ); ?>" target="_top">
            <input type="search" placeholder="<?php echo _( '記事を検索する' ); ?>" name="s">
        </form>
        <div class="close absolute m2" on="tap:sgn-search-lightbox.close" role="button" tabindex="3">× </div>
    </div>
</amp-lightbox>
