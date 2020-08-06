<div class="form-group col-md-6 {{ $errors->has('renew_product_code') ? ' error' : '' }}">
    <label for="price">Auto Renew Product Code</label>
    <input type="text" name="renew_product_code" id="renew_product_code"  class="form-control" placeholder="Enter auto renew product code"
           value="{{ (!empty($product->product_core->renew_product_code)) ? $product->product_core->renew_product_code : old("renew_product_code") ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('renew_product_code'))
        <div class="help-block">{{ $errors->first('renew_product_code') }}</div>
    @endif
</div>
