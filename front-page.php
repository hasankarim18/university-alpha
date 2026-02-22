<?php
get_header();
?>

<div class="page-banner">
    <div class="page-banner__bg-image"
        style="background-image:url('<?php echo get_theme_file_uri('/images/uni.jpg') ?>')"></div>
    <div class="page-banner__content container t-center c-white">
        <?php
        $front_page_title = get_field('banner_title', get_the_ID());

        ?>
        <h1 class="headline headline--large"> <?php echo $front_page_title; ?> </h1>
        <h2 class="headline headline--medium">We think you&rsquo;ll like it here.</h2>
        <h3 class="headline headline--small">Why don&rsquo;t you check out the <strong>major</strong> you&rsquo;re
            interested in?</h3>
        <a href="#" class="btn btn--large btn--blue">Find Your Major</a>
    </div>
</div>


<!--  -->

<div class="full-width-split group">
    <div class="full-width-split__one">
        <div class="full-width-split__inner">
            <h2 style="margin-bottom: 5px;" class="headline headline--small-plus t-center">
                Upcoming Events
            </h2>
            <div class="ue_today">
                <?php
                $today = new DateTime();
                ?>
                <i>Today:</i> <strong> <?php echo $today->format('d M - Y ') ?> </strong>
            </div>

            <?php
            $today_string = date('Y-m-d H:i:s');

            ?>

            <?php

            $homepage_events = new WP_Query(array(
                'post_type' => 'event',
                'posts_per_page' => -1,
                'meta_key' => 'event_date',
                'orderby' => 'meta_value',
                'order' => 'DESC',
                'meta_type' => 'DATETIME',
                'meta_query' => array(
                    array(
                        'key' => 'event_date',
                        'compare' => '>=',
                        'value' => $today_string,
                        'type' => 'DATE'
                    )
                )
            ));
            if ($homepage_events->have_posts()):
                while ($homepage_events->have_posts()):
                    $homepage_events->the_post();
                    $homepage_events_excerpt = get_the_excerpt();

                    ?>
                    <div class="event-summary">
                        <a class="event-summary__date t-center" href="#">
                            <?php
                            $event_date_field = get_field('event_date');
                            $event_date_time_object = new DateTime($event_date_field);

                            ?>

                            <span class="event-summary__month"><?php echo $event_date_time_object->format('M'); ?></span>
                            <span class="event-summary__day"><?php echo $event_date_time_object->format('d'); ?></span>
                        </a>
                        <div class="event-summary__content">
                            <h5 class="event-summary__title headline headline--tiny">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h5>
                            <h6 style="margin: 0;padding:0;color:deepskyblue;">At: <?php ?>
                            </h6>

                            </h2>
                            <p>
                                <?php
                                if (has_excerpt()):
                                    echo get_the_excerpt() . '...';
                                else:
                                    echo wp_trim_words(get_the_content(), 15, '...');
                                endif;
                                ?>
                                <a href="<?php the_permalink(); ?>" class="nu gray">Learn more</a>
                            </p>
                        </div>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
            else:
                ?>
                <div>
                    <h2>No up comming event</h2>
                </div>
                <?php
            endif;
            ?>

            <p class="t-center no-margin">
                <a href="<?php echo get_post_type_archive_link('event'); ?>" class="btn btn--blue">View All Events</a>
            </p>
        </div>
    </div>
    <div class="full-width-split__two">
        <div class="full-width-split__inner">
            <h2 class="headline headline--small-plus t-center">From Our Blogsss</h2>
            <?php
            $homepage_posts = new WP_Query(array(
                'post_type' => 'post',
                'posts_per_page' => 2
            ));
            if ($homepage_posts->have_posts()):
                while ($homepage_posts->have_posts()):
                    $homepage_posts->the_post();
                    $homepage_posts_excerpt = get_the_excerpt();

                    ?>
                    <div class="event-summary">
                        <a class="event-summary__date event-summary__date--beige t-center" href="#">
                            <span class="event-summary__month"><?php echo get_the_date('M') ?></span>
                            <span class="event-summary__day"><?php the_time('d'); ?></span>
                        </a>
                        <div class="event-summary__content">
                            <h5 class="event-summary__title headline headline--tiny">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h5>
                            <p>
                                <?php echo get_first_n_words($homepage_posts_excerpt, 15, '...'); ?>
                                <a href="<?php the_permalink(); ?>" class="nu gray">Read more</a>
                            </p>
                        </div>
                    </div>

                    <?php

                endwhile;
                wp_reset_postdata();
            endif;

            ?>
            <p class="t-center no-margin">
                <a href="<?php echo esc_url(site_url('/blog')); ?>" class="btn btn--yellow">View All Blog Posts</a>
            </p>
        </div>
    </div>
</div>

<div class="hero-slider">
    <div data-glide-el="track" class="glide__track">
        <div class="glide__slides">
            <div class="hero-slider__slide"
                style="background-image: url('<?php echo get_template_directory_uri() . '/images/bus.jpg' ?>')">
                <div class="hero-slider__interior container">
                    <div class="hero-slider__overlay">
                        <h2 class="headline headline--medium t-center">
                            Free Transportation
                        </h2>
                        <p class="t-center">
                            All students have free unlimited bus fare.
                        </p>
                        <p class="t-center no-margin">
                            <a href="#" class="btn btn--blue">Learn more</a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="hero-slider__slide"
                style="background-image: url('<?php echo get_template_directory_uri() . '/images/apples.jpg' ?>')">
                <div class="hero-slider__interior container">
                    <div class="hero-slider__overlay">
                        <h2 class="headline headline--medium t-center">
                            An Apple a Day
                        </h2>
                        <p class="t-center">
                            Our dentistry program recommends eating apples.
                        </p>
                        <p class="t-center no-margin">
                            <a href="#" class="btn btn--blue">Learn more</a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="hero-slider__slide"
                style="background-image: url('<?php echo get_template_directory_uri() . '/images/bread.jpg' ?>')">
                <div class="hero-slider__interior container">
                    <div class="hero-slider__overlay">
                        <h2 class="headline headline--medium t-center">Free Food</h2>
                        <p class="t-center">
                            Fictional University offers lunch plans for those in need.
                        </p>
                        <p class="t-center no-margin">
                            <a href="#" class="btn btn--blue">Learn more</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="slider__bullets glide__bullets" data-glide-el="controls[nav]"></div>
    </div>
</div>
<?php
get_footer();
?>