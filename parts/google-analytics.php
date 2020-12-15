<?php
$mumu = get_option('mumu');
$analytics = $mumu['theme_my_analytics']['id'] ?? null;
if (empty($analytics)) {
	return;
}
?>
<amp-analytics type="googleanalytics" id="analytics-1">
<script type="application/json">
{
  "vars": {
		"account": "<?php echo esc_attr($analytics); ?>"
  },
  "triggers": {
	"trackPageview": {
	  "on": "visible",
	  "request": "pageview"
	}
  }
}
</script>
</amp-analytics>
