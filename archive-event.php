<?php

get_header(); ?>
archive-event.php

<div class="page-banner">
    <div class="page-banner__bg-image"
        style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg') ?>);"></div>
    <div class="page-banner__content container container--narrow">
        <h1 class="page-banner__title">All Events</h1>
        <div class="page-banner__intro">
            <p>See what is going on in our world.</p>
        </div>
    </div>
</div>

<div class="container container--narrow page-section">
    <div>
        <h4 class="event_box">
            Upcoming events

            <i class="fa fa-arrow-right" aria-hidden="true"></i>
            <span class="up_box"></span>
        </h4>
        <h4 class="event_box">
            Past events <i class="fa fa-arrow-right" aria-hidden="true"></i>
            <span class="past_box"></span>
        </h4>
    </div>
    <?php
    $archive_event_query = new WP_Query([
        'post_type' => 'event',
        'posts_per_page' => -1,
        'meta_key' => 'event_date',
        'orderby' => 'meta_value',
        'order' => 'DESC',
        'meta_type' => 'DATETIME',

    ]);

    if ($archive_event_query->have_posts()):
        while ($archive_event_query->have_posts()):
            $archive_event_query->the_post();

            ?>


            <div class="event-summary">
                <?php
                $event_date = get_field('event_date');
                $ev_obj = new DateTime($event_date);
                $today = date('Y-m-d H:i:s');
                $bg_color = 'MidnightBlue';

                if ($ev_obj->format('Y-m-d H:i:s') < $today):
                    $bg_color = 'coral';
                endif;
                // echo $ev_obj->format('Y-m-d H:i:s');
                ?>
                <a style="background-color:<?php echo $bg_color; ?>" class="event-summary__date t-center" href="#">
                    <span class="event-summary__month">
                        <?php echo $ev_obj->format('M'); ?>
                    </span>
                    <span class="event-summary__day">
                        <?php echo $ev_obj->format('d'); ?>
                    </span>
                </a>
                <div class="event-summary__content">
                    <h5 class="event-summary__title headline headline--tiny"><a
                            href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                    <div>
                        <strong>
                            <i class="deep_sky_blue">Event Place: </i>
                            <?php
                            $event_place = get_field('event_place');
                            echo $event_place['value'];
                            ?>

                        </strong> <br>
                        <strong>
                            <i class="deep_sky_blue">Event Time: </i>

                            <span> <?php echo $ev_obj->format('h:i a') ?> </span>
                        </strong>
                    </div>
                    <p><?php echo wp_trim_words(get_the_content(), 18); ?> <a href="<?php the_permalink(); ?>"
                            class="nu gray">Learn more</a></p>
                </div>
            </div>
            <?php
        endwhile;
        wp_reset_postdata();

    endif;
    ?>

</div>

<?php get_footer();

?>