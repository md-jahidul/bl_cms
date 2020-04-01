<div class="form-group col-md-6 {{ $errors->has('recharge_product_code') ? ' error' : '' }}">
    <label for="recharge_product_code">Recharge Product Code</label>
    <input type="text" name="recharge_product_code" id="recharge_product_code"  class="form-control" placeholder="Enter recharge product code"
           value="{{ (!empty($product->product_core->recharge_product_code)) ? $product->product_core->recharge_product_code : old("recharge_product_code") ?? '' }}"
    {{ (!empty($product->product_core->recharge_product_code)) ? 'readonly' : '' }}>
    <div class="help-block"></div>
    @if ($errors->has('recharge_product_code'))
        <div class="help-block">{{ $errors->first('recharge_product_code') }}</div>
    @endif
</div>
