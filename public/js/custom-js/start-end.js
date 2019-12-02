$(function () {
    var date = new Date();
    date.setDate(date.getDate());
    $('#start_date').datetimepicker({
        format : 'YYYY-MM-DD HH:mm:ss',
        showClose: true,
        minDate: date,
    });
    $('#end_date').datetimepicker({
        format : 'YYYY/MM/DD HH:mm:ss',
        showClose: true,
        useCurrent: false, //Important! See issue #1075

    });
    $("#start_date").on("dp.change", function (e) {
        $('#end_date').data("DateTimePicker").minDate(e.date);
    });
    $("#end_date").on("dp.change", function (e) {
        $('#start_date').data("DateTimePicker").maxDate(e.date);
    });

});
