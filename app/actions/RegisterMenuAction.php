<?php

namespace Aphmau\Actions;

class RegisterMenuAction
{
    public static function register()
    {
        register_nav_menus([
            'header-navigation' => 'Header Navigation',
            'footer-navigation' => 'Footer Navigation',
        ]);
    }
}
