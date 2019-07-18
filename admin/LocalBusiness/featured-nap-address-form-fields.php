<div class="nap_box">
    <p class="meta-options nap_field meta-box-checkbox-wrapper">
        <?php
        global $post;
        $custom = get_post_custom($post->ID);
        $field_id = $custom["is_featured_nap_location"][0];
        $check_featured = get_post_meta(get_the_ID(), 'is_featured_nap_location', true);
        ?>
        <input <?php
        if ($check_featured == "yes") {
            echo "checked=checked";
        } else {
            
        }
        ?> id="is_featured_nap_location" value="yes" type="checkbox" name="is_featured_nap_location">
        <label for="is_featured_nap_location">Check this to make it featured</label>
    </p>
    <div class="fullwidth label1">(Only For Schema Purposes)</div>
    <p class="meta-options nap_field meta-box-checkbox-wrapper">
        <?php
        $field_id_1 = $custom["is_main_nap_location"][0];
        $check_featured_1 = get_post_meta(get_the_ID(), 'is_main_nap_location', true);
        ?>
        <input <?php
        if ($check_featured_1 == "yes") {
            echo "checked=checked";
        } else {
            
        }
        ?> id="is_main_nap_location" value="yes" type="checkbox" name="is_main_nap_location">
        <label for="is_main_nap_location">Check this to make it main address</label>
    </p>
</div>