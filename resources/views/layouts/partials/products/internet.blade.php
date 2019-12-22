@php
    if (isset($product->offer_info['duration_category_id'])){
        $offertype = $product->offer_info['duration_category_id'];
    }else{
        $offertype = '';
    }
@endphp

@include('layouts.partials.products.common-field.internet_volume')

@include('layouts.partials.products.common-field.duration_type')

@include('layouts.partials.products.common-field.validity')

@include('layouts.partials.products.common-field.balance_check')


