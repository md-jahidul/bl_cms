@php
    $fieldNameEn = "";
    $fieldNameBn = "";
    $fieldNameID = "";
    $tabInput = "";

    if (isset($is_tab) && $is_tab) {
        $fieldNameEn .= "componentData[$key][tab_items][$tabIndex][desc][value_en]";
        $fieldNameBn .= "componentData[$key][tab_items][$tabIndex][desc][value_bn]";
        $fieldNameID .= "componentData[$key][tab_items][$tabIndex][desc][id]";
        $tabInput .= '<input type="hidden" name="componentData[' . "$key" . '][title][is_tab]" value="1">';
    }else {
        $fieldNameEn .= "componentData[$key][desc][value_en]";
        $fieldNameBn .= "componentData[$key][desc][value_bn]";
        $fieldNameID .= "componentData[$key][desc][id]";
    }
@endphp

<div class="form-group col-md-6">
    {!! $tabInput !!}
    <label for="desc">Description En</label>
    <textarea type="text" rows="3" name="{{ $fieldNameEn }}" class="form-control {{ isset($is_editor) && $is_editor ? 'summernote_editor' : '' }}">{{ $data['desc']['value_en'] ?? '' }}</textarea>
{{--    <input type="hidden" name="componentData[{{$key}}][desc][group]" value="{{ $key + 1 }}">--}}
    <input type="hidden" name="{{ $fieldNameID }}" value="{{ $data['desc']['id'] ?? '' }}">
</div>

<div class="form-group col-md-6">
    <label for="desc">Description Bn</label>
    <textarea type="text" rows="3" name="{{ $fieldNameBn }}" class="form-control {{ isset($is_editor) && $is_editor ? 'summernote_editor' : '' }}">{{ $data['desc']['value_bn'] ?? '' }}</textarea>
{{--    <input type="hidden" name="componentData[{{$key}}][desc][group]" value="{{ $key + 1 }}">--}}
    <input type="hidden" name="{{ $fieldNameID }}" value="{{ $data['desc']['id'] ?? '' }}">
</div>
