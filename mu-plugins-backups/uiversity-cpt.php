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
        'menu_icon' => 'dashicons-hourglass',
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

    ];

    register_post_type('event', $program_args);


}

add_action('init', 'university_post_types');