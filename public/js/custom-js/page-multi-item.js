// Multi Image Component
function dropify() {
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
    $(this).attr('value', current_value);
    if ($('.img-data[value="' + current_value + '"]').not($(this)).length > 0 || current_value.length == 0) {
        $(this).focus();
        var showError = "It's already given"
        $(this).nextUntil().html(showError)
        $(this).val('')
    }
})

$(document).on('click', '#plus-image', function () {
    var option_count = $('.options-count');
    var total_option = option_count.length + 2;
    var componentType = $('#component_type').val()
    var input = '';

    input += '<div class="col-md-11 col-xs-6 options-count option-' + total_option + '">\n' +
        // '<input id="multi_item_count" type="hidden" name="multi_item_count" value="'+total_option+'">\n' +
        '<div class="form-group">\n' +
        '      <label for="message">Image One</label>\n' +
        '      <input type="file" class="dropify" name="componentData[' + total_option + '][image_one][value_en]" data-height="80"/>\n' +
        '      <input type="hidden" name="componentData[' + total_option + '][image_one][group]" value="' + total_option + '"/>\n' +
        '      <span class="text-primary">Please given file type (.png, .jpg, svg)</span>\n' +
        '  </div>\n' +
        ' </div>';
        if(componentType === "hovering_card_component"){
            input += '<div class="col-md-11 col-xs-5 options-count option-' + total_option + '">\n' +
                '<div class="form-group">\n' +
                '      <label for="message">Image Two</label>\n' +
                '      <input type="file" class="dropify" name="componentData[' + total_option + '][image_two][value_en]" data-height="80"/>\n' +
                '      <input type="hidden" name="componentData[' + total_option + '][image_two][group]"/ value="' + total_option + '">\n' +
                '      <span class="text-primary">Please given file type (.png, .jpg, svg)</span>\n' +
                ' </div>\n' +
                ' </div>';
        }

    input += '<div class="form-group col-md-6 option-' + total_option + '">\n' +
        '<label for="alt_text">Title En</label>\n' +
        '    <input type="text" name="componentData[' + total_option + '][title][value_en]" class="form-control img-data" required>\n' +
        '    <input type="hidden" name="componentData[' + total_option + '][title][group]" value="' + total_option + '">\n' +
        '<span class="help-block duplicate-error text-danger"></span>\n' +
        '</div>\n' +

        '<div class="form-group col-md-5 option-' + total_option + '">\n' +
        '    <label for="alt_text">Title Bn</label>\n' +
        '    <input type="text" name="componentData[' + total_option + '][title][value_bn]" class="form-control img-data" required>\n' +
        '    <input type="hidden" name="componentData[' + total_option + '][title][group]" value="' + total_option + '">\n' +
        '<span class="help-block duplicate-error text-danger"></span>\n' +
        '</div>\n' +

        '<div class="form-group col-md-6 option-' + total_option + '">\n' +
        '    <label for="alt_text">Desciption En</label>\n' +
        '    <textarea name="componentData[' + total_option + '][desc][value_en]" class="form-control img-data"></textarea>\n' +
        '    <input type="hidden" name="componentData[' + total_option + '][desc][group]" value="' + total_option + '">\n' +
        '<span class="help-block duplicate-error text-danger"></span>\n' +
        '</div>\n' +

        '<div class="form-group col-md-5 option-' + total_option + '">\n' +
        '    <label for="alt_text">Desciption Bn</label>\n' +
        '    <textarea name="componentData[' + total_option + '][desc][value_bn]" class="form-control img-data"></textarea>\n' +
        '    <input type="hidden" name="componentData[' + total_option + '][desc][group]" value="' + total_option + '">\n' +
        '<span class="help-block duplicate-error text-danger"></span>\n' +
        '</div>\n' +

        '<div class="form-group col-md-4 option-' + total_option + '">\n' +
        '<label for="alt_text">Button En</label>\n' +
        '    <input type="text" name="componentData[' + total_option + '][button][value_en]" class="form-control img-data" required>\n' +
        '    <input type="hidden" name="componentData[' + total_option + '][button][group]" value="' + total_option + '">\n' +
        '<span class="help-block duplicate-error text-danger"></span>\n' +
        '</div>\n' +

        '<div class="form-group col-md-4 option-' + total_option + '">\n' +
        '    <label for="alt_text">Button Bn</label>\n' +
        '    <input type="text" name="componentData[' + total_option + '][button][value_bn]" class="form-control img-data" required>\n' +
        '    <input type="hidden" name="componentData[' + total_option + '][button][group]" value="' + total_option + '">\n' +
        '<span class="help-block duplicate-error text-danger"></span>\n' +
        '</div>\n' +

        '<div class="form-group col-md-3 option-' + total_option + '">\n' +
        '    <label for="alt_text">Button Link</label>\n' +
        '    <input type="text" name="componentData[' + total_option + '][button_link][value_bn]" class="form-control img-data" required>\n' +
        '    <input type="hidden" name="componentData[' + total_option + '][title][group]" value="' + total_option + '">\n' +
        '<span class="help-block duplicate-error text-danger"></span>\n' +
        '</div>\n' +

        '<div class="form-group col-md-1 option-' + total_option + '">\n' +
        '   <label for="alt_text"></label>\n' +
        '   <button type="button" class="btn-sm btn-danger remove-image mt-2" data-id="option-' + total_option + '" ><i data-id="option-' + total_option + '" class="la la-trash"></i></button>\n' +
        '</div>';

    $('#' + componentType).append(input);
    dropify();

    $(document).on('click', '.remove-image', function (event) {
        var rowId = $(event.target).attr('data-id');
        $('.' + rowId).remove();
    });
});
