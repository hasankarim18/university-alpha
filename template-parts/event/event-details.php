<?php
$event_date = get_field('event_date');
$ev_obj = new DateTime($event_date);
$today = date('Y-m-d H:i:s');
$event_place = get_field('event_place');

?>

<div class="event_archive_details">

    <div class="event_item">
        <span class="event_label">Event Place</span>
        <span class="event_value">
            <?php
            $event_place = get_field('event_place');
            echo $event_place['value'];
            ?>
        </span>
    </div>

    <div class="event_item">
        <span class="event_label">Event Date</span>
        <span class="event_value">
            <?php echo $ev_obj->format('d M - Y'); ?>
        </span>
    </div>

    <div class="event_item">
        <span class="event_label">Event Time</span>
        <span class="event_value">
            <?php echo $ev_obj->format('h:i a'); ?>
        </span>
    </div>

</div>