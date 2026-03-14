<?php
if (!is_user_logged_in()):
    wp_redirect(esc_url(site_url('/')));

    exit;
else:
    ?>

    <?php get_header(); ?>
    <?php
    pageBanner();
    ?>


    <!-- showing all blogs -->

    <div class="container container--narrow page-section">
        <h1 class="headline">All Notes</h1>

        <div class="create-note">
            <h2 class="headline headline--medium">Create New Note</h2>
            <input class="new-note-title" placeholder="Title" type="text">
            <textarea class="new-note-body" name="" placeholder="Your note here" id=""></textarea>
            <span class="submit-note">Create Note</span>
            <span class="note-limit-message">Note limit reach: delete an existing note to make room for a new one </span>
        </div>
        <ul id="my-notes" class="min-list link-list">
            <?php
            $userNotes = new WP_Query([
                'post_type' => 'note',
                'posts_per_page' => -1,
                'orderby' => 'date',
                'order' => 'DESC',
                'author' => get_current_user_id() // user specific
        
            ])
                ?>

            <?php
            $i = 1;
            while ($userNotes->have_posts()):
                $userNotes->the_post();
                $note_id = get_the_ID();
                $title = str_replace("Private:", "", esc_attr(get_the_title()));
                //  $slug
                ?>
                <li data-id="<?php the_ID(); ?>">
                    <input readonly class="note-title-field" type="text" value=" <?php echo $title; ?>">
                    <span id="myNoteEdit" class="edit-note"><i class="fa fa-pencil" area-hidden="true"> Edit </i></span>
                    <span id="myNoteDelete" class="delete-note"><i class="fa fa-trash" area-hidden="true"> Delete</i></span>

                    <textarea readonly class="note-body-field" name="" id=""><?php echo esc_textarea(wp_strip_all_tags(get_the_content()));
                    ?> </textarea>
                    <span id="myNoteEdit" class="update-note btn btn--blue btn--small"><i class="fa fa-arrow-right"
                            area-hidden="true"> Save </i></span>
                </li>
                <?php
                $i++;
            endwhile;
            wp_reset_postdata();

            ?>

        </ul>
    </div>
    <?php get_footer(); ?>

    <?php
endif;
?>