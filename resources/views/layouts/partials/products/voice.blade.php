@php
    if (isset($product->offer_info['duration_category_id'])){
        $offertype = $product->offer_info['duration_category_id'];
    }else{
        $offertype = '';
    }
@endphp

@include('layouts.partials.products.common-field.recharge_code')

@include('layouts.partials.products.common-field.price_vat_mrp')

@include('layouts.partials.products.common-field.minute_volume')

@include('layouts.partials.products.common-field.call_rate')

@include('layouts.partials.products.common-field.call_rate_unit')

@include('layouts.partials.products.common-field.validity_unit')

@include('layouts.partials.products.common-field.validity')

@include('layouts.partials.products.common-field.ussd_code')

@include('layouts.partials.products.common-field.balance_check')

@include('layouts.partials.products.common-field.tag')


