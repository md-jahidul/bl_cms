(function () {
    var inputText = $('#input-text');
    var textArea = $('#text-area');
    var textEditor = $('#text-editor');
    var dropDown = $('#dropdown');
    var imageField = $('#image-field');
    var multiImage = $('#multi-image');

    var textField = $('#text-field');
    var textAreaField = $('#text-area-field');
    var textEditorField = $('#text-editor-field');
    var dropdownField = $('#dropdown_field');
    var singleImage = $('#single-image');
    var multipleImageField = $('#multiple-image-field');

    $('#data-type').change(function () {
        alert();
    });

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
    showHideElement(textArea, textAreaField);
    showHideElement(textEditor, textEditorField);
    showHideElement(dropDown, dropdownField);
    showHideElement(imageField, singleImage);
    showHideElement(multiImage, multipleImageField);
})();

