<div class="form-group col-md-6 {{ $errors->has('title_bn') ? ' error' : '' }}">
    <label for="title_bn" class="">Title Bangla</label>
    <input type="text" name="other_attributes[title_bn]"  class="form-control" placeholder="Enter price info"
            value="{{ (!empty($other_attributes['title_bn'])) ? $other_attributes['title_bn'] : "" }}" >
    <div class="help-block"></div>
    @if ($errors->has('title_bn'))
        <div class="help-block">  {{ $errors->first('title_bn') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('redirect_url') ? ' error' : '' }}">
    <label for="redirect_url" class="required">Redirect Url</label>
    <input type="text" name="redirect_url"  class="form-control" placeholder="Enter redirect url"
           value="{{ isset($sliderImage) ? $sliderImage->redirect_url : '' }}" required data-validation-required-message="Enter valid link">
    <p class="hints"> ( For internal link only path, e.g. /offers And for external full path e.g.  https://eshop.banglalink.net/ )</p>
    <div class="help-block"></div>
    @if ($errors->has('redirect_url'))
        <div class="help-block">  {{ $errors->first('redirect_url') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('url_btn_label') ? ' error' : '' }}">
    <label for="url_btn_label" class="required">Button Label</label>
    <input type="text" name="url_btn_label"  class="form-control" placeholder="Enter english title"
           value="{{ isset($sliderImage) ? $sliderImage->url_btn_label : '' }}" required data-validation-required-message="Enter link">
    <div class="help-block"></div>
    @if ($errors->has('url_btn_label'))
        <div class="help-block">  {{ $errors->first('url_btn_label') }}</div>
    @endif
</div>



<div class="form-group col-md-6 {{ $errors->has('button_label_bn') ? ' error' : '' }}">
    <label for="title" class="">Button Label Bangla</label>
    <input type="text" name="other_attributes[button_label_bn]"  class="form-control" placeholder="Button Label Bangla"
           value="{{ (!empty($other_attributes['button_label_bn'])) ? $other_attributes['button_label_bn'] : "" }}">
    <div class="help-block"></div>
    @if ($errors->has('button_label_bn'))
        <div class="help-block">  {{ $errors->first('button_label_bn') }}</div>
    @endif
</div>
