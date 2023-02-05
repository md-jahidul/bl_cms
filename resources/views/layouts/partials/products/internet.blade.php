@php
    if (isset($product->offer_info['duration_category_id'])){
        $offertype = $product->offer_info['duration_category_id'];
    }else{
        $offertype = '';
    }
@endphp

@if(strtolower($type) == 'prepaid')
    @include('layouts.partials.products.common-field.renew_code')
    @include('layouts.partials.products.common-field.recharge_code')
@endif

{{--@include('layouts.partials.products.common-field.recharge_code')--}}

@include('layouts.partials.products.common-field.price_vat_mrp')

@include('layouts.partials.products.common-field.internet_volume')

@include('layouts.partials.products.common-field.validity_unit')

@include('layouts.partials.products.common-field.validity')

@include('layouts.partials.products.common-field.validity_free_text')

@include('layouts.partials.products.common-field.ussd_code')

@include('layouts.partials.products.common-field.balance_check')

@include('layouts.partials.products.common-field.tag')

{{--@include('layouts.partials.products.common-field.image')--}}





