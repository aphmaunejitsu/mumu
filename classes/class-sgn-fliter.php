<?php
class Sgn_Filter
{
    public static function title_parts($title_parts)
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

    public static function title_separator()
    {
        $sep = ' | ';
        return $sep;
    }

    public static function setup_thumbnail()
    {
        add_theme_support('post-thumbnails');

        add_image_size('mumu-thumbnail-s-16x9', 480, 270, true);
        add_image_size('mumu-thumbnail-m-16x9', 752, 423, true);
        add_image_size('mumu-thumbnail-l-16x9', 1280, 720, true);
    }
    public static function set_query_vars($query_vars)
    {
        $query_vars[] = 'thumbnail';
        $query_vars[] = 'page';
        $query_vars[] = 'items';
        $query_vars[] = 'orderby';
        $query_vars[] = 'category';
        $query_vars[] = 'meta';
        return $query_vars;
    }

    public static function post_search($search)
    {
        if (is_search()) {
            $search .= " AND post_type = 'post'";
        }
        return $search;
    }

    public static function add_canonical()
    {
        $canonical = null;
        if (is_home() || is_front_page()) {
            $canonical = home_url();
        } elseif (is_category()) {
            $canonical = get_category_link(get_query_var('cat'));
        } elseif (is_tag()) {
            $canonical = get_tag_link(get_queried_object()->term_id);
        } elseif (is_search()) {
            $canonical = get_search_link();
        } elseif (is_page() || is_single()) {
            $canonical = get_permalink();
        } else {
            $canonical = home_url();
        }

        ob_start();
        require dirname(__FILE__) . '/template/canonical.php';
        $canonical_tag = ob_get_contents();
        ob_end_clean();

        echo $canonical_tag;
    }

    public static function add_js()
    {
    }

    public static function add_google_ads()
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
            ob_start();
            require dirname(__FILE__) . '/template/adsens.php';
            $ad = ob_get_contents();
            ob_end_clean();
        }

        echo $ad;
    }
}
