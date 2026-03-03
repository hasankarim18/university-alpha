single-professor.php #
<?php get_header(); ?>


<?php
if (have_posts()) {
    while (have_posts()) {
        the_post();
        ?>
        <div>
            <div class="page-banner">
                <div class="page-banner__bg-image"
                    style="background-image: url('<?php echo get_theme_file_uri('/images/ocean.jpg') ?>')"></div>
                <div class="page-banner__content container container--narrow">
                    <h1 class="page-banner__title">
                        <?php the_title(); ?>
                    </h1>
                    <div class="page-banner__intro">
                        <p><?php // the_title(); ?></p>
                    </div>
                </div>
            </div>



            <div class="container container--narrow page-section">
                <div class="spro_image_content">
                    <div class="professor_image">
                        <?php
                        if (has_post_thumbnail()) {
                            the_post_thumbnail('professorPortrait');
                        } else {
                            echo '<img style="width:380px;height:550px; border:1px solid #ccc;" src="' . get_template_directory_uri() . '/images/backup-thumbnail.png" alt="Default Thumbnail" />';
                            //  echo get_template_directory_uri();
                        }
                        ?>
                    </div>

                    <?php echo the_content(); ?>
                </div>


                <?php
                $related_programs = get_field('related_programs');

                if ($related_programs): ?>
                    <hr class="section-break">
                    <div class="related_programs">
                        <h2>Subject(s) Taught</h2>
                        <ul class="link-list min-list">
                            <?php foreach ($related_programs as $program): ?>
                                <li>
                                    <a href="<?php echo esc_url(get_permalink($program)); ?>">
                                        <?php echo esc_html(get_the_title($program)); ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
            <!-- relational -->



        </div>

    <?php }
}
?>


<?php get_footer(); ?>