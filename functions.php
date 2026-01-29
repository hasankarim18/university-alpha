<?php


function setup_theme_nav_menu()
{
    register_nav_menus(array(
        'header-menu' => __('UA Header menu (header-menu)', 'universityalpha'),
        'footer-menu' => __('UA Footer menu (footer-menu)', 'universityalpha'),
        'sidebar-menu' => __('UA Sidebar menu (sidebar-menu)', 'universityalpha'),
    ));
}

add_action('after_setup_theme', 'setup_theme_nav_menu');


// includeing assets

include_once get_template_directory() . '/includes/loadAssets.php';

function university_features()
{
    add_theme_support('title-tag');
}


add_action('after_setup_theme', 'university_features')

    ?>