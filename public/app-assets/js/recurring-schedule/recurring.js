$("input[name='recurring_type']").change(function () {
    let recurringType = $(this).val();
    switch (recurringType) {
        case 'daily':
            $('#weekday_selector').css('display', 'none');
            $('.weekday').attr('disabled', 'disabled');

            $('#dates').css('display', 'none');
            $('#month_dates').attr('disabled', 'disabled');

            $('#time_slot').css('display', 'block');
            $('#time_range').removeAttr('disabled');
            $('.select2').css('min-width', '400px');
            break;

        case 'weekly':
            $('#weekday_selector').css('display', 'block');
            $('.weekday').removeAttr('disabled');

            $('#dates').css('display', 'none');
            $('#month_dates').attr('disabled', 'disabled');

            $('#time_slot').css('display', 'block');
            $('#time_range').removeAttr('disabled');
            $('.select2').css('min-width', '400px');
            break;

        case 'monthly':
            $('#weekday_selector').css('display', 'none');
            $('.weekday').attr('disabled', 'disabled');

            $('#dates').css('display', 'block');
            $('#month_dates').removeAttr('disabled');

            $('#time_slot').css('display', 'block');
            $('#time_range').removeAttr('disabled');
            $('.select2').css('min-width', '400px');
            break;

        default :
            $('#weekday_selector').css('display', 'none');
            $('.weekday').attr('disabled', 'disabled');

            $('#dates').css('display', 'none');
            $('#month_dates').attr('disabled', 'disabled');

            $('#time_slot').css('display', 'none');
            $('#time_range').attr('disabled', 'disabled');
            break;

    }
});
