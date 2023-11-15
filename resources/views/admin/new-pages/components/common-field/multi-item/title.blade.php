@php
    $fieldNameEn = "";
    $fieldNameBn = "";
    $fieldNameID = "";
    $tabInput = "";

    if (isset($is_tab) && $is_tab) {
        $fieldNameEn .= "componentData[$key][tab_items][$tabIndex][title][value_en]";
        $fieldNameBn .= "componentData[$key][tab_items][$tabIndex][title][value_bn]";
        $fieldNameID .= "componentData[$key][tab_items][$tabIndex][title][id]";
        $tabInput .= '<input type="hidden" name="componentData[' . "$key" . '][title][is_tab]" value="1">';
    }else {
        $fieldNameEn .= "componentData[$key][title][value_en]";
        $fieldNameBn .= "componentData[$key][title][value_bn]";
        $fieldNameID .= "componentData[$key][title][id]";
    }
@endphp

<div class="form-group col-md-6">
    <label for="title_en">Title En</label>
    <input type="text" name="{{ $fieldNameEn }}" class="form-control"
           value="{{ $data['title']['value_en'] ?? '' }}">
{{--    <input type="hidden" name="componentData[{{$key}}][title][group]" value="{{ $key + 1 }}">--}}
    <input type="hidden" name="{{ $fieldNameID }}" value="{{ $data['title']['id'] ?? '' }}">
</div>

<div class="form-group col-md-6">
    <label for="title_en">Title Bn</label>
    <input type="text" name="{{ $fieldNameBn }}" class="form-control"
           value="{{ $data['title']['value_bn'] ?? '' }}">
{{--    <input type="hidden" name="componentData[{{$key}}][title][group]" value="{{ $key + 1 }}">--}}
    <input type="hidden" name="{{ $fieldNameID }}" value="{{ $data['title']['id'] ?? '' }}">
</div>
