<?php


function combine_search_data(WP_REST_Request $request)
{

    $search_term = sanitize_text_field($request->get_param('key'));
    $page = $request->get_param('page') ? $request->get_param('page') : 1;
    $main_query = new WP_Query(array(
        'post_type' => ['professor', 'post', 'page', 'event', 'program', 'campus'],
        'posts_per_page' => -1,
        'paged' => $page,
        's' => $search_term,
        'orderby' => 'post_type',
        'order' => 'ASC'

    ));

    $search_results = array(
        'generalInfo' => [],
        'professors' => [],
        'programs' => [],
        'events' => [],
        'campuses' => []
    );

    while ($main_query->have_posts()) {
        $main_query->the_post();

        if (get_post_type() == 'post' or get_post_type() == 'page') {
            array_push($search_results['generalInfo'], [
                'id' => get_the_ID(),
                'title' => get_the_title(),
                'type' => get_post_type(),
                'permalink' => get_the_permalink()
            ]);
        }
        if (get_post_type() == 'professor') {
            $related_programs_obj = get_field('related_programs');
            $related_programs = [];
            foreach ($related_programs_obj as $item) {
                array_push($related_programs, $item->post_title);
            }
            array_push($search_results['professors'], [
                'title' => get_the_title(),
                'type' => get_post_type(),
                'permalink' => get_the_permalink(),
                'related_programs' => $related_programs
            ]);
        }
        if (get_post_type() == 'program') {
            array_push($search_results['programs'], [
                'title' => get_the_title(),
                'type' => get_post_type(),
                'permalink' => get_the_permalink()
            ]);
        }
        if (get_post_type() == 'event') {
            array_push($search_results['events'], [
                'title' => get_the_title(),
                'type' => get_post_type(),
                'permalink' => get_the_permalink()
            ]);
        }
        if (get_post_type() == 'campus') {
            array_push($search_results['campuses'], [
                'title' => get_the_title(),
                'type' => get_post_type(),
                'permalink' => get_the_permalink()
            ]);
        }



        // $search_results;
    }
    wp_reset_postdata();

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