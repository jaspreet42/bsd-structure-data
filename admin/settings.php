<?php
// create custom plugin settings menu
add_action('admin_menu', 'all_schemas_create_menu');

function all_schemas_create_menu() {
    add_menu_page('All Schemas', 'All Schemas', 'manage_options', 'all-schemas', 'all_schemas_page');
    add_submenu_page('all-schemas', 'Schemas Settings', 'Schemas Settings', 'manage_options', 'schemas_settings', 'schema_settings_page');

    //call register settings function
    add_action('admin_init', 'all_schemas_settings');
}

function all_schemas_settings() {

    //register our fields
    //Basic Information Fields
    register_setting('allSchema_basic_information_fields', 'allSchema_website_name');
    register_setting('allSchema_basic_information_fields', 'allSchema_website_description');
    register_setting('allSchema_basic_information_fields', 'allSchema_website_logo');

    //Organization Social Fields
    register_setting('social-organization-schemas-fields', 'allSchema_facebook_url');
    register_setting('social-organization-schemas-fields', 'allSchema_facebook_code');
    register_setting('social-organization-schemas-fields', 'allSchema_twitter_url');
    register_setting('social-organization-schemas-fields', 'allSchema_twitter_code');
    register_setting('social-organization-schemas-fields', 'allSchema_instagram_url');
    register_setting('social-organization-schemas-fields', 'allSchema_instagram_code');
    register_setting('social-organization-schemas-fields', 'allSchema_linkedin_url');
    register_setting('social-organization-schemas-fields', 'allSchema_linkedin_code');
    register_setting('social-organization-schemas-fields', 'allSchema_myspace_url');
    register_setting('social-organization-schemas-fields', 'allSchema_myspace_code');
    register_setting('social-organization-schemas-fields', 'allSchema_pininterest_url');
    register_setting('social-organization-schemas-fields', 'allSchema_pininterest_code');
    register_setting('social-organization-schemas-fields', 'allSchema_youtube_url');
    register_setting('social-organization-schemas-fields', 'allSchema_youtube_code');
    register_setting('social-organization-schemas-fields', 'allSchema_google_plus_url');
    register_setting('social-organization-schemas-fields', 'allSchema_google_plus_code');
    register_setting('social-organization-schemas-fields', 'allSchema_organization_logo_checkbox');
    register_setting('social-organization-schemas-fields', 'allSchema_organization_name_checkbox');
    register_setting('social-organization-schemas-fields', 'allSchema_organization_url_checkbox');
    register_setting('social-organization-schemas-fields', 'allSchema_organization_description_checkbox');
    register_setting('social-organization-schemas-fields', 'allSchema_disable_organization_schema');
    register_setting('social-organization-schemas-fields', 'allSchema_enable_organization_schema_for_all_pages');


    //Local Business
    register_setting('local-business-schemas-fields', 'allSchema_enable_local_business_schema');
    register_setting('local-business-schemas-fields', 'allSchema_local_business_schema_type');
    register_setting('local-business-schemas-fields', 'allSchema_local_business_image');
    register_setting('local-business-schemas-fields', 'allSchema_local_business_website_logo_checkbox');
    register_setting('local-business-schemas-fields', 'allSchema_localbusiness_schema_email');
    register_setting('local-business-schemas-fields', 'allSchema_localbusiness_schema_phone');
    register_setting('local-business-schemas-fields', 'allSchema_localbusiness_schema_office_timings');

    register_setting('local-business-schemas-fields', 'allSchema_show_page_option_checkbox');

    //Website Schema
    register_setting('allSchema_website_schema_fields', 'allSchema_enable_website_schema');

    //Client Review Schema
    register_setting('allSchema_client_review_schema_fields', 'allSchema_enable_client_review_schema');

    //Medical Schema
    register_setting('allSchema_medical_schema_fields', 'allSchema_enable_medical_schema');
    register_setting('allSchema_medical_schema_fields', 'allSchema_medical_schema_type');
    register_setting('allSchema_medical_schema_fields', 'allSchema_medical_schema_specialty');
    register_setting('allSchema_medical_schema_fields', 'allSchema_medical_org_clinic_name');
    register_setting('allSchema_medical_schema_fields', 'allSchema_medical_schema_phone');
    register_setting('allSchema_medical_schema_fields', 'allSchema_medical_schema_email');
    
    //Video Schema
   
     register_setting('allSchema_video_schema_fields', 'allSchema_enable_video_schema');
}

