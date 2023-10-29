@php($key ?? 0)

<slot class="options-count">
    <input type="hidden" name="old_com_id[]" value="{{ $data['image_one']['id'] ?? '' }}">
    <input type="hidden" name="old_com_id[]" value="{{ $data['image_two']['id'] ?? '' }}">
    <input type="hidden" name="old_com_id[]" value="{{ $data['title']['id'] ?? '' }}">
    <input type="hidden" name="old_com_id[]" value="{{ $data['desc']['id'] ?? '' }}">
    <input type="hidden" name="old_com_id[]" value="{{ $data['button']['id'] ?? '' }}">
    <input type="hidden" name="old_com_id[]" value="{{ $data['button_link']['id'] ?? '' }}">

    @if(isset($component_type) && $component_type == "galley_masonry")
        <div class="col-md-11 col-xs-12 ">
            <div class="form-group">
                <label for="message">Image One</label>
                <input type="hidden" name="componentData[{{$key}}][image_one][value_en]" value="{{ $data['image_one']['value_en'] ?? '' }}">
                <input type="file" class="dropify" name="componentData[{{$key}}][image_one][value_en]" data-height="80" {{ isset($data) ? '' : 'required' }}
                data-default-file="{{ isset($data['image_one']['value_en']) ? config('filesystems.file_base_url') . $data['image_one']['value_en'] : '' }}"/>
                <input type="hidden" name="componentData[{{$key}}][image_one][group]" value="{{ $key + 1 }}">
                <input type="hidden" name="componentData[{{$key}}][image_one][id]" value="{{ $data['image_one']['id'] ?? '' }}">
                <span class="text-primary">Please given file type (.png, .jpg, svg)</span>
                <div class="help-block"></div>
            </div>
        </div>
    @else
        <div class="col-md-11 col-xs-12 ">
            <div class="form-group">
                <label for="message">Image One</label>
                <input type="hidden" name="componentData[{{$key}}][image_one][value_en]" value="{{ $data['image_one']['value_en'] ?? '' }}">
                <input type="file" class="dropify" name="componentData[{{$key}}][image_one][value_en]" data-height="80" {{ isset($data) ? '' : 'required' }}
                data-default-file="{{ isset($data['image_one']['value_en']) ? config('filesystems.file_base_url') . $data['image_one']['value_en'] : '' }}"/>
                <input type="hidden" name="componentData[{{$key}}][image_one][group]" value="{{ $key + 1 }}">
                <input type="hidden" name="componentData[{{$key}}][image_one][id]" value="{{ $data['image_one']['id'] ?? '' }}">
                <span class="text-primary">Please given file type (.png, .jpg, svg)</span>
                <div class="help-block"></div>
            </div>
        </div>

        @if(isset($component_type) && $component_type == "hovering_card_component")
            <div class="col-md-11 col-xs-5">
                <div class="form-group">
                    <label for="message">Image Two</label>
                    <input type="hidden" name="componentData[{{$key}}][image_two][value_en]" value="{{ $data['image_two']['value_en'] ?? '' }}">
                    <input type="file" class="dropify" name="componentData[{{$key}}][image_two][value_en]" data-height="80" {{ isset($data) ? '' : 'required' }}
                    data-default-file="{{ isset($data['image_two']['value_en']) ? config('filesystems.file_base_url') . $data['image_two']['value_en'] : '' }}"/>
                    <input type="hidden" name="componentData[{{$key}}][image_two][group]" value="{{ $key + 1 }}">
                    <input type="hidden" name="componentData[{{$key}}][image_two][id]" value="{{ $data['image_two']['id'] ?? '' }}">
                    <span class="text-primary">Please given file type (.png, .jpg, svg)</span>
                    <div class="help-block"></div>
                </div>
            </div>
        @endif
        <div class="form-group col-md-6">
            <label for="title_en">Title En</label>
            <input type="text" name="componentData[{{$key}}][title][value_en]" class="form-control"
                   value="{{ $data['title']['value_en'] ?? '' }}">
            <input type="hidden" name="componentData[{{$key}}][title][group]" value="{{ $key + 1 }}">
            <input type="hidden" name="componentData[{{$key}}][title][id]" value="{{ $data['title']['id'] ?? '' }}">
        </div>

        <div class="form-group col-md-5">
            <label for="title_en">Title Bn</label>
            <input type="text" name="componentData[{{$key}}][title][value_bn]" class="form-control"
                   value="{{ $data['title']['value_en'] ?? '' }}">
            <input type="hidden" name="componentData[{{$key}}][title][group]" value="{{ $key + 1 }}">
            <input type="hidden" name="componentData[{{$key}}][title][id]" value="{{ $data['title']['id'] ?? '' }}">
        </div>

        <div class="form-group col-md-6">
            <label for="title_en">Description En</label>
            <textarea type="text" rows="3" name="componentData[{{$key}}][desc][value_en]" class="form-control">{{ $data['desc']['value_en'] ?? '' }}</textarea>
            <input type="hidden" name="componentData[{{$key}}][desc][group]" value="{{ $key + 1 }}">
            <input type="hidden" name="componentData[{{$key}}][desc][id]" value="{{ $data['desc']['id'] ?? '' }}">
        </div>

        <div class="form-group col-md-5">
            <label for="title_en">Description Bn</label>
            <textarea type="text" rows="3" name="componentData[{{$key}}][desc][value_bn]" class="form-control">{{ $data['desc']['value_bn'] ?? '' }}</textarea>
            <input type="hidden" name="componentData[{{$key}}][desc][group]" value="{{ $key + 1 }}">
            <input type="hidden" name="componentData[{{$key}}][desc][id]" value="{{ $data['desc']['id'] ?? '' }}">
        </div>

        <div class="form-group col-md-4 {{ $errors->has('button_en') ? ' error' : '' }}">
            <label for="button_en">Button Title (English)</label>
            <input type="text" name="componentData[{{$key}}][button][value_en]"  class="form-control" placeholder="Enter company name bangla"
                   value="{{ $data['button']['value_en'] ?? '' }}">
            <input type="hidden" name="componentData[{{$key}}][button][group]" value="{{ $key + 1 }}">
            <input type="hidden" name="componentData[{{$key}}][button][id]" value="{{ $data['button']['id'] ?? '' }}">
            <div class="help-block"></div>
            @if ($errors->has('button_en'))
                <div class="help-block">  {{ $errors->first('button_en') }}</div>
            @endif
        </div>

        <div class="form-group col-md-4 {{ $errors->has('button_bn') ? ' error' : '' }}">
            <label for="button_bn" >Button Title (Bangla)</label>
            <input type="text" name="componentData[{{$key}}][button][value_bn]"  class="form-control" placeholder="Enter company name bangla"
                   value="{{ $data['button']['value_bn'] ?? '' }}">
            <input type="hidden" name="componentData[{{$key}}][button][group]" value="{{ $key + 1 }}">
            <input type="hidden" name="componentData[{{$key}}][button][id]" value="{{ $data['button']['id'] ?? '' }}">
            <div class="help-block"></div>
            @if ($errors->has('button_bn'))
                <div class="help-block">  {{ $errors->first('button_bn') }}</div>
            @endif
        </div>

        <div class="form-group col-md-3 {{ $errors->has('button_link') ? ' error' : '' }}">
            <label for="button_link" >Button URL</label>
            <input type="text" name="componentData[{{$key}}][button_link][value_en]"  class="form-control" placeholder="Enter company name bangla"
                   value="{{ $data['button_link']['value_en'] ?? '' }}">
            <input type="hidden" name="componentData[{{$key}}][button_link][group]" value="{{ $key + 1 }}">
            <input type="hidden" name="componentData[{{$key}}][button_link][id]" value="{{ $data['button_link']['id'] ?? '' }}">
            <div class="help-block"></div>
            @if ($errors->has('button_link'))
                <div class="help-block">  {{ $errors->first('button_link') }}</div>
            @endif
        </div>
    @endif

{{--    @dd($data)--}}
    @if(isset($key) && $key == 0)
        <div class="form-group col-md-1">
            <label for="alt_text"></label>
            <button type="button" class="btn-sm btn-outline-success mt-2" id="plus-image"><i class="la la-plus"></i></button>
        </div>
    @else
        @php($key+1)
        <div class="form-group col-md-1">
            <label for="alt_text"></label>
            <i class="la la-trash remove-image btn-sm btn-danger mt-2" data-com-id="{{ $component->id }}" data-group="{{ $data['image_one']['group'] }}"></i>
        </div>
    @endif
</slot>
