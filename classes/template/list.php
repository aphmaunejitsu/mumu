<div class="entry mb1">
	<a href="<?php echo $p->url; ?>">
		<div class='card flex items-start'>
			<div class='thumbnail mr1'>
				<amp-img
					alt="<?php echo $p->title; ?>"
					src='<?php echo $p->image['src']; ?>'
					layout="fixed"
					width='<?php echo $p->image['width']; ?>'
					height='<?php echo $p->image['height']; ?>' >
				</amp-img>
			</div>
			<div class="post-title"><?php echo $p->title; ?></div>
		</div>
		<div class="post-time flex justify-end">
			<time datetime="<?php echo $p->date; ?>">
			<i class="fas fa-calendar-alt"></i> <?php echo $p->date; ?>
			</time>
		</div>
	</a>
</div>

