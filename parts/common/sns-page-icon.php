<?php if (($tw_url = get_option('sgn_theme_my_twitter'))) : ?>
<a href="<?php echo $tw_url; ?>" target="_blank" class="inline-block p1" aria-label="<?php echo bloginfo('name');?> Twitter">
	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="22.2" viewBox="0 0 53 49">
		<title>Twitter</title>
		<path d="M45 6.9c-1.6 1-3.3 1.6-5.2 2-1.5-1.6-3.6-2.6-5.9-2.6-4.5 0-8.2 3.7-8.2 8.3 0 .6.1 1.3.2 1.9-6.8-.4-12.8-3.7-16.8-8.7C8.4 9 8 10.5 8 12c0 2.8 1.4 5.4 3.6 6.9-1.3-.1-2.6-.5-3.7-1.1v.1c0 4 2.8 7.4 6.6 8.1-.7.2-1.5.3-2.2.3-.5 0-1 0-1.5-.1 1 3.3 4 5.7 7.6 5.7-2.8 2.2-6.3 3.6-10.2 3.6-.6 0-1.3-.1-1.9-.1 3.6 2.3 7.9 3.7 12.5 3.7 15.1 0 23.3-12.6 23.3-23.6 0-.3 0-.7-.1-1 1.6-1.2 3-2.7 4.1-4.3-1.4.6-3 1.1-4.7 1.3 1.7-1 3-2.7 3.6-4.6" class="ampstart-icon ampstart-icon-twitter">
		</path>
	</svg>
</a>
<?php endif; ?>
<?php if (($fb_url = get_option('sgn_theme_my_fbpage'))) : ?>
<a href="<?php echo $fb_url; ?>" target="_blank" class="inline-block p1" aria-label="Link to Saigon.69 Facebook">
	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="23.6" viewBox="0 0 56 55">
		<title>Facebook</title>
		<path d="M47.5 43c0 1.2-.9 2.1-2.1 2.1h-10V30h5.1l.8-5.9h-5.9v-3.7c0-1.7.5-2.9 3-2.9h3.1v-5.3c-.6 0-2.4-.2-4.6-.2-4.5 0-7.5 2.7-7.5 7.8v4.3h-5.1V30h5.1v15.1H10.7c-1.2 0-2.2-.9-2.2-2.1V8.3c0-1.2 1-2.2 2.2-2.2h34.7c1.2 0 2.1 1 2.1 2.2V43" class="ampstart-icon ampstart-icon-fb">
		</path>
	</svg>
</a>
<?php endif; ?>
