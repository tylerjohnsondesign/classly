/* instructor.js */
jQuery(document).ready(function($) {
    $('.upload_image_button').click(function(e) {
        e.preventDefault();
        var button = $(this);
        var custom_uploader = wp.media({
            title: 'Insert image',
            library : {
                type : 'image'
            },
            button: {
                text: 'Use this image' // button label text
            },
            multiple: false // for multiple image selection set to true
        }).on('select', function() {
            var attachment = custom_uploader.state().get('selection').first().toJSON();
            $(button).prev().val(attachment.url);
            $(button).next().show();
            $(button).next().next().attr('src', attachment.url);
        }).open();
    });
    $('.remove_image_button').click(function(e) {
        e.preventDefault();
        $(this).prev().prev().val('');
        $(this).next().attr('src', '');
        $(this).hide();
    });
});