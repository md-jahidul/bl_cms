<div class="form-group col-md-4 {{ $errors->has('redirect_url') ? ' error' : '' }}">
    <label for="redirect_url">redirect_url</label>
    <input type="text" name="other_attributes[redirect_url]"  class="form-control" placeholder="Enter redirect redirect_url"
           value="{{ (!empty($other_attributes['redirect_url'])) ? $other_attributes['redirect_url'] : old("other_attributes.redirect_url") ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('redirect_url'))
        <div class="help-block">  {{ $errors->first('redirect_url') }}</div>
    @endif
</div>
