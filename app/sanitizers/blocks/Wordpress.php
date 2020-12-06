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
            for ($i = $this->nodes->count() - 1; $i >= 0; $i--) {
                $node = $this->nodes->item($i);
                if (($src = $this->getWordpressSrc($node)) === null) {
                    _log('nullpo wordpress');
                    continue;
                }

                if (! ($postid = url_to_postid($src))) {
                    return $this->content;
                }

                if (! ($post = get_post($postid))) {
                    return $this->content;
                }

                $permalink = get_permalink($postid);
                $html  = '<div class="container mumu-wordpress-card">';
                if (has_post_thumbnail($postid)) {
                    $thum_id = get_post_thumbnail_id($postid);
                    $image   = wp_get_attachment_image_src($thum_id, 'thumbnail');

                    $html .= '<div class="card-thumbnail flex justify-center">';
                    $html .= '<a href="' . $permalink . '">';
                    $html .= '<amp-img src="' . $image[0] . '" width="' . $image[1] . '" height="' . $image[2] . '" layout="fixed" alt="' . esc_html($post->post_title) . '">';
                    $html .= '</amp-img>';
                    $html .= '</a>';
                    $html .= '</div>';
                }

                $html .= '<div class="content">';
                $html .= '<div class="title">' . esc_html($post->post_title) . '</div>';
                $html .= '<div class="excerpt">' . esc_html(mumu_excerpt($post->post_content), 70) . '</div>';
                $html .= '<div class="read-more flex justify-end"><a href="' . $permalink . '">Read More</a></div>';
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
        $source = $node->nodeValue; //$this->content->saveHTML($node);
		$source = str_replace(["\r\n", "\r", "\n"], '', $source);
        if (! preg_match('/https?:\/{2}[\w\/:%#\$&\?\(\)~\.=\+\-]+/', $source, $match)) {
            return null;
        }

        return $match[0];
    }
}
