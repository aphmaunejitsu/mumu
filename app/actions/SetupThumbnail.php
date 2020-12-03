<?php

namespace Mumu\Actions;

class SetupThumbnail
{
    public static function thumbnails()
    {
        add_theme_support('post-thumbnails');

        add_image_size('mumu-thumbnail-s-16x9', 480, 270, true);
        add_image_size('mumu-thumbnail-m-16x9', 752, 423, true);
        add_image_size('mumu-thumbnail-l-16x9', 1280, 720, true);
    }
}
