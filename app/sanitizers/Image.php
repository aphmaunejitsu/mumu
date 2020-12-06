<?php

class Image
{
    public $content;
    public function __construct($content)
    {
        $this->content = $content;
    }

    public function __invoke()
    {
        _log('Start ' . __METHOD__);

        $nodes = $this->content->getElementsByTagName('img');
        if ($nodes->count() < 1) {
            return $this->content;
        }

        try {
            for ($i = $nodes->count() - 1; $i >= 0; $i--) {
                $node = $nodes->item($i);
                if (! $node->hasAttribute('src')) {
                    $node->parentNode->removeChild($node);
                    continue;
                }

                $src = $node->getAttribute('src');
                $width  = $node->getAttribute('width');
                $height = $node->getAttribute('height');

                if ( empty(trim($width)) || empty(trim($height))) {
                    if ( ($attachment = $this->get_image_id($node))) {
                        list($src, $width, $height, $f) = wp_get_attachment_image_src($attachment, 'large');
                    } else {
                        $width  = 480;
                        $height = 600;
                    }
                }

                $img = $this->content->createElement('amp-img');
                $img->setAttribute('src', $src);
                $img->setAttribute('width', $width);
                $img->setAttribute('height', $height);
                $img->setAttribute('layout', 'responsive');

                $node->parentNode->insertBefore($img, $node);
                $node->parentNode->removeChild($node);
            }

            return $this->content;
        } catch (\Exception $e) {
            _log($e);
            return $this->content;
        }
    }

	public function get_image_id( $image ) {
		if ( ($class = $image->getAttribute('class'))) {
			if (preg_match('/(.*)wp-image-([0-9]{1,})(.*)$/', $class, $matches ) ) {
				return (int)$matches[2];
			}
		}

		global $wpdb;
		$sql = "SELECT ID FROM {$wpdb->posts} WHERE post_name = %s";
		preg_match('/([^\/]+?)(-e\d+)?(-\d+x\d+)?(\.\w+)?$/', $image->getAttribute('src'), $matches );
		$post_name = $matches[1];
		return (int)$wpdb->get_var($wpdb->prepare($sql, $post_name));
	}
}
