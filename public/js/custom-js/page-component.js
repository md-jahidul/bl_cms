(function () {
    var cardLine =
        `<div class="col-md-12">
            <span><h5><strong>Card Info</strong></h5></span>
            <div class="form-actions col-md-12 mt-0 type-line"></div>
        </div>`

    var itemCountLine = function (itemNo = null, title = "Item") {
        return `<div class="col-md-12">
            <span><h5><strong class="item-counter">${title + " " + itemNo}</strong></h5></span>
            <div class="form-actions col-md-12 mt-0 item-divider"></div>
        </div>`
    }

    var redirectLink = function (index = 0) {
        return `<div class="form-group col-md-12">
            <label for="button_link" >Redirect Link URL</label>
            <input type="text" name="componentData[${index}][redirect_link][value_en]"  class="form-control" placeholder="Enter company name bangla">
            <div class="help-block"></div>
        </div>`
    }

    var attributeImage =
        `<div class="form-group col-md-12">
            <label for="alt_text" class="">Image</label>
            <div class="custom-file">
                <input type="file" name="attribute[image_file]" class="dropify" data-height="80">
                <span class="text-primary">Please given file type (.png, .jpg, svg)</span>
            </div>
        </div>`

    var attributeTitle =
        `<div class="form-group col-md-6">
            <label for="title_en">Title Field (English)</label>
            <input type="text" name="attribute[title][en]"  class="form-control" placeholder="Enter company name bangla">
            <div class="help-block"></div>
        </div>
        <div class="form-group col-md-6">
            <label for="title_en">Title Field (Bangla)</label>
            <input type="text" name="attribute[title][bn]"  class="form-control" placeholder="Enter company name bangla">
            <div class="help-block"></div>
        </div>`

    var attributeTitleSubTitle =
        `<div class="form-group col-md-6">
            <label for="desc_en">Description (English)</label>
            <textarea type="text" name="attribute[desc][en]"  class="form-control summernote_editor" placeholder="Enter offer details in english"></textarea>
            <div class="help-block"></div>
        </div>

        <div class="form-group col-md-6">
            <label for="desc_bn">Description (Bangla)</label>
            <textarea type="text" name="attribute[desc][bn]"  class="form-control summernote_editor" placeholder="Enter offer details in english" ></textarea>
            <div class="help-block"></div>
        </div>`

    var attributeButton =
        `<div class="form-group col-md-4">
            <label for="title_en">Button Field (English)</label>
            <input type="text" name="attribute[button_name][en]"  class="form-control" placeholder="Enter button name English">
            <div class="help-block"></div>
        </div>
        <div class="form-group col-md-4">
            <label for="button_bn">Button Field (Bangla)</label>
            <input type="text" name="attribute[button_name][bn]"  class="form-control" placeholder="Enter button name bangla">
            <div class="help-block"></div>
        </div>
        <div class="form-group col-md-4">
            <label for="title_en">Button Field URL</label>
            <input type="text" name="attribute[button_link][en]"  class="form-control" placeholder="Enter button name url">
            <div class="help-block"></div>
        </div>`

    var singleImage =
        `<div class="form-group col-md-12">
            <label for="alt_text" class="">Image Field</label>
            <div class="custom-file">
                <input type="file" name="componentData[0][image][value_en]" class="dropify" data-height="80">
                <span class="text-primary">Please given file type (.png, .jpg, svg)</span>
            </div>
        </div>`

    var imageOne = function (index= 0, isTab = false, tabIndex = 0) {
        let fieldName = ""
        if (isTab) {
            fieldName += `componentData[${index}][tab_items][${tabIndex}][image][value_en]`;
        }else {
            fieldName += `componentData[${index}][image][value_en]`;
        }

        return `<div class="col-md-12 col-xs-12">
            <div class="form-group">
                <label for="message">Image</label>
                <input type="file" class="dropify" name="${fieldName}" data-height="80"/>
                <span class="text-primary">Please given file type (.png, .jpg, svg)</span>
                <div class="help-block"></div>
            </div>
        </div>`
    }


    var imageTwo = function (index = 0, label = 'Hover', fieldName = 'image_hover') {
        return `<div class="col-md-12 col-xs-12">
            <div class="form-group">
                <label for="message">Image ${label}</label>
                <input type="file" class="dropify" name="componentData[${index}][${fieldName}][value_en]" data-height="80"/>
                <span class="text-primary">Please given file type (.png, .jpg, svg)</span>
                <div class="help-block"></div>
            </div>
        </div>`
    }

    var multiItemTitle = function (index = 0, isTab = false, tabIndex = 0) {
        let fieldNameEn = ""
        let fieldNameBn = ""
        let tabInput = ""

        if (isTab) {
            fieldNameEn += `componentData[${index}][tab_items][${tabIndex}][title][value_en]`;
            fieldNameBn += `componentData[${index}][tab_items][${tabIndex}][title][value_bn]`;
            tabInput += `<input type="hidden" name="componentData[${index}][title][is_tab]" value="1">`;
        }else {
            fieldNameEn += `componentData[${index}][title][value_en]`;
            fieldNameBn += `componentData[${index}][title][value_bn]`;
        }

        return `<div class="form-group col-md-6">
            <label for="title_en">Title En</label>
            ${tabInput}
            <input type="text" name="${fieldNameEn}" class="form-control">
        </div>
        <div class="form-group col-md-6">
            <label for="title_en">Title Bn</label>
            <input type="text" name="${fieldNameBn}" class="form-control">
        </div>`
    }

    var multiItemDescription  = function (index = 0, isTab = false, tabIndex = 0) {
        let fieldNameEn = ""
        let fieldNameBn = ""

        if (isTab) {
            fieldNameEn += `componentData[${index}][tab_items][${tabIndex}][desc][value_en]`;
            fieldNameBn += `componentData[${index}][tab_items][${tabIndex}][desc][value_bn]`;
        }else {
            fieldNameEn += `componentData[${index}][desc][value_en]`;
            fieldNameBn += `componentData[${index}][desc][value_bn]`;
        }

        return `<div class="form-group col-md-6">
            <label for="title_en">Description En</label>
            <textarea type="text" rows="3" name="${fieldNameEn}" class="form-control"></textarea>
        </div>

        <div class="form-group col-md-6">
            <label for="title_en">Description Bn</label>
            <textarea type="text" rows="3" name="${fieldNameBn}" class="form-control"></textarea>
        </div>`
    }

    var multiItemTitleTwo = function (index = 0, label = 'Title', fieldName = 'title') {
        return `<div class="form-group col-md-6">
            <label for="title_en">${label} En</label>
            <input type="text" name="componentData[${index}][${fieldName}][value_en]" class="form-control">
        </div>
        <div class="form-group col-md-6">
            <label for="title_en">${label} Bn</label>
            <input type="text" name="componentData[${index}][${fieldName}][value_bn]" class="form-control">
        </div>`
    }

    var multiItemDescriptionTwo  = function (index = 0, label = 'Description', fieldName = 'desc') {
        return `<div class="form-group col-md-6">
            <label for="title_en">${label} En</label>
            <textarea type="text" rows="3" name="componentData[${index}][${fieldName}][value_en]" class="form-control"></textarea>
        </div>

        <div class="form-group col-md-6">
            <label for="title_en">${label} Bn</label>
            <textarea type="text" rows="3" name="componentData[${index}][${fieldName}][value_bn]" class="form-control"></textarea>
        </div>`
    }

    var multiItemButton  = function (index = 0) {
        return `<div class="form-group col-md-4">
            <label for="button_en">Button Title (English)</label>
            <input type="text" name="componentData[${index}][button_name][value_en]"  class="form-control" placeholder="Enter company name bangla">
            <div class="help-block"></div>
        </div>

        <div class="form-group col-md-4">
            <label for="button_bn" >Button Title (Bangla)</label>
            <input type="text" name="componentData[${index}][button_name][value_bn]"  class="form-control" placeholder="Enter company name bangla">
            <div class="help-block"></div>
        </div>

        <div class="form-group col-md-4">
            <label for="button_link" >Button URL</label>
            <input type="text" name="componentData[${index}][button_link][value_en]"  class="form-control" placeholder="Enter company name bangla">
            <div class="help-block"></div>
        </div>`
    }

    var doubleButton  =
        `<div class="form-group col-md-4">
            <label for="button_en">Button One Title (English)</label>
            <input type="text" name="attribute[button_one_name][en]"  class="form-control" placeholder="Enter button name bangla">
            <div class="help-block"></div>
        </div>

        <div class="form-group col-md-4">
            <label for="button_bn" >Button One Title (Bangla)</label>
            <input type="text" name="attribute[button_one_name][bn]"  class="form-control" placeholder="Enter button name bangla">
            <div class="help-block"></div>
        </div>

        <div class="form-group col-md-4">
            <label for="button_link" >Button One URL</label>
            <input type="text" name="attribute[button_one_link][en]"  class="form-control" placeholder="Enter button name bangla">
            <div class="help-block"></div>
        </div>

        <div class="form-group col-md-4">
            <label for="button_en">Button Two Title (English)</label>
            <input type="text" name="attribute[button_two_name][en]"  class="form-control" placeholder="Enter button name bangla">
            <div class="help-block"></div>
        </div>

        <div class="form-group col-md-4">
            <label for="button_bn" >Button Two Title (Bangla)</label>
            <input type="text" name="attribute[button_two_name][bn]"  class="form-control" placeholder="Enter button name bangla">
            <div class="help-block"></div>
        </div>

        <div class="form-group col-md-4">
            <label for="button_link" >Button Two URL</label>
            <input type="text" name="attribute[button_two_link][en]"  class="form-control" placeholder="Enter button url bangla">
            <div class="help-block"></div>
        </div>`

    var addBtn  =
        `<div class="form-group col-md-12">
            <label for="alt_text"></label>
            <button type="button" class="btn-sm btn-outline-secondary block" id="plus-image"><i class="la la-plus"></i> Add More</button>
        </div>`

    var addTabBtn  =
        `<div class="form-group col-md-12">
            <label for="alt_text"></label>
            <button type="button" class="btn-sm btn-outline-warning block add-tab-item" ><i class="la la-plus"></i> Add More</button>
        </div>`

    var removeBtn =
        `<div class="form-group col-md-1 ">
           <label for="alt_text"></label>
           <i class="la la-trash remove-image btn-sm btn-danger"></i>
        </div>`;

    var removeTabItemBtn =
        `<div class="form-group col-md-1 ">
           <label for="alt_text"></label>
           <i class="la la-trash remove-tab-item btn-sm btn-danger"></i>
        </div>`;

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


    $('#component_type').on('change', function () {
        let componentElementId = $('#component_data');
        let componentType = $(this).val();
        let componentData = '';

        if (componentType === "banner_with_button"){
            componentData += attributeTitle + attributeTitleSubTitle + attributeButton + attributeImage;
        }else if(componentType === "hovering_card_component"){
            componentData +=
                `<slot class="page_component_multi_item">` +
                    attributeTitle +
                    attributeTitleSubTitle +
                    cardLine +
                    addBtn +
                    itemCountLine(1) +
                    imageOne() + imageTwo() +
                    multiItemTitle() +
                    multiItemDescription() +
                    redirectLink() +

                `</slot>`;
        }else if(componentType === "card_with_bg_color_component"){
            componentData +=
                `<slot class="page_component_multi_item">` +
                    attributeTitle +
                    attributeTitleSubTitle +
                    cardLine +
                    addBtn +
                    itemCountLine(1) +
                    imageOne() +
                    multiItemTitle() +
                    multiItemDescription() +
                    multiItemButton() +
                `</slot>`;
        }else if(componentType === "hiring_now_component"){
            componentData += attributeTitle + attributeTitleSubTitle + attributeImage + doubleButton;
        }else if(componentType === "top_image_card_with_button"){
            componentData +=
                `<slot class="page_component_multi_item">` +
                    attributeTitle +
                    attributeTitleSubTitle +
                    cardLine +
                    addBtn +
                    itemCountLine(1) +
                    imageOne() +
                    multiItemTitle() +
                    multiItemDescription() +
                    multiItemButton() +

                `</slot>`;
        }else if(componentType === "step_cards_with_hovering_effect"){
            componentData +=
                `<slot class="page_component_multi_item">` +
                    attributeTitle +
                    attributeTitleSubTitle +
                    attributeButton +
                    cardLine +
                    addBtn +
                    itemCountLine(1) +
                    imageOne() + imageTwo() +
                    multiItemTitle() +
                    multiItemDescription() +
                    multiItemTitleTwo(0, 'Title Hover', 'title_hover') +
                    multiItemDescriptionTwo(0, 'Description Hover', 'desc_hover') +

                `</slot>`;
        }else if(componentType === "galley_masonry"){
            componentData +=
                `<slot class="page_component_multi_item">` +
                    attributeTitle +
                    attributeTitleSubTitle +
                    attributeButton +
                    cardLine +
                    addBtn +
                    itemCountLine(1) +
                    imageOne() +
                `</slot>`;
        }else if(componentType === "tab_component_with_image_card_one"){
            componentData +=
                `<slot class="page_component_multi_item">` +
                    attributeTitle +
                    attributeTitleSubTitle +
                    cardLine +
                    addBtn +
                    itemCountLine(1, "Tab") +
                    multiItemTitle() +
                    `<div class="col-md-11 ml-5">
                        <div class="row tab-item">
                            <slot class="tab_item_count">
                                ${
                                    addTabBtn +
                                    multiItemTitle(0, true, 0) +
                                    multiItemDescription(0, true, 0) +
                                    imageOne(0, true, 0)
                                }
                            </slot>
                        </div>
                    </div>` +
                `</slot>`;
        }else{
            console.log('No component found!!')
        }

        componentElementId.empty()
        componentElementId.append(componentData)
        dropify();
        // if ( == )
        // var componentType = this.value + ".png"
        // var fullUrl = "{{ asset('component-images') }}/" + componentType;
        // $("#componentImg").attr('src', fullUrl)
    })

    $(document).on('click', '#plus-image', function () {
        var option_count = $('.page_component_multi_item');
        var index = option_count.length;
        var componentType = $('#component_type').val()
        var componentData = '';

        if (componentType === "banner_with_button"){
            componentData += attributeTitle + attributeTitleSubTitle + attributeButton + singleImage;
        }else if(componentType === "hovering_card_component"){
            componentData +=
                `<slot class="page_component_multi_item">` +
                    itemCountLine(index + 1) +
                    imageOne(index) + imageTwo(index) +
                    multiItemTitle(index) +
                    multiItemDescription(index) +
                    redirectLink(index) +
                    removeBtn +
                `</slot>`;
        }else if(componentType === "card_with_bg_color_component"){
            componentData +=
                `<slot class="page_component_multi_item">` +
                    itemCountLine(index + 1) +
                    imageOne(index) +
                    multiItemTitle(index) +
                    multiItemDescription(index) +
                    multiItemButton(index) +
                    removeBtn +
                `</slot>`;
        }else if(componentType === "hiring_now_component"){
            componentData += attributeTitle + attributeTitleSubTitle + singleImage + doubleButton;
        }else if(componentType === "top_image_card_with_button"){
            componentData +=
                `<slot class="page_component_multi_item">` +
                    itemCountLine(index + 1) +
                    imageOne(index) +
                    multiItemTitle(index) +
                    multiItemDescription(index) +
                    multiItemButton(index) +
                    removeBtn +
                `</slot>`;
        }else if(componentType === "step_cards_with_hovering_effect"){
            componentData +=
                `<slot class="page_component_multi_item">` +
                    itemCountLine(index + 1) +
                    imageOne(index) + imageTwo(index) +
                    multiItemTitle(index) +
                    multiItemDescription(index) +
                    multiItemTitleTwo(index, 'Title Hover', 'title_hover') +
                    multiItemDescriptionTwo(index, 'Description Hover', 'desc_hover') +
                    removeBtn +
                `</slot>`;
        }else if(componentType === "galley_masonry"){
            componentData +=
                `<slot class="page_component_multi_item">` +
                    itemCountLine(index + 1) +
                    imageOne(index) +
                    removeBtn +
                `</slot>`;
        }else if(componentType === "tab_component_with_image_card_one"){
            componentData +=
                `<slot class="page_component_multi_item">` +
                    itemCountLine(index + 1, "Tab") +
                    multiItemTitle(index) +
                `<div class="col-md-11 ml-5">
                    <div class="row tab-item">
                        <slot class="tab_item_count">
                            ${
                                addTabBtn +
                                itemCountLine('', '') +
                                multiItemTitle(index, true, 0) +
                                multiItemDescription(index, true, 0) +
                                imageOne(index, true, 0)
                            }
                        </slot>
                    </div>
                    </div>` +
                `</slot>`;
        }else{
            console.log('No component found!!')
        }

        $('#component_data').append(componentData);
        $('#' + componentType).append(componentData);
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
            $(event.target).parent().parent().remove();
            let itemCounter = $('.item-counter');
            itemCounter.each(function (index) {
                let totalItem = index + 1;
                $(this).html('Item ' + totalItem)
            })
        }
    });

    // Tab Item Add
    $(document).on('click', '.add-tab-item', function (e) {
        let tabItem = $(e.target).parent().parent().parent()

        let option_count = $('.page_component_multi_item');
        let index = option_count.length - 1;

        let tabItems = tabItem.children();
        let tabItemIndex = tabItems.length

        let componentData =
            `<slot class="tab_item_count">
                ${
                    itemCountLine('', '') +
                    multiItemTitle(index, true, tabItemIndex) +
                    multiItemDescription(index, true, tabItemIndex) +
                    imageOne(index, true, tabItemIndex) +
                    removeTabItemBtn
                }
            </slot>`
        tabItem.append(componentData)
        dropify();
    })
    // Tab Item Remove
    $(document).on('click', '.remove-tab-item', function (event) {
        $(event.target).parent().parent().remove();
        // let itemCounter = $('.item-counter');
        // itemCounter.each(function (index) {
        //     let totalItem = index + 1;
        //     $(this).html('Item ' + totalItem)
        // })
    })
})();
