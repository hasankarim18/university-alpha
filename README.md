# University Alpha Theme

## Wordpress theme for a fictional university

### Way to get Wordpress menu manually

```
  <?php

    $menu_name = 'footer-menu-3';
    $locations = get_nav_menu_locations();
    $menu = wp_get_nav_menu_object($locations[$menu_name]);
    $menuitems = wp_get_nav_menu_items($menu->term_id, array('order' => 'DESC'));


    if ($menuitems):
        ?>
        <ul class="min-list social-icons-list group">
            <?php foreach ($menuitems as $item): ?>
                <li>
                    <?php
                    echo $item->title;
                    ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
```

### How to do pagination using WP_Query

```
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

```
