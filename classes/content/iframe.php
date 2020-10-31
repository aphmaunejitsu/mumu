<?php
include_once dirname(__FILE__) . '/iframe/youtube.php';
include_once dirname(__FILE__) . '/iframe/googlemaps.php';
include_once dirname(__FILE__) . '/iframe/other.php';

class Content_IFrame
{
    protected $dom;
    public function __construct($dom)
    {
        $this->dom = $dom;
    }

    public function sanitize()
    {
        $nodes = $this->dom->getElementsByTagName('iframe');
        $node_length = $nodes->length;
        if ($node_length === 0) {
            return $this->dom;
        }

        for ($i = $node_length - 1; $i >= 0; $i--) {
            $node = $nodes->item($i);
            if (! $node instanceof DOMElement) {
                continue;
            }

            if (! $node->hasAttribute('src') || ! trim($node->getAttribute('src'))) {
                $node->parentNode->removeChild($node);
                continue;
            }

            $src = $node->getAttribute('src');
            $sanitizer = null;
            // Google Maps
            if (preg_match('/^https:\/\/www\.google\.(com|co\.jp)\/maps/', $src)) {
                $sanitizer = 'Content_Iframe_GoogleMaps';
            }

            // Youtube
            // https://youtu.be/qcuPeHT7gAk
            if (preg_match('/^https:\/\/www\.youtube\.com/', $src) || preg_match('/^https:\/\/youtu\.be/', $src)) {
                $sanitizer = 'Content_Iframe_Youtube';
            }


            if ($sanitizer) {
                $class = new $sanitizer($this->dom, $node);
                $class->sanitize();
            }
        }

        return $this->dom;
    }
}
