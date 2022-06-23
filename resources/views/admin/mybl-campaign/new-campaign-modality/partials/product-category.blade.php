@php
    $index = isset($key) ?  $key : 0;
@endphp

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

<div class="col-md-4 icheck_minimal skin mt-2">
    <fieldset>
        <input type="checkbox" id="show_in_home" value="1"
               name="campaign_details[{{ $index }}][show_in_home]" {{ isset($product->show_in_home) && $product->show_in_home ? 'checked' : '' }}>
        <label for="show_in_home">Show in Home</label>
    </fieldset>
</div>

<div class="col-md-4">
    <div class="form-group">
        <label class="required">Product Categories</label>
        <select name="campaign_details[{{ $index }}][product_category_slug]" class="browser-default custom-select" id="cash_back_type">
            <option value="">Select Cashback Type</option>
            @foreach($productCategories as $key => $data)
                <option value="{{ $key }}" {{ isset($product->product_category_slug) && $product->product_category_slug == $key ? 'selected' : '' }}>{{ $data }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group col-md-4">
    <label for="reward_getting_type">Show product as</label>
    <select id="navigate_action" name="campaign_details[{{ $index }}][show_product_as]" class="browser-default custom-select">
        <option value="bottom_sheet" {{ isset($product->show_product_as) && $product->show_product_as == "bottom_sheet" ? 'selected' : '' }}>Bottom Sheet</option>
        <option value="pop_up" {{ isset($product->show_product_as) && $product->show_product_as == "pop_up" ? 'selected' : '' }}>Pop-up</option>
        <option value="campaign_only" {{ isset($product->show_product_as) && $product->show_product_as == "campaign_only" ? 'selected' : '' }}>Campaign Section only</option>
    </select>
</div>
