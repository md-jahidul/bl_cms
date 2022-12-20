
@include('layouts.partials.slider_types.text_area')
@include('layouts.partials.common_types.label_with_url')


<div class="col-md-4">
    <label></label>
    <div class="form-group mt-1">
        <label for="is_external_link" class="mr-1">Is External Link:</label>
        <input type="checkbox" name="other_attributes[is_external_link]" value="1" id="is_external_link" {{ (!empty($other_attributes['is_external_link'])) ? 'checked' : null }}>
    </div>
</div>
