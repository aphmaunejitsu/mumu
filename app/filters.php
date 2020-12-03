<?php

use Mumu\Filters\ExcerptFilter;

add_filter('excerpt_more', [ExcerptFilter::class, 'newExcerptMore']);
