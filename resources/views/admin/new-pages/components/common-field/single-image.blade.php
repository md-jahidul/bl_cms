

@php
    $image = isset($component->component_data_mod[0]['image_one']['value_en']) ? $component->component_data_mod[0]['image_one']['value_en'] : null;
    $imageId = isset($component->component_data_mod[0]['image_one']['id']) ? $component->component_data_mod[0]['image_one']['id'] : null;
@endphp

<div class="form-group col-md-12">
    <label for="alt_text" class="">Image Field</label>
    <div class="custom-file">
        <input type="hidden" name="componentData[0][image_one][value_en]" value="{{ $image }}">
        <input type="file" name="componentData[0][image_one][value_en]" class="dropify" data-height="80"
               data-default-file="{{ $image ? config('filesystems.file_base_url') . $image : null }}">
        <input type="hidden" name="componentData[0][image_one][group]" value="1">
        <input type="hidden" name="componentData[0][image_one][id]" value="{{ $imageId }}">
        <span class="text-primary">Please given file type (.png, .jpg, svg)</span>
    </div>
</div>
