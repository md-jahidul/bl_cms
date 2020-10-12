<div class="form-group col-md-6">
    <label for="alt_text" class="">Image Field</label>
    <div class="custom-file">
        <input type="file" name="multiple_attributes[image]" class="dropify" data-height="80"
               data-default-file="{{ isset($multipleItem['image']) ? config('filesystems.file_base_url') . $multipleItem['image'] : '' }}">
        <span class="text-primary">Please given file type (.png, .jpg, svg)</span>
    </div>
</div>

<div class="form-group col-md-6">
    <label for="alt_text">Alt Text</label>
    <input type="text" value="{{ isset($multipleItem['alt_text']) ? $multipleItem['alt_text'] : '' }}"
           name="multiple_attributes[alt_text]" class="form-control">
</div>
