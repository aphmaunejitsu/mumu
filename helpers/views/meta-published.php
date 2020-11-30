<span class="published-post flex justify-end">
    <time class="entry-date published flex items-center" datetime="<?php echo $published_t; ?>">
        <?php get_template_part('parts/svg/calender'); ?>
        <?php echo $published; ?>
    </time>
    <time class="updateed-post flex items-center" datetime="<?php echo $updated_t; ?>">
        <?php get_template_part('parts/svg/refresh'); ?>
        <?php echo $updated; ?>
    </time>
</span>
