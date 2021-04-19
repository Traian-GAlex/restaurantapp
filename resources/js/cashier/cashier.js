$(document).ready(() => {
    $('#itemsTab').click((e) => {
        e.preventDefault();
        $('.nav-tabs>.nav-item>.nav-link').removeClass('active');
        $(e.target).addClass('active');
        $('#order_content').html('');
        $.get('/cashier/get/order/' + $('#order_id').val() + '/items')
            .done((response) => {
                $('#order_content').html(response);
            });
    });

    $('#tablesTab').click((e) => {
        e.preventDefault();
        $('.nav-tabs>.nav-item>.nav-link').removeClass('active');
        $(e.target).addClass('active');
        $('#order_content').html('');
        $.get('/cashier/get/order/' + $('#order_id').val() + '/tables')
            .done((response) => {
                $('#order_content').html(response);
            });
    });

    $('#paymentsTab').click((e) => {
        e.preventDefault();
        $('.nav-tabs>.nav-item>.nav-link').removeClass('active');
        $(e.target).addClass('active');
        $('#order_content').html('');
        $.get('/cashier/get/order/' + $('#order_id').val() + '/payments')
            .done((response) => {
                $('#order_content').html(response);
            });
    });

    $('#itemsTab').click();
})
