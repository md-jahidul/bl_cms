(function () {
    var inputText = $('#input-text');
    var extraTitle = $('#extra-title');
    var textArea = $('#text-area');
    var textEditor = $('#text-editor');
    var dropDown = $('#dropdown');
    var imageField = $('#image-field');
    var multiImage = $('#multi-image');
    var buttonCheck = $('#button-check');

    var related_product = $('#related_product');

    var textField = $('#text-field');
    var extraTitleField = $('#extra-title-field');
    var textAreaField = $('#text-area-field');
    var textEditorField = $('#text-editor-field');
    var dropdownField = $('#dropdown_field');
    var singleImage = $('#single-image');
    var multipleImageField = $('#multiple-image-field');
    var textAreaButton = $('#text-area-button');

    var related_product_field = $('#related_product_field');

    // $('#data-type').change(function () {
    //     alert();
    // });

    function showHideElement(field, item) {
        $(field).on('click', function () {
            var isChecked = $(this).is(":checked");
            if (isChecked) {
                $(item).removeClass('d-none')
            } else {
                $(item).addClass('d-none')
            }
        });
    }

    showHideElement(inputText, textField);
    showHideElement(extraTitle, extraTitleField);

    showHideElement(textArea, textAreaField);
    showHideElement(textEditor, textEditorField);
    showHideElement(dropDown, dropdownField);
    showHideElement(imageField, singleImage);
    showHideElement(multiImage, multipleImageField);
    showHideElement(buttonCheck, textAreaButton);

    showHideElement(related_product, related_product_field);
})();

