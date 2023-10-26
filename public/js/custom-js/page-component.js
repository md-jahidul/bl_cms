(function () {
    // var inputText = $('#input-text');
    // var extraTitle = $('#extra-title');
    // var textArea = $('#text-area');
    // var textEditor = $('#text-editor');
    // var dropDown = $('#dropdown');
    // var imageField = $('#image-field');
    // var multiImage = $('#multi-image');
    // var buttonCheck = $('#button-check');
    //
    // var related_product = $('#related_product');
    //
    // var textField = $('#text-field');
    // var extraTitleField = $('#extra-title-field');
    // var textAreaField = $('#text-area-field');
    // var textEditorField = $('#text-editor-field');
    // var dropdownField = $('#dropdown_field');
    // var singleImage = $('#single-image');
    // var multipleImageField = $('#multiple-image-field');
    // var textAreaButton = $('#text-area-button');
    //
    // var related_product_field = $('#related_product_field');
    //
    // $('#component-type').change(function () {
    //     var selectedValue = $('#data-type').find('option:selected').val();
    //     product.select_change('#component-type');
    //
    // });
    //
    //
    //
    // // $removeDomSelect = [$offerType, $packageType, $otherOfferType, $startupOfferDetails];
    // // $removeDomSelect.forEach(function ($ele) {
    // //     $ele.on('change', function () {
    // //         product.select_change($ele);
    // //     });
    // // })
    //
    // $('#save').on('click', function (e) {
    //     product.save(e, $removeDomSelect, 'product_form');
    // });
    //
    //
    //
    // function showHideElement(field, item)
    // {
    //     $(field).on('click', function () {
    //         var isChecked = $(this).is(":checked");
    //         if (isChecked) {
    //             $(item).removeClass('d-none')
    //             // $(item).show()
    //         } else {
    //             $(item).addClass('d-none')
    //             // $(item).hide()
    //         }
    //     });
    // }
    //
    // showHideElement(inputText, textField);
    // showHideElement(extraTitle, extraTitleField);
    //
    // showHideElement(textArea, textAreaField);
    // showHideElement(textEditor, textEditorField);
    // showHideElement(dropDown, dropdownField);
    // showHideElement(imageField, singleImage);
    // showHideElement(multiImage, multipleImageField);
    // showHideElement(buttonCheck, textAreaButton);
    //
    // showHideElement(related_product, related_product_field);

    $('#component_type').on('change', function () {
        alert(this.value)
        // var componentType = this.value + ".png"
        // var fullUrl = "{{ asset('component-images') }}/" + componentType;
        // $("#componentImg").attr('src', fullUrl)
    })
})();

