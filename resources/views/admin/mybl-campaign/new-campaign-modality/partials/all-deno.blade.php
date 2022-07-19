@php
    $index = isset($key) ?  $key : 0;
@endphp
<div id="image-input" class="form-group col-md-4">
    <div class="form-group">
        <label for="image_url">Thumbnail Image</label>
        <input type="file" id="image_url" name="campaign_details[{{ $index }}][thumb_image]" class="dropify" data-height="77"
               data-default-file="{{ isset($product->thumb_image) ? asset($product->thumb_image) : '' }}"/>
    </div>
</div>

<div id="image-input" class="form-group col-md-4 mb-0">
    <div class="form-group">
        <label for="image_url">Banner Image</label>
        <input type="file" id="image_url" name="campaign_details[{{ $index }}][banner_image]" class="dropify" data-height="77" data-allowed-file-extensions="png jpg jpeg gif"
               data-default-file="{{ isset($product->banner_image) ? asset($product->banner_image) : '' }}"/>
        <div class="help-block"></div>
    </div>
</div>

<div id="image-input" class="form-group col-md-4 mb-0">
    <div class="form-group">
        <label for="image_url">Popup Image</label>
        <input type="file" id="image_url" name="campaign_details[{{ $index }}][popup_image]" class="dropify" data-height="77" data-allowed-file-extensions="png jpg jpeg gif"
               data-default-file="{{ isset($product->popup_image) ? asset($product->popup_image) : '' }}"/>
        <div class="help-block"></div>
    </div>
</div>
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
<div class="col-md-4">
    <label for="cash_back_amount">Enter Fixed/Percentage amount of Cashback</label>
    <input type="number" name="campaign_details[{{$index}}][cash_back_amount]" id="cash_back_amount" class="form-control"
           placeholder="Enter The Fixed/Percentage of Cashback"
           value="{{ isset($product->cash_back_amount) ? $product->cash_back_amount : '' }}">
</div>
<div class="form-group col-md-4 cash_back_amount_for_product">
    <label for="max_amount">Max Cash Back Amount</label>
    <input type="number" name="campaign_details[{{ $index }}][max_amount]" class="form-control"
           placeholder="Please Enter Max Amount" value="{{ isset($product->max_amount) ? $product->max_amount : '' }}">
</div>
