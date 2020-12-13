<article id="post-<?php the_ID()?>" <?php post_class('mb2') ?>>
    <header class="article-header mb1">
        <?php
            if ( is_singular() ) :
                the_title('<h1 class="entry-title my1">', '</h1>');
            else :
                the_title('<h3 class="entry-title my1">', '</h3>');
            endif;
        ?>
        <a href="<?php the_permalink(); ?>" class="p0 text-decoration-none" ><?php featureImage(); ?></a>
        <div class="meta">
        <?php publishedPost(); ?>
        </div> <!-- .meta -->
    </header>
    <div class="article-content content mb1">
        <?php the_excerpt() ?>
		<div class="read-more flex justify-center my1">
			<a href="<?php the_permalink(); ?>" class="button">Read More</a>
		</div><!-- .read-more -->
    </div><!-- .article-content -->
    <footer class="article-footer mt1">
        <?php get_template_part('parts/content', 'footer'); ?>
    </footer>
</article>
