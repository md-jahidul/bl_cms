(function () {
    let isCampain = $('#is_campaign');
    let campaignImg = $('#image');
    let imgRequired = $('#imgRequired');

    $(isCampain).click(function () {
        if ($(isCampain).prop("checked")) {
            campaignImg.parent().removeClass('d-none')
            $('#showImg').removeClass('d-none')
        } else {
            $('#showImg').addClass('d-none')
            campaignImg.parent().addClass('d-none')
            imgRequired.addClass('d-none');
        }
    })

    $('#save').click(function (e) {
        if ($(isCampain).prop("checked")) {
            if (campaignImg.val() === '') {
                e.preventDefault();
                imgRequired.removeClass('d-none');
            } else {
                // $('#form_submit').submit();
                imgRequired.addClass('d-none');
            }
        } else {
            $('#showImg').addClass('d-none');
            campaignImg.val('');
            imgRequired.addClass('d-none');
        }
    });
})();
