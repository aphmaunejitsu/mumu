<?php

use App\Actions\RegisterMenuAction;
use App\Actions\RemoveAction;
use App\Actions\WidgetsAction;
use App\Actions\Style;

add_action('after_setup_theme',     [RegisterMenuAction::class, 'register']);
add_action('after_setup_theme',     [RemoveAction::class, 'remove']);
add_action('widgets_init',          [WidgetsAction::class, 'init']);
add_action('mumu_amp_custom_css', [Style::class, 'enqueueInlineStyle']);
