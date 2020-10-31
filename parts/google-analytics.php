<?php
$id = get_option( 'sgn_theme_analytics_id' );
if ( empty( $id ) ) {
	return;
}
?>
<amp-analytics type="googleanalytics" id="analytics-1">
<script type="application/json">
{
  "vars": {
		"account": "<?php echo esc_attr( $id ); ?>"
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
