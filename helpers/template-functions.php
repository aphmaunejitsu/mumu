<?php

if (! function_exists('featureImage')) {
    function featureImage() {
        $image[0] = esc_attr(get_template_directory_uri() . '/assets/images/no-image-752x423.jpg');
        $image[1] = 752;
        $image[2] = 423;

        $large[0]  = $image[0];
        $medium[0] = $image[0];
        $title = esc_attr(get_the_title());

        $category = null;
        if ( has_post_thumbnail( get_the_ID() ) ) {
            $thum_id = get_post_thumbnail_id( get_the_ID() );
            $image   = wp_get_attachment_image_src( $thum_id, 'sgn-list-thum' );
            $large   = wp_get_attachment_image_src( $thum_id, 'sgn-eyecatch-16-9' );
            $medium  = wp_get_attachment_image_src( $thum_id, 'post-eye-thum' );

            $image[0] = esc_attr($image[0]);
            $large[0] = esc_attr($large[0]);
            $medium[0] = esc_attr($medium[0]);
        }

        $html = <<<EOL
<div class='thumbnail mb1 overflow-hidden relative'>
    <amp-img alt="{$title}" src='{$image[0]}'
        layout="responsive" width='{$image[1]}' height='{$image[2]}'
        srcset='{$image[0]} 480w, {$medium[0]} 752w, {$large[0]} 1280w'>
    </amp-img>
</div>
EOL;
        echo $html;
    }
}
