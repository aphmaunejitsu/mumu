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
            <?php get_template_part('parts/common/sns'); ?>
            <div class="copy-right nowrap center">
                &copy; 2019 Aphmau Nejitsu
            </div>
        </div><!-- .theme-copyright -->
    </div>
</footer>
<?php do_action('mumu_google_analytics'); ?>
</body>
</html>
