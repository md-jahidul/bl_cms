<div class="form-group col-md-5 {{ $errors->has('product_img_url') ? ' error' : '' }}">
    <label for="alt_text">Product Image</label>
    <div class="custom-file">
        <input type="file" name="product_img_url" class="custom-file-input" id="{{ $imgField }}">
        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
    </div>
    <span class="text-primary">Please given file type (.png, .jpg)</span>

    <div class="help-block"></div>
    @if ($errors->has('product_img_url'))
        <div class="help-block">  {{ $errors->first('product_img_url') }}</div>
    @endif
</div>

<div class="form-group col-md-1">
    @if(isset($appServiceProduct->product_img_url))
        <img src="{{ isset($appServiceProduct->product_img_url) ? config('filesystems.file_base_url') . $appServiceProduct->product_img_url : '' }}"
         class="{{ isset($appServiceProduct->product_img_url) ? '' : 'd-none' }}" height="70" width="70" id="{{ $showImg }}">
    @else
        <img style="height:70px;width:70px;display:none" id="{{ $showImg }}">
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('product_img_web_en') ? ' error' : '' }}">
    <label class="required">Product Image Name Web EN</label>
    <div>
        <input type="text" name="product_img_web_en" required class="form-control"
               placeholder="Enter product image web name en"
               value="{{ isset($appServiceProduct->product_img_web_en) ? $appServiceProduct->product_img_web_en : "" }}">
    </div>

    @if ($errors->has('product_img_web_en'))
        <div class="help-block">{{ $errors->first('product_img_web_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('product_img_web_bn') ? ' error' : '' }}">
    <label class="required">Product Image Name Web BN</label>
    <div>
        <input type="text" name="product_img_web_bn" required class="form-control"
               placeholder="Enter product image web name bn"
               value="{{ isset($appServiceProduct->product_img_web_bn) ? $appServiceProduct->product_img_web_bn : "" }}">
    </div>

    @if ($errors->has('product_img_web_bn'))
        <div class="help-block">{{ $errors->first('product_img_web_bn') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('product_img_mobile_en') ? ' error' : '' }}">
    <label class="required">Product Image Name Mobile EN</label>
    <div>
        <input type="text" name="product_img_mobile_en" required class="form-control"
               placeholder="Enter product image mobile name en"
               value="{{ isset($appServiceProduct->product_img_mobile_en) ? $appServiceProduct->product_img_mobile_en : "" }}">
    </div>

    @if ($errors->has('product_img_mobile_en'))
        <div class="help-block">{{ $errors->first('product_img_mobile_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('product_img_mobile_bn') ? ' error' : '' }}">
    <label class="required">Product Image Name Mobile BN</label>
    <div>
        <input type="text" name="product_img_mobile_bn" required class="form-control"
               placeholder="Enter product image mobile name bn"
               value="{{ isset($appServiceProduct->product_img_mobile_bn) ? $appServiceProduct->product_img_mobile_bn : "" }}">
    </div>

    @if ($errors->has('product_img_mobile_bn'))
        <div class="help-block">  {{ $errors->first('product_img_mobile_bn') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('alt_text_en') ? ' error' : '' }}">
    <label>Alt Text EN</label>
    <div>
        <input type="text" name="alt_text_en" class="form-control"
               placeholder="Alt text en"
               value="{{ isset($appServiceProduct->alt_text_en) ? $appServiceProduct->alt_text_bn : "" }}">
    </div>

    @if ($errors->has('alt_text_en'))
        <div class="help-block">  {{ $errors->first('alt_text_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('alt_text_bn') ? ' error' : '' }}">
    <label>Alt Text BN</label>
    <div>
        <input type="text" name="alt_text_bn" class="form-control"
               placeholder="Alt text bn"
               value="{{ isset($appServiceProduct->alt_text_bn) ? $appServiceProduct->alt_text_bn : "" }}">
    </div>

    @if ($errors->has('alt_text_bn'))
        <div class="help-block">  {{ $errors->first('alt_text_bn') }}</div>
    @endif
</div>
