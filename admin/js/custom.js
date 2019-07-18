jQuery(document).ready(function ($) {
    var mediaUploader;
    $('#upload_image_button').click(function (e) {
        e.preventDefault();
        if (mediaUploader) {
            mediaUploader.open();
            return;
        }
        mediaUploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            }, multiple: false});
        mediaUploader.on('select', function () {
            var attachment = mediaUploader.state().get('selection').first().toJSON();
            $('#allSchema_website_logo').val(attachment.url);
            $('#allSchema_local_business_image').val(attachment.url);
        });
        mediaUploader.open();
    });
    //$('.show-schema-field').hide();
    var ckbox = $('#allSchema_local_business_website_logo_checkbox');
    $('#allSchema_local_business_website_logo_checkbox').on('click', function () {

        if (ckbox.is(':checked')) {
            $('.show-schema-field').hide();

        } else {

            $('.show-schema-field').show();
        }
    });
    
    
     var ckbox1 = $('#checkbox1');
    $('#checkbox1').on('click', function () {

        if (ckbox1.is(':checked')) {
        $sr =  $('#checkbox1').val();
            
            alert($sr);
  
        } else {

           alert($sr);  
        }
        
        
    });
    
    




});
