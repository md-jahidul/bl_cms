<div class="form-group col-md-6">
    <label for="alt_text" class="">Image Field</label>
    <div class="custom-file">
        <input type="file" name="image" class="dropify" data-height="80"
         data-default-file="{{ isset($component->image) ? config('filesystems.file_base_url') . $component->image : '' }}">
        <span class="text-primary">Please given file type (.png, .jpg, svg)</span>
    </div>
</div>

<div class="form-group col-md-6">
    <label for="alt_text">Alt Text English</label>
    <input type="text" value="{{ isset($component->alt_text) ? $component->alt_text : '' }}" name="alt_text"  class="form-control">
</div>

<div class="form-group col-md-6">
    <label for="alt_text">Alt Text Bangla</label>
    <input type="text" value="{{ isset($component->alt_text_bn) ? $component->alt_text_bn : '' }}" name="alt_text_bn"  class="form-control">
</div>

<div class="form-group col-md-3 {{ $errors->has('image_name_en') ? ' error' : '' }}">
    <label for="image_name_en" class="required">Image Name En</label>
    <input type="text" name="image_name_en" class="form-control section_alt_text slug-convert"
           value="{{ isset($component->image_name_en) ? $component->image_name_en : '' }}" required>
    <div class="help-block"></div>
    @if ($errors->has('image_name_en'))
        <div class="help-block">  {{ $errors->first('image_name_en') }}</div>
    @endif
</div>

<div class="form-group col-md-3 {{ $errors->has('image_name_bn') ? ' error' : '' }}">
    <label for="image_name_bn" class="required">Image Name Bn</label>
    <input type="text" name="image_name_bn" class="form-control section_alt_text slug-convert"
           value="{{ isset($component->image_name_bn) ? $component->image_name_bn : '' }}" required>
    <div class="help-block"></div>
    @if ($errors->has('image_name_bn'))
        <div class="help-block">  {{ $errors->first('image_name_bn') }}</div>
    @endif
</div>
