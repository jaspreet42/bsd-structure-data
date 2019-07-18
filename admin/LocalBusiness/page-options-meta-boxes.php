<?php

/**
 * Register meta boxes.
 */
function page_options_meta_boxes() {
    $page_option_selectors = get_option('allSchema_show_page_option_checkbox');
    foreach ($page_option_selectors as $page_option_selector) {
        add_meta_box('page-options-1', __('Page Options', 'page-options-1'), 'page_optoion_display_callback', $page_option_selector);
    }
    add_meta_box('page-options-1', __('Page Options', 'page-options-1'), 'page_optoion_display_callback', 'page');
}

add_action('add_meta_boxes', 'page_options_meta_boxes');

/**
 * Meta box display callback.
 *
 * @param WP_Post $post Current post object.
 */
function page_optoion_display_callback($post) {
    include plugin_dir_path(__FILE__) . '/page_options_tabs.php';
}

/**
 * Save meta box content.
 *
 * @param int $post_id Post ID
 */
function page_options_save_meta_box($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;
    if ($parent_id = wp_is_post_revision($post_id)) {
        $post_id = $parent_id;
    }
//    $fields = [
//        'select_nap_location'
//    ];
//
//    // update_post_meta($post_id, 'nap_attorney_name', 'abc');
//
//    foreach ($fields as $field) {
//        if (array_key_exists($field, $_POST)) {
//
//            update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
//        }
//    }

    global $post;
    // Get our form field
    if (isset($_POST['select_nap_location_chkbox'])) {
        $custom = $_POST['select_nap_location_chkbox'];
        // echo "value is:";
        // $old_meta = get_post_meta($post->ID, '_select_nap_location_chkbox', true);
        // Update post meta
        // if(!empty($old_meta)){

        update_post_meta($post->ID, '_select_nap_location_chkbox', isset($_POST['select_nap_location_chkbox']) ? $custom : 0);
        //} else {
        //add_post_meta($post->ID, '_select_nap_location_chkbox', $custom, true);
        // }
    }



//    if (isset($_POST['client_review_reviewed_by_field'])) {
//        $custom1 = $_POST['client_review_reviewed_by_field'];
//        // echo "value is:";
//        $old_meta1 = get_post_meta($post->ID, '_client_review_reviewed_by_field', true);
//        // Update post meta
//        if (!empty($old_meta)) {
//            die("here");
//            update_post_meta($post->ID, '_client_review_reviewed_by_field', isset($_POST['client_review_reviewed_by_field']) ? $custom1 : 0, $old_meta1);
//        } else {
//            add_post_meta($post->ID, '_client_review_reviewed_by_field', $custom1, true);
//        }
//
//        //die($old_meta1);
//    }
}

add_action('save_post', 'page_options_save_meta_box');


//Saving Fields Data For Review Schema

add_action('save_post', 'save_details', 100, 3);

function save_details($post_id, $post, $update) {

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post->ID;
    }

    update_post_meta($post->ID, "client_review_reviewed_by_field", isset($_POST["client_review_reviewed_by_field"]) ? $_POST["client_review_reviewed_by_field"] : "");
    update_post_meta($post->ID, "client_review_review_title_field", isset($_POST["client_review_review_title_field"]) ? $_POST["client_review_review_title_field"] : "" );
    update_post_meta($post->ID, "client_review_content_field", isset($_POST["client_review_content_field"]) ? $_POST["client_review_content_field"] : "" );
    update_post_meta($post->ID, "client_review_star_rating", isset($_POST["client_review_star_rating"]) ? $_POST["client_review_star_rating"] : "" );
}
add_action('save_post', 'save_menu_options', 100, 3);

function save_menu_options($post_id, $post, $update) {

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post->ID;
    }

    update_post_meta($post->ID, "menu_option_menu_title_field", isset($_POST["menu_option_menu_title_field"]) ? $_POST["menu_option_menu_title_field"] : "");
    update_post_meta($post->ID, "menu_option_widget_title_field", isset($_POST["menu_option_widget_title_field"]) ? $_POST["menu_option_widget_title_field"] : "" );

    
    }