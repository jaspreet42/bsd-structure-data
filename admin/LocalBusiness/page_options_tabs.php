<div id="mytabs">
    <ul class="nav-tab-wrapper current">
        <li><a class="nav-tab ui-tabs-active ui-state-active" href="#choose-nap-wrap">NAP</a></li>
        <li><a class="nav-tab" href="#client-reviews-wrap">Client Reviews</a></li>
        <li><a class="nav-tab" href="#youtube-videos-wrap">Youtube Videos</a></li>
        <li><a class="nav-tab" href="#menu-options-wrapper">Menu Options</a></li>
    </ul>      
    <div id="choose-nap-wrap" class="meta-options nap_box">

        <p class="meta-options nap_field ">
            <label for="select_nap_location">Select NAP</label>

            <?php
            $selected_nap_value = get_post_meta(get_the_ID(), '_select_nap_location_chkbox', true);
            // print_r($selected_nap_value);
            $i = 1;
            $loop = new WP_Query(array('post_type' => 'nap_location', 'posts_per_page' => -1, 'paged' => $paged));
            if ($loop->have_posts()) :
                while ($loop->have_posts()) : $loop->the_post();
                    //  echo "First checkbox:" . $i . get_the_ID() . "<br/>";
                    ?>
                <div class="meta-options nap_field meta-box-checkbox-wrapper">
                    <input type="hidden" name="select_nap_location_chkbox[<?php echo $i; ?>]" value="0" id="select_nap_location_hidden_chkbox">
                    <input type="checkbox" value="<?php echo get_the_ID(); ?>"
                    <?php
                    if (in_array(get_the_ID(), $selected_nap_value)) {

                        echo "checked='checked'";
                    } else {
                        echo "";
                    }  
                    ?>
                           name="select_nap_location_chkbox[<?php echo $i; ?>]" id="select_nap_location_chkbox" class="select_nap_location_chkbox">
                    <label><?php the_title(); ?></label>
                </div>
                <?php
                $i++;
            endwhile;
        endif;
        ?>
        </p>

        <?php /*         * <select name="select_nap_location" id="select_nap_location" class="select_nap_location">
          <option selected value="">Select Nap Location</option>
          <?php
          echo "seletced value is:". $selected_nap_value =  get_post_meta( get_the_ID(), 'select_nap_location', true );
          $loop = new WP_Query(array('post_type' => 'nap_location', 'posts_per_page' => -1, 'paged' => $paged));
          if ($loop->have_posts()) :
          while ($loop->have_posts()) : $loop->the_post();

          ?>
          <option <?php if($selected_nap_value == get_the_ID()) { ?> selected="selected" <?php } ?> value="<?php echo get_the_ID(); ?>" id="choose-nap-<?php echo get_the_ID(); ?>"><?php the_title(); ?></option>
          <?php
          endwhile;
          endif;
          ?>
          </select>   ** */ ?> 


    </div>
    <div id="client-reviews-wrap" class="meta-options  hidden">
        <div class="meta-options nap_field ">
            <label for="select_nap_location">Reviewed By</label>
            <div class="meta-options nap_field meta-box-input-box-wrapper">
                <input type="text"  name="client_review_reviewed_by_field" id="client_review_reviewed_by_field" class="client_review_reviewed_by_field" value="<?php echo get_post_meta($post->ID, 'client_review_reviewed_by_field', true); ?>" >
            </div>  
        </div>
        <div class="meta-options nap_field ">   
            <label for="select_nap_location">Review Title</label>
            <div class="meta-options nap_field meta-box-input-box-wrapper">
                <input type="text"  name="client_review_review_title_field" id="client_review_review_title_field" class="client_review_review_title_field" value="<?php echo get_post_meta($post->ID, 'client_review_review_title_field', true); ?>">
            </div>
        </div>
        <div class="meta-options nap_field ">
            <label for="select_nap_location">Review Content</label>
            <div class="meta-options nap_field meta-box-input-box-wrapper">
                <textarea id="client_review_content_field" name="client_review_content_field"><?php echo get_post_meta($post->ID, 'client_review_content_field', true); ?></textarea>
            </div>
        </div>
        <div class="meta-options nap_field ">
            <label for="select_nap_location">Star Rating</label>
            <div class="meta-options nap_field meta-box-radiobox-wrapper">
                <?php $starval =  get_post_meta($post->ID, 'client_review_star_rating', true); ?>  
               
                <p>
                    <input type="radio" id="client_review_star_rating_1" value="1" name="client_review_star_rating" <?php if($starval == 1) { echo "checked"; } ?>>
                    <label for="client_review_star_rating_1">1</label>
                </p>
                <p>
                    <input type="radio" id="client_review_star_rating_2" value="2" name="client_review_star_rating" <?php if($starval == 2) { echo "checked"; } ?>>
                    <label for="client_review_star_rating_2">2</label>
                </p>
                <p>
                    <input type="radio" id="client_review_star_rating_3" value="3" name="client_review_star_rating" <?php if($starval == 3) { echo "checked"; } ?>>
                    <label for="client_review_star_rating_3">3</label>
                </p>
                <p>
                    <input type="radio" id="client_review_star_rating_4" value="4" name="client_review_star_rating" <?php if($starval == 4) { echo "checked"; } ?>>
                    <label for="client_review_star_rating_4">4</label>
                </p>
                <p> 
                    <input type="radio" id="client_review_star_rating_5" value="5" name="client_review_star_rating" <?php if($starval == 5) { echo "checked"; } ?>>
                    <label for="client_review_star_rating_5">5</label>
                </p>
            </div>
        </div>
    </div>
    <div id="youtube-videos-wrap" class="meta-options hidden">
       <div class="meta-options nap_field ">
            <label for="video_schema_video_title">Video Title</label>
            <div class="meta-options nap_field meta-box-input-box-wrapper">
                <input type="text"  name="video_schema_video_title" id="video_schema_video_title" class="video_schema_video_title" value="<?php echo get_post_meta($post->ID, 'video_schema_video_title', true); ?>" >
            </div>  
        </div>
        <div class="meta-options nap_field ">
    <label for="video_schema_video_image_url">Video Image URL</label>
    <div class="meta-options nap_field meta-box-input-box-wrapper">
        <input type="url"  name="video_schema_video_image_url" id="video_schema_video_image_url" class="video_schema_video_image_url" value="<?php echo get_post_meta($post->ID, 'video_schema_video_image_url', true); ?>" >
    </div>  
