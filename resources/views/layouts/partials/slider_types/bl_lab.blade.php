<div class="form-group col-md-4 {{ $errors->has('redirect_url') ? ' error' : '' }}">
    <label for="redirect_url">URL English</label>
    <input type="text" name="other_attributes[redirect_url]"  class="form-control" placeholder="Enter redirect redirect_url"
           value="{{ (!empty($other_attributes['redirect_url'])) ? $other_attributes['redirect_url'] : old("other_attributes.redirect_url") ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('redirect_url'))
        <div class="help-block">  {{ $errors->first('redirect_url') }}</div>
    @endif
</div>

<div class="form-group col-md-4 {{ $errors->has('redirect_url_bn') ? ' error' : '' }}">
    <label for="redirect_url_bn">URL Bangla</label>
    <input type="text" name="other_attributes[redirect_url_bn]"  class="form-control" placeholder="Enter redirect redirect_url_bn"
           value="{{ (!empty($other_attributes['redirect_url_bn'])) ? $other_attributes['redirect_url_bn'] : old("other_attributes.redirect_url_bn") ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('redirect_url_bn'))
        <div class="help-block">  {{ $errors->first('redirect_url_bn') }}</div>
    @endif
</div>

@include('layouts.partials.slider_types.text_area')
@include('layouts.partials.common_types.label_with_url')
@include('layouts.partials.common_types.label_with_url',['count'=>1])




<div class=" col-md-6 {{ $errors->has('icon_image') ? ' error' : '' }}">
    <label for="alt_text" class="required">Icon Image</label>
    <div class="custom-file">
        <input type="file" name="icon_image" class="custom-file-input dropify"
                required data-validation-required-message="Slider image field is required" data-height="80" data-default-file="{{  isset($component) && isset($component->icon_image) ? config('filesystems.file_base_url') . $component->icon_image : ''}}">
    </div>
    <span class="text-primary">Please given file type (.png, .jpg, .svg)</span>

    <div class="help-block"></div>
    @if ($errors->has('icon_image'))
        <div class="help-block">  {{ $errors->first('icon_image') }}</div>
    @endif
</div>

<div class="form-group col-md-4 {{ $errors->has('icon_alt_text_en') ? ' error' : '' }}">
    <label for="icon_alt_text_en">Icon alt text</label>
    <input type="text" name="icon_alt_text_en"  class="form-control" placeholder="Enter redirect icon_alt_text_en"
           value="{{ isset($component) && isset($component->icon_alt_text_en) ? $component->icon_alt_text_en : '' }}">
    <div class="help-block"></div>
    @if ($errors->has('icon_alt_text_en'))
        <div class="help-block">  {{ $errors->first('icon_alt_text_en') }}</div>
    @endif
</div>

<div class="form-group col-md-4 {{ $errors->has('icon_alt_text_bn') ? ' error' : '' }}">
    <label for="icon_alt_text_bn">Icon alt text bn</label>
    <input type="text" name="icon_alt_text_bn"  class="form-control" placeholder="Enter redirect icon_alt_text_bn"
           value="{{ isset($component) && isset($component->icon_alt_text_bn) ? $component->icon_alt_text_bn : '' }}">
    <div class="help-block"></div>
    @if ($errors->has('icon_alt_text_bn'))
        <div class="help-block">  {{ $errors->first('icon_alt_text_bn') }}</div>
    @endif
</div>
