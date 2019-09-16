<div class="other_attributes">
    <div class="form-group col-md-6 {{ $errors->has('title') ? ' error' : '' }}">
        <label for="title" class="required">Monthly Rate</label>
        <input type="text" name="monthly_rate"  class="form-control" placeholder="Monthly Rate"
                value="" required data-validation-required-message="Monthly Rate">
        <div class="help-block"></div>
        @if ($errors->has('monthly_rate'))
            <div class="help-block">  {{ $errors->first('monthly_rate') }}</div>
        @endif
    </div>
    <div class="form-group col-md-6 {{ $errors->has('title') ? ' error' : '' }}">
        <label for="title" class="required">Google Play Store Link</label>
        <input type="text" name="title"  class="form-control" placeholder="Google Play Store Link"
                value="{{ old("title") ? old("title") : '' }}" required data-validation-required-message="Enter slider title">
        <div class="help-block"></div>
        @if ($errors->has('title'))
            <div class="help-block">  {{ $errors->first('title') }}</div>
        @endif
    </div>
</div>