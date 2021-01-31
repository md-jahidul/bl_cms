$(function () {
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

    $(document).on('click', '#plus-tab', function (event) {
        var itemPlusBtn = $(event.target).attr('data-id');
        var tab_count = $('.tab').length + 1;
        // var option_count = $('#' + itemPlusBtn + ' >' + '.options-count');
        var option_count = $('.options-count');
        var total_option = option_count.length + 2;

        // console.log(option_count)

        var tabField =
            '<!--Tab ' + total_option + '-->\n' +
            '<div class="form-group col-md-12 col-xs-6 tab tab_component_' + tab_count + '">\n' +
            '     <div class="pull-left mt-2">\n' +
            '         <h3><strong>Tab ' + tab_count + '</strong></h3>\n' +
            '     </div>\n' +
            '     <div class="pull-right">\n' +
            '         <label for="alt_text"></label>\n' +
            '         <button type="button" class="btn btn-danger mt-2 remove-image" data-id="tab_component_' + tab_count + '">' +
            '       <i data-id="tab_component_' + tab_count + '" class="la la-trash"></i></button>\n' +
            '     </div>\n' +
            '     <hr class="item-tab">\n' +
            ' </div>\n' +
            ' <div class="form-group col-md-6 tab_component_' + tab_count + '">\n' +
            '     <label for="title_en">Tab Title (English)</label>\n' +
            '     <input type="text" name="batch[tab_' + tab_count + '][title_en]"  class="form-control" placeholder="Enter company name bangla">\n' +
            ' </div>\n' +
            ' <div class="form-group col-md-6 tab_component_' + tab_count + '">\n' +
            '     <label for="title_bn" >Tab Title (Bangla)</label>\n' +
            '     <input type="text" name="batch[tab_' + tab_count + '][title_bn]"  class="form-control" placeholder="Enter company name bangla">\n' +
            ' </div>';

        tabField +=
            '<slot class="tab_component_' + tab_count + '  options-count" id="tab_component_' + tab_count + '">\n' +
            '<div class="col-md-12 col-xs-6 options-count">\n' +
            '    <h3><strong>Item 1</strong></h3>\n' +
            '    <hr class="item-line">\n' +
            '</div>\n' +

            '<div class="col-md-6 col-xs-6">\n' +
            '<input id="multi_item_count" type="hidden" name="multi_item_count" value="' + tab_count + '">\n' +
            '<div class="form-group">\n' +
            '      <label for="message">Image</label>\n' +
            '      <input type="file" class="dropify" name="batch[tab_' + tab_count + '][items][item_1][image]" data-height="80"/>\n' +
            '      <span class="text-primary">Please given file type (.png, .jpg, svg)</span>\n' +
            '  </div>\n' +
            ' </div>\n' +

            '<div class="form-group col-md-4 option-' + total_option + '">\n' +
            '    <label for="alt_text">Alt Text English</label>\n' +
            '    <input type="text" name="batch[tab_' + tab_count + '][items][item_1][alt_text_en]"  class="form-control">\n' +
            '</div>\n' +

            '<div class="form-group col-md-2">\n' +
            '  <label for="alt_text"></label>\n' +
            '  <button type="button" class="btn-sm btn-outline-success multi_item_remove mt-2 tab-multi-item" data-id="tab_component_' + tab_count + '">\n' +
            '      Add More Item\n' +
            '  </button>\n' +
            '</div>\n' +

            '<div class="form-group col-md-4 option-' + total_option + '">\n' +
            '    <label for="title_en">Alt Text Bangla</label>\n' +
            '    <input type="text" name="batch[tab_' + tab_count + '][items][item_1][alt_text_bn]"  class="form-control">\n' +
            '</div>\n' +

            '<div class="form-group col-md-4 option-' + total_option + '">\n' +
            '    <label for="title_en">Image Name English</label>\n' +
            '    <input type="text" name="batch[tab_' + tab_count + '][items][item_1][img_name_en]"  class="form-control">\n' +
            '</div>\n' +

            '<div class="form-group col-md-4 option-' + total_option + '">\n' +
            '    <label for="title_bn">Image Name Bangla</label>\n' +
            '    <input type="text" name="batch[tab_' + tab_count + '][items][item_1][img_name_bn]"  class="form-control">\n' +
            '</div>\n' +

            '<div class="form-group col-md-6 option-' + total_option + '">\n' +
            '    <label for="title_en">Title Field (English)</label>\n' +
            '    <input type="text" name="batch[tab_' + tab_count + '][items][item_1][title_en]"  class="form-control">\n' +
            '</div>\n' +

            '<div class="form-group col-md-6 option-' + total_option + '">\n' +
            '    <label for="title_bn">Title Field (Bangla)</label>\n' +
            '    <input type="text" name="batch[tab_' + tab_count + '][items][item_1][title_bn]"  class="form-control">\n' +
            '</div>\n' +

            '<slot';

        $("#batch_component").append(tabField);
        dropify();
    });

    //Batches Component Dynamic Field Component
    $(document).on('click', '.tab-multi-item', function (event) {
        var itemPlusBtn = $(event.target).attr('data-id');
        var option_count = $('#' + itemPlusBtn + ' >' + '.options-count');
        console.log(option_count)
        var total_option = option_count.length + 1;

        // alert(total_option)

        var tabComCount = $('.' + itemPlusBtn).length + 1
        var tabCount = itemPlusBtn.split("_")[2]

        var subItemInput =
            '<div class="col-md-12 col-xs-6 ' + itemPlusBtn + ' ' + itemPlusBtn + '_item_' + tabComCount + ' options-count">\n' +
            '    <h3><strong>Item ' + total_option + '</strong></h3>\n' +
            '    <hr class="item-line">\n' +
            '</div>\n' +

            '<div class="col-md-6 col-xs-6 ' + itemPlusBtn + '_item_' + tabComCount + '">\n' +
            '<input id="multi_item_count" type="hidden" name="multi_item_count" value="' + total_option + '">\n' +
            '<div class="form-group">\n' +
            '      <label for="message">Multiple Image</label>\n' +
            '      <input type="file" class="dropify" name="batch[tab_' + tabCount + '][items][item_' + total_option + '][image]" data-height="80"/>\n' +
            '      <span class="text-primary">Please given file type (.png, .jpg, svg)</span>\n' +
            '  </div>\n' +
            ' </div>\n' +
            '<div class="form-group col-md-4 ' + itemPlusBtn + '_item_' + tabComCount + '">\n' +
            '    <label for="alt_text">Alt Text English</label>\n' +
            '    <input type="text" name="batch[tab_' + tabCount + '][items][item_' + total_option + '][alt_text_en]"  class="form-control">\n' +
            '</div>\n' +

            '<div class="form-group col-md-1 ' + itemPlusBtn + '_item_' + tabComCount + '">\n' +
            '   <label for="alt_text"></label>\n' +
            '   <button type="button" class="btn-sm btn-danger remove-image mt-2" data-id="' + itemPlusBtn + '_item_' + tabComCount + '" ><i data-id="' + itemPlusBtn + '_item_' + tabComCount + '" class="la la-trash"></i></button>\n' +
            '</div>' +

            '<div class="form-group col-md-4 ' + itemPlusBtn + '_item_' + tabComCount + '">\n' +
            '    <label for="title_en">Alt Text Bangla</label>\n' +
            '    <input type="text" name="batch[tab_' + tabCount + '][items][item_' + total_option + '][alt_text_bn]"  class="form-control">\n' +
            '</div>\n' +

            '<div class="form-group col-md-4 ' + itemPlusBtn + '_item_' + tabComCount + '">\n' +
            '    <label for="title_en">Image Name English</label>\n' +
            '    <input type="text" name="batch[tab_' + tabCount + '][items][item_' + total_option + '][img_name_en]" class="form-control">\n' +
            '</div>\n' +

            '<div class="form-group col-md-4 ' + itemPlusBtn + '_item_' + tabComCount + '">\n' +
            '    <label for="title_en">Image Name Bangla</label>\n' +
            '    <input type="text" name="batch[tab_' + tabCount + '][items][item_' + total_option + '][img_name_bn]" class="form-control">\n' +
            '</div>\n' +

            '<div class="form-group col-md-6 ' + itemPlusBtn + '_item_' + tabComCount + '">\n' +
            '    <label for="title_en">Title En</label>\n' +
            '    <input type="text" name="batch[tab_' + tabCount + '][items][item_' + total_option + '][title_en]" class="form-control">\n' +
            '</div>\n' +
            '<div class="form-group col-md-6 ' + itemPlusBtn + '_item_' + tabComCount + '">\n' +
            '    <label for="title_bn">Title Bn</label>\n' +
            '    <input type="text" name="batch[tab_' + tabCount + '][items][item_' + total_option + '][title_bn]" class="form-control">\n' +
            '</div>';
        $("#" + itemPlusBtn).append(subItemInput);
        dropify();
    });
})
