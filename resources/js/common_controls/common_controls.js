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

    $('#itemsTab').click((e) => {
        e.preventDefault();
        $('.nav-tabs>.nav-item>.nav-link').removeClass('active');
        $(e.target).addClass('active');
    });

    $('#tablesTab').click((e) => {
        e.preventDefault();
        $('.nav-tabs>.nav-item>.nav-link').removeClass('active');
        $(e.target).addClass('active');
    });

    $('#paymentsTab').click((e) => {
        e.preventDefault();
        $('.nav-tabs>.nav-item>.nav-link').removeClass('active');
        $(e.target).addClass('active');
    });

    $('#itemsTab').click();


});
