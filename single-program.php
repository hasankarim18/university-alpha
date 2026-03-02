single-progam.php
<?php get_header(); ?>


<?php
if (have_posts()) {
    while (have_posts()) {
        the_post();
        ?>
        <div class="page-banner">
            <div class="page-banner__bg-image"
                style="background-image: url('<?php echo get_theme_file_uri('/images/ocean.jpg') ?>')"></div>
            <div class="page-banner__content container container--narrow">
                <h1 class="page-banner__title">
                    <?php the_title(); ?>
                </h1>
                <div class="page-banner__intro">
                    <p>Welcome to our <?php the_title(); ?> program.</p>
                </div>
            </div>
        </div>



        <div class="container container--narrow page-section">
            <div class="metabox metabox--position-up metabox--with-home-link">
                <p>
                    <a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('program'); ?>"><i
                            class="fa fa-home" aria-hidden="true"></i>
                        Back to All Programs</a>
                    <span class="metabox__main">
                        <?php the_title(); ?>
                    </span>
                </p>
            </div>
            <p class="text-xl">
                <?php echo the_content(); ?>
            </p>

            <!-- #professors of this program -->
            <div class="professors_of_this_program">

                <?php
                //   $professor_program_id = get_the_ID();
        
                echo "<br>";
                $related_prefessors = new WP_Query(array(
                    'post_type' => 'professor',
                    'posts_per_page' => -1,
                    'orderby' => 'title',
                    'order' => 'ASC',
                    'meta_query' => array(
                        array(
                            'key' => 'related_programs',
                            'compare' => 'LIKE',
                            'value' => '"' . get_the_ID() . '"',
                            //'type' => 'string'
                        )
                    )
                ));
                if ($related_prefessors->have_posts()):
                    ?>
                    <hr class="section-break">
                    <!-- #related events -->
                    <h2 class="headline headline--medium">Professors:</h2>

                    <?php
                    while ($related_prefessors->have_posts()):
                        $related_prefessors->the_post();

                        ?>
                        <div class="event-summary">

                            <div class="event-summary__content">
                                <h5 class="event-summary__title headline headline--tiny">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </h5>

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


                        // echo "Related programs: "
                        //  echo "Related event founds";
        

                    endwhile;
                    wp_reset_postdata();
                else:
                    echo 'No professor found';
                endif;

                ?>
            </div>

            <div class="program_related_events">

                <?php
                $program_id = get_the_ID();

                echo "<br>";
                $related_events = new WP_Query(array(
                    'post_type' => 'event',
                    'posts_per_page' => -1,
                    'meta_key' => 'event_date',
                    'orderby' => 'meta_value',
                    'order' => 'DESC',
                    'meta_type' => 'DATETIME',
                    'meta_query' => array(
                        array(
                            'key' => 'related_programs',
                            'compare' => 'LIKE',
                            'value' => '"' . $program_id . '"',
                            //'type' => 'string'
                        )
                    )
                ));
                if ($related_events->have_posts()):
                    ?>
                    <hr class="section-break">
                    <!-- #related events -->
                    <div class="single-program-events">

                        <h3 class="headline headline--small">
                            Events orgamized by <u> <?php echo esc_html(get_the_title()); ?> </u> Program
                        </h3>
                        <div class="up_past_events">
                            <span>Upcomming events:</span> <span class="upcomming_events"></span>
                            <!--  -->
                            <span>Past events:</span> <span class="past_events"></span>
                        </div>
                    </div>
                    <?php
                    while ($related_events->have_posts()):
                        $related_events->the_post();
                        $event_date = get_field('event_date');
                        $ev_obj = new DateTime($event_date);
                        $today = date('Y-m-d H:i:s');
                        $bg_color = 'MidnightBlue';

                        if ($ev_obj->format('Y-m-d H:i:s') < $today):
                            $bg_color = 'coral';
                        endif;
                        ?>
                        <div class="event-summary">
                            <a style="background-color:<?php echo $bg_color; ?>" class="event-summary__date t-center" href="#">
                                <?php
                                $event_date_field = get_field('event_date');
                                $event_date_time_object = new DateTime($event_date_field);

                                ?>

                                <span class="event-summary__month">
                                    <?php echo $event_date_time_object->format('M'); ?>
                                </span>
                                <span class="event-summary__day">
                                    <?php echo $event_date_time_object->format('d'); ?>
                                </span>
                            </a>
                            <div class="event-summary__content">
                                <h5 class="event-summary__title headline headline--tiny">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </h5>

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


                        // echo "Related programs: "
                        //  echo "Related event founds";
        

                    endwhile;
                    wp_reset_postdata();
                else:
                    echo '';
                endif;

                ?>
            </div>

        </div>


        </div>

    <?php }
}
?>


<?php get_footer(); ?>