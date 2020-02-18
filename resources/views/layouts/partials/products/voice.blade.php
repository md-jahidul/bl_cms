@php
    if (isset($product->offer_info['duration_category_id'])){
        $offertype = $product->offer_info['duration_category_id'];
    }else{
        $offertype = '';
    }
@endphp

@include('layouts.partials.products.common-field.minute_volume')

@include('layouts.partials.products.common-field.validity_unit')

@include('layouts.partials.products.common-field.validity')

