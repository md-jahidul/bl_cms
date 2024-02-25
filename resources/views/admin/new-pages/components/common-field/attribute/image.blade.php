<div class="form-group col-md-12">
    <label for="alt_text" class="">{{ $label ?? "Image" }}</label>
    <div class="custom-file">
        <input type="file" name="attribute[{{ $fieldName ?? 'image_file' }}]" class="dropify" data-height="80"
               data-default-file="{{ isset($component->attribute[$dataField ?? 'image']['en']) ? config('filesystems.file_base_url') . $component->attribute[$dataField ?? 'image']['en'] : null }}">
        <span class="text-primary">Please given file type (.png, .jpg, svg)</span>
    </div>
</div>
