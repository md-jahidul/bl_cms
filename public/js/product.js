var product = (function () {

    let publicFunctons = {
        'select_change' : function ($select) {
            let showInHome = $('#show_in_home');
            let optionText =  product.getOptionAliasText($select);

            ( $select.attr('id') == 'offer_type' ) && (optionText == 'packages' || optionText == 'others')  ? showInHome.hide() : showInHome.show();
            this.modifyDom(optionText, $select);
        },
        'modifyDom' : function modifyDom(selectedItemName, $select, action='hide')
        {
            let selectBy = '#';

            let options =  $select.find('option');
            let optionTextArr = $.map(options ,function (option) {

                if ( option.value !== '' &&  option.getAttribute('data-alias')/*.replace(/ |-/g,"_")*/ !== selectedItemName ) {
                    return  selectBy + option.getAttribute('data-alias');
                        // .replace(/ |-/g,"_");
                }
            });

            // debugger;

            let otherElements = optionTextArr.join(',');
            if (action == 'hide') {
                $(otherElements).hide();
                $(selectBy + selectedItemName).removeClass('d-none')
                                                .show()
                                                .find('input').each(function () {
                                                    $(this).val('');
                                                });
            } else {
                $(otherElements).remove();
            }
        },
        'getOptionAliasText' : function getOptionAText($select)
        {
            return $select.find('option:selected')
                        .attr('data-alias')
                        // .replace(/ |-/g,"_");
        },
        'save' : function save(e, $selects, form_id)
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

    $removeDomSelect = [$offerType, $packageType, $otherOfferType];

    $removeDomSelect.forEach(function($ele) {
        $ele.on('change',function () {
            product.select_change($ele);
        });
    })

    $('#save').on('click',function(e){
        product.save(e, $removeDomSelect, 'product_form');
    });
})();

