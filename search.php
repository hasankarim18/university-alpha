<?php get_header(); ?>search.php

<?php
pageBanner([
    'title' => 'Search - Results',
    'subtitle' => 'You searched for "' . esc_html(get_search_query()) . '"',
    'banner_image' => 'https://cdn.pixabay.com/photo/2015/10/11/10/09/hand-982054_1280.jpg'
]);
?>

<!-- showing all blogs -->

<div class="container container--narrow page-section">
    <?php

    while (have_posts()) {
        the_post();
        get_template_part('template-parts/content/content', get_post_type());

    }
    // the_posts_pagination();
    


    ?>

    <?php // get_search_form(); ?>



</div>
<?php get_footer(); ?>