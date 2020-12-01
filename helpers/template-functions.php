<?php

if (! function_exists('getAssetsDir')) {
    function getAssetsDir() {
        return esc_attr(get_template_directory_uri() . 'assests/');
    }
}

if (! function_exists('customLogo')) {
    function customLogo($id = null) {
        if (has_custom_logo($id)) {
            $custom_logo_id = get_theme_mod('custom_logo');
            $image = wp_get_attachment_image_src($custom_logo_id, 'full');
            $output = sprintf(
                '<amp-img src="%1$s" width="%2$s" height="%3$s" layout="fixed"></amp_img>',
                $image[0],
                $image[1],
                $image[2]
            );
        } else {
            $output = get_bloginfo('name');
        }

        $logo = '<a href="' . get_home_url() . '" class="home-link text-decoration-none inline-block mx-auto flex items-center">' . $output . '</a>';

        echo $logo;
    }
}

if (! function_exists('featureImage')) {
    function featureImage() {
        $image[0] = esc_attr(get_template_directory_uri() . '/assets/images/no-image-752x423.jpg');
        $image[1] = 752;
        $image[2] = 423;

        $large[0]  = $image[0];
        $medium[0] = $image[0];
        $title = esc_attr(get_the_title());
        $link = get_the_permalink();

        $category = null;
        if ( has_post_thumbnail( get_the_ID() ) ) {
            $thum_id = get_post_thumbnail_id( get_the_ID() );
            $image   = wp_get_attachment_image_src( $thum_id, 'mumu-thumbnail-s-16x9' );
            $large   = wp_get_attachment_image_src( $thum_id, 'mumu-thumbnail-l-16x9' );
            $medium  = wp_get_attachment_image_src( $thum_id, 'mumu-thumbnail-m-16x9' );

            $image[0] = esc_attr($image[0]);
            $large[0] = esc_attr($large[0]);
            $medium[0] = esc_attr($medium[0]);
        }

        ob_start();
        require dirname( __FILE__ ) . '/views/feature-image.php';
        $feature = ob_get_contents();
        ob_end_clean();

        echo $feature;
    }
}

if (! function_exists('publishedPost')) {
    function publishedPost() {
        $published = get_the_date('U');
        $updated   = get_the_modified_date('U');

        if (get_the_date('U') > get_the_modified_date('U')) {
            $published = get_the_date();
            $updated   = $published;

            $published_t = get_the_date('Y-m-d');
            $updated_t   = $published_t;
        } else {
            $published = get_the_date();
            $updated   = get_the_modified_date();

            $published_t = get_the_date('Y-m-d');
            $updated_t   = get_the_modified_date('Y-m-d');
        }

        ob_start();
        require dirname( __FILE__ ) . '/views/meta-published.php';
        $meta = ob_get_contents();
        ob_end_clean();

        echo $meta;
    }
}
