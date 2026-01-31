<!--  -->
<?php get_header(); ?>
<div class="page-banner">
    <div class="page-banner__bg-image"
        style="background-image: url('<?php echo get_theme_file_uri('/images/ocean.jpg') ?>')"></div>
    <div class="page-banner__content container container--narrow">
        <h1 class="page-banner__title">
            <?php the_title(); ?>
        </h1>
        <div class="page-banner__intro">
            <p>Post or page intro replace later</p>
        </div>
    </div>
</div>



<div class="container container--narrow page-section">
    <?php
    // show metabox if page is child page
    $post_id = get_the_ID();
    $if_child_then_parent_id = wp_get_post_parent_id($post_id);

    if ($if_child_then_parent_id != 0) {
        ?>
        <div class="metabox metabox--position-up metabox--with-home-link">
            <p>
                <a class="metabox__blog-home-link" href="<?php echo get_the_permalink($if_child_then_parent_id); ?>"><i
                        class="fa fa-home" aria-hidden="true"></i>
                    Back to Us <?php echo esc_html(get_the_title($if_child_then_parent_id)); ?></a>
                <span class="metabox__main"><?php echo esc_html(get_the_title(get_the_ID())); ?></span>
            </p>
        </div>

        <?php
    }
    ?>

    <?php
    $page_has_child = get_pages([
        'post_type' => 'page',
        'child_of' => get_the_ID()
    ]);
    // show when page is a child or has children
    // $if_child_then_parent_id == parent page 
    // $past_has_child == this page is a parent page and must have child
    if ($if_child_then_parent_id or $page_has_child) {
        ?>

        <div class="page-links">
            <h2 class="page-links__title"><a href="#">
                    <?php echo esc_html(get_the_title(get_the_ID())); ?>
                </a></h2>
            <ul class="min-list">

                <?php

                // parent
                if ($if_child_then_parent_id == 0) {
                    wp_list_pages([
                        'post_type' => 'page',
                        "child_of" => get_the_ID(),
                        'title_li' => null
                    ]);
                } else {
                    wp_list_pages([
                        'post_type' => 'page',
                        'title_li' => null,
                        "child_of" => $if_child_then_parent_id

                    ]);
                }
                ?>

            </ul>
        </div>

    <?php }
    ; ?>

    <div class="generic-content">
        <?php
        the_content();
        ?>
    </div>
</div>
<!-- 
<div class="page-section page-section--beige">
    <div class="container container--narrow generic-content">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officia voluptates vero vel temporibus aliquid
            possimus, facere accusamus modi. Fugit saepe et autem, laboriosam earum reprehenderit illum odit nobis,
            consectetur dicta. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos molestiae, tempora alias
            atque vero officiis sit commodi ipsa vitae impedit odio repellendus doloremque quibusdam quo, ea veniam, ad
            quod sed.</p>

        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officia voluptates vero vel temporibus aliquid
            possimus, facere accusamus modi. Fugit saepe et autem, laboriosam earum reprehenderit illum odit nobis,
            consectetur dicta. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos molestiae, tempora alias
            atque vero officiis sit commodi ipsa vitae impedit odio repellendus doloremque quibusdam quo, ea veniam, ad
            quod sed.</p>
    </div>
</div>
 -->
<div class="page-section page-section--white">
    <div class="container container--narrow">
        <h2 class="headline headline--medium">Biology Professors:</h2>

        <ul class="professor-cards">
            <li class="professor-card__list-item">
                <a href="#" class="professor-card">
                    <img class="professor-card__image"
                        src="<?php echo get_theme_file_uri('images/barksalot.jpg'); ?>" />
                    <span class="professor-card__name">Dr. Barksalot</span>
                </a>
            </li>
            <li class="professor-card__list-item">
                <a href="#" class="professor-card">
                    <img class="professor-card__image"
                        src="<?php echo get_theme_file_uri('images/meowsalot.jpg') ?> " />
                    <span class="professor-card__name">Dr. Meowsalot</span>
                </a>
            </li>
        </ul>
        <hr class="section-break" />

        <div class="row group generic-content">
            <div class="one-third">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officia voluptates vero vel temporibus
                    aliquid possimus, facere accusamus modi. Fugit saepe et autem, laboriosam earum reprehenderit illum
                    odit nobis, consectetur dicta. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos
                    molestiae, tempora alias atque vero officiis sit commodi ipsa vitae impedit odio repellendus
                    doloremque quibusdam quo, ea veniam, ad quod sed.</p>
            </div>

            <div class="one-third">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officia voluptates vero vel temporibus
                    aliquid possimus, facere accusamus modi. Fugit saepe et autem, laboriosam earum reprehenderit illum
                    odit nobis, consectetur dicta. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos
                    molestiae, tempora alias atque vero officiis sit commodi ipsa vitae impedit odio repellendus
                    doloremque quibusdam quo, ea veniam, ad quod sed.</p>
            </div>

            <div class="one-third">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officia voluptates vero vel temporibus
                    aliquid possimus, facere accusamus modi. Fugit saepe et autem, laboriosam earum reprehenderit illum
                    odit nobis, consectetur dicta. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos
                    molestiae, tempora alias atque vero officiis sit commodi ipsa vitae impedit odio repellendus
                    doloremque quibusdam quo, ea veniam, ad quod sed.</p>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>