<div class="form-group col-md-6 ">
    <label for="price">Recharge Product Code</label>
    <input type="text" name="mrp_price" id="mrp_price"  class="form-control" placeholder="Enter recharge product code"
           value="{{ (!empty($product->product_core->recharge_product_code)) ? $product->product_core->recharge_product_code : old("recharge_product_code") ?? '' }}">
    <div class="help-block"></div>
</div>
