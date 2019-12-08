@php

    if (isset($product->offer_info['other_offer_type_id'])){
        $offertype = $product->offer_info['other_offer_type_id'];
    }elseif(isset($product->offer_info['package_offer_type_id'])){
        $offertype = $product->offer_info['package_offer_type_id'];
    }else{
        $offertype = '';
    }
    isset($product->offer_info) ? $product : $offertype = ''
@endphp

<div class="form-group col-md-6 {{ $errors->has('offer_category_id') ? ' error' : '' }}">
    <label for="offer_category_id" class="required">Package Offer Types</label>
    <select class="form-control required" name="offer_info[package_offer_type_id]" id="package_type"
            required data-validation-required-message="Please select offer">
        <option value="">---Select Offer Type---</option>
        @foreach($packages_offer_child as $offer)
            <option data-alias="{{ $offer->alias }}" value="{{ $offer->id }}" {{ $offer->id == $offertype ? 'selected' : '' }}>{{ $offer->name_en }}</option>
        @endforeach
    </select>
    <div class="help-block"></div>
    @if ($errors->has('offer_category_id'))
        <div class="help-block">{{ $errors->first('offer_category_id') }}</div>
    @endif
</div>

<slot id="{{ strtolower($type) == 'prepaid' ? 'prepaid_plans' : 'postpaid_plans' }}" class="{{ ($offertype == 5 || $offertype == 7) ? '' : 'd-none' }}">
    <div class="form-group col-md-6 {{ $errors->has('view_list_btn_text_bn') ? ' error' : '' }}">
        <label for="view_list_btn_text_bn" class="required">Call Rate (Paisa)</label>
        <input type="text" name="call_rate"  class="form-control" placeholder="Enter call rate in paisa"
               oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
               value="{{ (!empty($product->product_core->call_rate)) ? $product->product_core->call_rate : old("call_rate") ?? '' }}"
               required data-validation-required-message="Enter view list button label bangla ">
        <div class="help-block"></div>
        @if ($errors->has('call_rate'))
            <div class="help-block">  {{ $errors->first('call_rate') }}</div>
        @endif
    </div>
    <div class="form-group col-md-6 {{ $errors->has('sms_rate') ? ' error' : '' }}">
        <label for="sms_rate" class="required">SMS Rate (Paisa)</label>
        <input type="text" name="sms_rate"  class="form-control" placeholder="Enter SMS rate in paisa"
               oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
               value="{{ (!empty($product->product_core->sms_rate)) ? $product->product_core->sms_rate : old("sms_rate") ?? '' }}"
               required data-validation-required-message="Enter view list url">
        <div class="help-block"></div>
        @if ($errors->has('sms_rate'))
            <div class="help-block">  {{ $errors->first('sms_rate') }}</div>
        @endif
    </div>
</slot>


@if(strtolower($type) == 'prepaid')
    <slot id="start_up_offers" class="{{ $offertype == 6 ? '' : 'd-none' }}">
        @include('layouts.partials.products.package.startup')
    </slot>
@else
    <slot id="icon_plans" class="{{ $offertype == 8 ? '' : 'd-none' }}">
        @include('layouts.partials.products.package.icon_plan')
    </slot>
@endif




