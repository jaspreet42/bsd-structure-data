<div class="nap_box">

    <p class="meta-options nap_field">
        <label for="nap_attorney_name">Attorney/Business Name</label>
        <input id="nap_attorney_name" value="<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_attorney_name', true)); ?>" type="text" name="nap_attorney_name">
    </p>
    <p class="meta-options nap_field">
        <label for="nap_street_address">Street Address</label>
        <input id="nap_street_address" value="<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_street_address', true)); ?>" type="text" name="nap_street_address">
    </p>
    <p class="meta-options nap_field">
        <label for="nap_suite_number">Suite Number</label>
        <input id="nap_suite_number" value="<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_suite_number', true)); ?>" type="text" name="nap_suite_number">
    </p>
    <p class="meta-options nap_field">
        <label for="nap_city_county">City/County</label>
        <input id="nap_city_county"  value="<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_city_county', true)); ?>" type="text" name="nap_city_county">
    </p>
    <p class="meta-options nap_field">
        <label for="nap_state">State</label>
        <input id="nap_published_date" value="<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_state', true)); ?>" type="text" name="nap_state">
    </p>
     <p class="meta-options nap_field">
        <label for="nap_state">Country</label>
        <input id="nap_published_date" value="<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_country', true)); ?>" type="text" name="nap_country">
    </p>
    <p class="meta-options nap_field">
        <label for="nap_zip_code">Zip Code</label>
        <input id="nap_zip_code" type="text" value="<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_zip_code', true)); ?>" name="nap_zip_code">
    </p>
    <p class="meta-options nap_field">
        <label for="nap_phone_number">Phone Number</label>
        <input id="nap_phone_number" type="text" value="<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_phone_number', true)); ?>" name="nap_phone_number">
    </p>

    <p class="meta-options nap_field">
        <label for="nap_fax_number">Fax Number</label>
        <input id="nap_fax_number" type="text" value="<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_fax_number', true)); ?>" name="nap_fax_number">
    </p>
    <p class="meta-options nap_field">
        <label for="nap_direction_link">Get Directions Link</label>
        <input id="nap_direction_link" type="text" value="<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_direction_link', true)); ?>" name="nap_direction_link">
    </p>
    <p class="meta-options nap_field">
        <label for="nap_map_iframe_code">MAP (Iframe Source Code)</label>
        <input id="nap_map_iframe_code" type="text" value="<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_map_iframe_code', true)); ?>" name="nap_map_iframe_code">
    </p>
     <p class="meta-options nap_field">
        <label for="nap_office_timings">Office Timings</label>
        <input id="nap_office_timings" type="text" value="<?php echo esc_attr(get_post_meta(get_the_ID(), 'nap_office_timings', true)); ?>" name="nap_office_timings">
    </p>
</div>