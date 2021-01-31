<div class="form-group col-md-6">
    <label for="alt_text" class="">Image Field</label>
    <div class="custom-file">
        <input type="file" name="single_base_image" class="dropify" data-height="80"
               data-default-file="{{ isset($component['single_base_image']) ? config('filesystems.file_base_url') . $component['single_base_image'] : '' }}">
        <span class="text-primary">Please given file type (.png, .jpg, svg)</span>
    </div>
</div>

<div class="form-group col-md-3">
    <label for="alt_text">Alt Text English</label>
    <input type="text" value="{{ isset($component['single_alt_text_en']) ? $component['single_alt_text_en'] : '' }}"
           name="single_alt_text_en" class="form-control">
</div>

<div class="form-group col-md-3">
    <label for="alt_text">Alt Text Bangla</label>
    <input type="text" value="{{ isset($component['single_alt_text_bn']) ? $component['single_alt_text_bn'] : '' }}"
           name="single_alt_text_bn" class="form-control">
</div>

<div class="form-group col-md-6">
    <label for="alt_text">Image Name English</label>
    <input type="text" value="{{ isset($component['single_image_name_en']) ? $component['single_image_name_en'] : '' }}"
           name="single_image_name_en" class="form-control slug-convert">
</div>

<div class="form-group col-md-6">
    <label for="alt_text">Image Name Bangla</label>
    <input type="text" value="{{ isset($component['single_image_name_bn']) ? $component['single_image_name_bn'] : '' }}"
           name="single_image_name_bn" class="form-control slug-convert">
</div>

