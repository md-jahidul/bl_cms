<h4 class="pl-1">Advance Option</h4>
<div class="form-actions col-md-12 mt-0"></div>

<div class="form-group col-md-4 {{ $errors->has('monthly_rate') ? ' error' : '' }}">
    <label for="title" class="">Monthly Rate</label>
    <input type="text" name="monthly_rate"  class="form-control" placeholder="Monthly Rate"
            value="" >
    <div class="help-block"></div>
    @if ($errors->has('monthly_rate'))
        <div class="help-block">  {{ $errors->first('monthly_rate') }}</div>
    @endif
</div>
<div class="form-group col-md-4 {{ $errors->has('google_play_link') ? ' error' : '' }}">
    <label for="title" class="">Google Play Store Link</label>
    <input type="text" name="google_play_link"  class="form-control" placeholder="Google Play Store Link"
            value="">
    <div class="help-block"></div>
    @if ($errors->has('google_play_link'))
        <div class="help-block">  {{ $errors->first('google_play_link') }}</div>
    @endif
</div>
<div class="form-group col-md-4 {{ $errors->has('app_store_link') ? ' error' : '' }}">
    <label for="title" class="">App Store Link</label>
    <input type="text" name="app_store_link"  class="form-control" placeholder="App Store Link"
            value="">
    <div class="help-block"></div>
    @if ($errors->has('app_store_link'))
        <div class="help-block">  {{ $errors->first('app_store_link') }}</div>
    @endif
</div>
