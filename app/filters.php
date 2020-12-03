<?php

function newExcerptMore($more) {
    return '...';
}
add_filter('excerpt_more', 'newExcerptMore');

function titleParts($title_parts)
{
    $title_parts['tagline'] = '';
    $title_parts['site']    = '';
    $site_name              = trim(get_bloginfo('name'));
    if (is_front_page()) { //フロントページの場合
        $title_parts['title']   = $site_name;
        $title_parts['site']    = '';
        $title_parts['tagline'] = trim(get_bloginfo('description'));
    } elseif (is_singular()) { //投稿ページの場合
        $title_parts['title'] = trim(get_the_title());
        $title_parts['site']  = $site_name;
    } elseif (is_archive()) { //アーカイブページの場合
        $title_parts['title'] = '「' . $title_parts['title'] . '」のアーカイブ';
        $title_parts['site']  = $site_name;
    } elseif (is_search()) {
        $title_parts['title'] = $title_parts['title'];
    } elseif (is_404()) { //404ページの場合
        $title_parts['title'] = 'お探しのページは見つかりませんでした';
        $title_parts['site']  = $site_name;
    }

    return $title_parts;
}
add_filter('document_title_parts', 'titleParts');

function titleSeparator()
{
    $sep = ' | ';
    return $sep;
}
add_filter('document_title_separator', 'titleSeparator');
