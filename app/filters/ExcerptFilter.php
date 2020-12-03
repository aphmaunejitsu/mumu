<?php

namespace Mumu\Filters;

class ExcerptFilter {
    public static function customExcerptLength($length) {
        return $length;
    }

    public static function newExcerptMore($more) {
        return '...';
    }
}
