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

{{--<div class="form-group col-md-6 {{ $errors->has('product_img_en') ? ' error' : '' }}">--}}
{{--    <label class="required">Product Image Name EN</label>--}}
{{--    <div>--}}
{{--        <input type="text" name="product_img_en" required class="form-control"--}}
{{--               placeholder="Enter product image name en"--}}
{{--               value="{{ isset($appServiceProduct->product_img_en) ? $appServiceProduct->product_img_en : "" }}">--}}
{{--    </div>--}}

{{--    @if ($errors->has('product_img_en'))--}}
{{--        <div class="help-block">{{ $errors->first('product_img_en') }}</div>--}}
{{--    @endif--}}
{{--</div>--}}

{{--<div class="form-group col-md-6 {{ $errors->has('product_img_bn') ? ' error' : '' }}">--}}
{{--    <label class="required">Product Image Name BN</label>--}}
{{--    <div>--}}
{{--        <input type="text" name="product_img_bn" required class="form-control"--}}
{{--               placeholder="Enter product image name bn"--}}
{{--               value="{{ isset($appServiceProduct->product_img_bn) ? $appServiceProduct->product_img_bn : "" }}">--}}
{{--    </div>--}}

{{--    @if ($errors->has('product_img_bn'))--}}
{{--        <div class="help-block">{{ $errors->first('product_img_bn') }}</div>--}}
{{--    @endif--}}
{{--</div>--}}

{{--<div class="form-group col-md-6 {{ $errors->has('alt_text_en') ? ' error' : '' }}">--}}
{{--    <label>Alt Text EN</label>--}}
{{--    <div>--}}
{{--        <input type="text" name="alt_text_en" class="form-control"--}}
{{--               placeholder="Alt text en"--}}
{{--               value="{{ isset($appServiceProduct->alt_text_en) ? $appServiceProduct->alt_text_bn : "" }}">--}}
{{--    </div>--}}

{{--    @if ($errors->has('alt_text_en'))--}}
{{--        <div class="help-block">  {{ $errors->first('alt_text_en') }}</div>--}}
{{--    @endif--}}
{{--</div>--}}

{{--<div class="form-group col-md-6 {{ $errors->has('alt_text_bn') ? ' error' : '' }}">--}}
{{--    <label>Alt Text BN</label>--}}
{{--    <div>--}}
{{--        <input type="text" name="alt_text_bn" class="form-control"--}}
{{--               placeholder="Alt text bn"--}}
{{--               value="{{ isset($appServiceProduct->alt_text_bn) ? $appServiceProduct->alt_text_bn : "" }}">--}}
{{--    </div>--}}

{{--    @if ($errors->has('alt_text_bn'))--}}
{{--        <div class="help-block">  {{ $errors->first('alt_text_bn') }}</div>--}}
{{--    @endif--}}
{{--</div>--}}
