<?php
/**
 * The main template file
 *
 * @link https://hcm-nights.com
 *
 * @package mumu
 * @since 1.0.0
 */
get_header(); ?>
<div id="primary" class="mx-auto">
    <main id="main" class="px1">
    <?php
    if (have_posts()) :
        while (have_posts()) :
            the_post();

            get_template_part( 'parts/content', get_post_type() );
        endwhile;
    else :
        get_template_part( 'parts/content', 'none' );
    endif;
    ?>
    </main><!-- #main -->
</div> <!-- #primary -->
<?php
get_sidebar();
get_footer();
