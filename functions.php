<?php

// custom api endpoints 
require(get_template_directory() . '/includes/CustomApiEndpoints.php');

function university_custom_rest()
{

    register_rest_field('post', 'author_name', [
        'get_callback' => function () {
            return get_the_author();
        }
    ]);
}

add_action('rest_api_init', 'university_custom_rest');

function pageBanner($args = null)
{
    // php logic will live here 
    ?>
    <?php
    if (!isset($args['title'])) {
        $args['title'] = get_the_title();
    }

    if (!isset($args['subtitle'])) {
        $args['subtitle'] = get_field('page_banner_subtitle');
    }

    if (!isset($args['banner_image'])) {
        $args['banner_image'] = get_theme_file_uri('/images/ocean.jpg');
        $image_field = get_field('page_banner_background_image');

        if (isset($image_field) && is_array($image_field)) {
            $args['banner_image'] = $image_field['sizes']['pageBanner'];
        }
    }

    ?>
    <div class="page-banner">
        <div class="page-banner__bg-image" style="background-image: url('<?php echo $args['banner_image']; ?>')"></div>
        <div class="page-banner__content container container--narrow">
            <h1 class="page-banner__title">
                <?php echo esc_html($args['title']); ?>
            </h1>
            <div class="page-banner__intro">
                <p><?php echo esc_html($args['subtitle']); ?></p>
            </div>
        </div>
    </div>
    <?php
}



function setup_theme_nav_menu()
{
    register_nav_menus(array(
        'header-menu' => __('UA Header menu (header-menu)', 'universityalpha'),
        'footer-menu-1' => __('UA Footer menu (footer-menu-1)', 'universityalpha'),
        'footer-menu-2' => __('UA Footer menu 2 (footer-menu-2)', 'universityalpha'),
        'footer-menu-3' => __('UA Social Icon (footer-menu-3)', 'universityalpha'),
        'sidebar-menu' => __('UA Sidebar menu (sidebar-menu)', 'universityalpha'),
    ));
}

add_action('after_setup_theme', 'setup_theme_nav_menu');


// includeing assets

include_once get_template_directory() . '/includes/loadAssets.php';

function university_features()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_image_size('professorLandscape', 400, 260, true);
    add_image_size('professorPortrait', 380, 450, true);
    add_image_size('pageBanner', 1500, 350, true);
}


add_action('after_setup_theme', 'university_features');


// importing post types 

include_once get_template_directory() . '/includes/postTypes.php';


// how to take first n words 


function get_first_n_words($string, $num_words = 100, $append = '...')
{
    $words = explode(' ', $string);
    if (count($words) < $num_words) {
        return $string;
    }

    $limited_words = array_slice($words, 0, $num_words);
    $new_string = implode(' ', $limited_words);
    return $new_string . $append;
}


function university_adjust_queries($query)
{
    // adjust queries for events
    if (
        !is_admin()
        && $query->is_main_query()
        && is_post_type_archive('event')
    ) {
        $query->set('posts_per_page', '5');
        $query->set('orderby', 'meta_value');
        $query->set('order', 'DESC');
        $query->set('meta_key', 'event_date');
        $query->set('meta_type', 'DATETIME');
        $query->set('meta_query', array(
            array(
                'key' => 'event_date',
                'compare' => '>=',
                'value' => date('Y-m-d H:i:s'),
                'type' => 'DATE'
            )
        ));
    }

    if (
        !is_admin()
        && $query->is_main_query()
        && is_post_type_archive('program')
    ) {
        $query->set('posts_per_page', -1);
        $query->set('orderby', 'title');
        $query->set('order', 'ASC');
    }

    if (
        !is_admin()
        && $query->is_main_query()
        && is_search()
    ) {
        $query->set('posts_per_page', -1);

    }


}


add_action('pre_get_posts', 'university_adjust_queries');



// redirect subscriber accounts out of admin and onto homepage

function redirect_subs_to_frontend()
{
    $our_current_user = wp_get_current_user();
    if (count($our_current_user->roles) == 1 && $our_current_user->roles[0] == 'subscriber') {
        wp_redirect(site_url('/'));
        exit;
    }
}
;

add_action('admin_init', 'redirect_subs_to_frontend');


function no_subs_admin_bar()
{
    $our_current_user = wp_get_current_user();
    if (count($our_current_user->roles) == 1 && $our_current_user->roles[0] == 'subscriber') {
        show_admin_bar(false);
    }
}
add_action('wp_loaded', 'no_subs_admin_bar');





?>