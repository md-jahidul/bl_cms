<div class="col-md-12 col-xs-12 ">
    <div class="form-group">
        <label for="message">Image</label>
        <input type="hidden" name="componentData[{{$key}}][image][value_en]"
               value="{{ $data['image']['value_en'] ?? '' }}">
        <input type="file" class="dropify" name="componentData[{{$key}}][image][value_en]" data-height="80"
               {{ isset($data) ? '' : 'required' }}
               data-default-file="{{ isset($data['image']['value_en']) ? config('filesystems.file_base_url') . $data['image']['value_en'] : '' }}"/>
        <input type="hidden" name="componentData[{{$key}}][image][group]" value="{{ $key + 1 }}">
        <input type="hidden" name="componentData[{{$key}}][image][id]" value="{{ $data['image']['id'] ?? '' }}">
        <span class="text-primary">Please given file type (.png, .jpg, svg)</span>
        <div class="help-block"></div>
    </div>
</div>
