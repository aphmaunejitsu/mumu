<?php

use Mumu\Actions\RegisterMenuAction;
use Mumu\Actions\RemoveAction;
use Mumu\Actions\WidgetsAction;
use Mumu\Actions\StyleAction;
use Mumu\Actions\SetupThumbnail;

// サムネイルのカスタマイズ
add_action('after_setup_theme',   [SetupThumbnail::class, 'thumbnails']);
// メニューの追加
add_action('after_setup_theme',   [RegisterMenuAction::class, 'register']);
// AMPに不要なAction削除
add_action('after_setup_theme',   [RemoveAction::class, 'remove']);
// Widgetsの初期化
add_action('widgets_init',        [WidgetsAction::class, 'init']);
// AMPのCSS出力
add_action('mumu_amp_custom_css', [StyleAction::class, 'enqueueInlineStyle']);
