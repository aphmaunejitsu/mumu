<?php

class Twitter
{
    const BLOCK = 'amp-twitter';
    public $content;
    public $nodes;

    public function __construct($content, $nodes)
    {
        $this->content = $content;
        $this->nodes = $nodes;
    }

    public function __invoke()
    {
        _log('Start ' . __METHOD__);

        try {
            for ($i = $this->nodes->count() - 1; $i >= 0; $i--) {
                $node = $this->nodes->item($i);
                if (($id = $this->getTwitterId($node)) === null) {
                    _log('nullpo');
                    continue;
                }

                $twitter = $this->content->createElement(self::BLOCK);
                $twitter->setAttribute('data-tweetid', $id);
                $twitter->setAttribute('width', 320);
                $twitter->setAttribute('height', 320);
                $twitter->setAttribute('layout', 'responsive');

                $node->replaceChild($twitter, $node->firstChild);
            }

            _log('End ' . __METHOD__);
            return $this->content;
        } catch (\Exception $e) {
            _log($e);
            return $this->content;
        }

    }

    private function getTwitterId($node)
    {
        _log('Start getTheId');
        $src = $node->nodeValue;
		if ( ! preg_match( '/https:\/\/twitter\.com\/[0-9a-zA-Z]+\/status\/([^&]+)\?.*/i', $src, $match ) ) {
            return null;
		}

		$id = str_replace(["\r\n", "\r", "\n"], '', $match[1]);
        _log('End getTwtterId');
        return $id;
    }
}
