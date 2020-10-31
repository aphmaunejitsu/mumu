<?php
	global $sgn_theme;
	$url = $sgn_theme->get_site_icon();
	if ($url) :
?>
<div class="site-icon mr1">
<amp-img src="<?php echo $url ?>" width="32px" height="32px" layout="fixed"></amp-img>
</div>
<?php endif; ?>
