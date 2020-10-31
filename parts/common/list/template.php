<div placeholder class="sgn-amp-list-loadin text-align-center">Loading ...</div>
<template type="amp-mustache">
	<div class="entry mb1">
		<a href="{{url}}">
			<div class='card flex items-start'>
				<div class='thumbnail mr1'>
					<amp-img alt="{{title}}" src='{{image.src}}' layout="fixed" width='{{image.width}}' height='{{image.height}}' ></amp-img>
				</div>
				<div class="post-title">{{title}}</div>
			</div>
			<div class="post-time flex justify-end">
				<time datetime="{{date}}" class="nowrap">
					<i class="fas fa-calendar-alt fa-fw"></i> {{date}}
				</time>
				<time datetime="{{mdate}}" class="nowrap ml1">
					<i class="fas fa-sync-alt fa-fw"></i> {{mdate}}
				</time>
			</div>
		</a>
	</div>
</template>
<div overflow role=button aria-label="もっと見る" class="sgn-list-readmore flex justify-center">
<span>もっと見る</span>
</div>

