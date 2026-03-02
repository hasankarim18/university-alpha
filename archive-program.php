archive-program.php <br>

<?php get_header(); ?>

<div class="page-banner">
    <div class="page-banner__bg-image"
        style="background-image: url('<?php echo get_theme_file_uri('/images/archive.jpg') ?>')"></div>
    <div class="page-banner__content container container--narrow">
        <h1 class="page-banner__title">
            <?php the_archive_title(); ?>

        </h1>
        <div class="page-banner__intro">
            <p>
                <?php the_archive_description(); ?>
            </p>
        </div>
    </div>
</div>

<!-- showing all blogs -->

<div class="container container--narrow page-section <?php ?> ">

    <ul class="link-list min-list">
        <?php

        while (have_posts()) {
            the_post();
            ?>
            <li>
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </li>
            <?php
        }
        // the_posts_pagination();
        


        ?>
    </ul>

    <div style="padding-top:30px;" class="pagination">
        <?php echo paginate_links(); ?>
    </div>


</div>
<?php get_footer(); ?>