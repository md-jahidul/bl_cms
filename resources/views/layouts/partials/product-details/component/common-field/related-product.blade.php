<div id="related_product_field" class="col-md-6 {{ $errors->has('offer_type_id') ? ' error' : '' }} d-none">
    <label for="editor_en">Related Product</label>
    <select name="offer_type_id" class="select2 form-control" id="data-type">
        <option value="">--Select Data Type--</option>
        {{--                                                            <option value="60">Special Data Offer</option>--}}
        {{--                                                            <option value="59">Special Voice Offer</option>--}}
        @foreach($products as  $product)
            <option value="{{ $product->id }}">{{ $product->name_en . '/ ' . $product->product_code }}</option>
        @endforeach
    </select>
    <div class="help-block"></div>
    @if ($errors->has('offer_type_id'))
        <div class="help-block">{{ $errors->first('offer_type_id') }}</div>
    @endif
</div>
