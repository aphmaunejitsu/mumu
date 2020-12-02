</div><!-- #content -->

<footer id="main-footer">
    <div class="container flex flex-column justify-center">
        <?php
            customLogo();
            wp_nav_menu([
                'menu_class'      => 'list-reset center m0 p0 nowrap',
                'container'       => 'nav',
                'theme_location'  => 'footer-navigation',
                'fallback_cb'     => null
            ]);
        ?>
        <div class="theme-copyright flex-column items-center justify-center">
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
            <div class="copy-right nowrap center">
                &copy; 2019 Aphmau Nejitsu
            </div>
        </div><!-- .theme-copyright -->
    </div>
</footer>
<?php get_template_part( 'parts/google', 'analytics' ); ?>
</body>
</html>
