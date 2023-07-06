@php
    if (isset($product->offer_info['other_offer_type_id'])){
        $offertype = $product->offer_info['other_offer_type_id'];
    }elseif (isset($product->offer_info['package_offer_type_id'])){
        $offertype = $product->offer_info['package_offer_type_id'];
    }
    isset($offertype) ? $offertype : $offertype = '';
    isset($product->offer_info) ? $product : $offertype = null
@endphp
<div class="col-md-12">
    <span><h4><strong>Other Info</strong></h4></span>
    <div class="form-actions col-md-12 mt-0 type-line"></div>
</div>

<div class="form-group col-md-6 {{ $errors->has('offer_category_id') ? ' error' : '' }}">
    <label for="offer_category_id" class="required">Other Offer Types</label>
    <select class="form-control required" name="offer_info[other_offer_type_id]" id="other_offer_type"
            required data-validation-required-message="Please select offer">
        <option value="">---Select Offer Type---</option>
        @foreach($others_offer_child as $offer)
            <option data-alias="{{ $offer->alias }}" value="{{ $offer->id }}" {{ $offertype == $offer->id ? 'selected' : '' }}>{{ $offer->name_en }}</option>
        @endforeach
    </select>
    <div class="help-block"></div>
    @if ($errors->has('offer_category_id'))
        <div class="help-block">{{ $errors->first('offer_category_id') }}</div>
    @endif
</div>

{{--Amar Offer--}}
<slot class="{{ $offertype == \App\Enums\OfferType::AMAR_OFFER_PREPAID || $offertype == \App\Enums\OfferType::AMAR_OFFER_POSTPAID ? '' : 'd-none' }}" id="amar_offer">
    @include('layouts.partials.products.other.other_detail_field')
</slot>

@if(strtolower($type) == 'prepaid')
    {{-- Balance transfer --}}
    <slot class="{{ $offertype == \App\Enums\OfferType::BALANCE_TRANSFER ? '' : 'd-none' }}" id="balance_transfer">
        @include('layouts.partials.products.other.other_detail_field')
    </slot>

    {{--Emergency Balance--}}
    <slot class="{{ $offertype == \App\Enums\OfferType::EMERGENCY_BALANCE ? '' : 'd-none' }}" id="emergency_balance">
        @include('layouts.partials.products.other.other_detail_field')
        <div class="col-md-4">
            <div class="form-group">
                <label for="show_in_home" class="display-block">Loan Type:</label>
                <input type="radio" name="offer_info[loan_type]" id="emg_balance" value="emergency_balance"
                    {{ (!empty($product->offer_info['loan_type'])) && $product->offer_info['loan_type'] == "emergency_balance" ? 'checked' : '' }}>
                    <label for="emg_balance">Is Emergency Main Balance</label>
                <br>
                <input type="radio" name="offer_info[loan_type]" id="emg_internet" value="emergency_internet"
                    {{ (!empty($product->offer_info['loan_type'])) && $product->offer_info['loan_type'] == "emergency_internet" ? 'checked' : '' }}>
                    <label for="emg_internet"> Is Emergency Internet</label>
            </div>
        </div>
    </slot>

    {{-- MFS Offers --}}
    <slot class="{{ $offertype == \App\Enums\OfferType::MFS_OFFERS ? '' : 'd-none' }}" id="mfs_offers">
        @include('layouts.partials.products.other.other_detail_field')
    </slot>

    {{--Device Offers--}}
    <slot class="{{ $offertype == \App\Enums\OfferType::DEVICE_OFFERS ? '' : 'd-none' }}" id="device_offers">
        @include('layouts.partials.products.other.other_detail_field')
    </slot>

    {{--MNP Offer--}}
    <slot class="{{ $offertype == \App\Enums\OfferType::MNP_OFFERS ? '' : 'd-none' }}" id="mnp_offers">
        @include('layouts.partials.products.other.other_detail_field')
    </slot>

    {{--4G Offers--}}
    <slot class="{{ $offertype == \App\Enums\OfferType::FOUR_G_OFFERS ? '' : 'd-none' }}" id="4g_offers">
        @include('layouts.partials.products.other.other_detail_field')
    </slot>
@endif

{{--Bondho SIM Offer--}}
@if(strtolower($type) == 'prepaid')
    <slot class="{{ $offertype == \App\Enums\OfferType::BONDHO_SIM_OFFER ? '' : 'd-none' }}" id="bondho_sim_offer">
        @include('layouts.partials.products.common-field.renew_code')
        @include('layouts.partials.products.common-field.recharge_code')
        @include('layouts.partials.products.common-field.price_vat_mrp')
        @include('layouts.partials.products.common-field.minute_volume')
        @include('layouts.partials.products.common-field.internet_volume')
        @include('layouts.partials.products.common-field.call_rate')
        @include('layouts.partials.products.common-field.call_rate_unit')
        @include('layouts.partials.products.common-field.validity_unit')
        @include('layouts.partials.products.common-field.validity')
        @include('layouts.partials.products.common-field.ussd_code')
        @include('layouts.partials.products.common-field.balance_check')
        @include('layouts.partials.products.common-field.tag')
    </slot>
@endif




