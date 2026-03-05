<div class="event-summary">

    <?php
    $event_date_field = get_field('event_date');
    $event_date_time_object = new DateTime($event_date_field);


    $today = date('Y-m-d H:i:s');
    $bg_color = 'MidnightBlue';

    if ($event_date_time_object->format('Y-m-d H:i:s') < $today):
        $bg_color = 'coral';
    endif;

    ?>
    <a style="background-color: <?php echo esc_attr($bg_color); ?>;" class="event-summary__date t-center" href="#">
        <span class="event-summary__month">
            <?php echo $event_date_time_object->format('M'); ?>
        </span>
        <span class="event-summary__day">
            <?php echo $event_date_time_object->format('d'); ?>
        </span>
    </a>
    <div class="event-summary__content">
        <h5 class="event-summary__title headline headline--tiny">
            <a href="<?php the_permalink(); ?>">
                <?php the_title(); ?>
            </a>
        </h5>

        <p>
            <?php
            if (has_excerpt()):
                echo get_the_excerpt() . '...';
            else:
                echo wp_trim_words(get_the_content(), 15, '...');
            endif;
            ?>
            <a href="<?php the_permalink(); ?>" class="nu gray">Learn more</a>
        </p>
    </div>
</div>