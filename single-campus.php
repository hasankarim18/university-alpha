single-campus.php <br>
<?php get_header(); ?>


<?php if (have_posts()): ?>
    <?php while (have_posts()):
        the_post();
        pageBanner();
        ?>
        <div class="container container--narrow page-section">
            <div class="metabox metabox--position-up metabox--with-home-link">
                <p>
                    <a class="metabox__blog-home-link" href="<?php echo esc_url(get_post_type_archive_link('campus')); ?>">
                        <i class="fa fa-home"></i> Back to all campuses
                    </a>
                </p>
            </div>

            <div class="text-xl">
                <?php the_content(); ?>
            </div>

            <?php
            $related_programs = get_field('related_programs');

            if ($related_programs): ?>
                <div class="related_programs">
                    <h2>Related Programs</h2>
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

    <?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>