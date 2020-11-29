<div class="sgn-feature-image mb1 relative">
    <?php
    if ( has_post_thumbnail() ) :
        $t_id   = get_post_thumbnail_id( get_the_ID() );
        $img    = wp_get_attachment_image_src( $t_id, 'sgn-eyecatch-16-9' );
        $medium = wp_get_attachment_image_src( $t_id, 'post-eye-thum' );
        $small  = wp_get_attachment_image_src( $t_id, 'sgn-list-thum' );
        $full   = wp_get_attachment_image_src( $t_id, 'full' );
    else :
        $img[0] = get_template_directory_uri() . '/assets/images/no-image-1290x680.png';
        $img[1] = 1290;
        $img[2] = 680;
        $full   = null;
    endif;
    ?>
    <figure>
    <amp-img
        on="tap:sgn-feature-lightbox" role="tutton"
        tabindex="0"
        src="<?php echo esc_url( $medium[0] ); ?>"
        width="<?php echo esc_html( $medium[1] ); ?>"
        height="<?php echo esc_html( $medium[2] ); ?>"
        layout="responsive"
        srcset="<?php echo esc_url( $img[0] ); ?> 1280w,
                        <?php echo esc_url( $medium[0] ); ?> 752w,
                        <?php echo esc_url( $small[0] ); ?> 480w">
    </amp-img>
    </figure>
</div>

