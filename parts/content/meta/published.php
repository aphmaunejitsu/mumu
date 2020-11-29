<span class="posted-on flex justify-end">
    <time class="entry-date published flex items-center" datetime="<?php esc_attr(get_the_date(DATE_W3C)); ?>">
        <?php get_template_part('parts/svg/calender'); ?>
        <?php the_date(); ?>
    </time>
    <time class="updateed flex items-center" datetime="<?php esc_attr(get_the_modified_date(DATE_W3C)); ?>">
        <?php get_template_part('parts/svg/refresh'); ?>
        <?php the_modified_date(); ?>
    </time>
</span>
