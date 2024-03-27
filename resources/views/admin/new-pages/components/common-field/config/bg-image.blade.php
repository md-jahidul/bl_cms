<div class="form-group col-md-4">
    <label for="editor_en">Background Image</label>
    <select name="config[is_bg_image]" class="form-control">
        <option value="yes" {{ isset($component->config['is_bg_image']) && $component->config['is_bg_image'] == "yes" ? 'selected' : '' }}>Yes</option>
        <option value="no" {{ isset($component->config['is_bg_image']) && $component->config['is_bg_image'] == "no" ? 'selected' : '' }}>No</option>
    </select>
</div>
