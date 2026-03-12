<li class="professor-card__list-item">
    <a class="professor-card" href="<?php the_permalink(); ?>">
        <?php
        if (has_post_thumbnail()) {
            ?>
            <img class="professor-car__image" src="<?php the_post_thumbnail_url('professorLandscape') ?>"
                alt="<?php the_title(); ?>">
            <?php
        } else {
            ?>
            <img style="width: 400px;height:260px;"
                src="<?php echo get_template_directory_uri() . '/images/backup-thumbnail.png' ?>" alt="Default Thumbnail"
                width="400" height="260" />

        <?php }
        ?>
        <span class="professor-card__name">
            <?php the_title(); ?>
        </span>
    </a>
</li>