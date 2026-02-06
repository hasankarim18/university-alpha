<?php
// load main styles
function university_files()
{
    // load font awesome
    wp_enqueue_style(
        'font-aweosome',
        'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css',
        [],
        '1.0.0',
        'all'
    );
    // load google fonts 
    wp_enqueue_style(
        'font-aweosome',
        'https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i',
        [],
        '1.0.0',
        'all'
    );
    wp_enqueue_style(
        'university-main-style.css',
        get_stylesheet_uri(),
        [],
        '1.0.0',
        'all'
    );
    // load stylesheet
    wp_enqueue_style(
        'university.css',
        get_template_directory_uri() . '/assets/css/main-styles.css',
        [],
        '1.0.0',
        'all'

    );
    // index.css
    wp_enqueue_style(
        'ua-index.css',
        get_template_directory_uri() . '/assets/css/index.css',
        [],
        '1.0.0',
        'all'

    );
    // styles- index.css
    wp_enqueue_style(
        'ua-style-index.css',
        get_theme_file_uri() . '/assets/css/style-index.css',
        [],
        '1.0.0',
        'all'

    );
    wp_enqueue_style(
        'ua-custom-styles.css',
        get_theme_file_uri() . '/assets/css/custom-styles.css',
        [],
        '1.0.0',
        'all'

    );

    // index.js 

    wp_enqueue_script(
        'ua-index.js',
        get_theme_file_uri('/build/index.js'),
        ['jquery'],
        '1.0.0',
        true

    );
}

add_action('wp_enqueue_scripts', 'university_files');
