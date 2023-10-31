@php($key ?? 0)
{{--@dd($data)--}}


<slot class="page_component_multi_item">
    @if(isset($component_type) && $component_type == "galley_masonry")
        <div class="col-md-12 col-xs-12 ">
            <div class="form-group">
                <label for="message">Image</label>
                <input type="hidden" name="componentData[{{$key}}][image][value_en]"
                       value="{{ $data['image']['value_en'] ?? '' }}">
                <input type="file" class="dropify" name="componentData[{{$key}}][image][value_en]" data-height="80"
                       {{ isset($data) ? '' : 'required' }}
                       data-default-file="{{ isset($data['image']['value_en']) ? config('filesystems.file_base_url') . $data['image']['value_en'] : '' }}"/>
                <input type="hidden" name="componentData[{{$key}}][image][group]" value="{{ $key + 1 }}">
                <input type="hidden" name="componentData[{{$key}}][image][id]" value="{{ $data['image']['id'] ?? '' }}">
                <span class="text-primary">Please given file type (.png, .jpg, svg)</span>
                <div class="help-block"></div>
            </div>
        </div>
    @else
        <div class="col-md-12 col-xs-12 ">
            <div class="form-group">
                <label for="message">Image</label>
                <input type="hidden" name="componentData[{{$key}}][image][value_en]"
                       value="{{ $data['image']['value_en'] ?? '' }}">
                <input type="file" class="dropify" name="componentData[{{$key}}][image][value_en]" data-height="80"
                       {{ isset($data) ? '' : 'required' }}
                       data-default-file="{{ isset($data['image']['value_en']) ? config('filesystems.file_base_url') . $data['image']['value_en'] : '' }}"/>
                <input type="hidden" name="componentData[{{$key}}][image][group]" value="{{ $key + 1 }}">
                <input type="hidden" name="componentData[{{$key}}][image][id]" value="{{ $data['image']['id'] ?? '' }}">
                <span class="text-primary">Please given file type (.png, .jpg, svg)</span>
                <div class="help-block"></div>
            </div>
        </div>

        @if(isset($component_type) && $component_type == "hovering_card_component")
            <div class="col-md-12 col-xs-5">
                <div class="form-group">
                    <label for="message">Image Hover</label>
                    <input type="hidden" name="componentData[{{$key}}][image_hover][value_en]"
                           value="{{ $data['image_hover']['value_en'] ?? '' }}">
                    <input type="file" class="dropify" name="componentData[{{$key}}][image_hover][value_en]"
                           data-height="80" {{ isset($data) ? '' : 'required' }}
                           data-default-file="{{ isset($data['image_hover']['value_en']) ? config('filesystems.file_base_url') . $data['image_hover']['value_en'] : '' }}"/>
                    <input type="hidden" name="componentData[{{$key}}][image_hover][group]" value="{{ $key + 1 }}">
                    <input type="hidden" name="componentData[{{$key}}][image_hover][id]"
                           value="{{ $data['image_hover']['id'] ?? '' }}">
                    <span class="text-primary">Please given file type (.png, .jpg, svg)</span>
                    <div class="help-block"></div>
                </div>
            </div>
        @endif
        @include('admin.new-pages.components.common-field.multi-item.title')
        @include('admin.new-pages.components.common-field.multi-item.description')
        @include('admin.new-pages.components.common-field.multi-item.redirect-link')
    @endif

    {{--    @dd($data)--}}
    @if(isset($key) && $key == 0)
            <div class="form-group col-md-12">
                <label for="alt_text"></label>
                <button type="button" class="btn-sm btn-outline-secondary block" id="plus-image"><i class="la la-plus">Add More</i></button>
            </div>
    @else
        @php($key+1)
        <div class="form-group col-md-1">
            <label for="alt_text"></label>
            <i class="la la-trash remove-image btn-sm btn-danger" data-com-id="{{ $component->id }}"
               data-group="{{ $data['image']['group'] }}"></i>
        </div>
    @endif
</slot>
