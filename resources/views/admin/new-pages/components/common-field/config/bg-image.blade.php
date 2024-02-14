
{{--@dd($component)--}}
<div class="form-group col-md-4">
    <label for="editor_en">Background Image</label>
    <select name="config[position]" class="form-control">
        <option value="yes" {{ isset($component->config['position']) && $component->config['position'] == "yes" ? 'selected' : '' }}>Yes</option>
        <option value="no" {{ isset($component->config['position']) && $component->config['position'] == "no" ? 'selected' : '' }}>No</option>
    </select>
</div>
