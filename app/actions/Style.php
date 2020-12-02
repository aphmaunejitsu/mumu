<?php

namespace App\Actions;

class Style
{
    public static function enqueueInlineStyle()
    {
        $style = file_get_contents(get_template_directory() . '/assets/css/aphmau.css');
        echo $style;
    }
}
