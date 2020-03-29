var product = (function () {

    let publicFunctons = {
        'select_change': function ($select) {
            let showInHome = $('#show_in_home');
            let optionText = product.getOptionAliasText($select);

            ($select.attr('id') == 'offer_type') && (optionText == 'packages' || optionText == 'others') ? showInHome.hide() : showInHome.show();
            this.modifyDom(optionText, $select);
        },
        'modifyDom': function modifyDom(selectedItemName, $select, action = 'hide')
        {
            let selectBy = '#';
            let options = $select.find('option');
            let optionTextArr = $.map(options, function (option) {
                if (option.value !== '' && option.getAttribute('data-alias') !== selectedItemName) {
                    return selectBy + option.getAttribute('data-alias');
                }
            });

            let otherElements = optionTextArr.join(',');
            if (action == 'hide') {
                $(otherElements).hide();
                $(selectBy + selectedItemName).removeClass('d-none')
                    .show()
                    .find(":input").each(function () {
                        $(this).val('');
                    });

                // Remove product details editor data
                $('.note-editable').each(function () {
                    $(this).children().remove();
                });

            } else {
                $(otherElements).remove();
            }
        },
        'getOptionAliasText': function getOptionAText($select)
        {
            return $select.find('option:selected')
                .attr('data-alias')
        },
        'save': function save(e, $selects, form_id)
        {
            e.preventDefault();
            var that = this;
            $selects.forEach(function ($select) {
                let optionText = that.getOptionAliasText($select);
                that.modifyDom(optionText, $select, 'remove');
            });

            $("#" + form_id).submit();
        }
    };

    return publicFunctons;
})();

(function () {
    let $offerType = $('#offer_type');
    let $packageType = $('#package_type');
    let $otherOfferType = $('#other_offer_type');
    let $startupOfferDetails = $('#design_structure');

    let $productDetailsComponent = $('#component_type');

    $removeDomSelect = [$offerType, $packageType, $otherOfferType, $startupOfferDetails, $productDetailsComponent];
    $removeDomSelect.forEach(function ($ele) {
        $ele.on('change', function () {
            console.log($ele);
            product.select_change($ele);
        });
    })

    $('#save').on('click', function (e) {
        product.save(e, $removeDomSelect, 'product_form');
    });
})();

(function () {
    function productBasicInfo(data)
    {
        let nameEn = $('#name_en');
        let nameBn = $('#name_bn');
        let activationUssd = $('#activation_ussd');
        let price = $('#price');
        let vat = $('#vat');
        return [
            nameEn.val(data.commercial_name_en),
            nameBn.val(data.commercial_name_bn),
            activationUssd.val(data.activation_ussd),
            price.val(data.price),
            vat.val(data.vat)
        ]
    }

    /**
     * @param type
     * @param data
     * Push existing Product Core Data on Offer type Component
     */
    function checkType(type, data)
    {
        let balanceCheckUSSD = $(".balance_check_ussd");
        let callRate = $(".call_rate");
        let internetVolumeMb = $(".internet_volume_mb");
        let minuteVolume = $(".minute_volume");
        let smsRate = $(".sms_rate");
        let smsVolume = $(".sms_volume");
        let validity = $(".validity");
        let validityUnit = $("#validity_unit");
        let $offerType = $("#offer_type");

        switch (type) {
            case 'data':
                $offerType.val('1');
                product.select_change($offerType);
                productBasicInfo(data);
                internetVolumeMb.val(data.internet_volume_mb);
                balanceCheckUSSD.val(data.balance_check_ussd);
                validity.val(data.validity);
                validityUnit.val(data.validity_unit);
                break;
            case 'voice':
                $offerType.val('2');
                product.select_change($offerType);
                productBasicInfo(data);
                minuteVolume.val(data.minute_volume);
                validity.val(data.validity);
                validityUnit.val(data.validity_unit);
                balanceCheckUSSD.val(data.balance_check_ussd);
                break;
            case 'mix':
                $offerType.val('3');
                product.select_change($offerType);
                productBasicInfo(data);
                minuteVolume.val(data.minute_volume);
                internetVolumeMb.val(data.internet_volume_mb);
                smsVolume.val(data.sms_volume);
                validity.val(data.validity);
                validityUnit.val(data.validity_unit);
                balanceCheckUSSD.val(data.balance_check_ussd);
                break;
            default:
                console.log('Offer Type Not found');
        }
    }

    $('#product_core').change(function () {
        var selectedProductCode = $(this).children("option:selected").val();
        var requestUrl = $(this).attr('data-url');

        // console.log(requestUrl);
        $.ajax({
            method: "GET",
            url: requestUrl + '/' + selectedProductCode,
        }).done(function (data) {
            // console.log(data.validity_unit);
            // console.log(data);
            checkType(data.content_type, data)
        });
    })
})();

