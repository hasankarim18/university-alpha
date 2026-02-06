<?php get_header(); ?>
author.php
<?php
$cur_auth = get_queried_object();

?>
<div class="page-banner">
    <div class="page-banner__bg-image"
        style="background-image: url('<?php echo get_theme_file_uri('/images/author.jpg') ?>')"></div>
    <div class="page-banner__content container container--narrow">
        <h1 class="page-banner__title">

            Posts by <?php the_author($cur_auth->ID); ?>
        </h1>
        <div class="page-banner__intro">
            <div class="author_info">
                <div> <?php echo get_avatar($cur_auth->ID, 96) ?> </div>
                <div class="author_description">
                    <p>Name: <?php echo esc_html($cur_auth->user_email); ?></p>
                    <p>
                        <?php the_archive_description(); ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- showing all blogs -->

<div class="container container--narrow page-section">

    <div class="metabox metabox--position-up metabox--with-home-link">
        <p>
            <a class="metabox__blog-home-link" href="<?php echo esc_url(site_url()); ?>"><i class="fa fa-home"
                    aria-hidden="true"></i>
                Back to Blog
            </a>
            <span class="metabox__main">
                <?php echo esc_html($cur_auth->display_name); ?>'s Posts
            </span>
        </p>
    </div>
    <?php

    while (have_posts()) {
        the_post();
        ?>
        <div class="post-item">
            <h2 class="headline headline--medium headline--post-title"><a
                    href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        </div>
        <div class="metabox">
            <p>Posted by <?php esc_html(the_author_posts_link()); ?> on <?php the_time('j-M-Y'); ?> in
                <?php echo get_the_category_list('& '); ?>
            </p>
        </div>
        <div class="generic-content">
            <?php the_excerpt(); ?>
            <p>
                <a class="btn btn--blue" href="<?php esc_url(the_permalink()); ?>">Continue reading...</a>
            </p>
        </div>
        <?php
    }
    // the_posts_pagination();
    


    ?>

    <div style="padding-top:30px;" class="pagination">
        <?php echo paginate_links(); ?>
    </div>


</div>
<?php get_footer(); ?>