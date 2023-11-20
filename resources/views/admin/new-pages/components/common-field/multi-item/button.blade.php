@php
    $fieldNameEn = "";
    $fieldNameBn = "";
    $fieldNameLink = "";
    $fieldNameID = "";
    $fieldLinkID = "";
    $tabInput = "";

    if (isset($is_tab) && $is_tab) {
        $fieldNameEn .= "componentData[$key][tab_items][$tabIndex][button_name][value_en]";
        $fieldNameBn .= "componentData[$key][tab_items][$tabIndex][button_name][value_bn]";
        $fieldNameLink .= "componentData[$key][tab_items][$tabIndex][button_link][value_en]";
        $fieldNameID .= "componentData[$key][tab_items][$tabIndex][button_name][id]";
        $fieldLinkID .= "componentData[$key][tab_items][$tabIndex][button_link][id]";
        $tabInput .= '<input type="hidden" name="componentData[' . "$key" . '][title][is_tab]" value="1">';
    }else {
        $fieldNameEn .= "componentData[$key][button_name][value_en]";
        $fieldNameBn .= "componentData[$key][button_name][value_bn]";
        $fieldNameLink .= "componentData[$key][button_link][value_en]";
        $fieldNameID .= "componentData[$key][button_name][id]";
        $fieldLinkID .= "componentData[$key][button_link][id]";
    }
@endphp

<div class="form-group col-md-4 {{ $errors->has('button_en') ? ' error' : '' }}">
    <label for="button_en">Button Title (English)</label>
    {!! $tabInput !!}
    <input type="text" name="{{ $fieldNameEn }}"  class="form-control" placeholder="Enter company name bangla"
           value="{{ $data['button_name']['value_en'] ?? '' }}">
{{--    <input type="hidden" name="componentData[{{$key}}][button_name][group]" value="{{ $key + 1 }}">--}}
    <input type="hidden" name="{{ $fieldNameID }}" value="{{ $data['button_name']['id'] ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('button_en'))
        <div class="help-block">  {{ $errors->first('button_en') }}</div>
    @endif
</div>

<div class="form-group col-md-4 {{ $errors->has('button_bn') ? ' error' : '' }}">
    <label for="button_bn" >Button Title (Bangla)</label>
    <input type="text" name="{{ $fieldNameBn }}"  class="form-control" placeholder="Enter company name bangla"
           value="{{ $data['button_name']['value_bn'] ?? '' }}">
{{--    <input type="hidden" name="componentData[{{$key}}][button_name][group]" value="{{ $key + 1 }}">--}}
    <input type="hidden" name="{{ $fieldNameID }}" value="{{ $data['button_name']['id'] ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('button_bn'))
        <div class="help-block">  {{ $errors->first('button_bn') }}</div>
    @endif
</div>

<div class="form-group col-md-4 {{ $errors->has('button_link') ? ' error' : '' }}">
    <label for="button_link" >Button URL</label>
    <input type="text" name="{{ $fieldNameLink }}"  class="form-control" placeholder="Enter company name bangla"
           value="{{ $data['button_link']['value_en'] ?? '' }}">
{{--    <input type="hidden" name="componentData[{{$key}}][button_link][group]" value="{{ $key + 1 }}">--}}
    <input type="hidden" name="{{ $fieldLinkID }}" value="{{ $data['button_link']['id'] ?? '' }}">
    <div class="help-block"></div>
    @if ($errors->has('button_link'))
        <div class="help-block">  {{ $errors->first('button_link') }}</div>
    @endif
</div>
