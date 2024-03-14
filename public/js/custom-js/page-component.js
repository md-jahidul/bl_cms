(function () {
    let configBgImage = `
        <div class="form-group col-md-4">
            <label for="editor_en">Background Image</label>
            <select name="config[bg_image]" class="form-control required" required>
                <option value="yes">Yes</option>
                <option value="no" selected>No</option>
            </select>
        </div>
    `

    var cardLine = function (title = "Card Info") {
        return `<div class="col-md-12">
            <span><h5><strong>${title}</strong></h5></span>
            <div class="form-actions col-md-12 mt-0 type-line"></div>
        </div>`
    }

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

    var videoUrl = function (index = 0) {
        return `<div class="form-group col-md-12" id="video_input_container">
            <label for="button_link" >Video URL</label>
            <input type="text" name="attribute[media_url][en]"  class="form-control" placeholder="Enter video link">
            <div class="help-block"></div>
        </div>`
    }

    // var attributeImage =
    //     `<div class="form-group col-md-12">
    //         <label for="alt_text" class="">Image</label>
    //         <div class="custom-file">
    //             <input type="file" name="attribute[image_file]" class="dropify" data-height="80">
    //             <span class="text-primary">Please given file type (.png, .jpg, svg)</span>
    //         </div>
    //     </div>`

    var attributeIsVideo = function (fieldName = "is_video", label = "Video Preview") {
        return `
        <div class="form-group col-md-12">
            <label for="is_video" class="">${label}</label>
            <div class="button_link">
                <input type="checkbox" id="is_video" name="attribute[is_video][en]" class="checkbox"/>
                <span class="text-primary"> Check here, if you need Video preview</span>
            </div>
        </div>`
    }
    
    var attributeImage = function (fieldName = "image_file", label = "Image") {
        return `
        <div class="form-group col-md-12" id="image_input_container">
            <label for="alt_text" class="">${label}</label>
            <div class="custom-file">
                <input type="file" name="attribute[${fieldName}]" class="dropify" data-height="80">
                <span class="text-primary">Please given file type (.png, .jpg, svg)</span>
            </div>
        </div>`
    }

    var attributeColor = function (fieldName = "color", label = "Color") {
        return `
        <div class="form-group col-md-4">
            <label for="alt_text" class="">${label}</label>
            <div class="custom-file">
                <input type="color" name="attribute[${fieldName}][en]" value="#FFFFFF">
            </div>
        </div>`
    }

    var attributeTitle =
        `<div class="form-group col-md-6">
            <label for="title_en">Title Field (English)</label>
            <input type="text" name="attribute[title][en]"  class="form-control" placeholder="Enter company name Bangla">
            <div class="help-block"></div>
        </div>
        <div class="form-group col-md-6">
            <label for="title_en">Title Field (Bangla)</label>
            <input type="text" name="attribute[title][bn]"  class="form-control" placeholder="Enter company name Bangla">
            <div class="help-block"></div>
        </div>`

    var dynamicInputField = function (label= 'Title', fieldName= 'title', lang='en', type="text") {
        var languageText = lang==="en" ? ' (English)' : lang==="bn" ? ' (Bangla)' : ' '+lang,
         languageKey = !['en','bn'].includes(lang) ? 'en': lang;
        return `<div class="form-group col-md-6">
            <label for="${fieldName + languageKey}">${label + languageText}</label>
            <input type="${type}" name="attribute[${fieldName}][${languageKey}]"  class="form-control" placeholder="Enter ${label + languageText}" id="${fieldName + languageKey}">
            <div class="help-block"></div>
        </div>`
    }

    var dynamicInputFieldPair = function (label= 'Title', fieldName= 'title', lang='en', type="text") {
        return dynamicInputField(label, fieldName, 'en', type) + dynamicInputField(label, fieldName, 'bn', type);
    }

    var attributeTitleSubTitle =
        `<div class="form-group col-md-6">
            <label for="desc_en">Description (English)</label>
            <textarea type="text" name="attribute[desc][en]"  class="form-control" placeholder="Enter offer details in english"></textarea>
            <div class="help-block"></div>
        </div>

        <div class="form-group col-md-6">
            <label for="desc_bn">Description (Bangla)</label>
            <textarea type="text" name="attribute[desc][bn]"  class="form-control" placeholder="Enter offer details in Bangla" ></textarea>
            <div class="help-block"></div>
        </div>`

    var attributeEditor =
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
            <input type="text" name="attribute[button_name][bn]"  class="form-control" placeholder="Enter button name Bangla">
            <div class="help-block"></div>
        </div>
        <div class="form-group col-md-4">
            <label for="title_en">Button Field URL</label>
            <input type="text" name="attribute[button_link][en]"  class="form-control" placeholder="Enter button name url">
            <div class="help-block"></div>
        </div>`

    var attrPlayStoreLink = function (index = 0) {
        return `<div class="form-group col-md-6">
            <label for="button_link" >Play Store Link</label>
            <input type="text" name="attribute[play_store_link][en]"  class="form-control" placeholder="Enter play store link">
            <div class="help-block"></div>
        </div>`
    }

    var attrAppStoreLink = function (index = 0) {
        return `<div class="form-group col-md-6">
            <label for="button_link" >App Store Link</label>
            <input type="text" name="attribute[app_store_link][en]"  class="form-control" placeholder="Enter app store link">
            <div class="help-block"></div>
        </div>`
    }

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
                <label for="message">${label} Image</label>
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

    var multiItemDescription  = function (index = 0, isTab = false, tabIndex = 0, it_editor = false) {
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
            <textarea type="text" rows="3" name="${fieldNameEn}" class="form-control ${it_editor ? 'summernote_editor' : '' }"></textarea>
        </div>

        <div class="form-group col-md-6">
            <label for="title_en">Description Bn</label>
            <textarea type="text" rows="3" name="${fieldNameBn}" class="form-control ${it_editor ? 'summernote_editor' : '' }"></textarea>
        </div>`
    }

    var multiItemFreeText = function (index = 0, fieldName, Label) {
        return `<div class="form-group col-md-6">
            <label for="title_en">${Label} En</label>
            <input type="text" name="componentData[${index}][${fieldName}][value_en]" class="form-control">
        </div>
        <div class="form-group col-md-6">
            <label for="title_en">${Label} Bn</label>
            <input type="text" name="componentData[${index}][${fieldName}][value_bn]" class="form-control">
        </div>`
    }

    var multiItemFeedback  = function (index = 0, isTab = false, tabIndex = 0) {
        let fieldFeedbackEn = ""
        let fieldFeedbackBn = ""
        let fieldNameEn = ""
        let fieldNameBn = ""
        let fieldDesignationEn = ""
        let fieldDesignationBn = ""
        let fieldInstituteEn = ""
        let fieldInstituteBn = ""
        let tabFeedback = ""
        let tabName = ""
        let tabDesignation = ""
        let tabInstitute = ""
        let tabInput = ""
        let tabTitle = ""

        if (isTab) {
            fieldFeedbackEn += `componentData[${index}][tab_items][${tabIndex}][feedback][value_en]`;
            fieldFeedbackBn += `componentData[${index}][tab_items][${tabIndex}][feedback][value_bn]`;
            fieldNameEn += `componentData[${index}][tab_items][${tabIndex}][name][value_en]`;
            fieldNameBn += `componentData[${index}][tab_items][${tabIndex}][name][value_bn]`;
            fieldDesignationEn += `componentData[${index}][tab_items][${tabIndex}][designation][value_en]`;
            fieldDesignationBn += `componentData[${index}][tab_items][${tabIndex}][designation][value_bn]`;
            fieldInstituteEn += `componentData[${index}][tab_items][${tabIndex}][institute][value_en]`;
            fieldInstituteBn += `componentData[${index}][tab_items][${tabIndex}][institute][value_bn]`;
            tabTitle += `<input type="hidden" name="componentData[${index}][title][is_tab]" value="1">`;
            // tabName += `<input type="hidden" name="componentData[${index}][name][is_tab]" value="1">`;
            // tabDesignation += `<input type="hidden" name="componentData[${index}][designation][is_tab]" value="1">`;
            // tabInstitute += `<input type="hidden" name="componentData[${index}][institute][is_tab]" value="1">`;
        }else {
            fieldFeedbackEn +=   `componentData[${index}][feedback][value_en]`;
            fieldFeedbackBn +=   `componentData[${index}][feedback][value_bn]`;
            fieldNameEn +=       `componentData[${index}][name][value_en]`;
            fieldNameBn +=       `componentData[${index}][name][value_bn]`;
            fieldDesignationEn+= `componentData[${index}][designation][value_en]`;
            fieldDesignationBn+= `componentData[${index}][designation][value_bn]`;
            fieldInstituteEn +=  `componentData[${index}][institute][value_en]`;
            fieldInstituteBn +=  `componentData[${index}][institute][value_bn]`;
        }

        return `<div class="form-group col-md-6">
            <label for="title_en">Feedback En</label>
            ${tabTitle}
            <textarea type="text" rows="3" name="${fieldFeedbackEn}" class="form-control"></textarea>
        </div>

        <div class="form-group col-md-6">
            <label for="title_en">Feedback Bn</label>
            <textarea type="text" rows="3" name="${fieldFeedbackBn}" class="form-control"></textarea>
        </div>

        <div class="form-group col-md-6">
            <label for="title_en">Name En</label>
            ${tabName}
            <input type="text" name="${fieldNameEn}" class="form-control">
        </div>
        <div class="form-group col-md-6">
            <label for="title_en">Name Bn</label>
            <input type="text" name="${fieldNameBn}" class="form-control">
        </div>

        <div class="form-group col-md-6">
            <label for="title_en">Designation En</label>
            ${tabDesignation}
            <input type="text" name="${fieldDesignationEn}" class="form-control">
        </div>
        <div class="form-group col-md-6">
            <label for="title_en">Designation Bn</label>
            <input type="text" name="${fieldDesignationBn}" class="form-control">
        </div>
        <div class="form-group col-md-6">
            <label for="title_en">Institute En</label>
            ${tabInstitute}
            <input type="text" name="${fieldInstituteEn}" class="form-control">
        </div>
        <div class="form-group col-md-6">
            <label for="title_en">Institute Bn</label>
            <input type="text" name="${fieldInstituteBn}" class="form-control">
        </div>
        `
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

    var multiItemVideoUrl = function (index = 0, label = 'Video URL', fieldName = 'video_url') {
        return `<div class="form-group col-md-12">
            <label for="title_en">${label}</label>
            <input type="text" name="componentData[${index}][${fieldName}][value_en]" class="form-control">
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

    var multiItemButton  = function (index = 0, isTab = false, tabIndex = 0) {
        let fieldNameEn = ""
        let fieldNameBn = ""
        let fieldNameIink = ""

        if (isTab) {
            fieldNameEn += `componentData[${index}][tab_items][${tabIndex}][button_name][value_en]`;
            fieldNameBn += `componentData[${index}][tab_items][${tabIndex}][button_name][value_bn]`;
            fieldNameIink += `componentData[${index}][tab_items][${tabIndex}][button_link][value_en]`;
        }else {
            fieldNameEn += `componentData[${index}][button_name][value_en]`;
            fieldNameBn += `componentData[${index}][button_name][value_bn]`;
            fieldNameIink += `componentData[${index}][button_link][value_en]`;
        }

        return `<div class="form-group col-md-4">
            <label for="button_en">Button Title (English)</label>
            <input type="text" name="${fieldNameEn}"  class="form-control" placeholder="Enter button lable English">
            <div class="help-block"></div>
        </div>

        <div class="form-group col-md-4">
            <label for="button_bn" >Button Title (Bangla)</label>
            <input type="text" name="${fieldNameBn}"  class="form-control" placeholder="Enter button lable bangla">
            <div class="help-block"></div>
        </div>

        <div class="form-group col-md-4">
            <label for="button_link" >Button URL</label>
            <input type="text" name="${fieldNameIink}"  class="form-control" placeholder="Enter button link">
            <div class="help-block"></div>
        </div>`
    }

    var multiItemUrl  = function (index = 0) {
        return `<div class="form-group col-md-12">
            <label for="button_link" >URL</label>
            <input type="text" name="componentData[${index}][url][value_en]"  class="form-control" placeholder="Enter url">
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

    var multiItemDoubleButton = function (index = 0) {
        return `<div class="form-group col-md-4">
            <label for="button_en">Button One Title (English)</label>
            <input type="text" name="componentData[${index}][button_one_name][value_en]"  class="form-control" placeholder="Enter button name bangla">
            <div class="help-block"></div>
        </div>

        <div class="form-group col-md-4">
            <label for="button_bn" >Button One Title (Bangla)</label>
            <input type="text" name="componentData[${index}][button_one_name][value_bn]"  class="form-control" placeholder="Enter button name bangla">
            <div class="help-block"></div>
        </div>

        <div class="form-group col-md-4">
            <label for="button_link" >Button One URL</label>
            <input type="text" name="componentData[${index}][button_one_link][value_en]"  class="form-control" placeholder="Enter button name bangla">
            <div class="help-block"></div>
        </div>

        <div class="form-group col-md-4">
            <label for="button_en">Button Two Title (English)</label>
            <input type="text" name="componentData[${index}][button_two_name][value_en]"  class="form-control" placeholder="Enter button name in English">
            <div class="help-block"></div>
        </div>

        <div class="form-group col-md-4">
            <label for="button_bn" >Button Two Title (Bangla)</label>
            <input type="text" name="componentData[${index}][button_two_name][value_bn]"  class="form-control" placeholder="Enter button name in Bangla">
            <div class="help-block"></div>
        </div>

        <div class="form-group col-md-4">
            <label for="button_link" >Button Two URL</label>
            <input type="text" name="componentData[${index}][button_two_link][value_en]"  class="form-control" placeholder="Enter button url">
            <div class="help-block"></div>
        </div>`
    }

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
        `<div class="form-group col-md-12 ">
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

    function summernote_editor(){
        $("textarea.summernote_editor").summernote({
            tableClassName: 'table table-primary table_large offer_table', /* This Table class is front-end table class */
            toolbar: [
                ['style',['style', 'bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['table', ['table']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link', 'picture', 'video', 'hr']],
                ['view', ['fullscreen', 'codeview']],
                ['insert', ['emoji']]
            ],
            popover: {
                table: [
                    ['custom', ['tableHeaders']],
                    ['add', ['addRowDown', 'addRowUp', 'addColLeft', 'addColRight']],
                    ['delete', ['deleteRow', 'deleteCol', 'deleteTable']]
                ],
            },

            height:200
        })
    }


    $('#component_type').on('change', function () {
        const componentTypeImg = this.value + ".png";
        const fullUrl = "{{ asset('page-component-image') }}/" + componentTypeImg;
        $("#componentImg").attr('src', fullUrl)

        let componentElementId = $('#component_data');
        let componentType = $(this).val();
        let componentData = '';

        if (componentType === "banner_with_button"){
            let config = `
                <div class="form-group col-md-4 {{ $errors->has('component_type') ? ' error' : '' }}">
                    <label for="editor_en" class="required">Position</label>
                    <select name="config[position]" class="form-control required" required>
                        <option value="right">Right</option>
                        <option value="bottom" selected>Bottom</option>
                    </select>
                </div>
            `
            componentData +=
                componentData +=
                `<slot class="page_component_multi_item">` +
                    cardLine('Config') +
                    config +
                    cardLine('Component Info') +
                    addBtn +
                    itemCountLine(1) +
                    imageOne() +
                    multiItemTitle() +
                    multiItemDescription() +
                    multiItemButton() +
                `</slot>`;
        }else if(componentType === "hovering_card_component"){
            componentData +=
                `<slot class="page_component_multi_item">` +
                    attributeTitle +
                    attributeTitleSubTitle +
                    cardLine() +
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
                    cardLine() +
                    addBtn +
                    itemCountLine(1) +
                    imageOne() +
                    multiItemTitle() +
                    multiItemDescription() +
                    multiItemButton() +
                `</slot>`;
        }else if(componentType === "hiring_now_component"){
            let config = `
                <div class="form-group col-md-3">
                    <label for="is_ookla">Is Ookla</label>
                    <select name="config[is_ookla]" class="form-control">
                        <option value="yes">Yes</option>
                        <option value="no" selected>No</option>
                    </select>
                </div>`
            componentData +=
                cardLine('Config') +
                config +
                cardLine('Component Items') +
                attributeTitle +
                attributeTitleSubTitle +
                attributeImage() +
                attributeImage('bg_img', "Background Image") +
                doubleButton +
                attributeColor("bg_color", "Background Color");
        }else if(componentType === "top_image_card_with_button"){
            let config = `
                <div class="form-group col-md-6 {{ $errors->has('component_type') ? ' error' : '' }}">
                    <label for="editor_en">Position</label>
                    <select name="config[slider_action]" class="form-control required" required>
                        <option value="">---Select Position---</option>
                        <option value="navigation">Navigation</option>
                    </select>
                </div>
                <div class="form-group col-md-6 {{ $errors->has('component_type') ? ' error' : '' }}">
                    <label for="editor_en">Component Type</label>
                    <select name="config[component_type]" class="form-control">
                        <option value="fixed" selected>Fixed Card</option>
                        <option value="slider">Slider Card</option>
                    </select>
                </div>`

            componentData +=
                `<slot class="page_component_multi_item">` +
                    cardLine('Config') +
                    config +
                    cardLine('Component Info') +
                    attributeTitle +
                    attributeTitleSubTitle +
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
                    cardLine() +
                    addBtn +
                    itemCountLine(1) +
                    imageOne() + imageTwo() +
                    multiItemTitle() +
                    multiItemDescription() +
                    multiItemTitleTwo(0, 'Title Hover', 'title_hover') +
                    multiItemDescriptionTwo(0, 'Description Hover', 'desc_hover') +
                `</slot>`;
        }else if(componentType === "galley_masonry"){
            let config = `
                <div class="form-group col-md-9 {{ $errors->has('component_type') ? ' error' : '' }}">
                    <label for="editor_en">Slider Action</label>
                    <select name="config[slider_action]" class="form-control">
                        <option value="">--Select Position--</option>
                        <option value="navigation">Navigation</option>
                        <option value="pagination">Pagination</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <div class="form-group mt-2">
                        <label for="gray_scale"></label><br>
                        <input type="checkbox" name="config[gray_scale]" value="1" id="gray_scale">
                        <label for="gray_scale" class="ml-1"> <strong>Gray Scale</strong></label><br>
                    </div>
                </div>
            `
            componentData +=
                `<slot class="page_component_multi_item">` +
                    cardLine('Config') +
                    config +
                    cardLine('Top Section') +
                    attributeTitle +
                    attributeTitleSubTitle +
                    attributeButton +
                    cardLine() +
                    addBtn +
                    itemCountLine(1) +
                    imageOne() +
                    multiItemTitle() +
                    multiItemDescription() +
                `</slot>`;
        }else if(componentType === "hero_section"){
            componentData +=
                `<slot class="page_component_multi_item">` +
                    attributeTitle +
                    attributeTitleSubTitle +
                    attributeImage() +
                    cardLine('Breadcrumbs') +
                    addBtn +
                    itemCountLine(1) +
                    multiItemTitle() +
                    redirectLink() +
                `</slot>`;
        }else if(componentType === "text_component"){
            let config = `
                <div class="form-group col-md-2">
                    <label for="is_accordion">Is Accordion</label>
                    <select name="config[is_accordion]" class="form-control">
                        <option value="yes">Yes</option>
                        <option value="no" selected>No</option>
                    </select>
                </div>`
            componentData +=
                `<slot class="page_component_multi_item">` +
                    cardLine('Config') +
                    config +
                    cardLine('Details Section') +
                    attributeEditor +
                `</slot>`;
        }else if(componentType === "text_with_image"){
            let config = `
                <div class="form-group col-md-3">
                    <label for="editor_en">Position</label>
                    <select name="config[position]" class="form-control">
                        <option value="right" selected>Right</option>
                        <option value="left">Left</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="bg_color">Background Color</label>
                    <select name="config[bg_color]" class="form-control">
                        <option value="yes">Yes</option>
                        <option value="no" selected>No</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="vertical_txt_align">Vertical Text Align</label>
                    <select name="config[vertical_txt_align]" class="form-control">
                        <option value="yes">Yes</option>
                        <option value="no" selected>No</option>
                    </select>
                </div>
            `
            componentData +=
                `<slot class="page_component_multi_item">` +
                    cardLine('Config') +
                    config +
                    cardLine('Component Details') +
                    attributeTitle +
                    attributeTitleSubTitle +
                    attributeIsVideo() +
                    attributeImage() +
                    videoUrl() +
                    doubleButton +
                `</slot>`;
        }else if(componentType === "top_image_bottom_text_component"){
            componentData +=
                `<slot class="page_component_multi_item">` +
                    cardLine() +
                    addBtn +
                    itemCountLine(1) +
                    imageOne() +
                    multiItemTitle() +
                    multiItemDescription() +
                `</slot>`;
        }else if(componentType === "icon_text_component"){
            componentData +=
                `<slot class="page_component_multi_item">` +
                    attributeTitle +
                    attributeTitleSubTitle +
                    cardLine() +
                    addBtn +
                    itemCountLine(1) +
                    imageOne() +
                    multiItemTitle() +
                    multiItemDescription() +
                `</slot>`;
        }else if(componentType === "icon_text_with_bg_component"){
            componentData +=
                `<slot class="page_component_multi_item">` +
                    attributeTitle +
                    attributeTitleSubTitle +
                    cardLine() +
                    addBtn +
                    itemCountLine(1) +
                    imageOne() +
                    multiItemTitle() +
                    multiItemDescription() +
                `</slot>`;
        }else if(componentType === "video_full_width_component"){
            componentData +=
                `<slot class="page_component_multi_item">` +
                    videoUrl() +
                `</slot>`;
        }else if(componentType === "video_with_text_container_component"){
            componentData +=
                `<slot class="page_component_multi_item">` +
                    attributeTitle +
                    attributeTitleSubTitle +
                    videoUrl() +
                `</slot>`;
        }else if(componentType === "stories_slider"){
            componentData +=
                `<slot class="page_component_multi_item">` +
                    attributeTitle +
                    attributeTitleSubTitle +
                    cardLine() +
                    addBtn +
                    itemCountLine(1) +
                    multiItemFeedback() +
                    imageOne() +
                `</slot>`;
        }else if(componentType === "tab_component_with_image_card_one" || componentType === "tab_component_with_image_card_two"){
            componentData +=
                `<slot class="page_component_multi_item">` +
                    attributeTitle +
                    attributeTitleSubTitle +
                    cardLine() +
                    addBtn +
                    itemCountLine(1, "Tab") +
                    multiItemTitle() +
                    `<div class="col-md-11 ml-5">
                        <div class="row tab-item">
                            <slot class="tab_item_count" data-tab-id="0">
                                ${
                                    addTabBtn +
                                    multiItemTitle(0, true, 0) +
                                    multiItemDescription(0, true, 0, true) +
                                    imageOne(0, true, 0) +
                                    multiItemButton(0, true, 0) +
                                    itemCountLine('', '')
                                }
                            </slot>
                        </div>
                    </div>` +
                `</slot>`;
        }else if(componentType === "tab_component_with_image_card_three"){
            componentData +=
                `<slot class="page_component_multi_item">` +
                    attributeTitle +
                    attributeTitleSubTitle +
                    cardLine() +
                    addBtn +
                    itemCountLine(1, "Tab") +
                    multiItemTitle() +
                    `<div class="col-md-11 ml-5">
                        <div class="row tab-item">
                            <slot class="tab_item_count" data-tab-id="0">
                                ${
                                    addTabBtn +
                                    multiItemFeedback(0, true, 0) +
                                    imageOne(0, true, 0) +
                                    itemCountLine('', '')
                                }
                            </slot>
                        </div>
                    </div>` +
                `</slot>`;
        }else if(componentType === "tab_component_with_image_card_four"){
            let contentType = `
                <div class="form-group col-md-4">
                    <label for="editor_en">Content Type</label>
                    <select name="componentData[0][content_type][value_en]" class="form-control tab_content_type">
                        <option value="static">Static</option>
                        <option value="dynamic" selected>Dynamic</option>
                    </select>
                    <input type="hidden" name="componentData[0][title][is_tab]" value="1">
                </div>
                <div class="form-group col-md-4 dynamic_or_static" style="display: none;">
                    <label for="static_component">Static Component</label>
                    <select name="componentData[0][static_component][value_en]" class="form-control">
                        <option value="find_store" selected>Find a Store</option>
                    </select>
                </div>
            `
            componentData +=
                `<slot class="page_component_multi_item">` +
                    attributeTitle +
                    attributeTitleSubTitle +
                    cardLine() +
                    addBtn +
                    itemCountLine(1, "Tab") +
                    multiItemTitle() +
                    contentType +
                    `<div class="col-md-11 ml-5 dynamic_or_static">
                        <div class="row tab-item">
                            <slot class="tab_item_count" data-tab-id="0">
                                ${
                                    addTabBtn +
                                    imageOne(0, true, 0) +
                                    multiItemButton(0, true, 0) +
                                    itemCountLine('', '')
                                }
                            </slot>
                        </div>
                    </div>` +
                `</slot>`;
        }else if(componentType === "explore_services"){
            componentData +=
                `<slot class="page_component_multi_item">` +
                    attributeTitle +
                    attributeTitleSubTitle +
                    cardLine() +
                    addBtn +
                    itemCountLine(1) +
                    imageOne() +
                    multiItemTitle() +
                    redirectLink() +
                `</slot>`;
        }else if(componentType === "explore_c"){
            componentData +=
                `<slot class="page_component_multi_item">` +
                    cardLine('Config') +
                    configBgImage +
                    cardLine('Component Heading') +
                    attributeTitle +
                    attributeTitleSubTitle +
                    cardLine() +
                    addBtn +
                    itemCountLine(1) +
                    imageOne() +
                    multiItemTitle() +
                    multiItemButton() +
                `</slot>`;
        }else if(componentType === "super_app"){
            componentData +=
                `<slot class="page_component_multi_item">` +
                    cardLine('Config') +
                    configBgImage +
                    cardLine('Component Info') +
                    attributeTitle +
                    attributeTitleSubTitle +
                    attributeImage() +
                    attrPlayStoreLink() +
                    attrAppStoreLink() +
                `</slot>`;
        }else if(componentType === "amar_offer"){
            componentData +=
                `<slot class="page_component_multi_item">` +
                    attributeTitle +
                    attributeTitleSubTitle +
                `</slot>`;
        }else if(componentType === "loyalty_offer"){
            componentData +=
                `<slot class="page_component_multi_item">` +
                    attributeTitle +
                    attributeTitleSubTitle +
                `</slot>`;
        }else if(componentType === "digital_world"){
            componentData +=
                `<slot class="page_component_multi_item">` +
                    cardLine('Config') +
                    attributeButton +
                    cardLine('Component Heading') +
                    attributeTitle +
                    attributeTitleSubTitle +
                    cardLine() +
                    addBtn +
                    itemCountLine(1) +
                    imageOne() +
                    multiItemTitle() +
                    multiItemDescription() +
                    multiItemButton() +
                    multiItemFreeText(0, 'date_txt', 'Date');
                `</slot>`;
        }else if(componentType === "bl_lab"){
            componentData +=
                `<slot class="page_component_multi_item">` +
                    cardLine('Component Heading') +
                    attributeImage() +
                    attributeTitle +
                    attributeTitleSubTitle +
                    doubleButton +
                    cardLine() +
                    addBtn +
                    itemCountLine(1) +
                    imageTwo(0, "Icon", "image_icon") +
                    imageTwo(0, "Card", "image_card") +
                    multiItemTitle() +
                    multiItemDescription() +
                    multiItemDoubleButton() +
                `</slot>`;
        }else if(componentType === "videos_component"){
            componentData +=
                `<slot class="page_component_multi_item">` +
                cardLine('Component Heading') +
                attributeTitle +
                attributeTitleSubTitle +
                attributeButton +
                cardLine() +
                addBtn +
                itemCountLine(1) +
                multiItemVideoUrl() +
                multiItemTitle() +
                multiItemDescription() +
            `</slot>`;
        }else if(componentType === "icon_text_with_image"){
            componentData +=
                `<slot class="page_component_multi_item">` +
                cardLine('Component Heading') +
                attributeTitle +
                attributeTitleSubTitle +
                attributeImage() +
                cardLine('Multi Items') +
                addBtn +
                itemCountLine(1) +
                imageTwo(0, 'Icon', 'image_icon') +
                multiItemTitle() +
                multiItemDescription() +
                `</slot>`;
        }else if(componentType === "multiple_image"){
            componentData +=
                `<slot class="page_component_multi_item">` +
                cardLine('Component Heading') +
                attributeTitle +
                cardLine('Multi Items') +
                addBtn +
                itemCountLine(1) +
                imageOne() +
                `</slot>`;
        }else if(componentType === "customer_complaint"){
            componentData +=
                `<slot class="page_component_multi_item">` +
                    dynamicInputField('Complaint Closed No', 'complaint_closed_no', '(%)') +
                    dynamicInputField('Unreached Customer No', 'unreached_customer_no', '(%)') +
                    dynamicInputFieldPair('Complaint Closed Title', 'complaint_closed_title') +
                    dynamicInputFieldPair('Unreached Customer Title', 'unreached_customer_title') +
                    attributeEditor +
                    // attributeTitleSubTitle +
                    // cardLine() +
                    // addBtn +
                    // itemCountLine(1) +
                    // imageOne() +
                    // multiItemTitle() +
                    // multiItemDescription() +
                `</slot>`;
        }else{
            console.log('No component found!!')
        }

        componentElementId.empty()
        componentElementId.append(componentData)
        dropify();
        summernote_editor();
    })

    $(document).on('click', '#plus-image', function () {
        var option_count = $('.page_component_multi_item');
        var index = option_count.length;
        var componentType = $('#component_type').val()
        var componentData = '';

        if (componentType === "banner_with_button"){
            componentData +=
                `<slot class="page_component_multi_item">` +
                    itemCountLine(index + 1) +
                    imageOne(index) +
                    multiItemTitle(index) +
                    multiItemDescription(index) +
                    multiItemButton(index) +
                    removeBtn +
                `</slot>`;
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
                    multiItemTitle(index) +
                    multiItemDescription(index) +
                    removeBtn +
                `</slot>`;
        }else if(componentType === "hero_section"){
            componentData +=
                `<slot class="page_component_multi_item">` +
                    itemCountLine(index + 1) +
                    multiItemTitle(index) +
                    redirectLink(index) +
                    removeBtn +
                `</slot>`;
        }else if(componentType === "top_image_bottom_text_component"){
            componentData +=
                `<slot class="page_component_multi_item">` +
                    itemCountLine(index + 1) +
                    imageOne(index) +
                    multiItemTitle(index) +
                    multiItemDescription(index) +
                    removeBtn +
                `</slot>`;
        }else if(componentType === "icon_text_component"){
            componentData +=
                `<slot class="page_component_multi_item">` +
                    itemCountLine(index + 1) +
                    imageOne(index) +
                    multiItemTitle(index) +
                    multiItemDescription(index) +
                    removeBtn +
                `</slot>`;
        }else if(componentType === "icon_text_with_bg_component"){
            componentData +=
                `<slot class="page_component_multi_item">` +
                    itemCountLine(index + 1) +
                    imageOne(index) +
                    multiItemTitle(index) +
                    multiItemDescription(index) +
                    removeBtn +
                `</slot>`;
        }else if(componentType === "stories_slider"){
            componentData +=
                `<slot class="page_component_multi_item">` +
                    itemCountLine(index + 1) +
                    multiItemFeedback(index) +
                    imageOne(index) +
                    removeBtn +
                `</slot>`;
        }else if(componentType === "tab_component_with_image_card_one" || componentType === "tab_component_with_image_card_two"){
            componentData +=
                `<slot class="page_component_multi_item">` +
                    itemCountLine(index + 1, "Tab") +
                    multiItemTitle(index) +
                    `<div class="col-md-11 ml-5">
                        <div class="row tab-item">
                            <slot class="tab_item_count" data-tab-id="${index}">
                                ${
                                    addTabBtn +
                                    multiItemTitle(index, true, 0) +
                                    multiItemDescription(index, true, 0) +
                                    imageOne(index, true, 0) +
                                    multiItemButton(index, true, 0) +
                                    itemCountLine('', '')
                                }
                            </slot>
                        </div>
                    </div>` +
                    removeBtn +
                `</slot>`;
        }else if(componentType === "tab_component_with_image_card_three") {
            componentData +=
                `<slot class="page_component_multi_item">` +
                    itemCountLine(index + 1, "Tab") +
                    multiItemTitle(index) +
                    `<div class="col-md-11 ml-5">
                        <div class="row tab-item">
                            <slot class="tab_item_count" data-tab-id="${index}">
                                ${
                                    addTabBtn +
                                    multiItemFeedback(index, true, 0) +
                                    imageOne(index, true, 0) +
                                    itemCountLine('', '')
                                }
                            </slot>
                        </div>
                        </div>` +
                    removeBtn +
                `</slot>`;
        }else if(componentType === "tab_component_with_image_card_four") {

            let contentType = `
                <div class="form-group col-md-4">
                    <label for="editor_en">Content Type</label>
                    <select name="componentData[${index}][content_type][value_en]" class="form-control tab_content_type">
                        <option value="static">Static</option>
                        <option value="dynamic" selected>Dynamic</option>
                    </select>
                    <input type="hidden" name="componentData[${index}][title][is_tab]" value="1">
                </div>
                <div class="form-group col-md-4" style="display: none;">
                    <label for="static_component">Static Component</label>
                    <select name="componentData[${index}][static_component][value_en]" class="form-control">
                        <option value="find_store" selected>Find a Store</option>
                    </select>
                </div>
            `
            componentData +=
                `<slot class="page_component_multi_item">` +
                    itemCountLine(index + 1, "Tab") +
                    multiItemTitle(index) +
                    contentType +
                    `<div class="col-md-11 ml-5 dynamic_or_static">
                        <div class="row tab-item">
                            <slot class="tab_item_count" data-tab-id="${index}">
                                ${
                                    addTabBtn +
                                    imageOne(index, true, 0) +
                                    multiItemButton(index, true, 0) +
                                    itemCountLine('', '')
                                }
                            </slot>
                        </div>
                    </div>` +
                    removeBtn +
                `</slot>`;
        }else if(componentType === "explore_services"){
            componentData +=
                `<slot class="page_component_multi_item">` +
                    itemCountLine(index + 1) +
                    imageOne(index) +
                    multiItemTitle(index) +
                    redirectLink(index) +
                    removeBtn +
                `</slot>`;
        }else if(componentType === "explore_c"){
            componentData +=
                `<slot class="page_component_multi_item">` +
                    itemCountLine(index + 1) +
                    imageOne(index) +
                    multiItemTitle(index) +
                    multiItemButton(index) +
                    removeBtn +
                `</slot>`;
        }else if(componentType === "explore_c"){
            componentData +=
                `<slot class="page_component_multi_item">` +
                    itemCountLine(index + 1) +
                    imageOne(index) +
                    multiItemTitle(index) +
                    multiItemButton(index) +
                    removeBtn +
                `</slot>`;
        }else if(componentType === "digital_world"){
            componentData +=
                `<slot class="page_component_multi_item">` +
                    itemCountLine(index + 1) +
                    imageOne(index) +
                    multiItemTitle(index) +
                    multiItemDescription(index) +
                    multiItemButton(index) +
                    multiItemFreeText(index, 'date_txt', 'Date') +
                    removeBtn +
                `</slot>`;
        }else if(componentType === "bl_lab"){
            componentData +=
                `<slot class="page_component_multi_item">` +
                    itemCountLine(index + 1) +
                    imageTwo(index, 'Icon', 'image_icon') +
                    imageTwo(index, 'Card', 'image_card') +
                    multiItemTitle(index) +
                    multiItemDescription(index) +
                    multiItemDoubleButton(index) +
                    removeBtn +
                `</slot>`;
        }else if(componentType === "videos_component"){
            componentData +=
                `<slot class="page_component_multi_item">` +
                    itemCountLine(index + 1) +
                    multiItemVideoUrl(index) +
                    multiItemTitle(index) +
                    multiItemDescription(index) +
                    removeBtn +
                `</slot>`;
        }else if(componentType === "icon_text_with_image"){
            componentData +=
                `<slot class="page_component_multi_item">` +
                    itemCountLine(index + 1) +
                    imageTwo(index, 'Icon', 'image_icon') +
                    multiItemTitle(index) +
                    multiItemDescription(index) +
                    removeBtn +
                `</slot>`;
        }else if(componentType === "multiple_image"){
            componentData +=
                `<slot class="page_component_multi_item">` +
                    itemCountLine(index + 1) +
                    imageOne(index) +
                    removeBtn +
                `</slot>`;
        }else{
            console.log('No component found!!')
        }

        $('#component_data').append(componentData);
        $('#' + componentType).append(componentData);
        dropify();
    });

    var onContentTypeChange = () => {
        if( $('#is_video').length){
            
            var video_input_container = $("#video_input_container");
            var image_input_container = $("#image_input_container");
            var is_video_check = $("#is_video").is(":checked");
            if(is_video_check){
                if(image_input_container) image_input_container.hide();
                if(video_input_container) video_input_container.show();
            }else{
                if(image_input_container) image_input_container.show();
                if(video_input_container) video_input_container.hide();
            }
            $(document).on('click', '#is_video', function (event) {
                var id = $(event.target).is(":checked");
                if(id) {
                    if(image_input_container) image_input_container.hide();
                    if(video_input_container) video_input_container.show();
                } else {
                    if(image_input_container) image_input_container.show();
                    if(video_input_container) video_input_container.hide();
                }
            });
        }
    }

    if( $('#component_type').length){
        onContentTypeChange();
    }
    $(document).on('change', '#component_type', function (event) {
        onContentTypeChange();
    });

    $(document).on('click', '.remove-image', function (event) {
        var id = $(event.target).attr('data-com-id');
        var group = $(event.target).attr('data-group');
        var tab = $(event.target).attr('data-tab');
        var parentId = $(event.target).attr('data-parent');
        if (id){
            const confirmPopupParams = {
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                html: jQuery('.delete_btn').html(),
                showCancelButton: true,
                confirmButtonColor: '#a2162a',
                cancelButtonColor: '#9dada5',
                confirmButtonText: 'Yes, delete it!'
            };

            const deletePopupParams = {
                title: 'Deleted!',
                text: 'Your item has been deleted.',
                type: 'success'
            };

            Swal.fire(confirmPopupParams).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: componentDataDestroyUrl + "?data-com-id=" + id + "&data-group=" + group + "&data-tab=" + tab + group + "&data-parent=" + parentId,
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
        let componentType = $('#component_type').val()
        let tabItem = $(e.target).parent().parent().parent()
        let index = $(e.target).parent().parent().attr('data-tab-id');
        let tabItems = tabItem.children();
        let tabItemIndex = tabItems.length

        let componentData = "";

        if (componentType === "tab_component_with_image_card_three"){
            componentData +=
                `<slot class="tab_item_count" data-tab-id="${index}">
                ${
                    multiItemFeedback(index, true, tabItemIndex) +
                    imageOne(index, true, tabItemIndex) +
                    removeTabItemBtn +
                    itemCountLine('', '')
                }
            </slot>`
        }else if (componentType === "tab_component_with_image_card_four"){
            componentData +=
                `<slot class="tab_item_count" data-tab-id="${index}">
                ${
                    imageOne(index, true, tabItemIndex) +
                    multiItemButton(index, true, tabItemIndex) +
                    removeTabItemBtn +
                    itemCountLine('', '')
                }
            </slot>`
        }else {
            componentData +=
                `<slot class="tab_item_count" data-tab-id="${index}">
                ${
                    multiItemTitle(index, true, tabItemIndex) +
                    multiItemDescription(index, true, tabItemIndex, true) +
                    imageOne(index, true, tabItemIndex) +
                    multiItemButton(index, true, tabItemIndex) +
                    removeTabItemBtn +
                    itemCountLine('', '')
                }
            </slot>`
        }
        tabItem.append(componentData)
        dropify();
        summernote_editor();
    })

    // Tab Item Remove
    $(document).on('click', '.remove-tab-item', function (event) {
        $(event.target).parent().parent().remove();
    })

    $(document).on('change', '.tab_content_type', function (event) {
        let contentType = $(this).val();
        let dynamicAndStaticFirst = $(event.target).parent().next('div');
        let dynamicAndStaticSecond = $(event.target).parent().next('div').next('div');

        if (contentType === "static"){
            dynamicAndStaticFirst.show()
            dynamicAndStaticSecond.hide()
        }else {
            dynamicAndStaticFirst.hide()
            dynamicAndStaticSecond.show()
        }
    })
})();
