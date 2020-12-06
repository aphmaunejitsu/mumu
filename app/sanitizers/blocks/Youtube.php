<?php

class Youtube
{
    const YOUTUBE = 'amp-youtube';
    public $content;
    public $nodes;

    public function __construct($content, $nodes)
    {
        $this->content = $content;
        $this->nodes = $nodes;
    }

    public function __invoke()
    {
        _log('Start Youtube::__invoke');

        try {
            foreach ($this->nodes as $node) {
                _log($node);
                if (($id = $this->getYoutubeId($node)) === null) {
                    _log('nullpo');
                    continue;
                }

                $youtube = $this->content->createElement(self::YOUTUBE);
                $youtube->setAttribute('data-videoid', $id);
                $youtube->setAttribute('width', 640);
                $youtube->setAttribute('height', 360);
                $youtube->setAttribute('layout', 'responsive');

                $node->replaceChild($youtube, $node->firstChild);
            }

            return $this->content;
        } catch (\Exception $e) {
            return $this->content;
        }

        _log('End Youtube::__invoke');
    }

    private function getYoutubeId($node)
    {
        _log('Start getYoutubeId');
        $src = $node->nodeValue; //$this->content->saveHTML($node);
		if ( ! preg_match( '/https:\/\/www\.youtube\.com/', $src ) ) {
			if ( ! preg_match( '/https:\/\/youtu.be/', $src ) ) {
				return null;
			}
		}

		if ( ! preg_match( '/.*\/embed\/([^&]+)\?.*/', $src, $match ) ) {
			if ( ! preg_match( '/\?v=([^&]+)/', $src, $match ) ) {
				if ( ! preg_match( '/https:\/\/youtu.be\/([^&]+)/', $src, $match ) ) {
					return null;
				}
			}
		}

		$id = str_replace(["\r\n", "\r", "\n"], '', $match[1]);
        _log('End getYoutubeId');
        return $id;
    }
}
