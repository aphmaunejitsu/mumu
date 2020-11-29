<?php

namespace App\Filters;

class ExcerptFilter {
    public static function customExcerptLength($length) {
        return $length;
    }

    public static function newExcerptMore($more) {
        return '...';
    }
}
