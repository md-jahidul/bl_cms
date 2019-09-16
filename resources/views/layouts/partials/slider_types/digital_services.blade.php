<div class="other_attributes">
    <div class="form-group col-md-6 {{ $errors->has('monthly_rate') ? ' error' : '' }}">
        <label for="title" class="required">Monthly Rate</label>
        <input type="text" name="monthly_rate"  class="form-control" placeholder="Monthly Rate"
                value="" required data-validation-required-message="Monthly Rate">
        <div class="help-block"></div>
        @if ($errors->has('monthly_rate'))
            <div class="help-block">  {{ $errors->first('monthly_rate') }}</div>
        @endif
    </div>
    <div class="form-group col-md-6 {{ $errors->has('google_play_link') ? ' error' : '' }}">
        <label for="title" class="required">Google Play Store Link</label>
        <input type="text" name="google_play_link"  class="form-control" placeholder="Google Play Store Link"
                value="" required data-validation-required-message="Google Play Store Link">
        <div class="help-block"></div>
        @if ($errors->has('google_play_link'))
            <div class="help-block">  {{ $errors->first('google_play_link') }}</div>
        @endif
    </div>
    <div class="form-group col-md-6 {{ $errors->has('app_store_link') ? ' error' : '' }}">
        <label for="title" class="required">App Store Link</label>
        <input type="text" name="app_store_link"  class="form-control" placeholder="App Store Link"
                value="" required data-validation-required-message="App Store Link">
        <div class="help-block"></div>
        @if ($errors->has('app_store_link'))
            <div class="help-block">  {{ $errors->first('app_store_link') }}</div>
        @endif
    </div>
</div>