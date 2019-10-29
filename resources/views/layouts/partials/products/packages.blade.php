<div class="form-group col-md-6 {{ $errors->has('view_list_btn_text_bn') ? ' error' : '' }}">
    <label for="view_list_btn_text_bn" class="required">Call Rate</label>
    <input type="text" name="offer_info[callrate_offer]"  class="form-control" placeholder="Enter view list button label bangla "
           value="{{ (!empty($other_attributes['view_list_btn_text_bn'])) ? $other_attributes['view_list_btn_text_bn'] : old("other_attributes.view_list_btn_text_bn") ?? '' }}"
           required data-validation-required-message="Enter view list button label bangla ">
    <div class="help-block"></div>
    @if ($errors->has('view_list_btn_text_bn'))
        <div class="help-block">  {{ $errors->first('view_list_btn_text_bn') }}</div>
    @endif
</div>

<div class="form-group col-md-6 {{ $errors->has('sms_rate_offer') ? ' error' : '' }}">
    <label for="sms_rate_offer" class="required">SMS Rate</label>
    <input type="text" name="offer_info[sms_rate_offer]"  class="form-control" placeholder="Enter view list url"
           value="{{ (!empty($other_attributes['sms_rate_offer'])) ? $other_attributes['sms_rate_offer'] : old("offer_info.sms_rate_offer") ?? '' }}"
           required data-validation-required-message="Enter view list url">
    <div class="help-block"></div>
    @if ($errors->has('sms_rate_offer'))
        <div class="help-block">  {{ $errors->first('sms_rate_offer') }}</div>
    @endif
</div>
