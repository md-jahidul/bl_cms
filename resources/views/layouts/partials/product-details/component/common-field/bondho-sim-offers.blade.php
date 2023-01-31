@php
    function match($id,$relatedProducts){
    if ($relatedProducts){
        foreach ($relatedProducts as $relatedProduct)
        {
            if($relatedProduct == $id){
                return true;
            }
        }
    }
    return false;
}
@endphp

<div id="related_product_field" class="col-md-12 {{ $errors->has('offer_type_id') ? ' error' : '' }}">
    <label for="editor_en">Related Product</label>
    <select name="other_attributes[]" class="select2 form-control" id="data-type" multiple="multiple" >
        @foreach($products as  $product)
            <option value="{{ $product->id }}"
                {{ match($product->id, $component->other_attributes) ? 'selected' : '' }}
            >{{ $product->name_en . '/ ' . $product->product_code }}</option>
        @endforeach
    </select>
    <div class="help-block"></div>
    @if ($errors->has('offer_type_id'))
        <div class="help-block">{{ $errors->first('offer_type_id') }}</div>
    @endif
</div>
