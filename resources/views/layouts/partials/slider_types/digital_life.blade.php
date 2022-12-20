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
@include('layouts.partials.slider_types.app_links')


<div class="col-md-4">
    <label></label>
    <div class="form-group mt-1">
        <label for="is_external_link" class="mr-1">Is External Link:</label>
        <input type="checkbox" name="other_attributes[is_external_link]" value="1" id="is_external_link" {{ (!empty($other_attributes['is_external_link'])) ? 'checked' : null }}>
    </div>
</div>
