@php
    $buttonOneId = isset($component->component_data_mod[0]['button_one']['id']) ? $component->component_data_mod[0]['button_one']['id'] : null;
    $buttonOneUrlId = isset($component->component_data_mod[0]['button_one_url']['id']) ? $component->component_data_mod[0]['button_one_url']['id'] : null;

    $buttonOneEn = isset($component->component_data_mod[0]['button_one']['value_en']) ? $component->component_data_mod[0]['button_one']['value_en'] : null;
    $buttonOneBn = isset($component->component_data_mod[0]['button_one']['value_bn']) ? $component->component_data_mod[0]['button_one']['value_bn'] : null;
    $buttonOneUrl = isset($component->component_data_mod[0]['button_one_url']['value_en']) ? $component->component_data_mod[0]['button_one_url']['value_en'] : null;

    $buttonTwoId = isset($component->component_data_mod[0]['button_two']['id']) ? $component->component_data_mod[0]['button_two']['id'] : null;
    $buttonTwoUrlId = isset($component->component_data_mod[0]['button_two_url']['id']) ? $component->component_data_mod[0]['button_two_url']['id'] : null;

    $buttonTwoEn = isset($component->component_data_mod[0]['button_two']['value_en']) ? $component->component_data_mod[0]['button_two']['value_en'] : null;
    $buttonTwoBn = isset($component->component_data_mod[0]['button_two']['value_bn']) ? $component->component_data_mod[0]['button_two']['value_bn'] : null;
    $buttonTwoUrl = isset($component->component_data_mod[0]['button_two_url']['value_en']) ? $component->component_data_mod[0]['button_two_url']['value_en'] : null;
@endphp

<div class="form-group col-md-4 {{ $errors->has('button_en') ? ' error' : '' }}">
    <label for="button_en">Button One Title (English)</label>
    <input type="text" name="componentData[0][button_one][value_en]"  class="form-control" placeholder="Enter button name bangla" value="{{ $buttonOneEn }}">
    <input type="hidden" name="componentData[0][button_one][group]" value="1">
    <input type="hidden" name="componentData[0][button_one][id]" value="{{ $buttonOneId }}">
    <div class="help-block"></div>
    @if ($errors->has('button_en'))
        <div class="help-block">  {{ $errors->first('button_en') }}</div>
    @endif
</div>

<div class="form-group col-md-4 {{ $errors->has('button_bn') ? ' error' : '' }}">
    <label for="button_bn" >Button One Title (Bangla)</label>
    <input type="text" name="componentData[0][button_one][value_bn]"  class="form-control" placeholder="Enter button name bangla"
           value="{{ $buttonOneBn }}">
    <input type="hidden" name="componentData[0][button_one][group]" value="1">
    <input type="hidden" name="componentData[0][button_one][id]" value="{{ $buttonOneId }}">
    <div class="help-block"></div>
    @if ($errors->has('button_bn'))
        <div class="help-block">  {{ $errors->first('button_bn') }}</div>
    @endif
</div>

<div class="form-group col-md-4 {{ $errors->has('button_link') ? ' error' : '' }}">
    <label for="button_link" >Button One URL</label>
    <input type="text" name="componentData[0][button_one_url][value_en]"  class="form-control" placeholder="Enter button name bangla"
           value="{{ $buttonOneUrl }}">
    <input type="hidden" name="componentData[0][button_one_url][group]" value="1">
    <input type="hidden" name="componentData[0][button_one_url][id]" value="{{ $buttonOneUrlId }}">
    <div class="help-block"></div>
    @if ($errors->has('button_link'))
        <div class="help-block">  {{ $errors->first('button_link') }}</div>
    @endif
</div>


<div class="form-group col-md-4 {{ $errors->has('button_en') ? ' error' : '' }}">
    <label for="button_en">Button Two Title (English)</label>
    <input type="text" name="componentData[0][button_two][value_en]"  class="form-control" placeholder="Enter button name bangla"
           value="{{ $buttonTwoEn }}">
    <input type="hidden" name="componentData[0][button_two][group]" value="1">
    <input type="hidden" name="componentData[0][button_two][id]" value="{{ $buttonTwoId }}">
    <div class="help-block"></div>
    @if ($errors->has('button_en'))
        <div class="help-block">  {{ $errors->first('button_en') }}</div>
    @endif
</div>

<div class="form-group col-md-4 {{ $errors->has('button_bn') ? ' error' : '' }}">
    <label for="button_bn" >Button Two Title (Bangla)</label>
    <input type="text" name="componentData[0][button_two][value_bn]"  class="form-control" placeholder="Enter button name bangla"
           value="{{ $buttonTwoBn }}">
    <input type="hidden" name="componentData[0][button_two][group]" value="1">
    <input type="hidden" name="componentData[0][button_two][id]" value="{{ $buttonTwoId }}">
    <div class="help-block"></div>
    @if ($errors->has('button_bn'))
        <div class="help-block">  {{ $errors->first('button_bn') }}</div>
    @endif
</div>

<div class="form-group col-md-4 {{ $errors->has('button_link') ? ' error' : '' }}">
    <label for="button_link" >Button Two URL</label>
    <input type="text" name="componentData[0][button_two_url][value_en]"  class="form-control" placeholder="Enter button url bangla"
           value="{{ $buttonTwoUrl }}">
    <input type="hidden" name="componentData[0][button_two_url][group]" value="1">
    <input type="hidden" name="componentData[0][button_two_url][id]" value="{{ $buttonTwoUrlId }}">
    <div class="help-block"></div>
    @if ($errors->has('button_link'))
        <div class="help-block">  {{ $errors->first('button_link') }}</div>
    @endif
</div>

