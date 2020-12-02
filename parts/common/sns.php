<div class="sns flex items-center justify-center">
<?php
if (($tw_url = get_option('sgn_theme_my_twitter'))) : ?>
    <a href="<?php echo $tw_url; ?>" target="_blank" class="inline-block p1" aria-label="<?php echo bloginfo('name'); ?> Twitter">
    <?php get_template_part('parts/icons/svg', 'twitter'); ?>
    </a>
<?php
endif;
if (($fb_url = get_option('sgn_theme_my_fbpage'))) : ?>
    <a href="<?php echo $fb_url; ?>" target="_blank" class="inline-block p1" aria-label="Link to <?php echo bloginfo('name'); ?> Facebook">
    <?php get_template_part('parts/icons/svg', 'facebook'); ?>
    </a>
<?php endif; ?>
</div>
