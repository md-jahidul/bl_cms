@php
    if (!empty($tabItemData)){
        $data = $tabItemData;
    }
    $fieldName = "";
    $fieldNameGroup = "";
    $imageId = "";
    $tabInput = "";

    if (isset($is_tab) && $is_tab) {
        $fieldName .= "componentData[$key][tab_items][$tabIndex][image][value_en]";
        $fieldNameGroup .= "componentData[$key][tab_items][$tabIndex][image][group]";
        $imageId .= "componentData[$key][tab_items][$tabIndex][image][id]";
        $tabInput .= '<input type="hidden" name="componentData[' . "$key" . '][title][is_tab]" value="1">';
    }else {
        $fieldName .= "componentData[$key][image][value_en]";
        $fieldNameGroup .= "componentData[$key][image][group]";
        $imageId .= "componentData[$key][image][id]";
    }
@endphp

<div class="col-md-12 col-xs-12 ">
    <div class="form-group">
        {!! $tabInput !!}
        <label for="message">Image</label>
        <input type="hidden" name="{{ $fieldName }}" value="{{ isset($data['image']['value_en']) ? $data['image']['value_en'] : '' }}">
        <input type="file" class="dropify" name="{{$fieldName}}" data-height="80"
               data-default-file="{{ isset($data['image']['value_en']) ? config('filesystems.file_base_url') . $data['image']['value_en'] : '' }}"/>
        <input type="hidden" name="{{ $fieldNameGroup }}" value="{{ $key + 1 }}">
        <input type="hidden" name="{{ $imageId }}" value="{{ isset($data['image']['id']) ? $data['image']['id'] : '' }}">
        <span class="text-primary">Please given file type (.png, .jpg, svg)</span>
        <div class="help-block"></div>
    </div>
</div>
