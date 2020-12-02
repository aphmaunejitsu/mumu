<footer class="sgn-footerbar">
        <div class="site-info nowrap">
            <?php customLogo(); ?>
        </div>
        <?php
            wp_nav_menu(
                array(
                    'menu'           => 'global navi',
                    'menu_class'     => 'list-reset nowrap',
                    'container'      => 'nav',
                    'theme_location' => 'sgn-footerbar',
                )
            );
            ?>
        <div class="sgn-footer-bottom flex flex-column items-center justify-center">
            <div class="sgn-sns-page flex items-center justify-center">
            <?php get_template_part( 'parts/common/sns-page-icon' ); ?>
            </div>
            <div class="copy-right nowrap">
                &copy; 2019 Mumu
            </div>
        </div>
</footer>
