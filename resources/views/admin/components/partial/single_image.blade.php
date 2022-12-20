<div class="form-group col-md-12 {{ $errors->has('image') ? ' error' : '' }}">
    <label for="mobileImg">Image</label>
    <div class="custom-file">
{{--        <input type="hidden" name="image" value="{{ isset($aboutLoyalty->banner_image_url) ? $aboutLoyalty->banner_image_url : '' }}">--}}
        <input type="file" name="image" data-height="90" class="dropify"
               data-default-file="{{ isset($component->image) ? config('filesystems.file_base_url') . $component->image : '' }}">
    </div>
    <span class="text-primary">Please given file type (.png, .jpg)</span>
    <div class="help-block"></div>
    @if ($errors->has('image'))
        <div class="help-block">  {{ $errors->first('image') }}</div>
    @endif
</div>
