@php
    if (isset($product->product_core['validity_unit'])){
        $validityType = $product->product_core['validity_unit'];
    }else{
        $validityType = '';
    }
@endphp

{{--{{ dd($product->offer_info) }}--}}

<div class="form-group col-md-6 validity_free_text {{($validityType == "free_text") ? '' : 'hidden'}}">
    <label for="validity">Validity Free Text EN</label>
    <input type="text" name="offer_info[validity_free_text_en]" class="form-control"
           placeholder="Enter validity text EN"
           value="{{ (!empty($product->offer_info['validity_free_text_en'])) ? $product->offer_info['validity_free_text_en'] : old("validity") ?? '' }}">
</div>

<div class="form-group col-md-6 validity_free_text {{($validityType == "free_text") ? '' : 'hidden'}}">
    <label for="validity">Validity Free Text BN</label>
    <input type="text" name="offer_info[validity_free_text_bn]" class="form-control"
           placeholder="Enter validity text BN"
           value="{{ (!empty($product->offer_info['validity_free_text_bn'])) ? $product->offer_info['validity_free_text_bn'] : old("validity") ?? '' }}">
</div>

