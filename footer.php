<?php
/**
 * Footer templete
 *
 * @package Mumu theme
 */

?>
</div><!-- #content -->

<footer id="main-footer">
	<div class="container flex flex-column justify-center">
		<?php
		mumu_custom_logo();
			wp_nav_menu(
				array(
					'menu_class'     => 'list-reset center m0 p0 nowrap',
					'container'      => 'nav',
					'theme_location' => 'footer-navigation',
					'fallback_cb'    => null,
				)
			);
			?>
		<div class="sns flex items-center justify-center">
		<?php
		$mumu   = get_option( 'mumu' );
		$tw_url = $mumu['theme_my_sns']['twitter'] ?? null;
		$fb_url = $mumu['theme_my_sns']['fbpage'] ?? null;
		_log( $tw_url );
		_log( $fb_url );
		if ( $tw_url ) :
			?>
			<a href="<?php echo $tw_url; ?>" target="_blank" class="inline-block p1" aria-label="<?php echo bloginfo( 'name' ); ?> Twitter">
			<?php get_template_part( 'parts/icons/svg', 'twitter' ); ?>
			</a>
			<?php
		endif;
		if ( $fb_url ) :
			?>
			<a href="<?php echo $fb_url; ?>" target="_blank" class="inline-block p1" aria-label="Link to <?php echo bloginfo( 'name' ); ?> Facebook">
			<?php get_template_part( 'parts/icons/svg', 'facebook' ); ?>
			</a>
		<?php endif; ?>
		</div>
		<div class="theme-copyright flex-column items-center justify-center">
			<div class="copy-right nowrap center">
				&copy; 2019 Aphmau Nejitsu
			</div>
		</div><!-- .theme-copyright -->
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
