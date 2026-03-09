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
    ));

    $search_results = array(
        'generalInfo' => [],
        'professors' => [],
        'programs' => [],
        'events' => [],
        'campuses' => [],
        'archives' => [
            'generalInfo' => get_post_type_archive_link('post'),
            'professors' => get_post_type_archive_link('professor'),
            'programs' => get_post_type_archive_link('program'),
            'events' => get_post_type_archive_link('event'),
            'campuses' => get_post_type_archive_link('campus')
        ]
    );

    while ($main_query->have_posts()) {
        $main_query->the_post();

        if (get_post_type() == 'post' or get_post_type() == 'page') {
            array_push($search_results['generalInfo'], [
                'id' => get_the_ID(),
                'title' => get_the_title(),
                'type' => get_post_type(),
                'permalink' => get_the_permalink(),
                'archive_link' => get_post_type() == 'page'
                    ? home_url('/')
                    : get_post_type_archive_link(get_post_type())
            ]);
        }
        if (get_post_type() == 'professor') {

            array_push($search_results['professors'], [
                'title' => get_the_title(),
                'type' => get_post_type(),
                'permalink' => get_the_permalink(),
                'image' => get_the_post_thumbnail_url(0, 'professorLandscape'),

            ]);
        }
        if (get_post_type() == 'program') {
            array_push($search_results['programs'], [
                'id' => get_the_ID(),
                'title' => get_the_title(),
                'type' => get_post_type(),
                'permalink' => get_the_permalink(),
                'archive_link' => get_post_type() == 'page'
                    ? home_url('/')
                    : get_post_type_archive_link(get_post_type())
            ]);
        }
        if (get_post_type() == 'event') {
            $event_date_field = get_field('event_date');
            $event_date_time_object = new DateTime($event_date_field);
            $today = date('Y-m-d H:i:s');
            $bg_color = 'MidnightBlue';

            if ($event_date_time_object->format('Y-m-d H:i:s') < $today):
                $bg_color = 'coral';
            endif;
            $description = '';
            if (has_excerpt()):
                $description = get_the_excerpt() . '...';
            else:
                $description = wp_trim_words(get_the_content(), 15, '...');
            endif;

            array_push($search_results['events'], [
                'title' => get_the_title(),
                'type' => get_post_type(),
                'permalink' => get_the_permalink(),
                'archive_link' => get_post_type() == 'page'
                    ? home_url('/')
                    : get_post_type_archive_link(get_post_type()),
                'day' => $event_date_time_object->format('d'),
                'month' => $event_date_time_object->format('M'),
                'bg_color' => $bg_color,
                'description' => $description

            ]);
        }
        if (get_post_type() == 'campus') {
            array_push($search_results['campuses'], [
                'title' => get_the_title(),
                'type' => get_post_type(),
                'permalink' => get_the_permalink(),
                'archive_link' => get_post_type() == 'page'
                    ? home_url('/')
                    : get_post_type_archive_link(get_post_type())
            ]);
        }



        // $search_results;
    }

    wp_reset_postdata();

    // 

    if ($search_results['programs']) {
        $programsMetaQuery = ['relation' => 'OR'];
        foreach ($search_results['programs'] as $program) {
            array_push($programsMetaQuery, [
                'key' => 'related_programs',
                'compare' => 'LIKE',
                'value' => '"' . $program['id'] . '"',
            ]);
        }

        $programRelationshipQuery = new WP_Query(array(
            'post_type' => 'professor',
            'meta_query' => $programsMetaQuery,
        ));

        while ($programRelationshipQuery->have_posts()) {
            $programRelationshipQuery->the_post();

            if (get_post_type() == 'professor') {

                array_push($search_results['professors'], [
                    'title' => get_the_title(),
                    'type' => get_post_type(),
                    'permalink' => get_the_permalink(),
                    'image' => get_the_post_thumbnail_url(0, 'professorLandscape'),

                ]);
            }

        }

        wp_reset_postdata();
        $search_results['professors'] = array_values(array_unique($search_results['professors'], SORT_REGULAR));
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