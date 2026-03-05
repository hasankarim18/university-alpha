<?php

get_header(); ?>
page-past-events.php // template file

<div class="page-banner">
    <div class="page-banner__bg-image"
        style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg') ?>);"></div>
    <div class="page-banner__content container container--narrow">
        <h1 class="page-banner__title">Past Events</h1>
        <div class="page-banner__intro">
            <p>Lets recap all past events.</p>
        </div>
    </div>
</div>

<div class="container container--narrow page-section">
    <div>

        <p style="text-align: right;"><a href="<?php echo site_url('/events') ?>"> See all upcoming
                events.</a>
        </p>
    </div>

    <?php
    $args = [
        'post_type' => 'event',
        // 'posts_per_page' => 1,
        'paged' => get_query_var('paged', 1),
        'meta_key' => 'event_date',
        'orderby' => 'meta_value',
        'order' => 'DESC',
        'meta_type' => 'DATETIME',
        'meta_query' => array(
            [
                'key' => 'event_date',
                'compare' => '<',
                'value' => date('Y-m-d H:i:s'),
                'type' => 'DATE'
            ]
        )
    ];
    $past_events = new WP_Query($args);

    if ($past_events->have_posts()):
        while ($past_events->have_posts()):
            $past_events->the_post();

            get_template_part('template-parts/event/loop', get_post_type());

        endwhile;
        echo paginate_links([
            'total' => $past_events->max_num_pages,
        ]);
        wp_reset_postdata();
        // the_posts_pagination();
    else:
        echo "<h2>No past events</h2>";
    endif;

    ?>

</div>

<?php get_footer();

?>