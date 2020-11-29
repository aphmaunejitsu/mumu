<article id="post-<?php the_ID()?>" <?php post_class() ?>>
    <header class="article-header">
        <?php
            if ( is_singular() ) :
                the_title('<h1 class="entry-title">', '</h1>');
            else :
                the_title('<h3 class="entry-title">', '</h3>');
            endif;
        ?>

        <?php featureImage(); ?>
        <div class="meta">
        <?php get_template_part('parts/content/meta/published'); ?>
        </div>
    </header>
    <div class="article-content content">
        <?php the_excerpt() ?>
    </div>
    <footer class="article-fotter">
        <?php the_category(' '); ?>
        <?php the_tags('', ' '); ?>
    </footer>
</article>
