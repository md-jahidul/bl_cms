{{--<input id="multi_item_count" type="hidden" name="multi_item_count" value="1">--}}
{{--<div class="col-md-6 col-xs-6">--}}
{{--    <div class="form-group">--}}
{{--        <label for="message">Multiple Image</label>--}}
{{--        <input type="file" class="dropify" name="multi_item[image_url-1]" data-height="80"/>--}}
{{--        <span class="text-primary">Please given file type (.png, .jpg, svg)</span>--}}
{{--    </div>--}}
{{--</div>--}}

{{--<div class="form-group col-md-3">--}}
{{--    <label for="alt_text">Alt Text English</label>--}}
{{--    <input type="text" name="multi_item[alt_text_en-1]" class="form-control">--}}
{{--</div>--}}

{{--<div class="form-group col-md-2">--}}
{{--    <label for="alt_text">Alt Text Bangla</label>--}}
{{--    <input type="text" name="multi_item[alt_text_bn-1]" class="form-control">--}}
{{--</div>--}}

{{--<div class="form-group col-md-1">--}}
{{--    <label for="alt_text"></label>--}}
{{--    <button type="button" class="btn-sm btn-outline-success multi_item_remove mt-2" id="plus-image"><i class="la la-plus"></i></button>--}}
{{--</div>--}}

{{--<div class="form-group col-md-6">--}}
{{--    <label for="alt_text">Image Name English</label>--}}
{{--    <input type="text" name="multi_item[img_name_en-1]" class="form-control">--}}
{{--</div>--}}

{{--<div class="form-group col-md-6">--}}
{{--    <label for="alt_text">Image Name Bangla</label>--}}
{{--    <input type="text" name="multi_item[img_name_bn-1]" class="form-control">--}}
{{--</div>--}}

@php isset($key) ? $key : $key = 0 @endphp

<input type="hidden" name="multi_img_ids[]" value="{{ isset($image['id']) ? $image['id'] : '' }}">
<div class="col-md-6 col-xs-6">
    <input type="hidden" name="base_image[]" value="{{ isset($image['base_image']) ? $image['base_image'] : '' }}">
    <div class="form-group">
        <label for="message">Multiple Image</label>
        <input type="file" class="dropify" name="base_image[]" data-height="80" {{ isset($image) ? '' : 'required' }}
               data-default-file="{{ isset($image['base_image']) ? config('filesystems.file_base_url') . $image['base_image'] : '' }}"/>
        <span class="text-primary">Please given file type (.png, .jpg, svg)</span>
        <div class="help-block"></div>
    </div>
</div>

<div class="form-group col-md-3">
    <label for="alt_text">Alt Text English</label>
    <input type="text" name="multi_alt_text_en[]" class="form-control"
           value="{{ isset($image['alt_text_en']) ? $image['alt_text_en'] : '' }}">
</div>

<div class="form-group col-md-2">
    <label for="alt_text">Alt Text Bangla</label>
    <input type="text" name="multi_alt_text_bn[]" class="form-control"
           value="{{ isset($image['alt_text_bn']) ? $image['alt_text_bn'] : '' }}">
</div>

@if(isset($key) && $key == 0)
    <div class="form-group col-md-1">
        <label for="alt_text"></label>
        <button type="button" class="btn-sm btn-outline-success multi_item_remove mt-2" id="plus-image"><i class="la la-plus"></i></button>
    </div>
@endif

<div class="form-group col-md-6 {{ $errors->has("img_name_en.$key") ? ' error' : '' }}">
    <label for="alt_text" class="required">Image Name English</label>
    <input type="text" name="img_name_en[]" class="form-control img-data slug-convert" required
           value="{{ isset($image['img_name_en']) ? $image['img_name_en'] : '' }}">
    <span class="duplicate-error text-danger"></span>

    <div class="help-block"></div>
    @if ($errors->has("img_name_en.$key"))
        <div class="help-block">  {{ $errors->first("img_name_en.$key") }}</div>
    @endif
</div>

<div class="form-group col-md-6">
    <label for="alt_text" class="required">Image Name Bangla</label>
    <input type="text" name="img_name_bn[]" class="form-control img-data slug-convert" required
           value="{{ isset($image['img_name_bn']) ? $image['img_name_bn'] : '' }}">
    <span class="help-block duplicate-error text-danger"></span>
</div>
