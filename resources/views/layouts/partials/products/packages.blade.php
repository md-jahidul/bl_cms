<div class="form-group col-md-6 {{ $errors->has('offer_category_id') ? ' error' : '' }}">
    <label for="offer_category_id" class="required">Package Offer Types</label>
    <select class="form-control required" name="offer_category_id" id="package_type"
            required data-validation-required-message="Please select offer">
        <option value="">---Select Offer Type---</option>
        @foreach($packages_offer_child as $offer)
            <option value="{{ $offer->id }}">{{ $offer->name }}</option>
        @endforeach
    </select>
    <div class="help-block"></div>
    @if ($errors->has('offer_category_id'))
        <div class="help-block">{{ $errors->first('offer_category_id') }}</div>
    @endif
</div>


<slot class="{{ strtolower($type) == 'prepaid' ? 'prepaid_plans' : 'postpaid_plans' }}" style="display: none">
    <div class="form-group col-md-6 {{ $errors->has('view_list_btn_text_bn') ? ' error' : '' }}">
        <label for="view_list_btn_text_bn" class="required">Call Rate (Paisa)</label>
        <input type="text" name="offer_info[callrate_offer]"  class="form-control" placeholder="Enter call rate in paisa"
               oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
               value="{{ (!empty($offerInfo['callrate_offer'])) ? $offerInfo['callrate_offer'] : old("other_attributes.callrate_offer") ?? '' }}"
               required data-validation-required-message="Enter view list button label bangla ">
        <div class="help-block"></div>
        @if ($errors->has('callrate_offer'))
            <div class="help-block">  {{ $errors->first('callrate_offer') }}</div>
        @endif
    </div>
    <div class="form-group col-md-6 {{ $errors->has('sms_rate_offer') ? ' error' : '' }}">
        <label for="sms_rate_offer" class="required">SMS Rate (Paisa)</label>
        <input type="text" name="offer_info[sms_rate_offer]"  class="form-control" placeholder="Enter SMS rate in paisa"
               oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
               value="{{ (!empty($offerInfo['sms_rate_offer'])) ? $offerInfo['sms_rate_offer'] : old("offer_info.sms_rate_offer") ?? '' }}"
               required data-validation-required-message="Enter view list url">
        <div class="help-block"></div>
        @if ($errors->has('sms_rate_offer'))
            <div class="help-block">  {{ $errors->first('sms_rate_offer') }}</div>
        @endif
    </div>
</slot>



<slot class="icon_plans" style="display: none">
    @include('layouts.partials.products.package.icon_plan')
</slot>

@if(strtolower($type) == 'prepaid')
    <slot class="start_up_offers" style="display: none">
        @include('layouts.partials.products.package.startup')
    </slot>
@endif


@push('page-js')
    <script type="text/javascript">
        $(function () {
            var $offerType = $('#package_type');

            function domMupulate(selectedItemName, action='hide'){
                let options =  $offerType.find('option');

                let optionTextArr = $.map(options ,function(option) {
                    // option.text.replace(/ |-/g,"_").toLowerCase();
                    // console.log(option.text.replace(/ |-/g,"_").toLowerCase())
                    if( option.value !== '' &&  option.text.replace(/ |-/g,"_").toLowerCase() !== selectedItemName ) { return  '.' + option.text.replace(/ |-/g,"_").toLowerCase();  }
                });
                debugger

                let otherElements = optionTextArr.join(',');

                if(action == 'hide'){
                    $(otherElements).hide();
                    $('.' + selectedItemName).removeClass('d-none')
                        .show()
                        .find('input').each(function(){
                        $(this).val('');
                    });
                }else{
                    $(otherElements).remove();
                }
            }

            $('#package_type').change(function () {
                // let optionText = $(this).children("option:selected").text();
                let showInHome = $('#show_in_home');
                let optionText =$("#package_type option:selected").text().replace(/ |-/g,"_").toLowerCase();

                // console.log(optionText)

                (optionText.toLowerCase() == 'startup' ? showInHome.hide() : showInHome.show())
                // debugger

                domMupulate(optionText);
            });

            $('#save').on('click',function(e){
                e.preventDefault();
                let optionText = $("#offer_type option:selected").text();
                // debugger
                domMupulate( optionText.toLowerCase(),'remove');
                $("#product_form").submit();
            });
        })
    </script>

@endpush





