<?php
/**
 * The main template file
 *
 * @link https://github.com/aphmaunejitsu/mumu
 *
 * @package mumu
 * @since 2.0.0
 */
get_header(); ?>

<div id="primary" class="mx-auto">
    <main id="main">
    <header class="page-header flex">
        <span class="page-title">
            [<?php echo esc_html(get_search_query()); ?>] の検索結果
        </span>
    </header><!-- .page-header -->

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
    <?php mumu_pagination() ?>
</div> <!-- #primary -->
<?php
get_sidebar();
get_footer();
