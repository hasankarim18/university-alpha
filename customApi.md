```
<?php


function combine_search_data($data)
{
    $data = [
        'route' => 'search',
        'timestamp' => current_time('mysql'),
    ];
    return $data;
}


function university_custom_rest_api()
{
    register_rest_route(
        'university/v3',
        "/search",
        [
            'method' => WP_REST_SERVER::READABLE,
            'callback' => 'combine_search_data'
        ]
    );
}

add_action('rest_api_init', 'university_custom_rest_api');

// ?rest_route=/university/v1/search


?>

```
