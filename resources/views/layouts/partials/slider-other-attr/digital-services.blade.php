<div class="form-group col-md-6 {{ $errors->has('sliding_speed') ? ' error' : '' }}">
    <label for="sliding_speed" class="required">Sliding Speed</label>
    <input type="text" name="other_attributes[sliding_speed]" oninput="this.value =Number(this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1'));"  class="form-control" placeholder="Enter sliding speed (sec)"  min="1" max="300"
            value="{{ (!empty($other_attributes['sliding_speed'])) ? $other_attributes['sliding_speed'] : old("other_attributes.sliding_speed") ?? '' }}"
            required data-validation-required-message="Enter price info">
    <div class="help-block"></div>
    @if ($errors->has('sliding_speed'))
        <div class="help-block">  {{ $errors->first('sliding_speed') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('view_list_btn_text_en') ? ' error' : '' }}">
    <label for="view_list_btn_text_en" class="required">View List Button Label</label>
    <input type="text" name="other_attributes[view_list_btn_text_en]"  class="form-control" placeholder="Enter view list button label"
            value="{{ (!empty($other_attributes['view_list_btn_text_en'])) ? $other_attributes['view_list_btn_text_en'] : old("other_attributes.view_list_btn_text_en") ?? '' }}"
            required data-validation-required-message="Enter view list button label">
    <div class="help-block"></div>
    @if ($errors->has('view_list_btn_text_en'))
        <div class="help-block">  {{ $errors->first('view_list_btn_text_en') }}</div>
    @endif
</div>
<div class="form-group col-md-6 {{ $errors->has('view_list_btn_text_bn') ? ' error' : '' }}">
    <label for="view_list_btn_text_bn" class="required">View List Button Bangla</label>
    <input type="text" name="other_attributes[view_list_btn_text_bn]"  class="form-control" placeholder="Enter view list button label bangla "
            value="{{ (!empty($other_attributes['view_list_btn_text_bn'])) ? $other_attributes['view_list_btn_text_bn'] : old("other_attributes.view_list_btn_text_bn") ?? '' }}"
            required data-validation-required-message="Enter view list button label bangla ">
    <div class="help-block"></div>
    @if ($errors->has('view_list_btn_text_bn'))
        <div class="help-block">  {{ $errors->first('view_list_btn_text_bn') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('view_list_url') ? ' error' : '' }}">
    <label for="view_list_url" class="required">View List Url</label>
    <input type="text" name="other_attributes[view_list_url]"  class="form-control" placeholder="Enter view list url"
           value="{{ (!empty($other_attributes['view_list_url'])) ? $other_attributes['view_list_url'] : old("other_attributes.view_list_url") ?? '' }}"
           required data-validation-required-message="Enter view list url">
    <div class="help-block"></div>
    @if ($errors->has('view_list_url'))
        <div class="help-block">  {{ $errors->first('view_list_url') }}</div>
    @endif
</div>








