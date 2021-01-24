<?php
/**
 * Link to SNS Page template
 *
 * @package Mumu Theme
 */

$mumu   = get_option( 'mumu' );
$tw_url = $mumu['theme_my_sns']['site']['twitter'] ?? null;
$fb_url = $mumu['theme_my_sns']['site']['fbpage'] ?? null;

if ( $tw_url || $fb_url ) : ?>
<div class="sns flex items-center justify-center">
	<?php
	if ( $tw_url ) :
		?>
		<a href="<?php echo esc_url( $tw_url ); ?>" target="_blank" class="inline-block p1" aria-label="<?php echo bloginfo( 'name' ); ?> Twitter">
		<?php get_template_part( 'parts/icons/svg', 'twitter' ); ?>
		</a>
		<?php
	endif;
	if ( $fb_url ) :
		?>
		<a href="<?php echo esc_url( $fb_url ); ?>" target="_blank" class="inline-block p1" aria-label="Link to <?php echo bloginfo( 'name' ); ?> Facebook">
		<?php get_template_part( 'parts/icons/svg', 'facebook' ); ?>
		</a>
	<?php endif; ?>
</div>
<?php endif; ?>
