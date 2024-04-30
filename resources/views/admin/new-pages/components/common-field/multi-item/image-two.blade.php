<div class="col-md-12 col-xs-5">
    <div class="form-group">
        <label for="message">{{ $label ?? "Image Hover" }}</label>
        <input type="hidden" name="componentData[{{$key}}][{{ $fieldName ?? "image_hover" }}][value_en]"
               value="{{ $data[$fieldName ?? 'image_hover']['value_en'] ?? '' }}">
        <input type="file" class="dropify" name="componentData[{{$key}}][{{ $fieldName ?? "image_hover" }}][value_en]" data-height="80"
               data-default-file="{{ isset($data[$fieldName ?? 'image_hover']['value_en']) ? config('filesystems.file_base_url') . $data[$fieldName ?? 'image_hover']['value_en'] : '' }}"/>
        <input type="hidden" name="componentData[{{$key}}][{{ $fieldName ?? "image_hover" }}][group]" value="{{ $key + 1 }}">
        <input type="hidden" name="componentData[{{$key}}][{{ $fieldName ?? "image_hover" }}][id]"
               value="{{ $data[ $fieldName ?? 'image_hover']['id'] ?? '' }}">
        <span class="text-primary">Please given file type (.png, .jpg, svg)</span>
        <div class="help-block"></div>
    </div>
</div>
