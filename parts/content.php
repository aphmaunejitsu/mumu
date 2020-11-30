<article id="post-<?php the_ID()?>" <?php post_class('mb2') ?>>
    <a href="<?php the_permalink(); ?>" class="p0 text-decoration-none" >
    <header class="article-header mb1">
        <?php
            if ( is_singular() ) :
                the_title('<h1 class="entry-title my1">', '</h1>');
            else :
                the_title('<h3 class="entry-title my1">', '</h3>');
            endif;
        ?>
        <?php featureImage(); ?>
        <div class="meta">
        <?php publishedPost(); ?>
        </div>
    </header>
    <div class="article-content content mb1">
        <?php the_excerpt() ?>
    </div>
    </a>
    <footer class="article-footer">
        <?php the_category(' '); ?>
        <?php the_tags('', ' '); ?>
    </footer>
</article>
