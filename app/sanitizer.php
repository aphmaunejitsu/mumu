<?php

use Masterminds\HTML5;

require_once MUMU_APP . '/sanitizers/Ad.php';
require_once MUMU_APP . '/sanitizers/Block.php';
require_once MUMU_APP . '/sanitizers/CleanHtml.php';
require_once MUMU_APP . '/sanitizers/Iframe.php';
require_once MUMU_APP . '/sanitizers/Image.php';

function ampContent() {
    try {
        if ( ! ( in_the_loop() && is_main_query() ) ) {
            return $content;
        }

        if (! is_single() ) {
            return $content;
        }

        $content = get_the_content();

        $body = mb_convert_encoding($content, 'HTML-ENTITIES', 'auto');

        $html5 = new HTML5();
        $dom = @$html5->loadHTML($body);

        $sanitizers = getSanitizers();
        foreach ($sanitizers as $sanitizer) {
            $dom = (new $sanitizer($dom))();
        }

        $html = $dom->saveHTML($dom);

        $html = (new CleanHtml($html))();

        return $html;
    } catch (\Exception $e) {
        _log($e);
        return $content;
    }
}

add_filter('the_content', 'ampContent', 999999999);

function getSanitizers()
{
    return [
        'Ad',
        'Block',
        'Iframe',
        'Image',
    ];
}
