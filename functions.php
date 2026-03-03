<?php


function setup_theme_nav_menu()
{
    register_nav_menus(array(
        'header-menu' => __('UA Header menu (header-menu)', 'universityalpha'),
        'footer-menu-1' => __('UA Footer menu (footer-menu-1)', 'universityalpha'),
        'footer-menu-2' => __('UA Footer menu 2 (footer-menu-2)', 'universityalpha'),
        'footer-menu-3' => __('UA Social Icon (footer-menu-3)', 'universityalpha'),
        'sidebar-menu' => __('UA Sidebar menu (sidebar-menu)', 'universityalpha'),
    ));
}

add_action('after_setup_theme', 'setup_theme_nav_menu');


// includeing assets

include_once get_template_directory() . '/includes/loadAssets.php';

function university_features()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_image_size('professorLandscape', 400, 260, true);
    add_image_size('professorPortrait', 380, 450, true);
    add_image_size('pageBanner', 1500, 350, true);
}


add_action('after_setup_theme', 'university_features');


// importing post types 

include_once get_template_directory() . '/includes/postTypes.php';


// how to take first n words 


function get_first_n_words($string, $num_words = 100, $append = '...')
{
    $words = explode(' ', $string);
    if (count($words) < $num_words) {
        return $string;
    }

    $limited_words = array_slice($words, 0, $num_words);
    $new_string = implode(' ', $limited_words);
    return $new_string . $append;
}


function university_adjust_queries($query)
{
    // adjust queries for events
    if (
        !is_admin()
        && $query->is_main_query()
        && is_post_type_archive('event')
    ) {
        $query->set('posts_per_page', '5');
        $query->set('orderby', 'meta_value');
        $query->set('order', 'DESC');
        $query->set('meta_key', 'event_date');
        $query->set('meta_type', 'DATETIME');
        $query->set('meta_query', array(
            array(
                'key' => 'event_date',
                'compare' => '>=',
                'value' => date('Y-m-d H:i:s'),
                'type' => 'DATE'
            )
        ));
    }

    if (
        !is_admin()
        && $query->is_main_query()
        && is_post_type_archive('program')
    ) {
        $query->set('posts_per_page', -1);
        $query->set('orderby', 'title');
        $query->set('order', 'ASC');
    }


}


add_action('pre_get_posts', 'university_adjust_queries');

?>