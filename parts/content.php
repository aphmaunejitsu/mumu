<?php
?>
<article id="post-<?php the_ID()?>" <?php post_class() ?>>
    <header class="article-header">
        <?php
            if ( is_singular() ) :
                the_title('<h1 class="entry-title">', '</h1>');
            else :
                the_title('<h3 class="entry-title">', '</h3>');
            endif;
        ?>

        <?php get_template_part('parts/common/feature-image'); ?>
        <div class="meta">
            <time datetime="" class="mr1">
                <?php get_template_part('parts/svg/calender'); ?>
                <span><?php echo get_the_date(null, get_the_ID()) ?></span>
            </time>
            <time datetime="">
                <?php get_template_part('parts/svg/refresh'); ?>
                <span><?php echo get_the_modified_date(null, get_the_ID()) ?></span>
            </time>
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
