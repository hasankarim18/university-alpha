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
}


add_action('after_setup_theme', 'university_features')

    ?>