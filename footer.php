<footer class="site-footer">
    <div class="site-footer__inner container container--narrow">
        <div class="group">
            <div class="site-footer__col-one">
                <h1 class="school-logo-text school-logo-text--alt-color">
                    <a href="<?php echo site_url(); ?>"><strong>Fictional</strong> University</a>
                </h1>
                <p><a class="site-footer__link" href="#">555.555.5555</a></p>
            </div>

            <div class="site-footer__col-two-three-group">
                <div class="site-footer__col-two">
                    <h3 class="headline headline--small">Explore</h3>
                    <nav class="nav-list">
                        <ul>
                            <?php
                            wp_nav_menu([
                                'theme_location' => 'footer-menu-1'
                            ]);
                            ?>
                        </ul>
                    </nav>
                </div>

                <div class="site-footer__col-three">
                    <h3 class="headline headline--small">Learn</h3>
                    <nav class="nav-list">
                        <ul>
                            <?php
                            wp_nav_menu([
                                'theme_location' => 'footer-menu-2'
                            ]);
                            ?>

                        </ul>
                    </nav>
                </div>
            </div>

            <div class="site-footer__col-four">
                <h3 class="headline headline--small">Connect With Us</h3>
                <nav>
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
                                    <a href="<?php echo esc_url($item->url); ?>"
                                        class="social-color-<?php echo $item->title; ?>">
                                        <i class="fa fa-<?php echo $item->title; ?>" aria-hidden="true"></i>
                                    </a>
                                </li>

                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                </nav>
            </div>
        </div>
    </div>
</footer>
<div class="search-overlay ">
    <div class="search-overlay__top">
        <div class="container">
            <i class="fa fa-search search-overlay__icon" aria-hidden="true"></i>
            <input type="text" class="search-term" placeholder="What are you looking for?" id="search-term"
                autocomplete="off">
            <i id="search-close-button" class="fa fa-window-close search-overlay__close" aria-hidden="true"></i>
        </div>
    </div>
    <!-- search results -->
    <div class="container">
        <div id="search-overlay__results"></div>
    </div>
</div>
<?php wp_footer(); ?>
</body>

</html>