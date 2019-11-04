<div class="form-group col-md-6 {{ $errors->has('offer_category_id') ? ' error' : '' }}">
    <label for="offer_category_id" class="required">Other Offer Types</label>
    <select class="form-control required" name="offer_category_id" id="other_offer_type"
            required data-validation-required-message="Please select offer">
        <option value="">---Select Offer Type---</option>
        @foreach($others_offer_child as $offer)
            <option value="{{ $offer->id }}">{{ $offer->name }}</option>
        @endforeach
    </select>
    <div class="help-block"></div>
    @if ($errors->has('offer_category_id'))
        <div class="help-block">{{ $errors->first('offer_category_id') }}</div>
    @endif
</div>

{{-- Balance transfer || Amar Offer || Device Offers || MNP Offer || 4G Offers--}}
<slot class="amar_offer balance_transfer emergency_balance device_offers mnp_offers 4g_offers" style="display: none">
    <div class="form-group col-md-6 {{ $errors->has('sms_rate_offer') ? ' error' : '' }}">
        <label for="sms_rate_offer" class="required">Title</label>
        <input type="text" name="offer_info[sms_rate_offer]"  class="form-control" placeholder="Enter SMS rate in paisa"
               oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
               value="{{ (!empty($offerInfo['sms_rate_offer'])) ? $offerInfo['sms_rate_offer'] : old("offer_info.sms_rate_offer") ?? '' }}"
               required data-validation-required-message="Enter view list url">
        <div class="help-block"></div>
        @if ($errors->has('sms_rate_offer'))
            <div class="help-block">  {{ $errors->first('sms_rate_offer') }}</div>
        @endif
    </div>
    <div class="form-group col-md-12 {{ $errors->has('sms_rate_offer') ? ' error' : '' }}">
        <label for="sms_rate_offer" class="required">Description</label>
        <textarea type="text" name="offer_info[sms_rate_offer]"  class="form-control" placeholder="Enter SMS rate in paisa"
                  required data-validation-required-message="Enter view list url">{{ (!empty($offerInfo['sms_rate_offer'])) ? $offerInfo['sms_rate_offer'] : old("offer_info.sms_rate_offer") ?? '' }}</textarea>
        <div class="help-block"></div>
        @if ($errors->has('sms_rate_offer'))
            <div class="help-block">  {{ $errors->first('sms_rate_offer') }}</div>
        @endif
    </div>
</slot>

{{--Bondho SIM Offer--}}
<slot class="bondho_sim_offer" style="display: none">
    <div class="form-group col-md-6 {{ $errors->has('internet_offer_mb') ? ' error' : '' }}">
        <label for="internet_offer_mb" class="required">Internet Volume (MB)</label>
        <input type="number" name="offer_info[internet_offer_mb]"  class="form-control" placeholder="Enter internet offer in MB"
               value="{{ (!empty($offerInfo['internet_offer_mb'])) ? $offerInfo['internet_offer_mb'] : old("offer_info.internet_offer_mb") ?? '' }}"
               required data-validation-required-message="Enter view list button label bangla ">
        <div class="help-block"></div>
        @if ($errors->has('internet_offer_mb'))
            <div class="help-block">  {{ $errors->first('internet_offer_mb') }}</div>
        @endif
    </div>

    <div class="form-group col-md-6 {{ $errors->has('minute_offer') ? ' error' : '' }}">
        <label for="minute_offer" class="required">Minute Volume</label>
        <input type="number" name="offer_info[minute_offer]"  class="form-control" placeholder="Enter minute offer"
               oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
               value="{{ (!empty($offerInfo['minute_offer'])) ? $offerInfo['minute_offer'] : old("offer_info.minute_offer") ?? '' }}"
               required data-validation-required-message="Enter view list url">
        <div class="help-block"></div>
        @if ($errors->has('minute_offer'))
            <div class="help-block">  {{ $errors->first('minute_offer') }}</div>
        @endif
    </div>
</slot>



@push('page-js')
    <script type="text/javascript">
        $(function () {
            var $offerType = $('#other_offer_type');

            function domMupulate(selectedItemName, action='hide'){
                let options =  $offerType.find('option');

                let optionTextArr = $.map(options ,function(option) {
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

            $('#other_offer_type').change(function () {
                // let optionText = $(this).children("option:selected").text();
                let showInHome = $('#show_in_home');
                let optionText =$("#other_offer_type option:selected").text().replace(/ |-/g,"_").toLowerCase();

                // console.log(optionText)

                (optionText.toLowerCase() == 'startup' ? showInHome.hide() : showInHome.show())
                // debugger

                domMupulate(optionText);
            });

            $('#save').on('click',function(e){
                e.preventDefault();
                let optionText = $("#other_offer_type option:selected").text();
                // debugger
                domMupulate( optionText.toLowerCase(),'remove');
                $("#product_form").submit();
            });
        })
    </script>

@endpush
