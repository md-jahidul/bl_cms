<div class="form-group col-md-6 {{ $errors->has('icon') ? ' error' : '' }}">
    <label for="mobileImg">Product Image</label>
    <div class="custom-file">
        <input type="file" name="product_image" data-height="90" class="dropify">
        {{--<!-- data-default-file="{{ config('filesystems.file_base_url') . $menu->icon }}"-->>--}}
    </div>
    <div class="help-block"></div>
    @if ($errors->has('icon'))
        <div class="help-block">  {{ $errors->first('icon') }}</div>
    @endif
</div>
