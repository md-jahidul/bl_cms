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
    let $imgOne = $('#imgOne');
    let $imgShowOne = $('#imgShowOne');

    let $imgTwo = $('#imgTwo');
    let $imgShowTwo = $('#imgShowTwo');

    $($imgOne).change(function () {
        showIamge.imageRead(this, $imgShowOne);
    });

    $($imgTwo).change(function () {
        showIamge.imageRead(this, $imgShowTwo);
    });
})();
