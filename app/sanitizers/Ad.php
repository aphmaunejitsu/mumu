<?php

class Ad
{
    public $contents;
    public function __construct($contents)
    {
        $this->contents = $contents;
    }

    public function __invoke()
    {
        try {
            $matches = null;

            if (! (get_option('sgn_theme_ad_inner_single'))) {
                return $this->contents;
            }

            if (! ($adsens = get_option('sgn_theme_ad_single'))) {
                return $this->contents;
            }

			$nodes = $this->contents->getElementsByTagName('p');
            if ($nodes->length < 1) {
                return $this->contents;
            }

            $html = '<div class="mumu-block-adsense flex justify-center">';
            $html .= $adsens;
            $html .= '</div>';

            $ad = $this->contents->createDocumentFragment();
            $ad->appendXML($html);

            $nodes->item(0)->insertBefore($ad);

            return $this->contents;
        } catch (\Exception $e) {
            _log($e);
            return $this->contents;
        }

    }
}
