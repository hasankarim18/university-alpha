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
