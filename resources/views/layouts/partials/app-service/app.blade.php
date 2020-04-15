@include('layouts.partials.app-service.common-field.validity-unit')
@include('layouts.partials.app-service.common-field.price')
@include('layouts.partials.app-service.common-field.tag')

@include('layouts.partials.app-service.common-field.product-image', ['imgField' => 'imgOne', 'showImg' => 'imgShowOne'])

<div class="form-group col-md-6 {{ $errors->has('google_play_link') ? ' error' : '' }}">
    <label for="title">Google Play Store Link</label>
    <input type="text" name="google_play_link"  class="form-control" placeholder="Enter play store link"
    value="{{ isset($appServiceProduct->google_play_link) ? $appServiceProduct->google_play_link : "" }}">
    <div class="help-block"></div>
    @if ($errors->has('google_play_link'))
        <div class="help-block">  {{ $errors->first('google_play_link') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('app_store_link') ? ' error' : '' }}">
    <label for="title">App Store Link</label>
    <input type="text" name="app_store_link"  class="form-control" placeholder="Enter app store link"
    value="{{ isset($appServiceProduct->app_store_link) ? $appServiceProduct->app_store_link : '' }}">
    <div class="help-block"></div>
    @if ($errors->has('app_store_link'))
        <div class="help-block">  {{ $errors->first('app_store_link') }}</div>
    @endif
</div>
