<div class="container flex flex-column">
    <div class="category mb1">
        <?php the_category(' '); ?>
        <?php the_tags('', ' '); ?>
    </div>
    <?php if (is_user_logged_in()): ?>
    <div class="edit-link mb1">
        <?php mumu_edit_link(); ?>
    </div>
    <?php endif; ?>
    <?php if (is_singular() && is_active_sidebar('under-article')): ?>
    <div class="widget mb1">
        <?php dynamic_sidebar('under-article') ?>
    </div>
    <?php endif; ?>
</div>
