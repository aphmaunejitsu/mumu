<?php

class Iframe
{
    public $content;
    public function __construct($content)
    {
        $this->content = $content;
    }

    public function __invoke()
    {
        $nodes = $this->content->getElementsByTagName('iframe');
        if ($nodes->count() < 1) {
            return $this->content;
        }

        foreach ($nodes as $node) {
            if (! $node->hasAttribute('src')) {
                $node->parentNode->removeChild($node);
                continue;
            }

            $src = $node->getAttribute('src');

            // Google Maps
            $isGoogleMaps = false;
            if (preg_match('/^https:\/\/www\.google\.(com|co\.jp)\/maps/', $src)) {
                $isGoogleMaps = true;
            }

            $iframe = $this->content->createElement('amp-iframe');
            $iframe->setAttribute('src', $node->getAttribute('src'));
            $iframe->setAttribute('frameborder', 0);
            $iframe->setAttribute('layout', 'responsive');
            $iframe->setAttribute('width', 600);
            $iframe->setAttribute('height', 450);

            if ($isGoogleMaps) {
                $iframe->setAttribute('sandbox', 'allow-scripts allow-same-origin allow-popups');
            }

            $node->parentNode->insertBefore($iframe, $node);
            $node->parentNode->removeChild($node);
        }

        return $this->content;
    }
}
