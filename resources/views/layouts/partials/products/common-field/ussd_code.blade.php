<div class="col-md-12">
    <span><h4><strong>USSD Code</strong></h4></span>
    <div class="form-actions col-md-12 mt-0 type-line"></div>
</div>

<div class="form-group col-md-6">
    <label for="activation_ussd">USSD Code (English)</label>
    <input type="text" name="activation_ussd" id="activation_ussd" class="form-control" placeholder="Enter offer ussd code in English"
           value="{{ (!empty($product->product_core->activation_ussd)) ? $product->product_core->activation_ussd : old("activation_ussd") ?? '' }}">
    <div class="help-block"></div>
</div>

<div class="form-group col-md-6">
    <label for="ussd_bn">USSD Code (Bangla)</label>
    <input type="text" name="ussd_bn"  class="form-control" placeholder="Enter offer ussd code in Bangla"
           value="{{ (!empty($product->ussd_bn)) ? $product->ussd_bn : old("ussd_bn") ?? '' }}">
</div>
