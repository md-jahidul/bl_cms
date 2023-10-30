(function () {
    var card =
        `<div class="col-md-12">
            <span><h5><strong>Card Info</strong></h5></span>
            <div class="form-actions col-md-12 mt-0 type-line"></div>
        </div>`

    var attributeTitle =
        `<div class="form-group col-md-6">
            <label for="title_en">Title Field (English)</label>
            <input type="text" name="attribute[title_en]"  class="form-control" placeholder="Enter company name bangla">
            <div class="help-block"></div>
        </div>
        <div class="form-group col-md-6">
            <label for="title_en">Title Field (English)</label>
            <input type="text" name="attribute[title_bn]"  class="form-control" placeholder="Enter company name bangla">
            <div class="help-block"></div>
        </div>`

    var attributeTitleSubTitle =
        `<div class="form-group col-md-6">
            <label for="desc_en">Description (English)</label>
            <textarea type="text" name="attribute[desc_en]"  class="form-control summernote_editor" placeholder="Enter offer details in english"></textarea>
            <div class="help-block"></div>
        </div>

        <div class="form-group col-md-6">
            <label for="desc_bn">Description (Bangla)</label>
            <textarea type="text" name="attribute[desc_bn]"  class="form-control summernote_editor" placeholder="Enter offer details in english" ></textarea>
            <div class="help-block"></div>
        </div>`

    var attributeButton =
        `<div class="form-group col-md-4">
            <label for="title_en">Button Field (English)</label>
            <input type="text" name="attribute[button_en]"  class="form-control" placeholder="Enter button name English">
            <div class="help-block"></div>
        </div>
        <div class="form-group col-md-4">
            <label for="title_en">Button Field (English)</label>
            <input type="text" name="attribute[button_bn]"  class="form-control" placeholder="Enter button name bangla">
            <div class="help-block"></div>
        </div>
        <div class="form-group col-md-4">
            <label for="title_en">Button Field URL</label>
            <input type="text" name="attribute[button_url]"  class="form-control" placeholder="Enter button name url">
            <div class="help-block"></div>
        </div>`

    var singleImage =
        `<div class="form-group col-md-12">
            <label for="alt_text" class="">Image Field</label>
            <div class="custom-file">
                <input type="file" name="componentData[0][image][value_en]" class="dropify" data-height="80">
<!--                <input type="hidden" name="componentData[0][image][group]" value="1">-->
                <span class="text-primary">Please given file type (.png, .jpg, svg)</span>
            </div>
        </div>`

    var imageOne =
        `<div class="col-md-12 col-xs-12">
            <div class="form-group">
                <label for="message">Image One</label>
                <input type="file" class="dropify" name="componentData[0][image][value_en]" data-height="80"/>
<!--                <input type="hidden" name="componentData[0][image][group]" value="1" data-role="group">-->
                <span class="text-primary">Please given file type (.png, .jpg, svg)</span>
                <div class="help-block"></div>
            </div>
        </div>`

    var imageTwo =
        `<div class="col-md-12 col-xs-12">
            <div class="form-group">
                <label for="message">Image Two</label>
                <input type="file" class="dropify" name="componentData[0][image_hover][value_en]" data-height="80"/>
<!--                <input type="hidden" name="componentData[0][image_hover][group]" value="1" data-role="group">-->
                <span class="text-primary">Please given file type (.png, .jpg, svg)</span>
                <div class="help-block"></div>
            </div>
        </div>`

    var multiItemTitle =
        `<div class="form-group col-md-6">
            <label for="title_en">Title En</label>
            <input type="text" name="componentData[0][title][value_en]" class="form-control">
<!--            <input type="hidden" name="componentData[0][title][group]" value="1" data-role="group">-->
        </div>

        <div class="form-group col-md-6">
            <label for="title_en">Title Bn</label>
            <input type="text" name="componentData[0][title][value_bn]" class="form-control">
<!--            <input type="hidden" name="componentData[0][title][group]" value="1" data-role="group">-->
        </div>`

    var multiItemDescription  =
        `<div class="form-group col-md-6">
            <label for="title_en">Description En</label>
            <textarea type="text" rows="3" name="componentData[0][desc][value_en]" class="form-control"></textarea>
<!--            <input type="hidden" name="componentData[0][desc][group]" value="1" data-role="group">-->
        </div>

        <div class="form-group col-md-6">
            <label for="title_en">Description Bn</label>
            <textarea type="text" rows="3" name="componentData[0][desc][value_bn]" class="form-control"></textarea>
<!--            <input type="hidden" name="componentData[0][desc][group]" value="1" data-role="group">-->
        </div>`

    var multiItemButton  =
        `<div class="form-group col-md-4">
            <label for="button_en">Button Title (English)</label>
            <input type="text" name="componentData[0][button][value_en]"  class="form-control" placeholder="Enter company name bangla">
<!--            <input type="hidden" name="componentData[0][button][group]" value="1" data-role="group">-->
            <div class="help-block"></div>
        </div>

        <div class="form-group col-md-4">
            <label for="button_bn" >Button Title (Bangla)</label>
            <input type="text" name="componentData[0][button][value_bn]"  class="form-control" placeholder="Enter company name bangla">
<!--            <input type="hidden" name="componentData[0][button][group]" value="1" data-role="group">-->
            <div class="help-block"></div>
        </div>

        <div class="form-group col-md-4">
            <label for="button_link" >Button URL</label>
            <input type="text" name="componentData[0][button_link][value_en]"  class="form-control" placeholder="Enter company name bangla">
<!--            <input type="hidden" name="componentData[0][button_link][group]" value="1" data-role="group">-->
            <div class="help-block"></div>
        </div>`

    var doubleButton  =
        `<div class="form-group col-md-4">
            <label for="button_en">Button One Title (English)</label>
            <input type="text" name="componentData[0][button_one][value_en]"  class="form-control" placeholder="Enter button name bangla">
<!--            <input type="hidden" name="componentData[0][button_one][group]" value="1">-->
            <div class="help-block"></div>
        </div>

        <div class="form-group col-md-4">
            <label for="button_bn" >Button One Title (Bangla)</label>
            <input type="text" name="componentData[0][button_one][value_bn]"  class="form-control" placeholder="Enter button name bangla">
            <input type="hidden" name="componentData[0][button_one][group]" value="1">
            <div class="help-block"></div>
        </div>

        <div class="form-group col-md-4">
            <label for="button_link" >Button One URL</label>
            <input type="text" name="componentData[0][button_one_url][value_en]"  class="form-control" placeholder="Enter button name bangla">
            <input type="hidden" name="componentData[0][button_one_url][group]" value="1">
            <div class="help-block"></div>
        </div>

        <div class="form-group col-md-4">
            <label for="button_en">Button Two Title (English)</label>
            <input type="text" name="componentData[0][button_two][value_en]"  class="form-control" placeholder="Enter button name bangla">
<!--            <input type="hidden" name="componentData[0][button_two][group]" value="1">-->
            <div class="help-block"></div>
        </div>

        <div class="form-group col-md-4">
            <label for="button_bn" >Button Two Title (Bangla)</label>
            <input type="text" name="componentData[0][button_two][value_bn]"  class="form-control" placeholder="Enter button name bangla">
<!--            <input type="hidden" name="componentData[0][button_two][group]" value="1">-->
            <div class="help-block"></div>
        </div>

        <div class="form-group col-md-4">
            <label for="button_link" >Button Two URL</label>
            <input type="text" name="componentData[0][button_two_url][value_en]"  class="form-control" placeholder="Enter button url bangla">
<!--            <input type="hidden" name="componentData[0][button_two_url][group]" value="1">-->
            <div class="help-block"></div>
        </div>`

    var multiItemBtnAddRemove  =
        `<div class="form-group col-md-12">
            <label for="alt_text"></label>
            <button type="button" class="btn-sm btn-outline-secondary mt-2 block" id="plus-image"><i class="la la-plus"></i></button>
        </div>`

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
            componentData += attributeTitle + attributeTitleSubTitle + attributeButton + line + singleImage;
        }else if(componentType === "hovering_card_component"){
            componentData +=
                `<slot class="page_component_multi_item">` +
                    attributeTitle +
                    attributeTitleSubTitle +
                    card +
                    imageOne + imageTwo +
                    multiItemTitle +
                    multiItemDescription +
                    multiItemButton +
                    multiItemBtnAddRemove +
                `</slot>`;
        }else if(componentType === "card_with_bg_color_component"){
            componentData +=
                `<slot class="page_component_multi_item">` +
                    attributeTitle +
                    attributeTitleSubTitle +
                    card +
                    imageOne +
                    multiItemTitle +
                    multiItemDescription +
                    multiItemButton +
                    multiItemBtnAddRemove +
                `</slot>`;
        }else if(componentType === "hiring_now_component"){
            componentData += attributeTitle + attributeTitleSubTitle + singleImage + doubleButton;
        }else if(componentType === "top_image_card_with_button"){
            componentData +=
                `<slot class="page_component_multi_item">` +
                    attributeTitle +
                    attributeTitleSubTitle +
                    card +
                    imageOne +
                    multiItemTitle +
                    multiItemDescription +
                    multiItemButton +
                    multiItemBtnAddRemove +
                `</slot>`;
        }else if(componentType === "galley_masonry"){
            componentData +=
                `<slot class="page_component_multi_item">` +
                    attributeTitle +
                    attributeTitleSubTitle +
                    card +
                    attributeButton +
                    imageOne +
                    multiItemBtnAddRemove +
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
})();

