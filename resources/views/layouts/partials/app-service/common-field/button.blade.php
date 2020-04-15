<div class="form-group col-md-6 ">
    <label for="button_en">Button Title (English)</label>
    <input type="text" name="other_info[button_en]" id="button_en"  class="form-control"
           placeholder="Enter button title in English"
           value="{{ isset($appServiceProduct->other_info['button_en']) ? $appServiceProduct->other_info['button_en'] : "" }}">
    <div class="help-block"></div>
</div>

<div class="form-group col-md-6 ">
    <label for="button_bn">Button Title (Bangla)</label>
    <input type="text" name="other_info[button_bn]" id="button_bn"  class="form-control"
           placeholder="Enter button title in Bangla"
           value="{{ isset($appServiceProduct->other_info['button_bn']) ? $appServiceProduct->other_info['button_bn'] : "" }}">
    <div class="help-block"></div>
</div>

<div class="form-group col-md-6 ">
    <label for="button_link">Button Link</label>
    <input type="text" name="other_info[button_link]" id="button_link"  class="form-control"
           placeholder="Enter button link"
           value="{{ isset($appServiceProduct->other_info['button_link']) ? $appServiceProduct->other_info['button_link'] : "" }}">
    <div class="help-block"></div>
</div>
