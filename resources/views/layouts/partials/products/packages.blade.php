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

<div class="col-md-12">
    <span><h4><strong>Package Info</strong></h4></span>
    <div class="form-actions col-md-12 mt-0 type-line"></div>
</div>

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

<slot id="{{ strtolower($type) == 'prepaid' ? 'prepaid_plans' : 'postpaid_plans' }}"
      class="{{ ($offertype == \App\Enums\OfferType::PREPAID_PLANS || $offertype == \App\Enums\OfferType::POSTPAID_PLANS) ? '' : 'd-none' }}">
{{--    @include('layouts.partials.products.common-field.price_vat_mrp')--}}
    @include('layouts.partials.products.common-field.sms_rate')
    @include('layouts.partials.products.common-field.sms_rate_unit')
</slot>


@if(strtolower($type) == 'prepaid')
    <slot id="start_up_offers" class="{{ $offertype == \App\Enums\OfferType::START_UP_OFFERS ? '' : 'd-none' }}">
        @include('layouts.partials.products.package.startup')
    </slot>
@else
    <slot id="icon_plans" class="{{ $offertype == \App\Enums\OfferType::ICON_PLANS ? '' : 'd-none' }}">
        @include('layouts.partials.products.package.icon_plan')
    </slot>
    <slot id="propaid_plans" class="{{ $offertype == \App\Enums\OfferType::PROPAID_PLANS ? '' : 'd-none' }}">
{{--        @include('layouts.partials.products.common-field.price_vat_mrp')--}}
{{--        @include('layouts.partials.products.common-field.minute_volume')--}}
{{--        @include('layouts.partials.products.common-field.internet_volume')--}}
{{--        @include('layouts.partials.products.common-field.call_rate')--}}
{{--        @include('layouts.partials.products.common-field.call_rate_unit')--}}
        @include('layouts.partials.products.common-field.sms_rate')
        @include('layouts.partials.products.common-field.sms_rate_unit')
        @include('layouts.partials.products.common-field.validity_unit')
        @include('layouts.partials.products.common-field.validity')
        @include('layouts.partials.products.common-field.balance_check')
        @include('layouts.partials.products.common-field.tag')
    </slot>
@endif




