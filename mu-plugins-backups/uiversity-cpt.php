<?php
function university_post_types()
{

    // event post type

    $labels = [
        'name' => 'Events',
        'singular_name' => 'Event',
        'menu_name' => 'Events',
        'name_admin_bar' => 'Event',
        'add_new_item' => 'Add New Event',
        'edit_item' => 'Edit Event',
        'new_item' => 'New Event',
        'view_item' => 'View Event',
        'search_items' => 'Search Events',
        'not_found' => 'No events found',
        'not_found_in_trash' => 'No events found in Trash',
        'all_items' => 'All Events',
    ];

    $args = [
        'labels' => $labels,
        'capability_type' => 'event',
        'map_meta_cap' => true,
        'public' => true,
        'menu_icon' => 'dashicons-calendar-alt',
        'show_in_rest' => true,
        'has_archive' => true,
        'rewrite' => ['slug' => 'events', 'with_front' => false],
        'supports' => [
            'title',
            'editor',
            'thumbnail',
            'excerpt',
        ],
        'taxonomies' => ['category', 'post_tag'],
        'can_export' => true,
        'menu_position' => 100

    ];

    register_post_type('event', $args);

    // #program_post_type 

    $program_labels = [
        'name' => 'Programs',
        'singular_name' => 'Program',
        'menu_name' => 'Programs',
        'name_admin_bar' => 'Program',
        'add_new_item' => 'Add New Program',
        'edit_item' => 'Edit Program',
        'new_item' => 'New Program',
        'view_item' => 'View Program',
        'search_items' => 'Search Programs',
        'not_found' => 'No programs found',
        'not_found_in_trash' => 'No programs found in Trash',
        'all_items' => 'All programs',
    ];

    $program_args = [
        'labels' => $program_labels,
        'public' => true,
        'menu_icon' => 'dashicons-awards',
        'show_in_rest' => true,
        'has_archive' => true,
        'rewrite' => ['slug' => 'programs', 'with_front' => false],
        'supports' => [
            'title',
            'editor',
            'thumbnail',
            'excerpt',
        ],
        'taxonomies' => ['category', 'post_tag'],
        'can_export' => true,
        'menu_position' => 110

    ];

    register_post_type('program', $program_args);

    // #professor_post type
    $professor_labels = [
        'name' => 'Professors',
        'singular_name' => 'Professor',
        'menu_name' => 'Professors',
        'name_admin_bar' => 'Professor',
        'add_new_item' => 'Add New Professor',
        'edit_item' => 'Edit Professor',
        'new_item' => 'New Professor',
        'view_item' => 'View Professor',
        'search_items' => 'Search Professor',
        'not_found' => 'No Professors found',
        'not_found_in_trash' => 'No Professors found in Trash',
        'all_items' => 'All Professors',
    ];

    $professor_args = [
        'labels' => $professor_labels,
        'public' => true,
        'menu_icon' => 'dashicons-welcome-learn-more',
        'show_in_rest' => true,
        'has_archive' => false, // default
        //  'rewrite' => ['slug' => 'professors', 'with_front' => false],
        'supports' => [
            'title',
            'editor',
            'thumbnail',
            'excerpt',
        ],
        'taxonomies' => ['category', 'post_tag'],
        'can_export' => true,
        'menu_position' => 120

    ];

    register_post_type('professor', $professor_args);

    #capases post type

    $campus_labels = [
        'name' => 'Campuses',
        'singular_name' => 'Campus',
        'menu_name' => 'Campuses',
        'name_admin_bar' => 'Campus',
        'add_new_item' => 'Add New Campus',
        'edit_item' => 'Edit Campus',
        'new_item' => 'New Campus',
        'view_item' => 'View Campus',
        'search_items' => 'Search Campus',
        'not_found' => 'No Campuses found',
        'not_found_in_trash' => 'No Campuses found in Trash',
        'all_items' => 'All Campuses',
    ];

    $campus_args = [
        'labels' => $campus_labels,
        'public' => true,
        'menu_icon' => 'dashicons-location-alt',
        'show_in_rest' => true,
        'has_archive' => true, // default
        'rewrite' => ['slug' => 'campuses', 'with_front' => false],
        'supports' => [
            'title',
            'editor',
            'thumbnail',
            'excerpt',
        ],
        'taxonomies' => ['category', 'post_tag'],
        'can_export' => true,
        'menu_position' => 130

    ];

    register_post_type('Campus', $campus_args);

}

add_action('init', 'university_post_types');