<?php
get_header(); ?>
<div id="primary" class="mx-auto">
    <main id="main">
        <header class="page-header">
            <?php
            the_archive_title( '<h2 class="page-title">', '</h2>' );
            the_archive_description( '<div class="archive-description">', '</div>' );
            ?>
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
    <?php pagination() ?>
</div> <!-- #primary -->
<?php
get_sidebar();
get_footer();
