/* schedule.js */
jQuery(document).ready(function($) {

    // On filter.
    $('.classly-filter-button').on('click', function(e) {
        // Prevent default.
        e.preventDefault();
        // Remove button class.
        $('.classly-filter-active').removeClass('classly-filter-active');
        // Add class.
        $(this).addClass('classly-filter-active');
        // Get filter.
        var filter = $(this).data('id');
        // Check filter.
        if(filter == 'all') {
            // Show all.
            $('.classly-single-start').show();
            return;
        }
        // Hide all.
        $('.classly-single-start').hide();
        // Show filtered.
        $('.classly-single-start.classly-' + filter).show();
    });

});