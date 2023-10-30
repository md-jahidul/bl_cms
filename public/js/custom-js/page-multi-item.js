(function () {

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

// $(document).on('keyup', '.img-data', function (e) {
//     var current_value = $(this).val();
//     var inputEl = $(this);
//     if (current_value) {
//         var ifEdit = duplicateChecker.split(",")[1]
//         if (ifEdit !== "edit") {
//             $.ajax({
//                 url: duplicateChecker + "/" + current_value,
//                 methods: "get",
//                 success: function (data) {
//                     if (data) {
//                         inputEl.nextUntil().html("Already exist in database")
//                         inputEl.val('')
//                     } else {
//                         console.log("Not Exist")
//                     }
//                 },
//                 error: function (error) {
//                     alert("Something went wrong")
//                 }
//             })
//         }
//     }
//     $(this).nextUntil().html("")
//     $(this).attr('value', current_value);
//     if ($('.img-data[value="' + current_value + '"]').not($(this)).length > 0 || current_value.length == 0) {
//         $(this).focus();
//         var showError = "It's already given"
//         $(this).nextUntil().html(showError)
//         $(this).val('')
//     }
// })

$(document).on('click', '#plus-image', function () {
    var option_count = $('.page_component_multi_item');

    var total_option = option_count.length;
    var group_count = total_option + 1
    var componentType = $('#component_type').val()
    var input = '';

    input += "<slot class='page_component_multi_item'>"
    if(componentType === "galley_masonry"){
        input += '<div class="col-md-12 col-xs-6 ">\n' +
            '<div class="form-group">\n' +
            '      <label for="message">Image One</label>\n' +
            '      <input type="file" class="dropify" name="componentData[' + total_option + '][image_one][value_en]" data-height="80"/>\n' +
            // '      <input type="hidden" name="componentData[' + total_option + '][image_one][group]" value="' + group_count + '" data-role="group"/>\n' +
            '      <span class="text-primary">Please given file type (.png, .jpg, svg)</span>\n' +
            '  </div>\n' +
            ' </div>';
    } else {
        input += '<div class="col-md-12 col-xs-6 ">\n' +
            '<div class="form-group">\n' +
            '      <label for="message">Image One</label>\n' +
            '      <input type="file" class="dropify" name="componentData[' + total_option + '][image_one][value_en]" data-height="80"/>\n' +
            // '      <input type="hidden" name="componentData[' + total_option + '][image_one][group]" value="' + group_count + '" data-role="group"/>\n' +
            '      <span class="text-primary">Please given file type (.png, .jpg, svg)</span>\n' +
            '  </div>\n' +
            ' </div>';
        if(componentType === "hovering_card_component"){
            input += '<div class="col-md-12 col-xs-5 ">\n' +
                '<div class="form-group">\n' +
                '      <label for="message">Image Two</label>\n' +
                '      <input type="file" class="dropify" name="componentData[' + total_option + '][image_two][value_en]" data-height="80"/>\n' +
                // '      <input type="hidden" name="componentData[' + total_option + '][image_two][group]"/ value="' + group_count + '" data-role="group">\n' +
                '      <span class="text-primary">Please given file type (.png, .jpg, svg)</span>\n' +
                ' </div>\n' +
                ' </div>';
        }
        input += '<div class="form-group col-md-6 ">\n' +
            '<label for="alt_text">Title En</label>\n' +
            '    <input type="text" name="componentData[' + total_option + '][title][value_en]" class="form-control " required>\n' +
            // '    <input type="hidden" name="componentData[' + total_option + '][title][group]" value="' + group_count + '" data-role="group">\n' +
            '<span class="help-block duplicate-error text-danger"></span>\n' +
            '</div>\n' +

            '<div class="form-group col-md-6 ">\n' +
            '    <label for="alt_text">Title Bn</label>\n' +
            '    <input type="text" name="componentData[' + total_option + '][title][value_bn]" class="form-control " required>\n' +
            // '    <input type="hidden" name="componentData[' + total_option + '][title][group]" value="' + group_count + '" data-role="group">\n' +
            '<span class="help-block duplicate-error text-danger"></span>\n' +
            '</div>\n' +

            '<div class="form-group col-md-6 ">\n' +
            '    <label for="alt_text">Desciption En</label>\n' +
            '    <textarea name="componentData[' + total_option + '][desc][value_en]" class="form-control "></textarea>\n' +
            // '    <input type="hidden" name="componentData[' + total_option + '][desc][group]" value="' + group_count + '" data-role="group">\n' +
            '<span class="help-block duplicate-error text-danger"></span>\n' +
            '</div>\n' +

            '<div class="form-group col-md-6 ">\n' +
            '    <label for="alt_text">Desciption Bn</label>\n' +
            '    <textarea name="componentData[' + total_option + '][desc][value_bn]" class="form-control "></textarea>\n' +
            // '    <input type="hidden" name="componentData[' + total_option + '][desc][group]" value="' + group_count + '" data-role="group">\n' +
            '<span class="help-block duplicate-error text-danger"></span>\n' +
            '</div>\n' +

            '<div class="form-group col-md-4 ">\n' +
            '<label for="alt_text">Button En</label>\n' +
            '    <input type="text" name="componentData[' + total_option + '][button][value_en]" class="form-control " required>\n' +
            // '    <input type="hidden" name="componentData[' + total_option + '][button][group]" value="' + group_count + '" data-role="group">\n' +
            '<span class="help-block duplicate-error text-danger"></span>\n' +
            '</div>\n' +

            '<div class="form-group col-md-4 ">\n' +
            '    <label for="alt_text">Button Bn</label>\n' +
            '    <input type="text" name="componentData[' + total_option + '][button][value_bn]" class="form-control " required>\n' +
            // '    <input type="hidden" name="componentData[' + total_option + '][button][group]" value="' + group_count + '" data-role="group">\n' +
            '<span class="help-block duplicate-error text-danger"></span>\n' +
            '</div>\n' +

            '<div class="form-group col-md-4 ">\n' +
            '    <label for="alt_text">Button Link</label>\n' +
            '    <input type="text" name="componentData[' + total_option + '][button_link][value_en]" class="form-control " required>\n' +
            // '    <input type="hidden" name="componentData[' + total_option + '][button_link][group]" value="' + group_count + '" data-role="group">\n' +
            '<span class="help-block duplicate-error text-danger"></span>\n' +
            '</div>';
    }

    input += '<div class="form-group col-md-1 ">\n' +
        '   <label for="alt_text"></label>\n' +
        '   <i class="la la-trash remove-image btn-sm btn-danger"></i> \n' +
        '</div>';
    input += "</slot>"

    $('#component_data').append(input);
    $('#' + componentType).append(input);
    dropify();
});

    $(document).on('click', '.remove-image', function (event) {
        var id = $(event.target).attr('data-com-id');
        var group = $(event.target).attr('data-group');
        if (id){
            var confirmPopupParams = {
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                html: jQuery('.delete_btn').html(),
                showCancelButton: true,
                confirmButtonColor: '#a2162a',
                cancelButtonColor: '#9dada5',
                confirmButtonText: 'Yes, delete it!'
            };

            var deletePopupParams = {
                title: 'Deleted!',
                text: 'Your item has been deleted.',
                type: 'success'
            }

            Swal.fire(confirmPopupParams).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: componentDataDestroyUrl + "?data-com-id=" + id + "&data-group=" + group,
                        methods: "get",
                        success: function (redirectUrl) {
                            Swal.fire(deletePopupParams);
                            $(event.target).parent().parent().remove();
                        },
                        error: function () {
                            // window.location.replace(url);
                        }
                    })
                }
            })
        } else {
            // console.log($('input[data-role=group]'));
            $(event.target).parent().parent().remove();
        }
    });
})();
