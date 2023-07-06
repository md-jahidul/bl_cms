{{--<div class="form-group col-md-6 {{ $errors->has('product_img_url') ? ' error' : '' }}">--}}
{{--    <label for="alt_text">Product Image</label>--}}
{{--    <div class="custom-file">--}}
{{--        <input type="file" name="product_img_url" class="custom-file-input dropify" id="{{ $imgField }}"--}}
{{--               data-default-file="{{ isset($appServiceProduct->product_img_url) ? config('filesystems.file_base_url') . $appServiceProduct->product_img_url : '' }}">--}}
{{--        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>--}}
{{--    </div>--}}
{{--    <span class="text-primary">Please given file type (.png, .jpg)</span>--}}

{{--    <div class="help-block"></div>--}}
{{--    @if ($errors->has('product_img_url'))--}}
{{--        <div class="help-block">  {{ $errors->first('product_img_url') }}</div>--}}
{{--    @endif--}}
{{--</div>--}}

{{--<div class="form-group col-md-1">--}}
{{--    @if(isset($appServiceProduct->product_img_url))--}}
{{--        <img src="{{ isset($appServiceProduct->product_img_url) ? config('filesystems.file_base_url') . $appServiceProduct->product_img_url : '' }}"--}}
{{--         class="{{ isset($appServiceProduct->product_img_url) ? '' : 'd-none' }}" height="70" width="70" id="{{ $showImg }}">--}}
{{--    @else--}}
{{--        <img style="height:70px;width:70px;display:none" id="{{ $showImg }}">--}}
{{--    @endif--}}
{{--</div>--}}
