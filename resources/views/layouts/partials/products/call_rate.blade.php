@php
    if (isset($product->offer_info['duration_category_id'])){
        $offertype = $product->offer_info['duration_category_id'];
    }else{
        $offertype = '';
    }
@endphp

@include('layouts.partials.products.common-field.call_rate')

@include('layouts.partials.products.common-field.validity_unit')

@include('layouts.partials.products.common-field.validity')

