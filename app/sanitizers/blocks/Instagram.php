<?php

class Instagram
{
    const BLOCK = 'amp-instagram';
    public $content;
    public $nodes;

    public function __construct($content, $nodes)
    {
        $this->content = $content;
        $this->nodes = $nodes;
    }

    public function __invoke()
    {
        _log('Start Instagram::__invoke');

        try {
            foreach ($this->nodes as $node) {
                _log($node);
                if (($id = $this->getInstagramId($node)) === null) {
                    _log('nullpo');
                    continue;
                }

                $block = $this->content->createElement(self::BLOCK);
                $block->setAttribute('data-shortcode', $id);
                $block->setAttribute('width', 320);
                $block->setAttribute('height', 320);
                $block->setAttribute('layout', 'responsive');

                $node->replaceChild($block, $node->firstChild);
            }

            return $this->content;
        } catch (\Exception $e) {
            return $this->content;
        }

        _log('End Instagram::__invoke');
    }

    private function getInstagramId($node)
    {
        _log('Start getInstagramId');
        $src = $node->nodeValue;
        // https://www.instagram.com/p/xxxxxxxxx
		if (! preg_match( '/https:\/\/www\.instagram\.com\/p\/([^&]+)/i', $src, $match)) {
            _log('nullpo instagram');
            return null;
		}

		$id = str_replace(["\r\n", "\r", "\n"], '', $match[1]);
        _log('End getInstagramId');
        return $id;
    }
}
