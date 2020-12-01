<?php

use App\Actions\RegisterMenuAction;
use App\Actions\RemoveAction;

add_action('after_setup_theme', [RegisterMenuAction::class, 'register']);
add_action('after_setup_theme', [RemoveAction::class, 'remove']);
