<div class="form-group col-md-6 {{ $errors->has('redirect_url') ? ' error' : '' }}">
    <label for="redirect_url" class="required">Redirect Url</label>
    <input type="text" name="other_attributes[redirect_url]"  class="form-control" placeholder="Enter redirect url"
           value="{{ isset($other_attributes) ? $other_attributes['redirect_url'] : '' }}" required data-validation-required-message="Enter valid link">
    <p class="hints"> ( For internal link only path, e.g. /offers And for external full path e.g.  https://eshop.banglalink.net/ )</p>
    <div class="help-block"></div>
    @if ($errors->has('redirect_url'))
        <div class="help-block">  {{ $errors->first('redirect_url') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('button_label_en') ? ' error' : '' }}">
    <label for="button_label_en" class="required">Button Label (English)</label>
    <input type="text" name="other_attributes[button_label_en]"  class="form-control" placeholder="Enter english title"
           value="{{ isset($other_attributes) ? $other_attributes['button_label_en'] : '' }}" required data-validation-required-message="Enter english title">
    <div class="help-block"></div>
    @if ($errors->has('button_label_en'))
        <div class="help-block">  {{ $errors->first('button_label_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('button_label_bn') ? ' error' : '' }}">
    <label for="title" class="">Button Label (Bangla)</label>
    <input type="text" name="other_attributes[button_label_bn]"  class="form-control" placeholder="Button Label Bangla"
           required data-validation-required-message="Enter bangla title"
           value="{{ (!empty($other_attributes['button_label_bn'])) ? $other_attributes['button_label_bn'] : "" }}">
    <div class="help-block"></div>
    @if ($errors->has('button_label_bn'))
        <div class="help-block">  {{ $errors->first('button_label_bn') }}</div>
    @endif
</div>
