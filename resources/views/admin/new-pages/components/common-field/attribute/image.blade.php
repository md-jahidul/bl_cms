<div class="form-group col-md-12">
    <label for="alt_text" class="">Image Field</label>
    <div class="custom-file">
        <input type="file" name="attribute[image_file]" class="dropify" data-height="80"
               data-default-file="{{ $component->attribute['image']['en'] ? config('filesystems.file_base_url') . $component->attribute['image']['en'] : null }}">
        <span class="text-primary">Please given file type (.png, .jpg, svg)</span>
    </div>
</div>
