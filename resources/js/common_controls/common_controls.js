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
});
