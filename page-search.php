<!--  -->
<?php get_header(); ?>
page-search.php
<?php
$page_title = get_the_title();
if (is_page(31)) {
    $page_title = 'About Us - University Alpha';
    pageBanner([
        'title' => $page_title
    ]);
} else {
    pageBanner();
}


?>



<div class="container container--narrow page-section">
    <div class="generic-content">
        <form class="search-form" method="get" action="<?php echo esc_url(site_url('/')); ?> ">
            <label class="headline headline--medium" form="s" for="">Perform a new search.</label>
            <div class="search-form-row">
                <input placeholder="What are you looking for?" class="s" id="s" type="search" name="s">

                <input class="search-submit" type="submit" value="Search">
            </div>
        </form>
    </div>
</div>


<?php get_footer(); ?>