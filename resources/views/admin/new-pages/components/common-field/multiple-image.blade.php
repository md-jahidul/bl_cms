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

{{--<input type="hidden" name="multi_img_ids[]" value="{{ isset($image['id']) ? $image['id'] : '' }}">--}}
<div class="col-md-6 col-xs-6">

    <div class="form-group">
        <label for="message">First Image</label>
        <input type="file" class="dropify" name="componentData[0][image_one][value_en]" data-height="80" {{ isset($image) ? '' : 'required' }}
        data-default-file="{{ isset($image['base_image']) ? config('filesystems.file_base_url') . $image['base_image'] : '' }}"/>
        <input type="hidden" name="componentData[0][image_one][group]" value="1">
        <span class="text-primary">Please given file type (.png, .jpg, svg)</span>
        <div class="help-block"></div>
    </div>
</div>
<div class="col-md-5 col-xs-5">
    <div class="form-group">
        <label for="message">Second Image</label>
        <input type="file" class="dropify" name="componentData[0][image_two][value_en]" data-height="80" {{ isset($image) ? '' : 'required' }}
        data-default-file="{{ isset($image['base_image']) ? config('filesystems.file_base_url') . $image['base_image'] : '' }}"/>
        <input type="hidden" name="componentData[0][image_two][group]" value="1">
        <span class="text-primary">Please given file type (.png, .jpg, svg)</span>
        <div class="help-block"></div>
    </div>
</div>

<div class="form-group col-md-6">
    <label for="title_en">Title En</label>
    <input type="text" name="componentData[0][title_en][value_en]" class="form-control">
    <input type="hidden" name="componentData[0][title_en][group]" value="1">
</div>

<div class="form-group col-md-5">
    <label for="title_en">Title Bn</label>
    <input type="text" name="componentData[0][title_bn][value_bn]" class="form-control">
    <input type="hidden" name="componentData[0][title_bn][group]" value="1">
</div>

<div class="form-group col-md-6">
    <label for="title_en">Description En</label>
    <textarea type="text" rows="3" name="componentData[0][desc_en][value_en]" class="form-control"></textarea>
    <input type="hidden" name="componentData[0][desc_en][group]" value="1">
</div>

<div class="form-group col-md-5">
    <label for="title_en">Description En</label>
    <textarea type="text" rows="3" name="componentData[0][desc_bn][value_bn]" class="form-control"></textarea>
    <input type="hidden" name="componentData[0][desc_bn][group]" value="1">
</div>

@if(isset($key) && $key == 0)
    <div class="form-group col-md-1">
        <label for="alt_text"></label>
        <button type="button" class="btn-sm btn-outline-success multi_item_remove mt-2" id="plus-image"><i class="la la-plus"></i></button>
    </div>
@endif
