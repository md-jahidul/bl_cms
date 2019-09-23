<h4 class="pl-1">Advance Option</h4>
<div class="form-actions col-md-12 mt-0"></div>

<div class="form-group col-md-4 {{ $errors->has('title_bn') ? ' error' : '' }}">
    <label for="title_bn" class="">Title Bangla</label>
    <input type="text" name="title_bn"  class="form-control" placeholder="Enter price info"
            value="{{ (!empty($other_attributes['title_bn'])) ? $other_attributes['title_bn'] : "" }}" >
    <div class="help-block"></div>
    @if ($errors->has('title_bn'))
        <div class="help-block">  {{ $errors->first('title_bn') }}</div>
    @endif
</div>

<div class="form-group col-md-4 {{ $errors->has('price_info') ? ' error' : '' }}">
    <label for="price_info" class="">Price Info</label>
    <input type="text" name="price_info"  class="form-control" placeholder="Enter price info"
            value="{{ (!empty($other_attributes['price_info'])) ? $other_attributes['price_info'] : "" }}" >
    <div class="help-block"></div>
    @if ($errors->has('price_info'))
        <div class="help-block">  {{ $errors->first('price_info') }}</div>
    @endif
</div>

<div class="form-group col-md-4 {{ $errors->has('price_info_bn') ? ' error' : '' }}">
    <label for="price_info_bn" class="">Price Info</label>
    <input type="text" name="price_info_bn"  class="form-control" placeholder="Enter price info (Bangla)"
            value="{{ (!empty($other_attributes['price_info_bn'])) ? $other_attributes['price_info_bn'] : "" }}" >
    <div class="help-block"></div>
    @if ($errors->has('price_info_bn'))
        <div class="help-block">  {{ $errors->first('price_info_bn') }}</div>
    @endif
</div>

<div class="form-group col-md-4 {{ $errors->has('google_play_link') ? ' error' : '' }}">
    <label for="title" class="">Google Play Store Link</label>
    <input type="text" name="google_play_link"  class="form-control" placeholder="Google Play Store Link"
            value="{{ (!empty($other_attributes['google_play_link'])) ? $other_attributes['google_play_link'] : "" }}">
    <div class="help-block"></div>
    @if ($errors->has('google_play_link'))
        <div class="help-block">  {{ $errors->first('google_play_link') }}</div>
    @endif
</div>
<div class="form-group col-md-4 {{ $errors->has('app_store_link') ? ' error' : '' }}">
    <label for="title" class="">App Store Link</label>
    <input type="text" name="app_store_link"  class="form-control" placeholder="App Store Link"
            value="{{ (!empty($other_attributes['app_store_link'])) ? $other_attributes['app_store_link'] : "" }}">
    <div class="help-block"></div>
    @if ($errors->has('app_store_link'))
        <div class="help-block">  {{ $errors->first('app_store_link') }}</div>
    @endif
</div>

<div class="form-group col-md-12 {{ $errors->has('description_bn') ? ' error' : '' }}">
    <label for="description_bn" class="required">Description</label>
    <textarea type="text" name="description_bn" rows="5"  class="form-control" placeholder="Enter alt text"
                required data-validation-required-message="Please select start date">{{ old("title") ? old("title") : '' }}</textarea>
    <div class="help-block"></div>
    @if ($errors->has('description_bn'))
        <div class="help-block">  {{ $errors->first('description_bn') }}</div>
    @endif
</div>

