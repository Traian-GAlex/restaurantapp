$(document).ready(function () {

    $("#tablesViewerBtn").click(function () {
        var show = "<i class=\"las la-eye la-lg\"></i> Show tables";
        var hide = "<i class=\"las la-eye-slash la-lg\"></i> Hide tables";
        if ('true' === $(this).val()) {
            $(this).html(hide);
            $(this).val('false');
            showTableListModal();
        } else {
            $(this).html(show);
            $(this).val('true');
        }
    });

    $('#tablesList').on('hide.bs.modal', function () {
        $("#tablesViewerBtn").click();
        // closeTablesListBtn
    }).on('shown.bs.modal', function () {
        $.get("/cashier/get-tables")
            .done(function (response) {
                // console.log('response is ' , response);
                $("#tablesModalBody").html(response);

            });
    })

    function showTableListModal() {
        var options = {
            backdrop: 'static',
            keyboard: true,
            focus: true,
            show: true,
        };
        $("#tablesList").modal(options);
    }

});
