<?php

get_header(); ?>
archive-event.php

<?php
pageBanner([
    'title' => 'Events - University Alpha',

]);
?>

<div class="container container--narrow page-section">

    <?php


    if (have_posts()):
        while (have_posts()):
            the_post();

            ?>
            <?php
            get_template_part('template-parts/event/loop', get_post_type());
            ?>

            <?php
        endwhile;

        the_posts_pagination();
        ?>
        <hr class="section-break">
        <p style="text-align: right;"> Looking for a recap of past
            events?<a href="<?php echo site_url('/past-events') ?>">Check out our past eents archive.</a>
        </p>
        <?php
    endif;
    ?>

</div>

<?php get_footer();

?>