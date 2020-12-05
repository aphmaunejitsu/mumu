<?php


remove_filter('the_excerpt', 'wpautop');
remove_filter('term_description', 'wpautop');
add_filter('wp_lazy_loading_enabled', '__return_false');

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


function post_search($search)
{
    if (is_search()) {
        $search .= " AND post_type = 'post'";
    }
    return $search;
}
add_filter('posts_search', 'post_search');

function google_auto_adsens()
{
    $ad = null;
    if (is_404()) {
        return;
    }

    if (! get_option('sgn_theme_ad_show')) {
        return;
    }

    if (! get_option('sgn_theme_ad_adsens_auto')) {
        return;
    }

    if (($adsens = get_option('sgn_theme_ad_adsens'))) {
        $ad = '<amp-auto-ads type="adsense" data-ad-client="ca-pub-' . $adsens . "></amp-auto-ads>";
    }

    echo $ad;
}
add_filter('google_auto_adsens', 'google_auto_adsens');

