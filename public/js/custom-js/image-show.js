var showIamge = (function () {
    let publicFunction = {
        'imageRead': function readURL(input, imgField)
        {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(imgField).css('display', 'block');
                    $(imgField).attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        },
    };
    return publicFunction;
})();

(function () {
    let $desktopImg = $('#desktopImg');
    let $desktopImgShow = $('#desktopImgShow');

    let $mobileImg = $('#mobileImg');
    let $mobileImgShow = $('#mobileImgShow');

    $($desktopImg).change(function () {
        showIamge.imageRead(this, $desktopImgShow);
    });

    $($mobileImg).change(function () {
        showIamge.imageRead(this, $mobileImgShow);
    });
})();
