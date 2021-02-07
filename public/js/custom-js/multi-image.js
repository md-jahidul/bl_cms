// Multi Image Component
function dropify(){
    $('.dropify').dropify({
        messages: {
            'default': 'Browse for an Image File to upload',
            'replace': 'Click to replace',
            'remove': 'Remove',
            'error': 'Choose correct file format'
        }
    });
}

$(document).on('keyup', '.img-data', function (e) {
    var current_value = $(this).val();
    var inputEl = $(this);
    if (current_value) {
        var ifEdit = duplicateChecker.split(",")[1]
        if (ifEdit !== "edit") {
            $.ajax({
                url: duplicateChecker + "/" + current_value,
                methods: "get",
                success: function (data) {
                    if (data) {
                        inputEl.nextUntil().html("Already exist in database")
                        inputEl.val('')
                    } else {
                        console.log("Not Exist")
                    }
                },
                error: function (error) {
                    alert("Something went wrong")
                }
            })
        }
    }
    $(this).nextUntil().html("")
    $(this).attr('value',current_value);
    if ($('.img-data[value="' + current_value + '"]').not($(this)).length > 0 || current_value.length == 0 ) {
        $(this).focus();
        var showError = "It's already given"
        $(this).nextUntil().html(showError)
        $(this).val('')
    }
})

$(document).on('click', '#plus-image', function () {
    var option_count = $('.options-count');
    var total_option = option_count.length + 2;

    var input = '<div class="col-md-6 col-xs-6 options-count option-' + total_option + '">\n' +
        // '<input id="multi_item_count" type="hidden" name="multi_item_count" value="'+total_option+'">\n' +
        '<div class="form-group">\n' +
        '      <label for="message">Multiple Image</label>\n' +
        '      <input type="file" class="dropify" name="base_image[]" data-height="80"/>\n' +
        '      <span class="text-primary">Please given file type (.png, .jpg, svg)</span>\n' +
        '  </div>\n' +
        ' </div>\n' +
        '<div class="form-group col-md-3 option-' + total_option + '">\n' +
        '    <label for="alt_text">Alt Text English</label>\n' +
        '    <input type="text" name="multi_alt_text_en[]"  class="form-control">\n' +
        '</div>\n' +
        '<div class="form-group col-md-2 option-' + total_option + '">\n' +
        '    <label for="alt_text">Alt Text Bangla</label>\n' +
        '    <input type="text" name="multi_alt_text_bn[]"  class="form-control">\n' +
        '</div>\n' +
        '<div class="form-group col-md-1 option-' + total_option + '">\n' +
        '   <label for="alt_text"></label>\n' +
        '   <button type="button" class="btn-sm btn-danger remove-image mt-2" data-id="option-' + total_option + '" ><i data-id="option-' + total_option + '" class="la la-trash"></i></button>\n' +
        '</div>\n' +
        '<div class="form-group col-md-6 option-' + total_option + '">\n' +
        '<label for="alt_text">Image Name English</label>\n' +
        '    <input type="text" name="img_name_en[]" class="form-control img-data" required>\n' +
        '<span class="help-block duplicate-error text-danger"></span>\n' +
        '</div>\n' +
        '<div class="form-group col-md-6 option-' + total_option + '">\n' +
        '    <label for="alt_text">Image Name Bangla</label>\n' +
        '    <input type="text" name="img_name_bn[]" class="form-control img-data" required>\n' +
        '<span class="help-block duplicate-error text-danger"></span>\n' +
        '</div>';

    $('#multiple_image').append(input);
    dropify();
});
