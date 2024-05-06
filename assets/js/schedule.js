/* schedule.js */
jQuery(document).ready(function($) {

    // On add schedule.
    $('button.classly_schedule_add_button').on('click', function(e) {
        // Prevent default.
        e.preventDefault();
        var schedule = $('#schedule-copy').clone();
        // Get and increase count.
        var count = $('.classly_schedule_fields').data('count') + 1;
        // Set count.
        $('.classly_schedule_fields').data('count', count);
        // Update schedule ID.
        schedule.attr('id', 'schedule-' + count);
        // Remove style.
        schedule.removeAttr('style');
        // Append to schedule list.
        schedule.appendTo('.classly_schedule_fields');
    });

    // On remove schedule.
    $(document).on('click', 'button.classly_schedule_remove_button', function(e) {
        // Prevent default.
        e.preventDefault();
        // Remove schedule.
        $(this).parent().parent().remove();
        // Update value.
        updateValue();
    });

    // On change.
    $(document).on('change', '.classly_schedule_fields select', function() {
        updateValue();
    });

    // Update value.
    function updateValue() {
        // Create object.
        var schedule = {};
        // Set count.
        var count = 0;
        // Loop through each schedule.
        $('.classly_schedule_fields .classly_schedule_field').each(function(index, element) {
            // Get ID.
            var set_id = count++;
            // Get day.
            var day = $(element).find('.classy_schedule_day_field').val();
            // Get start time.
            var start_time = $(element).find('.classy_schedule_start_field').val();
            // Get end time.
            var end_time = $(element).find('.classy_schedule_end_field').val();
            // Check for day, start, and end.
            if(!day || !start_time || !end_time) {
                return;
            }
            // Add to schedule object as JSON with set_id as the key and day, start_time, end_time as the value.
            schedule[set_id] = {
                'day': day,
                'start': start_time,
                'end': end_time
            };
        });
        // Convert to JSON.
        schedule = JSON.stringify(schedule);
        // Save to field.
        $('#classly_schedule').val(schedule);
    }

});