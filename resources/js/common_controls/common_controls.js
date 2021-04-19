window.$ = require('jquery');

$(document).ready(() => {
    // alert('ok');
    $('#itemsPerPage').change(function () {
        console.log($(this).val());
        $.get('/options/rows-per-page/' + $(this).val())
            .done((response) => {
                console.log(response);
                location.reload();
            });
    });

    $('#submit_filter_dates').click((event) => {
        event.preventDefault();
        $.ajax({
                type: "POST",
                url: '/options/set_filter_dates/',
                data: $('#date_segment_filter').serialize(),
                // success: success,
                dataType: 'json'
            }).done((response) => {
            console.log(response.data);
            location.reload();
        })
    });




});
