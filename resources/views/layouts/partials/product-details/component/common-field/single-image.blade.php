<div class="form-group col-md-6">
    <label for="alt_text" class="">Image Field</label>
    <div class="custom-file">
        <input type="file" name="image" class="dropify" data-height="80"
         data-default-file="{{ isset($component->image) ? config('filesystems.file_base_url') . $component->image : '' }}">
        <span class="text-primary">Please given file type (.png, .jpg, svg)</span>
    </div>
</div>

<div class="form-group col-md-6">
    <label for="alt_text">Alt Text</label>
    <input type="text" value="{{ isset($component->alt_text) ? $component->alt_text : '' }}" name="alt_text"  class="form-control">
</div>
