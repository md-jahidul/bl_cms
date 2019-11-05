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



<slot id="{{ strtolower($type) == 'prepaid' ? 'prepaid_plans' : 'postpaid_plans' }}" style="display: none">
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





@if(strtolower($type) == 'prepaid')
    <slot id="start_up_offers" class="d-none">
        @include('layouts.partials.products.package.startup')
    </slot>
@else
    <slot id="icon_plans" class="d-none">
        @include('layouts.partials.products.package.icon_plan')
    </slot>
@endif




