@if( !empty($ecarrer_item->additional_info) )
    @php $additional_info = json_decode($ecarrer_item->additional_info); @endphp
@endif

<div class="form-group col-md-6 {{ $errors->has('university_bn') ? ' error' : '' }}">
    <label for="university_bn" class="required1">University Name (English)</label>
    <input type="text" name="additional_info[testimonial_info][university_en]" class="form-control" placeholder="Enter university name" 
           value="{{ (isset($additional_info->testimonial_info->university_en)) ? $additional_info->testimonial_info->university_en : '' }}"
           data-validation-required-message="Enter slider info">
    <div class="help-block"><small></small></div>
    @if ($errors->has('university_en'))
        <div class="help-block">  {{ $errors->first('university_en') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('university_bn') ? ' error' : '' }}">
    <label for="university_bn" class="required1">University Name (Bangla)</label>
    <input type="text" name="additional_info[testimonial_info][university_bn]" class="form-control" placeholder="Enter university name" 
           value="{{ (isset($additional_info->testimonial_info->university_bn)) ? $additional_info->testimonial_info->university_bn : '' }}"
           data-validation-required-message="Enter slider info">
    <div class="help-block"><small></small></div>
    @if ($errors->has('university_bn'))
        <div class="help-block">  {{ $errors->first('university_bn') }}</div>
    @endif
</div>


