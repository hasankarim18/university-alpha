<?php


function combine_search_data(WP_REST_Request $request)
{

    $search_term = sanitize_text_field($request->get_param('search'));
    $search = new WP_Query(array(
        'post_type' => ['professor', 'post',],
        'posts_per_page' => -1,
        's' => $search_term

    ));

    $search_results = array();

    while ($search->have_posts()) {
        $search->the_post();

        array_push($search_results, array(
            'title' => get_the_title(),
            'link' => get_the_permalink(),
            'post_type' => get_post_type(),

        ));


    }


    return $search_results;
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