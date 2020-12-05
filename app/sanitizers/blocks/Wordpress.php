<?php

class Wordpress
{
	protected $content;
	protected $nodes;
    public function __construct($content, $nodes)
    {
		$this->content = $content;
		$this->nodes = $nodes;
	}

    public function __invoke()
    {
        try {
            foreach ($this->nodes as $node) {
                if (($src = $this->getWordpressSrc($node)) === null) {
                    _log('nullpo');
                    continue;
                }


                if (! ($postid = url_to_postid($src))) {
                    return $this->content;
                }

                if (! ($post = get_post($postid))) {
                    return $this->content;
                }

                $permalink = get_permalink($postid);
                $html = '<div class="container mumu-wordpress-card flex flex-column">';
                $html .= '<header><h4 class="m1">' . esc_attr($post->post_title) . '</h4></header>';
                if (has_post_thumbnail($postid)) {
                    $thum_id = get_post_thumbnail_id($postid);
                    $image   = wp_get_attachment_image_src($thum_id, 'mumu-thumbnail-s-16x9');

                    $html   .= '<div class="card-thumbnail">';
                    $html   .= '<a href="' . $permalink . '">';
                    $html   .= '<amp-img src="' . $image[0] . '" width="' . $image[1] . '" height="' . $image[2] . '" layout="responsive" alt="' . esc_attr($post->post_title) . '">';
                    $html   .= '</amp-img>';
                    $html   .= '</a></div>';
                }

                $html .= '<div class="content">';
                $html .= '<div class="body">' . mumu_excerpt($post->post_content) . '</div>';
                $html .= '</div>';

                $html .= '</div>';

                $wp = $this->content->createDocumentFragment();
                $wp->appendXML($html);

                $node->replaceChild($wp, $node->firstChild);
            }

            return $this->content;
        } catch (\Exception $e) {
            return $this->content;
        }
    }

    public function getWordpressSrc($node)
    {
        $source = $this->content->saveHTML($node);
		$source = str_replace(["\r\n", "\r", "\n"], '', $source);
        if (! preg_match('/https?:\/{2}[\w\/:%#\$&\?\(\)~\.=\+\-]+/', $source, $match)) {
            return null;
        }

        _log($match);
        return $match[0];
    }
}
