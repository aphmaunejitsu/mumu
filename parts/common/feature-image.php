<?php
    $image[0] = get_template_directory_uri() . '/assets/images/no-image-752x423.jpg';
    $image[1] = 752;
    $image[2] = 423;

    $large[0]  = $image[0];
    $medium[0] = $image[0];

    $category = null;
    if ( has_post_thumbnail( get_the_ID() ) ) {
        $thum_id = get_post_thumbnail_id( get_the_ID() );
        $image   = wp_get_attachment_image_src( $thum_id, 'sgn-list-thum' );
        $large   = wp_get_attachment_image_src( $thum_id, 'sgn-eyecatch-16-9' );
        $medium  = wp_get_attachment_image_src( $thum_id, 'post-eye-thum' );
    }
?>
<div class='thumbnail mb1 overflow-hidden relative'>
    <amp-img alt="<?php echo esc_attr( $title ); ?>"
        src='<?php echo esc_attr( $image[0] ); ?>'
        layout="responsive"
        width='<?php echo $image[1]; ?>'
        height='<?php echo $image[2]; ?>'
        srcset='<?php echo esc_attr($image[0]) ?> 480w,
                <?php echo esc_attr($medium[0]) ?> 752w,
                <?php echo esc_attr($large[0]) ?>1280w'
    >
    </amp-img>
</div>
