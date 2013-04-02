$(document).ready(function() {
    $.ajax({
        url: '/eventbrite/asistentes.html',
        dataType: 'html',
        success: function(response, status, jqXHR) {
            $('#attendees').html(response);
        }
    });
});