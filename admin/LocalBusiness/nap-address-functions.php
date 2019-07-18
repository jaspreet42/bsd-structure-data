<?php
/* * **Custom Post Type NAP**** */

function nap_init() {
    $args = array(
        'label' => 'NAP',
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => array('slug' => 'nap_location'),
        'query_var' => true,
        'menu_icon' => 'dashicons-sticky',
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'trackbacks',
            'comments',
            'revisions',
            'thumbnail',
            'author',
            'page-attributes',)
    );
    register_post_type('nap_location', $args);
}

add_action('init', 'nap_init');

/**
 * Register meta boxes.
 */
function nap_register_meta_boxes() {

    add_meta_box('nap-1', __('NAP Details', 'nap'), 'nap_display_callback', 'nap_location');
    add_meta_box('featured-nap-1', __('Featured NAP Location', 'featured-nap'), 'featured_nap_display_callback', 'nap_location');
}

add_action('add_meta_boxes', 'nap_register_meta_boxes');

/**
 * Meta box display callback.
 *
 * @param WP_Post $post Current post object.
 */
function nap_display_callback($post) {
    include plugin_dir_path(__FILE__) . '/nap-address-form-fields.php';
}

/**
 * Meta box display callback.
 *
 * @param WP_Post $post Current post object.
 */
function featured_nap_display_callback($post) {
    include plugin_dir_path(__FILE__) . '/featured-nap-address-form-fields.php';
}

/**
 * Save meta box content.
 *
 * @param int $post_id Post ID
 */
function nap_save_meta_box($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;
    if ($parent_id = wp_is_post_revision($post_id)) {
        $post_id = $parent_id;
    }
    $fields = [
        'nap_attorney_name',
        'nap_street_address',
        'nap_suite_number',
        'nap_city_county',
        'nap_state',
        'nap_country',
        'nap_published_date',
        'nap_zip_code',
        'nap_phone_number',
        'nap_fax_number',
        'nap_direction_link',
        'nap_map_iframe_code',
        'nap_office_timings',
        'video_schema_video_title',
        'video_schema_video_image_url',
        'video_schema_video_id',
        'video_schema_video_description',
        'video_schema_video_date_uploaded'
    ];


    // to update featured post
    update_post_meta($post_id, 'is_featured_nap_location', $_POST["is_featured_nap_location"]);
    update_post_meta($post_id, 'is_main_nap_location', $_POST["is_main_nap_location"]);

    foreach ($fields as $field) {
        if (array_key_exists($field, $_POST)) {
            update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
        }
    }
}

add_action('save_post', 'nap_save_meta_box');

/* * *************
 * Make NAP Featured
 */
add_filter('manage_nap-location_posts_columns', 'featured_nap_posts_columns');

function featured_nap_posts_columns($columns) {
    $columns['featured'] = __('Featured');
    return $columns;
}

add_action('manage_nap-location_posts_custom_column', 'featured_nap_locations_column', 10, 2);

function featured_nap_locations_column($column, $post_id) {
    // Image column
    if ('featured' === $column) {
        $check_featured1 = get_post_meta(get_the_ID(), 'is_featured_nap_location', true);
        ?>
        <form method='post'>
            <input <?php if ($check_featured1 == "yes") {
            echo "checked=checked";
        } else {
            
        } ?> type='checkbox' post-data="<?php echo get_the_ID() ?>"  id='niew<?php echo get_the_ID() ?>' class='featured-post-icons'>
        </form>

        <script>

            var ajax_url = "../wp-admin/admin-ajax.php";
            $('input#niew<?php echo get_the_ID(); ?>').change(function () {

                if (jQuery('input#niew<?php echo get_the_ID(); ?>').is(':checked')) {
                    var featur_val = 'yes';
                } else {
                    var featur_val = 'No';
                }

                var post_data = jQuery('#niew<?php echo get_the_ID(); ?>').attr('post-data');
                jQuery.ajax({
                    url: ajax_url,
                    type: 'POST',
                    data: {post_data: post_data, featur_val: featur_val, action: 'my_ajax'},
                    success: function (response) {
                        console.log(response);

                    }
                });

            });



        </script>   
        <?php
    }
}

add_action('wp_ajax_my_ajax', 'my_ajax');
add_action('wp_ajax_nopriv_my_ajax', 'my_ajax');

function my_ajax() {

    $featuredboxcheck = $_POST["featuredboxcheck"];
    $post_data = $_POST["post_data"];
    $featur_val = $_POST["featur_val"];
    update_post_meta($post_data, 'is_featured_nap_location', $featur_val);

    exit();
}
?>