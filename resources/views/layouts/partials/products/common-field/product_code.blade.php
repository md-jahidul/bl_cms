
<div class="form-group col-md-6 {{ $errors->has('product_code') ? ' error' : '' }}">
    <label for="product_code" class="required">Product ID</label>
    <select id="product_core" name="product_code"
            data-url="{{ url('product-core/match') }}"
            required data-validation-required-message="Please select product code">
        <option value="">Select product code</option>
        @foreach($productCoreCodes as $productCodes)
            <option value="{{ $productCodes['product_code'] }}">{{ $productCodes['product_code'] }}</option>
        @endforeach
    </select>
    <div class="help-block"></div>
    @if ($errors->has('product_code'))
        <div class="help-block">{{ $errors->first('product_code') }}</div>
    @endif
</div>
