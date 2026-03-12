single-program.php
<?php get_header(); ?>


<?php
if (have_posts()) {
    while (have_posts()) {
        the_post();
        pageBanner();
        ?>




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

            <!-- #campuses -->

            <hr class="section-break">

            <div>
                <h2>Campuses</h2>
                <?php
                $camuses = get_field('campuses');
                echo "<h3>";
                echo esc_html($camuses[0]->post_title);
                echo "</h3>";
                ?>

            </div>

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
                    <div class="sp_professor_container">
                        <?php
                        while ($related_prefessors->have_posts()):
                            $related_prefessors->the_post();
                            echo '<u class="professor-cards">';
                            get_template_part('template-parts/content/content', 'professor');
                            echo '</u>';
                        endwhile;
                        wp_reset_postdata();
                        ?>
                    </div>
                    <?php
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

                        get_template_part('template-parts/event/loop', get_post_type());



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