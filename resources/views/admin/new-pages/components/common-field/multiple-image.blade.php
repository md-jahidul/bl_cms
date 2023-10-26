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
<div class="col-md-11 col-xs-12">
    <div class="form-group">
        <label for="message">Image One</label>
        <input type="file" class="dropify" name="componentData[0][image_one][value_en]" data-height="80" {{ isset($image) ? '' : 'required' }}
        data-default-file="{{ isset($image['base_image']) ? config('filesystems.file_base_url') . $image['base_image'] : '' }}"/>
        <input type="hidden" name="componentData[0][image_one][group]" value="1">
        <span class="text-primary">Please given file type (.png, .jpg, svg)</span>
        <div class="help-block"></div>
    </div>
</div>

@if($component_type == "hovering_card_component")
    <div class="col-md-11 col-xs-5">
        <div class="form-group">
            <label for="message">Image Two</label>
            <input type="file" class="dropify" name="componentData[0][image_two][value_en]" data-height="80" {{ isset($image) ? '' : 'required' }}
            data-default-file="{{ isset($image['base_image']) ? config('filesystems.file_base_url') . $image['base_image'] : '' }}"/>
            <input type="hidden" name="componentData[0][image_two][group]" value="1">
            <span class="text-primary">Please given file type (.png, .jpg, svg)</span>
            <div class="help-block"></div>
        </div>
    </div>
@endif



<div class="form-group col-md-6">
    <label for="title_en">Title En</label>
    <input type="text" name="componentData[0][title][value_en]" class="form-control">
    <input type="hidden" name="componentData[0][title][group]" value="1">
</div>

<div class="form-group col-md-5">
    <label for="title_en">Title Bn</label>
    <input type="text" name="componentData[0][title][value_bn]" class="form-control">
    <input type="hidden" name="componentData[0][title][group]" value="1">
</div>

<div class="form-group col-md-6">
    <label for="title_en">Description En</label>
    <textarea type="text" rows="3" name="componentData[0][desc][value_en]" class="form-control"></textarea>
    <input type="hidden" name="componentData[0][desc][group]" value="1">
</div>

<div class="form-group col-md-5">
    <label for="title_en">Description En</label>
    <textarea type="text" rows="3" name="componentData[0][desc][value_bn]" class="form-control"></textarea>
    <input type="hidden" name="componentData[0][desc][group]" value="1">
</div>

<div class="form-group col-md-4 {{ $errors->has('button_en') ? ' error' : '' }}">
    <label for="button_en">Button Title (English)</label>
    <input type="text" name="componentData[0][button][value_en]"  class="form-control" placeholder="Enter company name bangla"
           value="{{ isset($component->button_en) ? $component->button_en : '' }}">
    <input type="hidden" name="componentData[0][button][group]" value="1">
    <div class="help-block"></div>
    @if ($errors->has('button_en'))
        <div class="help-block">  {{ $errors->first('button_en') }}</div>
    @endif
</div>

<div class="form-group col-md-4 {{ $errors->has('button_bn') ? ' error' : '' }}">
    <label for="button_bn" >Button Title (Bangla)</label>
    <input type="text" name="componentData[0][button][value_bn]"  class="form-control" placeholder="Enter company name bangla"
           value="{{ isset($component->button_bn) ? $component->button_bn : '' }}">
    <input type="hidden" name="componentData[0][button][group]" value="1">
    <div class="help-block"></div>
    @if ($errors->has('button_bn'))
        <div class="help-block">  {{ $errors->first('button_bn') }}</div>
    @endif
</div>

<div class="form-group col-md-3 {{ $errors->has('button_link') ? ' error' : '' }}">
    <label for="button_link" >Button URL</label>
    <input type="text" name="componentData[0][button_link][value_en]"  class="form-control" placeholder="Enter company name bangla"
           value="{{ isset($component->button_link) ? $component->button_link : '' }}">
    <input type="hidden" name="componentData[0][button_link][group]" value="1">
    <div class="help-block"></div>
    @if ($errors->has('button_link'))
        <div class="help-block">  {{ $errors->first('button_link') }}</div>
    @endif
</div>

@if(isset($key) && $key == 0)
    <div class="form-group col-md-1">
        <label for="alt_text"></label>
        <button type="button" class="btn-sm btn-outline-success multi_item_remove mt-2" id="plus-image"><i class="la la-plus"></i></button>
    </div>
@endif
