@php
    $index = isset($key) ?  $key : 0;
@endphp

<div class="col-md-4" >
    <div class="form-group">
        <label class="required">Cashback Type : </label>
        <select name="campaign_details[{{ $index }}][cash_back_type]" class="browser-default custom-select" id="cash_back_type">
            <option value="">Select Cashback Type</option>
            <option value="fixed_amount" {{ isset($product->cash_back_type) && $product->cash_back_type == "fixed_amount" ? 'selected' : '' }}>Fixed Amount</option>
            <option value="percentage" {{ isset($product->cash_back_type) && $product->cash_back_type == "percentage" ? 'selected' : '' }}>Percentage</option>
        </select>
    </div>
</div>

<div class="form-group col-md-4 cash_back_amount_for_product">
    <label for="max_amount">Max Cash Back Amount</label>
    <input type="number" name="campaign_details[{{ $index }}][max_amount]" class="form-control"
           placeholder="Please Enter Max Amount" value="{{ isset($product->max_amount) ? $product->max_amount : '' }}">
</div>
