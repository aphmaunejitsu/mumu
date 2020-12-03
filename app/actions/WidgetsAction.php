<?php

namespace Mumu\Actions;

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
            'name'          => 'Under Article',
            'id'            => 'under-article',
        ] + $config);

    }
}