function schema_settings_page() {
    ?>
    <div class="wrap">
        <h1>Schema Settings</h1>
        <?php settings_errors(); ?>
        <?php
        if (isset($_GET['tab'])) {
            $active_tab = $_GET['tab'];
        } else {
            $active_tab = 'basic_information';
        }
        ?>
        <h2 class="nav-tab-wrapper">
            <a href="?page=schemas_settings&tab=basic_information" class="nav-tab  <?php echo $active_tab == 'basic_information' ? 'nav-tab-active' : ''; ?>">Basic Information</a>
            <a href="?page=schemas_settings&tab=website_schema" class="nav-tab  <?php echo $active_tab == 'website_schema' ? 'nav-tab-active' : ''; ?>">Website Schema</a>
            <a href="?page=schemas_settings&tab=organization_schema" class="nav-tab  <?php echo $active_tab == 'organization_schema' ? 'nav-tab-active' : ''; ?>">Organization</a>
            <a href="?page=schemas_settings&tab=local_business_schema" class="nav-tab  <?php echo $active_tab == 'local_business_schema' ? 'nav-tab-active' : ''; ?>">Local Business</a>
            <a href="?page=schemas_settings&tab=client_review_schema" class="nav-tab  <?php echo $active_tab == 'client_review_schema' ? 'nav-tab-active' : ''; ?>">Client Review Schema</a>
            <a href="?page=schemas_settings&tab=medical_schemas" class="nav-tab  <?php echo $active_tab == 'medical_schemas' ? 'nav-tab-active' : ''; ?>">Medical Schema</a>
            <a href="?page=schemas_settings&tab=video_schemas" class="nav-tab  <?php echo $active_tab == 'video_schemas' ? 'nav-tab-active' : ''; ?>">Video Schema</a>

        </h2>
        <form method="post" action="options.php"> 
            <?php if ($active_tab == 'basic_information') { ?>

                <div class="small-groups">
                    <h2>Basic Details of Website</h2>
                    <table class="form-table">
                        <tr valign="top">
                            <th scope="row">Website Name</th>  
                            <td>  
                                <input type="text"  name="allSchema_website_name" value="<?php echo (!empty(get_option('allSchema_website_name')) ? get_option('allSchema_website_name') : bloginfo('name') ); ?>">
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Website Description</th>  
                            <td>  
                                <textarea type="text"  name="allSchema_website_description" value="<?php echo (!empty(get_option('allSchema_website_description')) ? get_option('allSchema_website_description') : bloginfo('description') ); ?>"><?php echo (!empty(get_option('allSchema_website_description')) ? get_option('allSchema_website_description') : bloginfo('description') ); ?></textarea>
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Website Logo</th>  
                            <td>  

                                <input id="allSchema_website_logo" type="text" name="allSchema_website_logo" value="<?php echo get_option('allSchema_website_logo'); ?>" />
                                <input id="upload_image_button" type="button" class="button-primary" value="Insert Image" />

                            </td>
                        </tr>
                    </table>
                </div>
                <?php
                settings_fields('allSchema_basic_information_fields');
                do_settings_sections('allSchema_basic_information_fields');
                ?>
            <?php } elseif ($active_tab == 'website_schema') { ?> 
                <div class="small-groups">
                    <h2>Website Schema</h2>
                    <table class="form-table">
                        <tr valign="top">
                            <th scope="row">Enable Website Schema (by default it is disabled)</th>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" name="allSchema_enable_website_schema" value="Yes" <?php
                                    if (get_option('allSchema_enable_website_schema') == 'Yes') {
                                        echo 'checked';
                                    }
                                    ?> >
                                    <span class="slider round"></span>
                                </label>
                            </td>
                        </tr> 

                    </table>
                </div>

                <?php
                settings_fields('allSchema_website_schema_fields');
                do_settings_sections('allSchema_website_schema_fields');
                ?>
            <?php } elseif ($active_tab == 'organization_schema') { ?>
                <div class="small-groups">
                    <h2>Social Addresses</h2>
                    <table class="form-table">
                        <tr valign="top">
                            <th scope="row">Facebook</th>  
                            <td>  
                                <input type="text" name="allSchema_facebook_url" value="<?php echo (!empty(get_option('allSchema_facebook_url')) ? get_option('allSchema_facebook_url') : null ); ?>">
                            </td>
                            <td>
                                <input type="text" name="allSchema_facebook_code" value="<?php echo (!empty(get_option('allSchema_facebook_code')) ? get_option('allSchema_facebook_code') : null ); ?>">
                            </td>

                        </tr>
                        <tr valign="top">
                            <th scope="row">Twitter</th>
                            <td>
                                <input type="text" name="allSchema_twitter_url" value="<?php echo (!empty(get_option('allSchema_twitter_url')) ? get_option('allSchema_twitter_url') : null ); ?>">
                            </td>
                            <td>
                                <input type="text" name="allSchema_twitter_code" value="<?php echo (!empty(get_option('allSchema_twitter_code')) ? get_option('allSchema_twitter_code') : null ); ?>">
                            </td>

                        </tr>
                        <tr valign="top">
                            <th scope="row">Instagram</th>
                            <td>
                                <input type="text" name="allSchema_instagram_url" value="<?php echo (!empty(get_option('allSchema_instagram_url')) ? get_option('allSchema_instagram_url') : null ); ?>" >
                            </td>
                            <td>
                                <input type="text" name="allSchema_instagram_code" value="<?php echo (!empty(get_option('allSchema_instagram_code')) ? get_option('allSchema_instagram_code') : null ); ?>" >
                            </td>


                        </tr>  
                        <tr valign="top">
                            <th scope="row">Linkedin</th>

                            <td>
                                <input type="text" name="allSchema_linkedin_url" value="<?php echo (!empty(get_option('allSchema_linkedin_url')) ? get_option('allSchema_linkedin_url') : null ); ?>">
                            </td>
                            <td>
                                <input type="text" name="allSchema_linkedin_code" value="<?php echo (!empty(get_option('allSchema_linkedin_code')) ? get_option('allSchema_linkedin_code') : null ); ?>">
                            </td>

                        </tr>
                        <tr valign="top">
                            <th scope="row">Pinterest</th>

                            <td>
                                <input type="text" name="allSchema_pininterest_url" value="<?php echo (!empty(get_option('allSchema_pininterest_url')) ? get_option('allSchema_pininterest_url') : null ); ?>">
                            </td>
                            <td>
                                <input type="text" name="allSchema_pininterest_code" value="<?php echo (!empty(get_option('allSchema_pininterest_code')) ? get_option('allSchema_pininterest_code') : null ); ?>">
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">YouTube</th>
                            <td>
                                <input type="text" name="allSchema_youtube_url" value="<?php echo (!empty(get_option('allSchema_youtube_url')) ? get_option('allSchema_youtube_url') : null ); ?>">
                            </td>
                            <td>
                                <input type="text" name="allSchema_youtube_code" value="<?php echo (!empty(get_option('allSchema_youtube_code')) ? get_option('allSchema_youtube_code') : null ); ?>">
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Google+</th>
                            <td>
                                <input type="text" name="allSchema_google_plus_url" value="<?php echo (!empty(get_option('allSchema_google_plus_url')) ? get_option('allSchema_google_plus_url') : null ); ?>">
                            </td>
                            <td>
                                <input type="text" name="allSchema_google_plus_code" value="<?php echo (!empty(get_option('allSchema_google_plus_code')) ? get_option('allSchema_google_plus_code') : null ); ?>">
                            </td>

                        </tr>
                    </table> 
                </div>
                <div class="small-groups">
                    <h2>More Options</h2>
                    <p>Include Following Things in Organization Schemas.Default they are not included.</p>
                    <table class="form-table">
                        <tr valign="top">
                            <th scope="row">Name</th>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" name="allSchema_organization_name_checkbox" value="Yes"
                                    <?php
                                    if (get_option('allSchema_organization_name_checkbox') == 'Yes') {
                                        echo 'checked';
                                    }
                                    ?> >
                                    <span class="slider round"></span>
                                </label>
                            </td> 
                        </tr> 
                        <tr valign="top">
                            <th scope="row">URL</th>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" name="allSchema_organization_url_checkbox" value="Yes" <?php
                                    if (get_option('allSchema_organization_url_checkbox') == 'Yes') {
                                        echo 'checked';
                                    }
                                    ?> >
                                    <span class="slider round"></span>
                                </label>
                            </td>
                        </tr> 
                        <th scope="row">Logo</th>
                        <td>
                            <label class="switch">
                                <input type="checkbox" name="allSchema_organization_logo_checkbox" value="Yes" <?php
                                if (get_option('allSchema_organization_logo_checkbox') == 'Yes') {
                                    echo 'checked';
                                }
                                ?> >
                                <span class="slider round"></span>
                            </label>
                        </td>
                        </tr> 
                        <tr valign="top">
                            <th scope="row">Description</th>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" name="allSchema_organization_description_checkbox" value="Yes" <?php
                                    if (get_option('allSchema_organization_description_checkbox') == 'Yes') {
                                        echo 'checked';
                                    }
                                    ?> >
                                    <span class="slider round"></span>
                                </label>
                            </td>
                        </tr> 
                    </table>
                </div>
                <div class="small-groups">  
                    <h2>Disable Schema</h2>
                    <p>If checked organization schema will be disabled.</p>
                    <table class="form-table">
                        <tr valign="top">
                            <th scope="row">Disable Organization Schema</th>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" name="allSchema_disable_organization_schema" value="Yes" <?php
                                    if (get_option('allSchema_disable_organization_schema') == 'Yes') {
                                        echo 'checked';
                                    }
                                    ?> >
                                    <span class="slider round"></span>
                                </label>
                            </td>
                        </tr> 

                    </table>  
                </div>
                <div class="small-groups">  
                    <h2>Show on All Pages</h2>
                    <p>By Default it is shown only on home page.If checked it will shown on all pages.</p>
                    <table class="form-table">
                        <tr valign="top">
                            <th scope="row">All Pages</th>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" name="allSchema_enable_organization_schema_for_all_pages" value="Yes" <?php
                                    if (get_option('allSchema_enable_organization_schema_for_all_pages') == 'Yes') {
                                        echo 'checked';
                                    }
                                    ?> >
                                    <span class="slider round"></span>
                                </label>
                            </td>
                        </tr> 

                    </table>  
                </div>
                <?php
                settings_fields('social-organization-schemas-fields');
                do_settings_sections('social-organization-schemas-fields');
                ?>

            <?php } elseif ($active_tab == 'local_business_schema') { ?>
                <div class="small-groups">
                    <h2>Local Business</h2>
                    <table class="form-table">
                        <tr valign="top">
                            <th scope="row">Enable Local Business Schema</th>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" name="allSchema_enable_local_business_schema" value="Yes" 
                                    <?php
                                    if (get_option('allSchema_enable_local_business_schema') == 'Yes') {
                                        echo 'checked';
                                    }
                                    ?> >
                                    <span class="slider round"></span>
                                </label>
                            </td>

                        </tr> 
                        <tr valign="top">
                            <th scope="row">And/Or Be More Specific <br/> Select from the given list</th>
                            <td>
                                <?php $local_business_schema_type_selected = get_option('allSchema_local_business_schema_type'); ?>
                                <select name="allSchema_local_business_schema_type">
                                    <option <?php if ($local_business_schema_type_selected == "allSchema_AnimalShelter") { ?> selected <?php } ?> value="allSchema_AnimalShelter">AnimalShelter</option>
                                    <option <?php if ($local_business_schema_type_selected == "allSchema_AutomotiveBusiness") { ?> selected <?php } ?> value="allSchema_AutomotiveBusiness">AutomotiveBusiness</option>
                                    <option <?php if ($local_business_schema_type_selected == "allSchema_Dentist") { ?> selected <?php } ?> value="allSchema_Dentist">Dentist</option>
                                    <option <?php if ($local_business_schema_type_selected == "allSchema_DryCleaningOrLaundry") { ?> selected <?php } ?> value="allSchema_DryCleaningOrLaundry">DryCleaningOrLaundry</option>
                                    <option <?php if ($local_business_schema_type_selected == "allSchema_EmergencyService") { ?> selected <?php } ?> value="allSchema_EmergencyService">EmergencyService</option>
                                    <option <?php if ($local_business_schema_type_selected == "allSchema_EmploymentAgency") { ?> selected <?php } ?> value="allSchema_EmploymentAgency">EmploymentAgency</option>
                                    <option <?php if ($local_business_schema_type_selected == "allSchema_EntertainmentBusiness") { ?> selected <?php } ?> value="allSchema_EntertainmentBusiness">EntertainmentBusiness</option>
                                    <option <?php if ($local_business_schema_type_selected == "allSchema_AutomotiveBusiness") { ?> selected <?php } ?>  value="allSchema_FinancialService">FinancialService</option>
                                    <option <?php if ($local_business_schema_type_selected == "allSchema_FinancialService") { ?> selected <?php } ?> value="allSchema_FoodEstablishment">FoodEstablishment</option> 
                                    <option <?php if ($local_business_schema_type_selected == "allSchema_GovernmentOffice") { ?> selected <?php } ?> value="allSchema_GovernmentOffice">GovernmentOffice</option>
                                    <option <?php if ($local_business_schema_type_selected == "allSchema_HealthAndBeautyBusiness") { ?> selected <?php } ?>  value="allSchema_HealthAndBeautyBusiness">HealthAndBeautyBusiness</option>
                                    <option <?php if ($local_business_schema_type_selected == "allSchema_HomeAndConstructionBusiness") { ?> selected <?php } ?> value="allSchema_HomeAndConstructionBusiness">HomeAndConstructionBusiness</option>
                                    <option <?php if ($local_business_schema_type_selected == "allSchema_InternetCafe") { ?> selected <?php } ?>  value="allSchema_InternetCafe">InternetCafe</option>
                                    <option <?php if ($local_business_schema_type_selected == "allSchema_LegalService") { ?> selected <?php } ?>  value="allSchema_LegalService">LegalService</option>
                                    <option <?php if ($local_business_schema_type_selected == "allSchema_Library") { ?> selected <?php } ?> value="allSchema_Library">Library</option>
                                    <option <?php if ($local_business_schema_type_selected == "allSchema_LodgingBusiness") { ?> selected <?php } ?>  value="allSchema_LodgingBusiness">LodgingBusiness</option>
                                    <option <?php if ($local_business_schema_type_selected == "allSchema_MedicalBusiness") { ?> selected <?php } ?>  value="allSchema_LodgingBusiness">MedicalBusiness</option>
                                    <option <?php if ($local_business_schema_type_selected == "allSchema_ProfessionalService") { ?> selected <?php } ?> value="allSchema_ProfessionalService">ProfessionalService</option>
                                    <option <?php if ($local_business_schema_type_selected == "allSchema_RadioStation") { ?> selected <?php } ?> value="allSchema_RadioStation">RadioStation</option>
                                    <option <?php if ($local_business_schema_type_selected == "allSchema_RealEstateAgent") { ?> selected <?php } ?> value="allSchema_RealEstateAgent">RealEstateAgent</option>
                                    <option <?php if ($local_business_schema_type_selected == "allSchema_RecyclingCenter") { ?> selected <?php } ?>  value="allSchema_RecyclingCenter">RecyclingCenter</option> 
                                    <option <?php if ($local_business_schema_type_selected == "allSchema_SelfStorage") { ?> selected <?php } ?> value="allSchema_SelfStorage">SelfStorage</option> 
                                    <option <?php if ($local_business_schema_type_selected == "allSchema_ShoppingCenter") { ?> selected <?php } ?> value="allSchema_ShoppingCenter">ShoppingCenter</option>
                                    <option <?php if ($local_business_schema_type_selected == "allSchema_SportsActivityLocation") { ?> selected <?php } ?> value="allSchema_SportsActivityLocation">SportsActivityLocation</option>
                                    <option <?php if ($local_business_schema_type_selected == "allSchema_Store") { ?> selected <?php } ?> value="allSchema_Store" >Store</option>
                                    <option <?php if ($local_business_schema_type_selected == "allSchema_TelevisionStation") { ?> selected <?php } ?> value="allSchema_TelevisionStation">TelevisionStation</option>
                                    <option <?php if ($local_business_schema_type_selected == "allSchema_TouristInformationCenter") { ?> selected <?php } ?>  value="allSchema_TouristInformationCenter">TouristInformationCenter</option>
                                    <option <?php if ($local_business_schema_type_selected == "allSchema_TravelAgency") { ?> selected <?php } ?> value="allSchema_TravelAgency">TravelAgency</option>
                                </select>
                            </td>

                        </tr> 
                        <tr valign="top">
                            <th>
                                Image
                            </th>

                            <td>  
                                <strong>Include Website Logo</strong>
                                <label class="switch"> 

                                    <input <?php
                                    if (get_option('allSchema_local_business_website_logo_checkbox') == "Yes") {
                                        echo "checked";
                                    }
                                    ?> id="allSchema_local_business_website_logo_checkbox" type="checkbox" name="allSchema_local_business_website_logo_checkbox" value="Yes">
                                    <span class="slider round"></span>
                                </label>
                            </td>
                            <?php if (get_option('allSchema_local_business_website_logo_checkbox') != 'Yes') { ?>

                                <td class="show-schema-field"><strong>OR</strong></td>
                                <td class="show-schema-field">  

                                    <input id="allSchema_local_business_image" type="text" name="allSchema_local_business_image" value="<?php echo get_option('allSchema_local_business_image'); ?>" />
                                    <input id="upload_image_button" type="button" class="button-primary" value="Insert Image" />

                                </td>  
                            <?php } ?>
                        </tr>
                        <tr valign="top">
                            <th colspan="4" scope="row">Show Page Options (by Default it is shown on Page)<br/> Please select from list where you want to show page option box </th> 
                        </tr>  
                        <tr valign="top"> 
                            <?php
                            $all_post_types = array();
                            $page_option_selector = get_option('allSchema_show_page_option_checkbox');
                            foreach (get_post_types(['public' => true], 'names') as $post_type) {
                                $all_post_types[] = $post_type;
                                ?> 
                            <?php }
                            ?>
                            <?php
                            $array_all_post_types = array_diff($all_post_types, ["page", "attachment"]);
                            $postIndex = 0;
                            foreach ($array_all_post_types as $post_type_1) {
                                ?>
                                <td> 
                                    <input <?php
                                    // if ($page_option_selector[$postIndex] == $post_type_1) {
                                    if (in_array($post_type_1, $page_option_selector)) {
                                        echo "checked";
                                    }
                                    ?> type="checkbox"  value="<?php echo $post_type_1; ?>" name="allSchema_show_page_option_checkbox[]">
                                        <?php echo $post_type_1; ?>
                                </td>
                                <?php
                                $postIndex++;
                            }
                            ?>
                        </tr>
                        <tr valign="top">
                            <th colspan="4" scope="row">In Case common telephone & email for all addresses <br/> Enter Detail Below : </th> 
                        </tr> 
                        <tr valign="top">
                            <th scope="row">Email</th>
                            <td>  
                                <input type="email"  name="allSchema_localbusiness_schema_email" value="<?php echo (!empty(get_option('allSchema_localbusiness_schema_email')) ? get_option('allSchema_localbusiness_schema_email') : '' ); ?>">
                            </td>
                        </tr> 
                        <tr valign="top">
                            <th scope="row">Phone</th>
                            <td>  
                                <input type="tel"  name="allSchema_localbusiness_schema_phone" value="<?php echo (!empty(get_option('allSchema_localbusiness_schema_phone')) ? get_option('allSchema_localbusiness_schema_phone') : '' ); ?>">
                            </td>  
                        </tr> 

                        <tr valign="top">
                            <th scope="row">Office Timings</th>
                            <td>  
                                <input type="text"  name="allSchema_localbusiness_schema_office_timings" value="<?php echo (!empty(get_option('allSchema_localbusiness_schema_office_timings')) ? get_option('allSchema_localbusiness_schema_office_timings') : '' ); ?>">
                            </td>  
                        </tr> 
                    </table>  
                    <?php
                    settings_fields('local-business-schemas-fields');
                    do_settings_sections('local-business-schemas-fields');
                    ?>
                </div>
            <?php } elseif ($active_tab == 'client_review_schema') {
                ?> 
                <div class="small-groups">
                    <table class="form-table">
                        <tr valign="top">
                            <th scope="row">Enable Client Review Schema</th>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" name="allSchema_enable_client_review_schema" value="Yes" <?php
                                    if (get_option('allSchema_enable_client_review_schema') == 'Yes') {
                                        echo 'checked';
                                    }
                                    ?> >
                                    <span class="slider round"></span>
                                </label>
                            </td>
                        </tr> 
                    </table> 
                </div>
                <?php
                settings_fields('allSchema_client_review_schema_fields');
                do_settings_sections('allSchema_client_review_schema_fields');
                ?>
            <?php } elseif ($active_tab == 'medical_schemas') {
                ?> 
                <div class="small-groups">
                    <h2>Medical Schema</h2>
                    <table class="form-table">
                        <tr valign="top">
                            <th scope="row">Enable Medical Schema (by default it is disabled)</th>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" name="allSchema_enable_medical_schema" value="Yes" <?php
                                    if (get_option('allSchema_enable_medical_schema') == 'Yes') {
                                        echo 'checked';
                                    }
                                    ?> >
                                    <span class="slider round"></span>
                                </label>
                            </td>
                        </tr> 
                        <tr valign="top">
                            <th scope="row">Type</th>
                            <td>
                                <?php $medical_schema_type_selected = get_option('allSchema_medical_schema_type'); ?>
                                <select name="allSchema_medical_schema_type">
                                    <option <?php if ($medical_schema_type_selected == "allSchema_Medical_Organization") { ?> selected <?php } ?> value="allSchema_Medical_Organization">Medical Organization</option>
                                    <option <?php if ($medical_schema_type_selected == "allSchema_Medical_Clinic") { ?> selected <?php } ?> value="allSchema_Medical_Clinic">Medical Clinic</option>
                                </select>
                            </td>
                        </tr> 
                        <tr valign="top">
                            <th scope="row">Medical Specialty</th>
                            <td>  
                                <input type="text"  name="allSchema_medical_schema_specialty" value="<?php echo (!empty(get_option('allSchema_medical_schema_specialty')) ? get_option('allSchema_medical_schema_specialty') : '' ); ?>">
                            </td>
                        </tr>   
                        <tr valign="top">
                            <th scope="row">Email</th>
                            <td>  
                                <input type="email"  name="allSchema_medical_schema_email" value="<?php echo (!empty(get_option('allSchema_medical_schema_email')) ? get_option('allSchema_medical_schema_email') : '' ); ?>">
                            </td>
                        </tr> 
                        <tr valign="top">
                            <th scope="row">Phone</th>
                            <td>  
                                <input type="tel"  name="allSchema_medical_schema_phone" value="<?php echo (!empty(get_option('allSchema_medical_schema_phone')) ? get_option('allSchema_medical_schema_phone') : '' ); ?>">
                            </td>  
                        </tr> 
                        <tr valign="top">
                            <th scope="row">Organization/Clinic Name</th>
                            <td>  
                                <input type="text"  name="allSchema_medical_org_clinic_name" value="<?php echo (!empty(get_option('allSchema_medical_org_clinic_name')) ? get_option('allSchema_medical_org_clinic_name') : '' ); ?>">
                            </td>    
                        </tr>   
                    </table>
                </div>

                <?php
                settings_fields('allSchema_medical_schema_fields');
                do_settings_sections('allSchema_medical_schema_fields');
                ?>
                <?php
            } elseif ($active_tab == 'video_schemas') {
                ?> 
                <div class="small-groups">
                    <h2>Video Schema</h2>
                    <table class="form-table">
                        <tr valign="top">
                            <th scope="row">Enable Video Schema (by default it is disabled)</th>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" name="allSchema_enable_video_schema" value="Yes" <?php
                                    if (get_option('allSchema_enable_video_schema') == 'Yes') {
                                        echo 'checked';
                                    }
                                    ?> >
                                    <span class="slider round"></span>
                                </label>
                            </td>
                        </tr> 
                       
                    </table>
                </div>

                <?php
                settings_fields('allSchema_video_schema_fields');
                do_settings_sections('allSchema_video_schema_fields');
                ?>
                <?php
            } else {
                
            }
            submit_button();
            ?>
        </form>

    </div>
    <?php
}

if (is_admin())
    add_action('admin_enqueue_scripts', 'load_wp_media_files');