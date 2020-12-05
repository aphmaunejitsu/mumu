<?php

require_once MUMU_APP . '/sanitizers/blocks/Youtube.php';
require_once MUMU_APP . '/sanitizers/blocks/Twitter.php';

class Block
{
    public $content;
    public $blocks = [
        'wp-block-embed-youtube'   => 'Youtube',
        // 'wp-block-embed-wordpress' => 'Wordpress',
        'wp-block-embed-twitter'   => 'Twitter',
    ];

    public function __construct($content)
    {
        $this->content = $content;
    }

    public function __invoke()
    {
        try {
            $xpath = new DOMXpath($this->content);

            foreach ($this->blocks as $path => $block) {
                $xp = '//*[contains(@class, "' . $path . '")]';
                $nodes = $xpath->query($xp);
                (new $block($this->content, $nodes))();
            }

            return $this->content;
        } catch (\Exception $e) {
            _log($e);
            return $this->content;
        }
    }
}