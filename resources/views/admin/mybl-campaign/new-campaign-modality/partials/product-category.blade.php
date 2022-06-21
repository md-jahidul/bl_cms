<div id="image-input" class="form-group col-md-6">
    <div class="form-group">
        <label for="image_url">Thumbnail Image</label>
        <input type="file" id="image_url" name="campaign_details[0][thumbnail_img]" class="dropify" data-height="77"/>
    </div>
</div>

<div id="image-input" class="form-group col-md-6 mb-0">
    <div class="form-group">
        <label for="image_url">Banner Image</label>
        <input type="file" id="image_url" name="campaign_details[0][banner_image]" class="dropify" data-height="77" data-allowed-file-extensions="png jpg jpeg gif"/>
        <div class="help-block"></div>
    </div>
</div>

<div class="form-group col-md-6 mb-0">
    <label for="desc_en" class="required">Description En</label>
    <textarea rows="3" id="desc_en" name="campaign_details[0][desc_en]" class="form-control" placeholder="Enter description in English"></textarea>
</div>

<div class="form-group col-md-6">
    <label for="desc_bn" class="required">Description Bn</label>
    <textarea rows="3" id="desc_bn" name="campaign_details[0][desc_bn]"
              class="form-control"
              placeholder="Enter description in Bangla"></textarea>
</div>
<div class="col-md-4">
    <div class="form-group">
        <label class="required">Product Categories</label>
        <select name="campaign_details[0][product_category_slug]" class="browser-default custom-select" id="cash_back_type">
            <option value="">Select Cashback Type</option>
            @foreach($productCategories as $key => $data)
                <option value="{{ $key }}">{{ $data }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="col-md-3 icheck_minimal skin mt-2">
    <fieldset>
        <input type="checkbox" id="show_in_home" value="1"
               name="campaign_details[0][show_in_home]">
        <label for="show_in_home">Show in Home</label>
    </fieldset>
</div>
