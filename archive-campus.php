<?php get_header();
pageBanner();

?>


<!-- showing all blogs -->

<div class="container container--narrow page-section">
    <?php
    while (have_posts()) {
        the_post();
        ?>
        <div class="archive-campus">
            <div class="post-item">
                <h2 class="headline headline--medium headline--post-title"><a
                        href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            </div>

            <div class="generic-content">
                <?php the_excerpt(); ?>
                <p>
                    <a class="btn btn--blue" href="<?php esc_url(the_permalink()); ?>">Continue reading...</a>
                </p>
            </div>

            <div style="padding-top:30px;" class="pagination">
                <?php echo paginate_links(); ?>
            </div>
        </div>
    <?php } ?>

</div>
<?php

get_footer(); ?>