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
        _log('Start Twitter::__invoke');

        try {
            foreach ($this->nodes as $node) {
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

            return $this->content;
        } catch (\Exception $e) {
            return $this->content;
        }

        _log('End Youtube::__invoke');
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
