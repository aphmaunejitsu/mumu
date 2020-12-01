<?php

use App\Filters\SetupThumbnail;

// サムネイルのカスタマイズ
add_action('after_setup_theme', [SetupThumbnail::class, 'thumbnails']);
