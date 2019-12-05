@php
    if (isset($product->product->offer_info['other_offer_type_id'])){
        $offertype = $product->product->offer_info['other_offer_type_id'];
    }elseif (isset($product->product->offer_info['package_offer_type_id'])){
        $offertype = $product->product->offer_info['package_offer_type_id'];
    }

    isset($offertype) ? $offertype : $offertype = '';

    isset($product->offer_info) ? $product : $offertype = null
@endphp

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
<slot class="{{ $offertype == 12 || $offertype == 17 ? '' : 'd-none' }}" id="amar_offer">
    @include('layouts.partials.products.other.other_detail_field')
</slot>

@if(strtolower($type) == 'prepaid')
    {{-- Balance transfer --}}
    <slot class="{{ $offertype == 10 ? '' : 'd-none' }}" id="balance_transfer">
        @include('layouts.partials.products.other.other_detail_field')
    </slot>

    {{--Emergency Balance--}}
    <slot class="{{ $offertype == 11 ? '' : 'd-none' }}" id="emergency_balance">
        @include('layouts.partials.products.other.other_detail_field')
    </slot>

    {{-- MFS Offers --}}
    <slot class="{{ $offertype == 18 ? '' : 'd-none' }}" id="mfs_offers">
        @include('layouts.partials.products.other.other_detail_field')
    </slot>

    {{--Device Offers--}}
    <slot class="{{ $offertype == 15 ? '' : 'd-none' }}" id="device_offers">
        @include('layouts.partials.products.other.other_detail_field')
    </slot>

    {{--MNP Offer--}}
    <slot class="{{ $offertype == 14 ? '' : 'd-none' }}" id="mnp_offers">
        @include('layouts.partials.products.other.other_detail_field')
    </slot>

    {{--4G Offers--}}
    <slot class="{{ $offertype == 16 ? '' : 'd-none' }}" id="4g_offers">
        @include('layouts.partials.products.other.other_detail_field')
    </slot>
@endif

{{--Bondho SIM Offer--}}
@if(strtolower($type) == 'prepaid')
    <slot class="{{ $offertype == 13 ? '' : 'd-none' }}" id="bondho_sim_offer">
        <div class="form-group col-md-6 {{ $errors->has('minute_volume') ? ' error' : '' }}">
            <label for="minute_volume" class="required">Minute Volume</label>
            <input type="text" name="minute_volume"  class="form-control" placeholder="Enter minute volume"
                   oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
                   value="{{ (!empty($product->product_core->minute_volume)) ? $product->product_core->minute_volume : old("minute_volume") ?? '' }}"
                   required data-validation-required-message="Enter view list url">
            <div class="help-block"></div>
            @if ($errors->has('minute_volume'))
                <div class="help-block">  {{ $errors->first('minute_volume') }}</div>
            @endif
        </div>

        <div class="form-group col-md-6 {{ $errors->has('internet_volume_mb') ? ' error' : '' }}">
            <label for="internet_volume_mb" class="required">Internet Volume (MB)</label>
            <input type="number" name="internet_volume_mb"  class="form-control" placeholder="Enter internet volume in MB"
                   oninput="this.value =(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"
                   value="{{ (!empty($product->product_core->internet_volume_mb)) ? $product->product_core->internet_volume_mb : old("internet_volume_mb") ?? '' }}"
                   required data-validation-required-message="Enter view list button label bangla ">
            <div class="help-block"></div>
            @if ($errors->has('internet_volume_mb'))
                <div class="help-block">  {{ $errors->first('internet_volume_mb') }}</div>
            @endif
        </div>
    </slot>
@endif




