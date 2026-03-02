<?php get_header(); ?>
single-event.php
<?php if (have_posts()): ?>
    <?php while (have_posts()):
        the_post(); ?>

        <div class="page-banner">
            <div class="page-banner__bg-image"
                style="background-image: url('<?php echo esc_url(get_theme_file_uri('/images/ocean.jpg')); ?>')">
            </div>

            <div class="page-banner__content container container--narrow">
                <h1 class="page-banner__title">
                    <?php the_title(); ?>
                </h1>
            </div>
        </div>

        <div class="container container--narrow page-section">

            <div class="metabox metabox--position-up metabox--with-home-link">
                <p>
                    <a class="metabox__blog-home-link" href="<?php echo esc_url(site_url('/event')); ?>">
                        <i class="fa fa-home"></i> Event Home
                    </a>
                </p>
            </div>

            <div class="single-event-date">
                <strong>Held on:</strong>
                <?php
                $event_place = get_field('event_place');
                echo $event_place ? esc_html($event_place['value']) : 'No event place specified.';
                ?>
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