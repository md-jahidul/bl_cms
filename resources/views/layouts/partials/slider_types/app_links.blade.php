<div class="form-group col-md-6 {{ $errors->has('google_play_link') ? ' error' : '' }}">
    <label for="title">Google Play Store Link</label>
    <input type="text" name="other_attributes[google_play_link]"  class="form-control" placeholder="Enter play store link"
           value="{{ (!empty($other_attributes['google_play_link'])) ? $other_attributes['google_play_link'] : old("other_attributes.google_play_link") ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('google_play_link'))
        <div class="help-block">  {{ $errors->first('google_play_link') }}</div>
    @endif
</div>


<div class="form-group col-md-6 {{ $errors->has('app_store_link') ? ' error' : '' }}">
    <label for="title">App Store Link</label>
    <input type="text" name="other_attributes[app_store_link]"  class="form-control" placeholder="Enter app store link"
           value="{{ (!empty($other_attributes['app_store_link'])) ? $other_attributes['app_store_link'] : old("other_attributes.app_store_link") ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('app_store_link'))
        <div class="help-block">  {{ $errors->first('app_store_link') }}</div>
    @endif
</div>
