<?php

namespace App\Actions;

class WidgetsAction
{
    public static function init()
    {
        $config = [
            'before_widget' => '<section class="widget %1$s %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h3>',
            'after_title'   => '</h3>'
        ];

        register_sidebar([
            'name'          => 'Header Navi menu',
            'id'            => 'sidebar-primary'
        ] + $config);

        register_sidebar([
            'name'          => 'Footer Center',
            'id'            => 'sidebar-center-footer'
        ] + $config);

        register_sidebar([
            'name'          => 'Footer Left',
            'id'            => 'sidebar-left-footer'
        ] + $config);

        register_sidebar([
            'name'          => 'Footer right',
            'id'            => 'sidebar-right-footer'
        ] + $config);
    }
}