</div>
        <div class="meta-options nap_field ">   
            <label for="video_schema_video_id">You Tube Video ID</label>
            <div class="meta-options nap_field meta-box-input-box-wrapper">
                <input type="text"  name="video_schema_video_id" id="video_schema_video_id" class="video_schema_video_id" value="<?php echo get_post_meta($post->ID, 'video_schema_video_id', true); ?>">
            </div>
        </div>
        <div class="meta-options nap_field ">
            <label for="video_schema_video_description">Video Description</label>
            <div class="meta-options nap_field meta-box-input-box-wrapper">
                <textarea id="video_schema_video_description" name="video_schema_video_description"><?php echo get_post_meta($post->ID, 'video_schema_video_description', true); ?></textarea>
            </div>
        </div>
         <div class="meta-options nap_field ">
            <label for="video_schema_video_date_uploaded">Video Date Uploaded</label>
            <div class="meta-options nap_field meta-box-input-box-wrapper">
                <input type="text" id="video_schema_video_date_uploaded" name="video_schema_video_date_uploaded"  value="<?php echo get_post_meta($post->ID, 'video_schema_video_date_uploaded', true); ?>">
            </div>
        </div>
    </div>
    <div id="menu-options-wrapper" class="meta-options  hidden">
       <div class="meta-options nap_field ">   
            <label for="menu_option_menu_title_field">Menu Title</label>
            <div class="meta-options nap_field meta-box-input-box-wrapper">
                <input type="text"  name="menu_option_menu_title_field" id="menu_option_menu_title_field" class="menu_option_menu_title_field" value="<?php echo get_post_meta($post->ID, 'menu_option_menu_title_field', true); ?>">
            </div>
        </div>
          <div class="meta-options nap_field ">   
            <label for="menu_option_widget_title_field">Widget Title</label>
            <div class="meta-options nap_field meta-box-input-box-wrapper">
                <input type="text"  name="menu_option_widget_title_field" id="menu_option_widget_title_field" class="menu_option_widget_title_field" value="<?php echo get_post_meta($post->ID, 'menu_option_widget_title_field', true); ?>">
            </div>
        </div>
    </div>
</div>