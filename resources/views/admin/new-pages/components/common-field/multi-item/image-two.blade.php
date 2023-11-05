<div class="col-md-12 col-xs-5">
    <div class="form-group">
        <label for="message">Image Hover</label>
        <input type="hidden" name="componentData[{{$key}}][image_hover][value_en]"
               value="{{ $data['image_hover']['value_en'] ?? '' }}">
        <input type="file" class="dropify" name="componentData[{{$key}}][image_hover][value_en]"
               data-height="80" {{ isset($data) ? '' : 'required' }}
               data-default-file="{{ isset($data['image_hover']['value_en']) ? config('filesystems.file_base_url') . $data['image_hover']['value_en'] : '' }}"/>
        <input type="hidden" name="componentData[{{$key}}][image_hover][group]" value="{{ $key + 1 }}">
        <input type="hidden" name="componentData[{{$key}}][image_hover][id]"
               value="{{ $data['image_hover']['id'] ?? '' }}">
        <span class="text-primary">Please given file type (.png, .jpg, svg)</span>
        <div class="help-block"></div>
    </div>
</div>
