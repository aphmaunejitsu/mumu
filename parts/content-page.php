<article id="post-<?php the_ID()?>" <?php post_class('mb2') ?>>
    <header class="article-header mb1">
        <?php the_title('<h1 class="entry-title my1">', '</h1>'); ?>
        <div class="meta mb1">
        <?php publishedPost(); ?>
        </div> <!-- .meta -->
    </header>
    <div class="article-content content mb1">
        <?php the_content() ?>
    </div><!-- .article-content -->
    <footer class="article-footer mt1">
        <?php get_template_part('parts/content/article', 'footer'); ?>
    </footer>
</article>
