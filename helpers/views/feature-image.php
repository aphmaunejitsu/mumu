<div class='thumbnail mb1 overflow-hidden relative'>
    <amp-img alt="<?php echo esc_html($title) ?>"
        src='<?php echo $image[0] ?>'
        layout="responsive"
        width='<?php echo $image[1] ?>'
        height='<?php echo $image[2] ?>'
        srcset='<?php echo $image[0] ?> 480w, <?php echo$medium[0] ?> 752w, <?php echo $large[0] ?> 1280w'
    >
    </amp-img>
</div>
