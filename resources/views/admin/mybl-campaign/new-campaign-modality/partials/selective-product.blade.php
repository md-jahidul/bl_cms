@php
    $index = isset($key) ?  $key : 0;
@endphp

<input type="hidden" name="campaign_details[{{ $index }}][campaign_details_id]" value="{{ isset($product->id) ? $product->id : '' }}">
<div id="image-input" class="form-group col-md-6">
    <div class="form-group">
        <label for="image_url">Thumbnail Image</label>
        <input type="file" id="image_url" name="campaign_details[{{ $index }}][thumb_image]" class="dropify" data-height="77"
        data-default-file="{{ isset($product->thumb_image) ? asset($product->thumb_image) : '' }}"/>
    </div>
</div>

<div id="image-input" class="form-group col-md-6 mb-0">
    <div class="form-group">
        <label for="image_url">Banner Image</label>
        <input type="file" id="image_url" name="campaign_details[{{ $index }}][banner_image]" class="dropify" data-height="77" data-allowed-file-extensions="png jpg jpeg gif"
        data-default-file="{{ isset($product->banner_image) ? asset($product->banner_image) : '' }}"/>
        <div class="help-block"></div>
    </div>
</div>

<div class="form-group col-md-6 mb-0">
    <label for="desc_en" class="required">Description En</label>
    <textarea rows="3" id="desc_en" name="campaign_details[{{ $index }}][desc_en]" class="form-control"
              placeholder="Enter description in English">{{ isset($product->desc_en) ? $product->desc_en : '' }}</textarea>
</div>

<div class="form-group col-md-6">
    <label for="desc_bn" class="required">Description Bn</label>.
    <textarea rows="3" id="desc_bn" name="campaign_details[{{ $index }}][desc_bn]"
              class="form-control"
              placeholder="Enter description in Bangla">{{ isset($product->desc_bn) ? $product->desc_bn : '' }}</textarea>
</div>
@php
    $productType = '<span class="text-success">(Prepaid) </span>'
@endphp
<div class="form-group col-md-4 product_code" id="cta_action">
    <label for="product_code" class="required">Product Code</label>
    <select id="product_code" name="campaign_details[{{ $index }}][product_code]" class="browser-default custom-select product-list">
        <option value="">Select Product</option>
        @foreach ($products as $key => $value)
            <option value="{{ $value->product_code }}"{{ isset($product->product_code) && $product->product_code == $value->product_code ? 'selected' : '' }}
            >{!! ($value->sim_type == 1 ? $productType : "(Postpaid) ") . $value->commercial_name_en . " / " . $value->product_code  !!}</option>
        @endforeach
    </select>
    <div class="help-block"></div>
</div>
<div class="col-md-3 icheck_minimal skin mt-2">
    <fieldset>
        <input type="checkbox" id="show_in_home" value="1"
               name="campaign_details[{{ $index }}][show_in_home]" {{ isset($product->show_in_home) && $product->show_in_home ? 'checked' : '' }}>
        <label for="show_in_home">Show in Home</label>
    </fieldset>
</div>
