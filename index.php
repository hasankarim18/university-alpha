<?php get_header(); ?>

<div class="page-banner">
    <div class="page-banner__bg-image"
        style="background-image: url('<?php echo get_theme_file_uri('/images/ocean.jpg') ?>')"></div>
    <div class="page-banner__content container container--narrow">
        <h1 class="page-banner__title">
            Welcome to our blog!
        </h1>
        <div class="page-banner__intro">
            <p>Keep up with out latest news.</p>
        </div>
    </div>
</div>

<!-- showing all blogs -->

<div class="container container--narrow page-section">
    <?php
    $paged = get_query_var('paged') ? get_query_var('paged') : 1;
    $post_query = new WP_Query([
        'post_type' => 'post',
        'posts_per_page' => 2,
        'paged' => $paged

    ]);

    if ($post_query->have_posts()):
        while ($post_query->have_posts()):
            $post_query->the_post();
            ?>
            <div class="post-item">
                <h3><?php echo esc_html(get_the_title()); ?></h3>
            </div>
            <?php
        endwhile;
        echo paginate_links([
            'total' => $post_query->max_num_pages,
            'current' => $paged,
        ]);

        wp_reset_postdata();

    endif;

    ?>


</div>
<?php get_footer(); ?>