<?php get_header(); ?>
single-post.php
<?php
if (have_posts()) {
    while (have_posts()) {
        the_post();
        pageBanner();
        ?>



        <div class="container container--narrow page-section">
            <div class="metabox metabox--position-up metabox--with-home-link">
                <p>
                    <a class="metabox__blog-home-link" href="<?php echo site_url('/blog'); ?>"><i class="fa fa-home"
                            aria-hidden="true"></i>
                        Back to Blog</a>
                    <span class="metabox__main">
                        Posted by
                        <?php esc_html(the_author_posts_link()); ?> on
                        <?php the_time('j-M-Y'); ?> in
                        <?php echo get_the_category_list('& '); ?>
                    </span>
                </p>
            </div>
            <p class="text-xl">
                <?php echo the_content(); ?>
            </p>
        </div>

        </div>

    <?php }
}
?>


<?php get_footer(); ?>