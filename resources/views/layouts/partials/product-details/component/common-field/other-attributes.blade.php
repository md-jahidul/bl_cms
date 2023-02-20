<!--

* User: BS23 (Mehedi Hasan Shuvo)
* Date: 03-01-2023

This blade file is only for others attributes fields. 
You have to pass the other_attributes Array which have key (field name) and value (Label and placeholder) in the time of including this file. See the Example

'other_attributes' => [
    'compl_cld_no' => 'Complaint Closed No (%)',
    'compl_cld_title_en' => 'Complaint Closed Title EN',
    'compl_cld_title_bn' => 'Complaint Closed Title BN',
    'unreached_cust_no' => 'Unreached Customer No (%)',
    'unreached_cust_title_en' => 'Unreached Customer Title EN',
    'unreached_cust_title_bn' => 'Unreached Customer Title BN',
],

-->

@foreach ($other_attributes as $key => $attribute)
    
    <div class="form-group col-md-6 {{ $errors->has($key) ? ' error' : '' }}">
        <label for="{{$key}}">{{ isset($attribute) ? $attribute : "Extra Title (English)" }}</label>
        <input type="text" name="other_attr[{{$key}}]"  class="form-control" placeholder="{{$attribute}}"
        value="{{ isset($component->other_attributes[$key]) ? $component->other_attributes[$key] : '' }}">
        <div class="help-block"></div>
        @if ($errors->has($key))
            <div class="help-block">{{ $errors->first($key) }}</div>
        @endif
    </div>

@endforeach


